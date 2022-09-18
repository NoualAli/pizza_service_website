import '../bootstrap';
import { createAppHelper } from '../createApp'
import RestaurantsList from "../Components/restaurant/RestaurantsList";
import OrderConfiguration from "../Components/OrderConfiguration";
import HomeSlider from "../Components/HomeSlider";
import VueGoogleMaps from "@fawmi/vue-google-maps"


const app = createAppHelper()
app.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBmhPnQiV4cSdyDmTF1HzX6Gzvt0HbRDv8',
        libraries: 'places',
    }
})

app.component('home-slider', HomeSlider);
app.component('order-configuration', OrderConfiguration);
app.component('restaurants-list', RestaurantsList);

app.mount('#app');

