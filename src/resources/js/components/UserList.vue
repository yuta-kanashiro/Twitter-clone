<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card" v-for="user in users" v-bind:key="user.id">
                    <router-link :to="'/user-profile/' + user.id" class="router-link">
                        <div class="card-body d-flex">
                            <div class="me-2">
                                <div v-if="user.profile_image === null">
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
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue'

export default {
    setup(){
        const users = ref([]);

        // ユーザー一覧取得
        const getUserList = async() => {
            const response = await axios.get('/api/usersList')
            users.value = response.data
        }

        onMounted(getUserList)

        return{
            users,
        }
    }
}
</script>
