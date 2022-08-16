import './bootstrap';
import { createApp } from 'vue';
import MainNavbar from "./components/MainNavbar.vue";

const app = createApp({});
app.component('main-navbar', MainNavbar);

app.mount('#app');
