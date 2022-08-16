import './bootstrap';
import { createApp } from 'vue';
import MainNavbar from "./components/MainNavbar.vue";
import MapHeader from './components/MapHeader.vue';
import MapBox from './components/MapBox.vue';
import RestaurantsMapListing from './components/RestaurantsMapListing'

const app = createApp({});
app.component('main-navbar', MainNavbar);
app.component('map-header', MapHeader);
app.component('map-box', MapBox);
app.component('restaurants-map-listing', RestaurantsMapListing);

app.mount('#app');

