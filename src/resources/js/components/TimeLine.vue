<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" v-show="!isLoading">
                <div v-if="tweetExists" class="card">
                    <div class="card-body d-flex text-black border-bottom" v-for="tweet in tweets" v-bind:key="tweet.id">
                        <div class="me-2">
                            <router-link :to="'/user-profile/' + tweet.user.id" class="router-link">
                                <div v-if="!tweet.user.profile_image">
                                    <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="60" height="60">
                                </div>
                                <div v-else>
                                    <!-- プロフィール画像編集機能追加後、ここに記述を追加 -->
                                </div>
                            </router-link>
                        </div>
                        <div>
                            <router-link :to="'/user-profile/' + tweet.user.id" class="router-link">
                                <b>{{ tweet.user.account_name }}</b>
                                <span class="text-muted ms-1">@{{ tweet.user.user_name }}</span>
                                <span class="text-muted ms-2">{{ format(tweet.created_at) }}</span>
                            </router-link>
                            <router-link :to="'/tweet/' + tweet.id" class="router-link">
                                <span class="d-block">{{ tweet.text }}</span>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div v-else class="text-center">
                    <span class="d-block mb-2">ツイートがありません</span>
                    <router-link :to="'/userList'" class="router-link">
                        <button class="btn btn-info rounded-pill text-white px-4 py-2">ユーザーをフォローしてみる</button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue'
import dayjs from "dayjs";
dayjs.locale("ja");

export default {
    setup(){
        const tweets = ref([]);
        const tweetExists = ref()
        const isLoading = ref(false);

        const getTimeLine = async () => {
            isLoading.value = true
            const response = await axios.get('/api/timeLine')
            tweets.value = response.data.tweets
            tweetExists.value = Boolean(response.data.tweetExists)
            isLoading.value = false
        }

        // 日付のフォーマット
        const format = (created_at) => {
            return dayjs(created_at).format("YYYY年MM月DD日 h:mm A");
        }

        onMounted(() => {
            getTimeLine()
        })

        return{
            tweets,
            tweetExists,
            isLoading,
            format
        }
    }
}
</script>
