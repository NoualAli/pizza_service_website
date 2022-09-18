import '../bootstrap';
import { createAppHelper } from '../createApp'
import RestaurantsList from "../Components/restaurant/RestaurantsList";
import HeroComponent from '../Components/HeroComponent'
import { url } from '../Helpers/main'
import OrderConfiguration from "../Components/OrderConfiguration";
import VueGoogleMaps from "@fawmi/vue-google-maps"

const app = createAppHelper()
app.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBmhPnQiV4cSdyDmTF1HzX6Gzvt0HbRDv8',
        libraries: 'places',
    }
})
app.component('order-configuration', OrderConfiguration);
app.use(url)
app.component('hero-component', HeroComponent);
app.component('restaurants-list', RestaurantsList);
app.mount('#app');
