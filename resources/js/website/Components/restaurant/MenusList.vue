<template>
    <div class="container-fluid is-sticky py-2" id="menusNav">
        <Splide :options="this.sliderOptions" aria-label="My Favorite Images">
            <SplideSlide v-for="menu in this.menus" :key="menu.id">
                <span class="ps-radio-btn my-2" :class="{'active': menu.id == this.activeMenu?.id}"
                    @click="this.setActiveMenu(menu)">
                    {{ menu.name }}
                    <small>({{ this.calculateTotalProducts(menu) }})</small>
                </span>
            </SplideSlide>
        </Splide>
    </div>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/splide/dist/css/themes/splide-skyblue.min.css';
export default {
    components: {
        Splide,
        SplideSlide,
    },
    props: {
        menus: Object,
        products: Object,
        restaurant: Object
    },
    data() {
        return {
            activeMenu: null,
            sliderOptions: {
                rewind: true,
                autoWidth: true,
                width: 'auto',
                type: 'slide',
                perPage: this.menus.length,
                gap: 0,
                padding: 0,
                drag: true,
                arrows: false,
                pagination: false,
                trimSpace: 'move',
                breakpoints: {
                    780: {
                        type: 'loop'
                    }
                }
            }
        }
    },
    mounted() {
        this.activeMenu = this.menus[0]
    },
    methods: {
        setActiveMenu(menu) {
            this.activeMenu = menu
            this.$emit('menuSelected', menu)
        },
        calculateTotalProducts(menu) {
            let total = 0
            for (let index = 0; index < this.products.length; index++) {
                const product = this.products[index]
                if (product.restaurant_id == this.restaurant.id && product.menu_id == menu.id) {
                    total += 1
                }
            }
            return total
        }
    }
}
</script>

<style scoped>
#menusNav {
    z-index: 10;
    background-color: #fff;
    margin-bottom: 60px !important;
}
</style>
