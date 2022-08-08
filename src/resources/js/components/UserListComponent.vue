<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- <router-link> -->
                    <div class="card" v-for="user in users" v-bind:key="user.id">
                        <div class="card-body d-flex" style="gap:0 12px">
                            <div>
                                <div v-if="user.profile_image === null">
                                    <img class="rounded-circle" src="../img/default.png" alt="プロフィール画像" width="60" height="60">
                                </div>
                                <div v-else>
                                    <!-- プロフィール画像編集機能追加後、ここに記述を追加 -->
                                </div>
                            </div>
                            <div>
                                <b>{{ user.account_name}}</b><br>
                                <text class="text-muted">@{{ user.user_name}}</text><br>
                                <text size="3">{{ user.profile_text}}</text>
                            </div>
                        </div>
                    </div>
                <!-- </router-link> -->
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

        const getUserList = async() => {
            const response = await axios.get('/api')
            users.value = response.data
        }

        onMounted(getUserList)

        return{
            users,
            // getUserList // これを返す意味ってなに？
        }
    }
}
</script>
