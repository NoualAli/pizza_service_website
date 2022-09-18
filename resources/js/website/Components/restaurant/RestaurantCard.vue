<template>
    <div class="ps-card--container">
        <a :href="restaurant.link" class="ps-card">
            <img :src="this.getCover()" :alt="'Cover ' + restaurant.name" class="ps-card--img" />
            <div class="ps-card--body text-left">
                <h4>{{ restaurant.name }}</h4>
                <p>
                    {{ restaurant.address }}
                </p>
                <div class="ps-card--categories">
                    <span v-for="category in restaurant.categories" :key="category.id">{{ category.name }}</span>
                </div>
                <div class="ps-card--details">
                    <div class="ps-card--detail">
                        <i class="la la-clock-o fs-5 d-inline-block text-success"
                            :class="{'text-danger': !restaurant.is_open}"></i>
                        <span>
                            {{restaurant.today_time_slots }}
                        </span>
                        <span class="fw-bold text-success" v-if="restaurant.is_open">Open</span>
                        <span class="fw-bold text-danger" v-else>Closed</span>
                    </div>
                </div>
                <div class="ps-card--details">
                    <div class="ps-card--detail">
                        <i class="las la-map-marker fs-5 d-inline-block"></i>
                        <span>{{ restaurant.distance }} Km</span>
                    </div>
                    <div class="ps-card--detail">
                        <i class="la la-clock-o fs-5 d-inline-block"></i>
                        <span>{{ restaurant.delivery_time }} min</span>
                    </div>
                    <div class="ps-card--detail">
                        <i class="las la-money-bill-wave fs-5 d-inline-block"></i>
                        <span>{{ restaurant.avg_price }} €</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</template>

<script>
import { url } from "../../Helpers/main"
export default {
    props: {
        restaurant: {
            type: Object
        }
    },
    methods: {
        getCover() {
            return url(this.restaurant.cover)
        }
    }
}
</script>
