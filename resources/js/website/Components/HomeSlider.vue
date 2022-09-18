<template>
    <div class="header_container">
        <Splide :options="this.sliderOptions" aria-label="My Favorite Images">
            <SplideSlide>
                <img :src="this.sliderOneImg" alt="" class="slider_img">
            </SplideSlide>
        </Splide>
        <!-- <div class="box container">
            <order-configuration :showAddressInput="false">
            </order-configuration>
        </div> -->
    </div>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import OrderConfiguration from './OrderConfiguration'
import '@splidejs/splide/dist/css/themes/splide-skyblue.min.css';
import { url } from '../Helpers/main'
export default {
    components: {
        Splide,
        SplideSlide,
        OrderConfiguration
    },
    computed: {
        sliderOneImg() {
            return url('assets/heros/slider1.jpg')
        }
    },
    data() {
        return {
            sliderOptions: {
                rewind: true,
                width: '100%',
                height: 'calc(100vh - 61px)',
                heightRatio: 0.8,
                cover: true,
                type: 'slide',
                perPage: 1,
                gap: 0,
                padding: 0,
                drag: true,
                // arrows: false,
                pagination: false,
                trimSpace: 'move',
            }
        }
    }
}
</script>

<style scoped>
.header_container {
    position: relative;
    /* margin-bottom: 161px; */
}

.slider_img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.box {
    padding: 25px;
    border-radius: 8px;
    width: 100%;
    height: auto;
    background-color: #fcfcfc;
    position: absolute;
    bottom: -10%;
    left: 50%;
    transform: translate(-50%);
    box-shadow:
        0px 1.5px 6.6px rgba(0, 0, 0, 0.025),
        0px 3.7px 16.8px rgba(0, 0, 0, 0.035),
        0px 7.6px 34.2px rgba(0, 0, 0, 0.045),
        0px 15.7px 70.4px rgba(0, 0, 0, 0.055),
        0px 43px 193px rgba(0, 0, 0, 0.08);
}
</style>
