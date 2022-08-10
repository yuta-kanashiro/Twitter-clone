import { createRouter, createWebHistory } from "vue-router";

import UserList from './components/UserList'

const routes = [
    { path: '/', name: 'home', component: UserList },
]

const router = createRouter({
    history: createWebHistory(), // HTML5 History モード
    routes,
})

export default router;
