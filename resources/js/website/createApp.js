import { createApp } from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css'
// import { i18nVue } from 'laravel-vue-i18n'
// Vue.config.productionTip = false

export const createAppHelper = () => {
    return createApp({}).use(VueSweetalert2);
}
