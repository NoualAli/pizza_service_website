<template>
    <div>
        <div class="container my-5">
            <order-configuration @orderTypeChanged="this.fetchRestaurants" @clientPlaceChanged="this.fetchRestaurants"
                :showAddressInput="false">
            </order-configuration>
            <CategoriesList @categoryChanged="this.filterRestaurants" @categoryCleared="this.fetchRestaurants">
            </CategoriesList>
        </div>
        <Transition name="fade">
            <div class="row my-5" v-if="Object.entries(this.restaurants)?.length">
                <div class="col-lg-3 my-2" v-for="restaurant in restaurants" :key="restaurant.id">
                    <RestaurantCard :restaurant="restaurant" />
                </div>
            </div>
            <p v-else class="container text-center">
                No restaurants were found in this area, please choose another location
            </p>
        </Transition>
    </div>
</template>

<script>
import CategoriesList from '../CategoriesList'
import RestaurantCard from './RestaurantCard'
import OrderConfiguration from '../OrderConfiguration'
import { Transition } from 'vue'
import { url } from '../../Helpers/main'
export default {
    components: {
        Transition,
        CategoriesList,
        RestaurantCard, OrderConfiguration
    },
    name: 'restaurants-list',
    data() {
        return {
            restaurants: {},
            categories: {},
            currentCategory: null,
        }
    },

    mounted() {
        this.fetchRestaurants()
    },

    methods: {
        async fetchRestaurants() {
            await axios.get(url('api/restaurants')).then((result) => {
                this.restaurants = result.data.restaurants
                this.currentCategory = null
            })
        },

        async filterRestaurants(data) {
            await axios.get(url('api/restaurants?category_id=' + data.id)).then((result) => {
                this.currentCategory = data.id
                this.restaurants = result.data.restaurants
            })
        }
    }
}
</script>
