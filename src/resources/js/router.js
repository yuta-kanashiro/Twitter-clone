import { createRouter, createWebHistory } from "vue-router";

import TimeLine from "./components/TimeLine";
import UserList from "./components/UserList";
import UserProfile from "./components/UserProfile";
import TweetShow from "./components/TweetShow";
import FollowList from "./components/FollowList";

const routes = [
    { path: "/", redirect: "/home" },
    {
        path: "/home",
        name: "timeLine",
        component: TimeLine
    },
    {
        path: "/userList",
        name: "userList",
        component: UserList
    },
    {
        path: "/user-profile/:id",
        name: "userProfile",
        component: UserProfile,
        props: true
    },
    {
        path: "/tweet/:id",
        name: "tweetShow",
        component: TweetShow,
        props: true
    },
    {
        path: "/user-profile/:id/follow-list",
        name: "followList",
        component: FollowList,
        props: true
    },
]

const router = createRouter({
    history: createWebHistory(), // HTML5 History モード
    routes,
});

export default router;
