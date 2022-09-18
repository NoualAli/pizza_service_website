import './bootstrap';
import { createAppHelper } from './createApp'

import HeroComponent from './Components/HeroComponent'

const app = createAppHelper()
app.component('hero-component', HeroComponent);

app.mount('#app');

