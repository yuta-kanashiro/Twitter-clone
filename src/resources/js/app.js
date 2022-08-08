// require('./bootstrap');  // これっている？多分今は使ってない気がする。Vueのバージョンの違い？

import { createApp } from 'vue'
import App from './App.vue';
import router from "./router.js";

const app = createApp(App)
app.use(router);
app.mount('#app')
