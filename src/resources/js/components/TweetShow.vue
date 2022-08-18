<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card" v-if="!isLoding">
                    <div class="card-body">
                        <router-link :to="'/user-profile/' + user.id" class="router-link d-flex mb-3">
                            <div class="d-flex">
                                <div class="me-2">
                                    <div v-if="user.profile_image === null">
                                        <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="50" height="50">
                                    </div>
                                    <div v-else>
                                        <!-- プロフィール画像編集機能追加後、ここに記述を追加 -->
                                    </div>
                                </div>
                                <div>
                                    <b class="d-block">{{ user.account_name }}</b>
                                    <span class="d-blocck text-muted">@{{ user.user_name }}</span>
                                </div>
                            </div>
                        </router-link>
                        <div>
                            <span class="d-block fs-4 mb-2">{{ tweet.text }}</span>
                            <span class="d-block text-muted">{{ format(tweet.created_at) }}</span>
                        </div>
                        <div class="mt-2">
                            <LikeButton :tweetId="tweetId" :isLike="isLike" @emitLike="getLikeData"/>
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
import dayjs from "dayjs";
dayjs.locale("ja");

export default {
    components: {
        LikeButton
    },
    props: {
        id: String
    },
    setup(props){
        const tweet = ref([]);
        const user = ref([]);
        const tweetId = ref(Number(props.id));
        const isLike = ref();

        const isLoding = ref(false);

        // ツイート一覧取得
        const getTweetData = async () => {
            isLoding.value = true

            const getIsLike = axios.get('/api/isLike/' + tweetId.value)
            const getTweet = axios.get('/api/tweet/' + tweetId.value)

            const likeExists = await getIsLike
            isLike.value = likeExists.data === 1 ? true : false

            const tweetData = await getTweet
            tweet.value = tweetData.data
            user.value = tweetData.data.user

            isLoding.value = false
        }

        // 日付のフォーマット
        const format = (data) => {
            let created_at = dayjs(data).format("YYYY年MM月DD日 h:mm A");
            return created_at;
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
            tweetId,
            isLike,
            isLoding,
            format,
            getLikeData
        }
    }
}
</script>
