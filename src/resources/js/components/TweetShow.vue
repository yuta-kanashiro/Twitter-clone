<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card" v-if="!isLoding">
                    <div class="card-body">
                        <div class="d-flex">
                            <router-link :to="'/user-profile/' + user.id" class="router-link mb-3">
                                <div class="me-2">
                                    <div v-if="!user.profile_image">
                                        <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="50" height="50">
                                    </div>
                                    <div v-else>
                                        <img class="rounded-circle border" :src="user.profile_image" alt="プロフィール画像" width="50" height="50">
                                    </div>
                                </div>
                                <div>
                                    <b class="d-block">{{ user.account_name }}</b>
                                    <span class="d-blocck text-muted">@{{ user.user_name }}</span>
                                </div>
                            </router-link>
                            <div class="ms-auto">
                                <TweetDeleteButton :tweetId="tweetId" :isLoginUser="isLoginUser" />
                            </div>
                        </div>
                        <div>
                            <span class="d-block fs-4 mb-2">{{ tweet.text }}</span>
                            <span class="d-block text-muted">{{ format(tweet.created_at) }}</span>
                        </div>
                        <div class="mt-2">
                            <p>{{ countLikes }}<span class="text-muted">件のいいね</span></p>
                            <LikeButton class="border-top pt-3" :tweetId="tweetId" :isLike="isLike" @emitLike="getLikeData"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { ref, onMounted } from 'vue'
import LikeButton from './LikeButton.vue';
import TweetDeleteButton from './TweetDeleteButton.vue';
import dayjs from "dayjs";
dayjs.locale("ja");

export default {
    components: {
        LikeButton,
        TweetDeleteButton,
    },
    props: {
        id: String
    },
    setup(props){
        const tweet = ref([]);
        const user = ref([]);
        const countLikes = ref();
        const isLoginUser = ref();
        const tweetId = ref(Number(props.id));
        const isLike = ref();
        const isLoding = ref(false);

        // ツイート一覧取得
        const getTweetData = async () => {
            isLoding.value = true

            const likeExists = await axios.get('/api/isLike/' + tweetId.value)
            isLike.value = Boolean(likeExists.data)

            const tweetData = await axios.get('/api/tweet/' + tweetId.value)
            tweet.value = tweetData.data.tweet
            user.value = tweetData.data.tweet.user
            countLikes.value = tweetData.data.countLikes
            isLoginUser.value = tweetData.data.loginUserId === tweetData.data.tweet.user_id ? true : false

            isLoding.value = false
        }

        // 日付のフォーマット
        const format = (created_at) => {
            return dayjs(created_at).format("YYYY年MM月DD日 h:mm A");
        }

        const getLikeData = (likeData) => {
            isLike.value = likeData
        }

        onMounted(() => {
            getTweetData()
        })

        return{
            tweet,
            user,
            countLikes,
            isLoginUser,
            tweetId,
            isLike,
            isLoding,
            format,
            getLikeData
        }
    }
}
</script>
