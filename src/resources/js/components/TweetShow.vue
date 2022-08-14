<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <router-link :to="'/user-profile/' + user.id" class="router-link d-flex mb-3">
                            <!-- <div class="d-flex mb-3"> -->
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
                            <!-- </div> -->
                        </router-link>
                        <div>
                            <span class="d-block fs-4 mb-2">{{ tweet.text }}</span>
                            <span class="d-block text-muted">{{ format(tweet.created_at) }}</span>
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
import dayjs from "dayjs";
dayjs.locale("ja");

export default {
    props: {
        id: String
    },
    setup(props){
        const tweet = ref([]);
        const user = ref([]);
        const id = ref(Number(props.id));

        // ユーザー一覧取得
        const getTweet = async() => {
            const response = await axios.get('/api/tweet/' + id.value)
            tweet.value = response.data
            user.value = response.data.user
        }

        // 日付のフォーマット
        const format = (data) => {
            let created_at = dayjs(data).format("YYYY年MM月DD日 h:mm A");
            return created_at;
        }

        onMounted(getTweet)

        return{
            tweet,
            user,
            format,
        }
    }
}
</script>
