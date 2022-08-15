<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- ユーザープロフィール -->
                <div class="card mb-5">
                    <div class="card-body text-black" style="gap:0 12px">
                        <div class="mb-2">
                            <div v-if="!user.profile_image">
                                <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="100" height="100">
                            </div>
                            <div v-else>
                                <!-- プロフィール画像編集機能追加後、ここに記述を追加 -->
                            </div>
                        </div>
                        <div>
                            <div class="d-flex">
                                <div>
                                    <h4 class="mb-0 fw-bold">{{ user.account_name }}</h4>
                                    <span class="d-block text-muted mb-2">@{{ user.user_name }}</span>
                                </div>
                                <div class="ms-auto">
                                    <button v-if="loginUserId === user.id" type="button" class="btn btn-outline-dark rounded-pill">編集</button>
                                    <FollowButton v-else :id="user.id"/>
                                </div>
                            </div>
                            <span class="d-block">{{ user.profile_text }}</span>
                        </div>
                        <router-link :to="'/user-profile/' + user.id + '/follow-list'" class="router-link">
                            <div class="d-flex mt-2">
                                <div>{{ countFollowing }}<span class="text-muted me-1">フォロー</span></div>
                                <div>{{ countFollower }}<span class="text-muted">フォロワー</span></div>
                            </div>
                        </router-link>
                    </div>
                </div>
                
                <!-- ツイート一覧 -->
                <div class="card">
                    <div class="card-body d-flex text-black border-bottom" v-for="tweet in tweets" v-bind:key="tweet.id">
                        <router-link :to="'/tweet/' + tweet.id" class="router-link d-flex">
                            <div class="me-2">
                                <div v-if="!user.profile_image">
                                    <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="60" height="60">
                                </div>
                                <div v-else>
                                    <!-- プロフィール画像編集機能追加後、ここに記述を追加 -->
                                </div>
                            </div>
                            <div>
                                <b>{{ user.account_name }}</b>
                                <span class="text-muted ms-1">@{{ user.user_name }}</span>
                                <span class="text-muted float-end ">{{ format(tweet.created_at) }}</span>
                                <span class="d-block">{{ tweet.text }}</span>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue'
import FollowButton from './FollowButton.vue';
import dayjs from "dayjs";
dayjs.locale("ja");

export default {
    components: {
        FollowButton
    },
    props: {
        id: String
    },
    setup(props) {
        const user = ref([]);
        const tweets = ref([]);
        const loginUserId = ref();
        // Numberでidを文字列から数値に変換
        const id = ref(Number(props.id));
        const countFollowing = ref();
        const countFollower = ref();

        // あるユーザーの情報を取得
        const getProfileData = async() => {
            const response = await axios.get('/api/userProfile/' + id.value)
            user.value = response.data.user
            tweets.value = response.data.user.tweets
            loginUserId.value = response.data.loginUserId
            countFollowing.value = response.data.countFollowing
            countFollower.value = response.data.countFollower
        }

        // 日付のフォーマット
        const format = (data) => {
            let created_at = dayjs(data).format("YYYY年MM月DD日");
            return created_at;
        }

        onMounted(getProfileData)

        return{
            user,
            tweets,
            loginUserId,
            countFollowing,
            countFollower,
            format
        }
    }
}
</script>
