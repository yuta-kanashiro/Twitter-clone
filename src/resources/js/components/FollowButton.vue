<template>
    <div>
        <div class="follow" v-if="!isFollowing" @click="follow">
            <button type="button" class="btn btn-outline-info rounded-pill" v-cloak>フォロー</button>
        </div>
        <div class="unfollow" v-else @click="unfollow">
            <button type="button" class="btn btn-info text-white rounded-pill">フォロー中</button>
        </div>
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
        console.log(props.id)

        // フォローチェック（既にフォローしているユーザーかチェック）
        const followCheck = async() => {
            const response = await axios.get('/api/followCheck/' + id.value)
            isFollowing.value = response.data
        }

        // フォローする
        const follow = async() => {
            await axios.get('/api/follow/' + id.value)
            followCheck()
        }

        // フォローを外す
        const unfollow = async() => {
            await axios.get('/api/unfollow/' + id.value)
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
