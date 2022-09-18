<template>
    <p class="fw-bold">
        Back to
        <a :href="this.currentRestaurantUrl"> {{ this.currentRestaurant.name }}</a>
    </p>
    <div class="row flex-lg-row flex-column-reverse">
        <div class="col-lg-7">
            <cart-checkout @checkoutSuccess="this.fetchCart()" :restaurant="this.currentRestaurant" :user="this.user">
            </cart-checkout>
        </div>
        <div class="col-lg-5 my-3 my-lg-0">
            <AsideCartList @setAsCurrentProduct="this.setCurrentProduct"></AsideCartList>
        </div>
    </div>
    <!-- Product settings -->
    <product-settings v-if="Object.entries(currentProduct).length" :isActive="this.psActive" :data="this.currentProduct"
        @updateCart="this.updateCart" @closePS="this.closePS()">
    </product-settings>
</template>

<script>
import HeroComponent from '../HeroComponent'
import AsideCartList from './AsideCartList'
import ProductSettings from '../restaurant/ProductSettings'
import { url } from '../../Helpers/main'
export default {
    components: {
        HeroComponent, AsideCartList, ProductSettings
    },
    props: {
        user: {
            type: [Object, null, String]
        },
    },
    data() {
        return {
            items: [],
            total: null,
            subtotal: null,
            cart: null,
            updateCheckout: null,
            currentRestaurant: {},
            currentRestaurantUrl: null,
            currentProduct: {},
            psActive: false,
        }
    },

    created() {
        this.fetchCart()
        this.getCurrentRestaurnt()

    },
    methods: {
        async getCurrentRestaurnt() {
            await axios.get(url('current-restaurant')).then(result => {
                this.currentRestaurant = result.data.current_restaurant
                this.currentRestaurantUrl = url('restaurants/' + this.currentRestaurant.id)
            })
        },
        async getTypeOfOrder() {
            await axios.get(url('order-type')).then(result => {
                this.orderType = result.data.type
            })
        },
        getExtraList(options) {
            return Object.keys(JSON.parse(JSON.stringify(options.extra))).join(', ')
        },
        async removeFromCart(item) {
            await this.$swal({
                icon: 'error',
                html: '<p>Are you sure you want to remove <b>' + item.title + ' ?</b></p>',
                customClass: {
                    confirmButton: 'btn btn-success mx-1',
                    cancelButton: 'btn btn-danger mx-1'
                },
                buttonsStyling: false,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'No, cancel!',
                showCancelButton: true,
            }).then(result => {
                if (result.isConfirmed) {
                    axios.delete(url('api/cart?product=' + item.hash)).then(result => {
                        this.fetchCart()
                        this.$swal({
                            icon: 'success',
                            text: result.data.message,
                            toast: true,
                            position: 'bottom-right',
                            button: false,
                            showConfirmButton: false,
                            timer: 7000,
                        });
                    })
                }
            })
        },
        setCurrentProduct(product) {
            this.currentProduct = product
            this.psActive = true
        },
        openPS() {
            this.psActive = true
        },
        closePS() {
            this.psActive = false
        },
        async updatedCart(e, item) {
            await axios.put(url('api/cart?quantity=' + e.target.value + '&product=' + item)).then(result => {
                this.fetchCart()
                this.$swal({
                    icon: 'success',
                    text: result.data.message,
                    toast: true,
                    position: 'bottom-right',
                    button: false,
                    showConfirmButton: false,
                    timer: 7000,
                });
            })
        },
        async fetchCart() {
            await axios.get(url('api/cart')).then(result => {
                this.cart = result.data.cart
                this.items = this.cart.items
                this.total = this.cart.total.toFixed(2)
                let taxePart = (this.total * 14) / 100;
                this.subtotal = (this.total - taxePart).toFixed(2);
            })
        }
    }
}
</script>
