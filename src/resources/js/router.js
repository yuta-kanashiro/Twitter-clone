import { createRouter, createWebHistory } from "vue-router";

import UserListComponent from './components/UserListComponent.vue'

const routes = [
    { path: '/', name: 'home', component: UserListComponent },
]

const router = createRouter({
    history: createWebHistory(), // HTML5 History モード
    routes,
})

export default router;
