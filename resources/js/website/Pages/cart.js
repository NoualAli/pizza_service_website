import '../bootstrap';
import { createAppHelper } from '../createApp'
import Cart from "../Components/cart/Cart.vue"
import CartCheckout from "../Components/cart/CartCheckout.vue"
import CartRow from "../Components/cart/CartRow.vue"
import VueGoogleMaps from "@fawmi/vue-google-maps"
import HeroComponent from '../Components/HeroComponent'
import OrderConfiguration from '../Components/OrderConfiguration'

const app = createAppHelper()
app.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBmhPnQiV4cSdyDmTF1HzX6Gzvt0HbRDv8',
        libraries: 'places',
    }
})

app.component('order-configuration', OrderConfiguration)
app.component('hero-component', HeroComponent);
app.component('cart', Cart);
app.component('cart-row', CartRow)
app.component('cart-checkout', CartCheckout)

app.mount('#app');

