<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div id="tab">
                    <div class="tab-menu btn-group d-flex mb-1" role="group">
                        <button @click="isSelect('following')" class="btn border-bottom" :class="{'active': tabItem === 'following'}">フォロー</button>
                        <button @click="isSelect('follower')" class="btn border-bottom" :class="{'active': tabItem === 'follower'}">フォロワー</button>
                    </div>

                    <div class="tab-contents">
                        <!-- フォロー一覧 -->
                        <div v-show="tabItem === 'following'">
                            <div class="card" v-for="user in followingUsers" v-bind:key="user.id">
                                <router-link :to="'/user-profile/' + user.id" class="router-link">
                                    <div class="card-body d-flex">
                                        <div class="me-2">
                                            <div v-if="!user.profile_image">
                                                <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="60" height="60">
                                            </div>
                                            <div v-else>
                                                <img class="rounded-circle border" :src="user.profile_image" alt="プロフィール画像" width="60" height="60">
                                            </div>
                                        </div>
                                        <div>
                                            <b class="d-block">{{ user.account_name }}</b>
                                            <span class="d-blocck text-muted">@{{ user.user_name }}</span>
                                            <span class="d-block">{{ user.profile_text }}</span>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                        </div>

                        <!-- フォロワー一覧 -->
                        <div v-show="tabItem === 'follower'">
                            <div class="card" v-for="user in followerUsers" v-bind:key="user.id">
                                <router-link :to="'/user-profile/' + user.id" class="router-link">
                                    <div class="card-body d-flex">
                                        <div class="me-2">
                                            <div v-if="!user.profile_image">
                                                <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="60" height="60">
                                            </div>
                                            <div v-else>
                                                <img class="rounded-circle border" :src="user.profile_image" alt="プロフィール画像" width="60" height="60">
                                            </div>
                                        </div>
                                        <div>
                                            <b class="d-block">{{ user.account_name }}</b>
                                            <span class="d-blocck text-muted">@{{ user.user_name }}</span>
                                            <span class="d-block">{{ user.profile_text }}</span>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
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

export default {
    props: {
        id: String
    },
    setup(props) {
        const tabItem = ref('following');
        const followingUsers = ref([]);
        const followerUsers = ref([])

        // フォロー一覧取得
        const getFollowList = async() => {
            const response = await axios.get('/api/followList/' + props.id)
            followingUsers.value = response.data.followingUsers
            followerUsers.value = response.data.followerUsers
        }

        const isSelect = (data) =>  {
            tabItem.value = data;
        }

        onMounted(getFollowList)

        return {
            tabItem,
            isSelect,
            followingUsers,
            followerUsers,
        }
    }
}
</script>
