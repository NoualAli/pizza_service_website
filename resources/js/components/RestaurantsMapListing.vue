<template>
    <div class="accordion accordion-flush" id="restaurantsMapList">
        <div class="accordion-item" v-for="restaurant in this.$props.restaurants" :key="restaurant.name">
            <h2 class="accordion-header" :id="'flush-heading-' + restaurant.id">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    :data-bs-target="'#flush-collapse-' + restaurant.id" aria-expanded="false"
                    :aria-controls="'flush-collapse-' + restaurant.id">
                    {{ restaurant.name }}
                </button>
            </h2>
            <div :id="'flush-collapse-' + restaurant.id" class="accordion-collapse collapse show"
                :aria-labelledby="'flush-heading-' + restaurant.id" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <p>{{ restaurant.address }}</p>
                    <!-- <p><b>Distance: {{ calculateDistance(restaurant) }} Km</b></p> -->
                    <a href="restaurant/${restaurant.id}" class="btn btn-primary text-white d-block">Menu</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['restaurants'],

    mounted() {
        // this.getRestaurants()
        // this.calculateDistance()
    },

    methods: {
        // calculateDistance(restaurant) {
        //     const options = { units: 'kilometers' };
        //     return restaurant.distance = Math.round(turf.distance(
        //         this.retrieveClientLocation(),
        //         [restaurant.longitude, restaurant.latitude],
        //         options
        //     ));
        // },
        // calculateAllDistances() {
        //     for (const restaurant of this.restaurants) {
        //         this.calculateDistance(restaurant)
        //     }
        // },

        // // Récupère la liste des restaurant
        // async getRestaurants() {
        //     try {
        //         const response = await axios.get('api/restaurants-list')
        //         this.restaurants = response.data.data
        //     } catch (error) {
        //         console.error(error);
        //     }
        // },

        // retrieveClientLocation() {
        //     return JSON.parse(window.sessionStorage.getItem('clientLocation'))
        // },
    }
}
</script>
