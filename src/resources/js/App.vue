<template>
    <div class="main">
        <router-view></router-view>
        <TweetCreate/>
    </div>
</template>

<script>
import TweetCreate from "./components/TweetCreate";

export default {
    components: {
        TweetCreate
    },
};
</script>
