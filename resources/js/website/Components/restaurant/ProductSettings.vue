<template>
    <div class="product-config-container p-4" :class="{ 'active': isActive }" @click="(e) => this.closePS(e)"
        v-if="isActive">
        <div class="card rounded-2 settings-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">{{ product.name }}</h5>
                <h5 class="m-0">{{ this.calculatePrice() }} €</h5>
                <i class="bi bi-x-circle text-danger fs-4" role="button" data-type="close"
                    @click="(e) => this.closePS(e)"></i>
            </div>
            <div class="card-body">
                <!-- Size -->
                <h2>Size</h2>
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" :id="this.setInputName('norm_size')"
                                @change="(e) => this.setSize(product.price_norm, 'norm')" value="norm"
                                :checked="this.settings.size == 'norm'">
                            <label class="form-check-label" :for="this.setInputName('norm_size')">
                                Norm.
                                <small class="fw-bold">({{ product.price_norm }}€)</small>
                            </label>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="form-check" v-if="product.price_perhe">
                            <input class="form-check-input" type="radio" :id="this.setInputName('perhe_size')"
                                @change="(e) => this.setSize(product.price_perhe, 'perhe')"
                                :checked="this.settings.size == 'perhe'">
                            <label class="form-check-label" :for="this.setInputName('perhe_size')">
                                Perhe
                                <small class="fw-bold">({{ product.price_perhe }}€)</small>
                            </label>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="form-check" v-if="product.price_pannu">
                            <input class="form-check-input" type="radio" :id="this.setInputName('pannu_size')"
                                @change="(e) => this.setSize(product.price_pannu, 'pannu')"
                                :checked="this.settings.size == 'pannu'">
                            <label class="form-check-label" :for="this.setInputName('pannu_size')">
                                Pannu
                                <small class="fw-bold">({{ product.price_pannu }}€)</small>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Extras -->
                <hr v-if="Object.entries(this.extras).length" />
                <div v-if="Object.entries(this.extras).length">
                    <div class="card-text fw-bold">
                        <h2>Extras</h2>

                        <div class="form-check form-check-inline" v-for="extra in this.extras"
                            :key="'product-' + product.id + '-extra-' + extra.id">
                            <input class="form-check-input" type="checkbox"
                                :id="this.setInputName('product-' + product.id + '-extra-' + extra.id)"
                                @change="(e) => this.setExtra(extra.price, extra.name)"
                                :checked="this.extraExist(extra.name)">
                            <label class="form-check-label"
                                :for="this.setInputName('product-' + product.id + '-extra-' + extra.id)">
                                {{ extra.name }}
                                <small v-if="extra.price">({{ extra.price }} €)</small>
                            </label>
                        </div>
                    </div>
                </div>
                <hr v-if="Object.entries(this.extras).length" />

                <!-- Additional informations -->
                <h2>Additional informations</h2>

                <textarea v-model="additionalInformations" rows="5" id="additionalInformations"
                    class="form-control"></textarea>
                <hr>

                <!-- Quantity -->
                <h2>Quantity</h2>
                <i class="bi bi-dash-circle text-danger fs-4" role="button" @click="this.updateQuantity(false)"></i>
                <span class="mx-2 fs-4">{{ quantity }}</span>
                <i class="bi bi-plus-circle text-success fs-4" role="button" @click="this.updateQuantity()"></i>
            </div>

            <div class=" card-footer p-0">
                <button class="btn btn-primary text-white d-block w-100 rounded-0" @click="this.addToCart()"
                    v-if="!updateBtn">
                    Add to cart
                </button>
                <button class="btn btn-primary text-white d-block w-100 rounded-0" @click="this.updateCart()" v-else>
                    Update
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        errors: Object,
        isActive: Boolean,
        product: {
            type: [Object, null, String]
        },
        cartItem: {
            type: [Object, null, String]
        }
    },
    watch: {
        isActive() {
            if (this.isActive) {
                this.initSettings()
            }
        }
    },
    data() {
        return {
            settings: {},
            quantity: 1,
            extras: {},
            additionalInformations: null,
            updateBtn: false,
            price: 0
        }
    },
    mounted() {
        this.initSettings()
    },
    unmounted() {
        this.reset()
    },
    computed: {
    },
    methods: {
        reset() {
            this.settings = {
                price: 0,
                size: null,
                extras: {},
            }
            this.quantity = 1
            this.extras = {}
            this.additionalInformations = null
            this.calculatePrice()
            this.$emit('psUnmounted')
        },
        updateQuantity(add = true) {
            if (this.quantity) {
                if (!add) {
                    if (this.quantity > 1) {
                        this.quantity--
                    }
                } else {
                    this.quantity = this.quantity + 1
                }
            }
            this.calculatePrice()
        },
        closePS(e) {
            if (e.target.classList.contains('product-config-container', 'active') || e.target.dataset.type == 'close') {
                this.$emit('closePS')
            }
        },
        setSize(price, size) {
            this.settings.size = size
            this.settings.price = price
            this.calculatePrice()
        },
        setExtra(price, name) {
            if (this.extraExist(name)) {
                delete this.settings.extras[name]
            } else {
                this.settings.extras[name] = price
            }
            this.calculatePrice()
        },
        extraExist(name) {
            return + (this.settings.extras[name] !== undefined && this.settings.extras[name] !== null)
        },
        calculatePrice() {
            let price = isNaN(Number(this.settings.price)) && Number(this.settings.price) !== undefined ? Number(this.product.price_norm) : Number(this.settings.price)
            for (const key in this.settings.extras) {
                if (Object.hasOwnProperty.call(this.settings.extras, key)) {
                    price += Number(this.settings.extras[key]);
                }
            }
            return (price * this.quantity).toFixed(2)
        },
        initSettings() {
            if (Object.entries(this.cartItem).length) {
                this.updateBtn = true
                this.extras = this.product.extras
                this.setSize(this.cartItem.options.price, this.cartItem.options.size)
                this.quantity = this.cartItem.quantity
                this.additionalInformations = this.cartItem.extra_info.additional_informations
                this.settings.extras = {}
                for (const key in this.cartItem.options.extras) {
                    if (Object.hasOwnProperty.call(this.cartItem.options.extras, key)) {
                        const price = this.cartItem.options.extras[key];
                        this.setExtra(price, key)
                    }
                }
                this.calculatePrice()
            } else {
                this.updateBtn = false
                this.extras = this.product.extras
                this.setSize(this.product.price_norm, 'norm')
                this.psActive = false
                this.currentTab = false
                this.settings = {}
                this.settings['size'] = "norm"
                this.settings['price'] = this.product.price_norm
                this.settings['extras'] = {}
                this.quantity = 1
                this.additionalInformations = null
            }
        },
        addToCart() {
            this.$emit('addToCart', {
                settings: this.settings,
                quantity: this.quantity,
                additionalInformations: this.additionalInformations
            })
        },
        updateCart() {
            this.$emit('updateCartItem', {
                item_hash: this.cartItem.hash,
                settings: this.settings,
                quantity: this.quantity,
                additionalInformations: this.additionalInformations
            })
        },
        setInputName(name) {
            if (this.updateBtn) {
                return name + '-update'
            }
            return name
        }
    }
}
</script>
<style>
.product-config-container {
    opacity: 0;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: -1000;
    background-color: rgba(0, 0, 0, .3);
    transform: translateY(0);
    transition: .3s ease-in-out;
}

.product-config-container.active {
    opacity: 1;
    z-index: 1031;
}

.settings-card {
    position: sticky;
    top: 0;
    transform: translateY(-100vh);
    width: 50%;
    margin: 0 auto;
    height: 100%;
    overflow-y: auto;
    z-index: 30;
    transition: .5s ease-in-out;
}

.product-config-container.active .settings-card {
    transform: translateY(0);
}

@media screen and (max-width: 780px) {
    .product-config-container {
        padding: 0 !important;
        height: 100%;
    }

    .settings-card {
        width: 100%;
    }
}
</style>
