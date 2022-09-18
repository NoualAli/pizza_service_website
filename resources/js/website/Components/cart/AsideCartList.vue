<template>
    <div class="card rounded-0 d-lg-block is-sticky" id="asideCartList">
        <div class="card-header d-flex flex-row justify-content-between align-items-center">
            <h3>
                Cart
                <small v-if="Object.entries(this.items).length" class="text-muted fs-6">
                    Total items: {{ this.cart.quantities_sum }}
                </small>
            </h3>
            <i class="bi bi-eye text-primary fs-4" role="button" @click="this.redirect()"
                v-if="showLink && Object.entries(this.items).length"></i>
        </div>
        <div class="card-body">
            <div class="list-group list-group-flush" v-if="Object.entries(this.items).length">
                <div class="list-group-item" v-for="item in this.items" :key="item.id">
                    <CartRow :rowUpdate="rowUpdate" @itemDeleted="this.itemDeleted" @itemUpdated="this.itemUpdated"
                        :item="item" @psOpened="this.openPS" />
                </div>
            </div>
            <p class="text-muted" v-else>Your cart is empty</p>
        </div>
        <div class="card-footer" v-if="Object.entries(this.items).length">
            <small class="d-flex justify-content-between align-items-center">
                <b>Subtotal</b>
                <div>{{ subtotal }} €</div>
            </small>
            <hr class="my-2" />
            <small class="d-flex justify-content-between align-items-center">
                <b>VAT tax (14%)</b>
                <div>{{ tax }} €</div>
            </small>
            <hr class="my-2" />
            <small class="d-flex justify-content-between align-items-center">
                <b>Delivery fee</b>
                <div>{{ deliveryFee }} €</div>
            </small>
            <hr class="my-2" />
            <small class="d-flex justify-content-between align-items-center">
                <b>Total</b>
                <div>{{ total }} €</div>
            </small>
        </div>
    </div>
</template>

<script>
import { url } from '../../Helpers/main'
import CartRow from './CartRow'
export default {
    components: { CartRow },
    props: {
        shouldUpdate: Boolean,
        showLink: Boolean,
        rowUpdate: Boolean,
    },
    data() {
        return {
            items: [],
            total: null,
            subtotal: null,
            cart: null,
            tax: 0,
            discount: 0,
            deliveryFee: 0,
            cartUrl: url('cart-index'),
        }
    },

    created() {
        this.fetchCart()
    },
    watch: {
        shouldUpdate(value) {
            if (value) {
                this.fetchCart()
                this.$emit('cartUpdated')
            }
        }
    },
    methods: {
        redirect() {
            window.location.assign(this.cartUrl)
        },
        openPS(data) {
            this.$emit('psOpened', data)
        },
        itemDeleted() {
            this.fetchCart()
        },
        itemUpdated() {
            this.fetchCart()
        },
        async fetchCart() {
            await axios.get(url('api/cart')).then(result => {
                this.cart = result.data.cart
                this.items = this.cart.items
                this.deliveryFee = this.cart.extra_info.delivery_fee
                this.discount = this.cart.extra_info.discount
                this.setTax()
                this.setSubtotal()
                this.setTotal()
            })
        },
        setTax() {
            this.tax = ((this.cart.total * 14) / 100).toFixed(2);
        },
        setSubtotal() {
            this.subtotal = (this.cart.total - this.tax).toFixed(2);
        },
        setTotal() {
            let total = this.cart.total + this.deliveryFee
            if (this.discount > 0) {
                total = (total * this.discount) / 100
            }

            this.total = total.toFixed(2)
        }
    }
}
</script>

<style scoped>
#asideCartList {
    top: 140px !important;
}
</style>
