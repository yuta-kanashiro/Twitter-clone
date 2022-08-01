import { createRouter, createWebHistory } from "vue-router";

import exampleComponent from './components/ExampleComponent.vue'

const routes = [
    { path: '/', name: 'home', component: exampleComponent },
]

const router = createRouter({
    history: createWebHistory(), // HTML5 History モード
    routes,
})

export default router;
