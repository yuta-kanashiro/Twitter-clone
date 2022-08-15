<template>
    <div>
        <button type="button" class="btn btn-outline-info rounded-pill" v-if="!isFollowing" @click="follow">フォロー</button>
        <button type="button" class="btn btn-info text-white rounded-pill" v-else @click="unfollow">フォロー中</button>
    </div>
</template>

<script>

import axios from 'axios';
import { ref, onMounted } from 'vue'

export default {
    props: {
        id: Number
    },
    setup(props){
        const user = ref([]);
        const id = ref(props.id)
        const isFollowing = ref();

        // フォローチェック（既にフォローしているユーザーかチェック）
        const followCheck = async() => {
            const response = await axios.get('/api/followCheck/' + id.value)
            isFollowing.value = response.data
        }

        // フォローする
        const follow = async() => {
            await axios.post('/api/follow/' + id.value)
            followCheck()
        }

        // フォローを外す
        const unfollow = async() => {
            await axios.post('/api/unfollow/' + id.value)
            followCheck()
        }

        onMounted(followCheck)

        return{
            user,
            isFollowing,
            follow,
            unfollow
        }
    }
}
</script>
