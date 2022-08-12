import { createRouter, createWebHistory } from "vue-router";

import UserList from './components/UserList'
import UserShow from './components/UserShow'

const routes = [
    { path: '/', name: 'home', component: UserList },
    { path: '/user-profile/:id', name: 'userProfile', component: UserShow, props: true },
]

const router = createRouter({
    history: createWebHistory(), // HTML5 History モード
    routes,
})

export default router;
