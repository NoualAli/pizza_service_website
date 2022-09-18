// import './bootstrap';
import { createApp } from 'vue';
import NotifyRestorer from './Components/NotifyRestorer'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Echo from 'laravel-echo';

const app = createApp({});

window.Echo = new Echo({
    broadcaster: "socket.io",
    host: window.location.hostname + ':6001'
});

app.use(VueSweetalert2);
app.component('notify-restorer', NotifyRestorer)
app.mount('#app');
