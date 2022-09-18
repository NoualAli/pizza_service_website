<template>
    <!-- Menus list -->
    <MenusList @menuSelected="this.setActiveMenu" :products="this.products" :menus="this.menus"
        :restaurant="this.restaurant" />

    <div class="row w-full flex-lg-row flex-column-reverse">
        <!-- Products list -->
        <div class="col-lg-8 col-md-6">
            <section v-for="menu in this.menus" :key="menu.name">
                <div class="container-fluid card rounded-0 px-4 py-3" v-if="this.activeMenu.id == menu.id">
                    <h4 :id="'menu-' + menu.id">{{ activeMenu.name }}</h4>
                    <div class="list-group list-group-flush">
                        <div v-for="product in this.products" :key="product.id">
                            <!-- Product Card -->
                            <product-card v-if="product.menu_id == menu.id" :product="product"
                                @cartUpdated="this.shouldUpdateCart = true" @psOpened="this.openPS(product)"
                                :showAddButton="this.restaurant.is_open">
                            </product-card>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Cart -->
        <div class="col-lg-4 my-3 my-lg-0">
            <aside-cart-list :rowUpdate="true" :showLink="this.restaurant.is_open" :shouldUpdate="this.shouldUpdateCart"
                @cartUpdated="this.shouldUpdateCart = false" @psOpened="this.aclOpenPS">
            </aside-cart-list>
        </div>
    </div>

    <!-- Product settings -->
    <product-settings :errors="this.errors" v-if="this.psActive" :isActive="this.psActive" :cartItem="this.cartItem"
        :product="this.currentProduct" @addToCart="this.addToCart" @updateCartItem="this.updateCartItem"
        @closePS="this.closePS()">
    </product-settings>

</template>

<script>
import MenusList from './MenusList'
import ProductCard from './ProductCard'
import AsideCartList from '../cart/AsideCartList'
import ProductSettings from './ProductSettings'

import { url } from '../../Helpers/main'
export default {
    components: {
        MenusList, ProductCard, AsideCartList, ProductSettings
    },
    props: {
        restaurant: Object
    },
    data() {
        return {
            menus: null,
            products: null,
            activeMenu: null,
            shouldUpdateCart: false,
            psActive: false,
            currentProduct: {},
            cartItem: {},
            errors: []
        }
    },

    created() {
        this.menus = this.restaurant.menus
        this.activeMenu = this.menus[0]
        this.products = this.restaurant.products
    },

    methods: {
        openPS(product) {
            this.psActive = true
            this.currentProduct = product
        },
        aclOpenPS(data) {
            this.openPS(data.product)
            this.cartItem = data.item
        },
        closePS() {
            this.psActive = false
            this.currentProduct = {}
            this.cartItem = {}
        },
        setActiveMenu(data) {
            this.activeMenu = data
        },
        async addToCart(data) {
            await axios.post(url('api/cart'), {
                'product': this.currentProduct.id,
                'settings': JSON.stringify(data.settings),
                'quantity': data.quantity,
                'additional_informations': data.additionalInformations
            }).then(result => {
                this.closePS()
                if (result.data.success) {
                    this.shouldUpdateCart = true
                    this.$swal({
                        icon: 'success',
                        text: result.data.message,
                        toast: true,
                        position: 'bottom-right',
                        button: false,
                        showConfirmButton: false,
                        timer: 7000,
                    });
                    this.$emit('cartUpdated');
                } else {
                    this.$swal({
                        icon: 'error',
                        text: result.data.message,
                    });
                }
            }).catch(error => {
                console.error(error.response);
            })
        },
        async updateCartItem(data) {
            await axios.put(url('api/cart'), {
                item_hash: data.item_hash,
                product: this.currentProduct.id,
                settings: data.settings,
                quantity: data.quantity,
                additional_informations: data.additionalInformations
            }).then(result => {
                this.closePS()
                if (result.data.success) {
                    this.shouldUpdateCart = true
                    this.$swal({
                        icon: 'success',
                        text: result.data.message,
                        toast: true,
                        position: 'bottom-right',
                        button: false,
                        showConfirmButton: false,
                        timer: 7000,
                    });
                    this.$emit('cartUpdated');
                } else {
                    this.$swal({
                        icon: 'error',
                        text: result.data.message,
                    });
                }
            }).catch(error => {
                if (error.response.status == 422) {
                    this.$swal({
                        icon: 'error',
                        text: error.response.data.message,
                        toast: true,
                        position: 'bottom-right',
                        button: false,
                        showConfirmButton: false,
                        timer: 7000,
                    });
                    this.errors = error.response.data.errors
                    console.log(this.errors);
                } else {
                    console.error(error.response);
                }
            })
        },
    }
}

</script>
