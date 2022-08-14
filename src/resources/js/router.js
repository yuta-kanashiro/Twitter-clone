import { createRouter, createWebHistory } from "vue-router";

import UserList from './components/UserList'
import UserListShow from './components/UserListShow'
import TweetShow from './components/TweetShow'

const routes = [
    { path: '/', name: 'home', component: UserList },
    { path: '/user-profile/:id', name: 'userProfile', component: UserListShow, props: true },
    { path: '/tweet/:id', name: 'tweetShow', component: TweetShow, props: true },
]

const router = createRouter({
    history: createWebHistory(), // HTML5 History モード
    routes,
})

export default router;
