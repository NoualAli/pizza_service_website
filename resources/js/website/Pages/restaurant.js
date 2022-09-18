import '../bootstrap';
import { createAppHelper } from '../createApp'

import ProductsList from "../Components/restaurant/ProductsList";
import ProductCard from "../Components/restaurant/ProductCard"
import ProductSettings from '../Components/restaurant/ProductSettings'

import AsideCartList from "../Components/cart/AsideCartList"
import CartRow from "../Components/cart/CartRow"

import HeroComponent from '../Components/HeroComponent'
import ScrollButton from '../Components/ScrollButton'

const app = createAppHelper()

app.component('product-settings', ProductSettings);
app.component('scroll-button', ScrollButton);
app.component('hero-component', HeroComponent);
app.component('products-list', ProductsList);
app.component('product-card', ProductCard);
app.component('aside-cart-list', AsideCartList);
app.component('cart-row', CartRow);

app.mount('#app');

