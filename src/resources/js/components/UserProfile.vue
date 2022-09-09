<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" v-show="!isLoading">
                <!-- ユーザープロフィール -->
                <div class="card mb-5">
                    <div class="card-body text-black" style="gap:0 12px">
                        <div class="mb-2">
                            <div v-if="!user.profile_image">
                                <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="100" height="100">
                            </div>
                            <div v-else>
                                <img class="rounded-circle border" :src="user.profile_image" alt="プロフィール画像" width="100" height="100">
                            </div>
                        </div>
                        <div>
                            <div class="d-flex">
                                <div>
                                    <h4 class="mb-0 fw-bold">{{ user.account_name }}</h4>
                                    <span class="d-block text-muted mb-2">@{{ user.user_name }}</span>
                                </div>
                                <div class="ms-auto">
                                    <UserEdit v-if="loginUserId" :loginUser="user"/>
                                    <FollowButton v-else :userId="user.id" :isFollowing="isFollowing" @emitFollow="isFollow"/>
                                </div>
                            </div>
                            <span class="d-block">{{ user.profile_text }}</span>
                        </div>
                        <router-link :to="'/user-profile/' + user.id + '/follow-list'" class="router-link">
                            <div class="d-flex mt-2">
                                <div>{{ countFollowings }}<span class="text-muted me-1">フォロー</span></div>
                                <div>{{ countFollowers }}<span class="text-muted">フォロワー</span></div>
                            </div>
                        </router-link>
                    </div>
                </div>

                <div id="tab">
                    <div class="tab-menu btn-group d-flex mb-1" role="group">
                        <button @click="isSelect('tweets')" class="btn border-bottom" :class="{'active': tabItem === 'tweets'}">{{ countTweets }}ツイート</button>
                        <button @click="isSelect('likes')" class="btn border-bottom" :class="{'active': tabItem === 'likes'}">{{ countLikes }}いいね</button>
                    </div>
                </div>

                <div class="tab-contents">
                    <div v-show="tabItem === 'tweets'">
                        <!-- ツイート一覧 -->
                        <div v-if="countTweets != 0" class="card">
                            <div class="card-body d-flex text-black border-bottom" v-for="tweet in tweets" v-bind:key="tweet.id">
                                <router-link :to="'/tweet/' + tweet.id" class="router-link d-flex">
                                    <div class="me-2">
                                        <div v-if="!user.profile_image">
                                            <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="60" height="60">
                                        </div>
                                        <div v-else>
                                            <img class="rounded-circle border" :src="user.profile_image" alt="プロフィール画像" width="60" height="60">
                                        </div>
                                    </div>
                                    <div>
                                        <b>{{ user.account_name }}</b>
                                        <span class="text-muted ms-1">@{{ user.user_name }}</span>
                                        <span class="text-muted ms-2">{{ format(tweet.created_at) }}</span>
                                        <span class="d-block" style="white-space: pre-wrap;">{{ tweet.text }}</span>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <div v-else class="text-center">
                            <span class="d-block my-2">ツイートがありません</span>
                        </div>
                    </div>

                    <div v-show="tabItem === 'likes'">
                        <!-- いいね一覧 -->
                        <div v-if="countLikes != 0" class="card">
                            <div class="card-body d-flex text-black border-bottom" v-for="like in likes" v-bind:key="like.id">
                                <router-link :to="'/tweet/' + like.id" class="router-link d-flex">
                                    <div class="me-2">
                                        <div v-if="!like.user.profile_image">
                                            <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="60" height="60">
                                        </div>
                                        <div v-else>
                                            <img class="rounded-circle border" :src="like.user.profile_image" alt="プロフィール画像" width="60" height="60">
                                        </div>
                                    </div>
                                    <div>
                                        <router-link :to="'/tweet/' + like.id" class="router-link">
                                            <b>{{ like.user.account_name }}</b>
                                            <span class="text-muted ms-1">@{{ like.user.user_name }}</span>
                                            <span class="text-muted ms-2">{{ format(like.created_at) }}</span>
                                            <span class="d-block" style="white-space: pre-wrap;">{{ like.text }}</span>
                                        </router-link>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <div v-else class="text-center">
                            <span class="d-block my-2">いいねがありません</span>
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
import FollowButton from './FollowButton.vue';
import UserEdit from './UserEdit.vue';
import dayjs from "dayjs";
dayjs.locale("ja");

export default {
    components: {
        FollowButton,
        UserEdit,
    },
    props: {
        id: String
    },
    setup(props) {
        const user = ref([]);
        const tweets = ref([]);
        const likes = ref([]);
        const loginUserId = ref();
        // Numberでidを文字列から数値に変換
        const userId = ref(Number(props.id));
        const countFollowings = ref();
        const countFollowers = ref();
        const countTweets = ref();
        const countLikes = ref();
        const isFollowing = ref();
        const isLoading = ref(false);
        const tabItem = ref('tweets');

        // あるユーザーの情報を取得
        const getUserData = async () => {
            isLoading.value = true

            const followingExists = await axios.get('/api/isFollowing/' + userId.value)
            isFollowing.value = Boolean(followingExists.data)

            const ProfileData = await axios.get('/api/userProfile/' + userId.value)
            user.value = ProfileData.data.user
            tweets.value = ProfileData.data.user.tweets
            likes.value = ProfileData.data.tweetLikes
            loginUserId.value = ProfileData.data.loginUserId === ProfileData.data.user.id ? true : false
            countFollowings.value = ProfileData.data.countFollowings
            countFollowers.value = ProfileData.data.countFollowers
            countTweets.value = ProfileData.data.countTweets
            countLikes.value = ProfileData.data.countLikes

            isLoading.value = false
        }

        // 日付のフォーマット
        const format = (created_at) => {
            return dayjs(created_at).format("YYYY年MM月DD日 h:mm A");
        }

        const isFollow = (followData) => {
            isFollowing.value = followData
        }

        const isSelect = (data) =>  {
            tabItem.value = data;
        }

        onMounted(() => {
            getUserData()
        })

        return{
            user,
            tweets,
            likes,
            loginUserId,
            countFollowings,
            countFollowers,
            countTweets,
            countLikes,
            isFollowing,
            isLoading,
            format,
            isFollow,
            tabItem,
            isSelect,
        }
    }
}
</script>
