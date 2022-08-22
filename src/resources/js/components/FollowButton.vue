<template>
    <div>
        <button type="button" class="btn btn-outline-info rounded-pill" v-if="!isFollowing" @click="follow">フォロー</button>
        <button type="button" class="btn btn-info text-white rounded-pill" v-else @click="unfollow">フォロー中</button>
    </div>
</template>

<script>

import axios from 'axios';
import { ref } from 'vue'

export default {
    props: {
        userId: Number,
        isFollowing: Boolean
    },
    setup(props, context){
        const user = ref([]);

        const execEmit = () => {
            context.emit('emitFollow', !props.isFollowing);
        }

        // フォローする
        const follow = async() => {
            try {
                await axios.post('/api/follow/' + props.userId)
                execEmit()
            } catch (error) {
                alert("エラーが発生しました。")
            }
        }

        // フォローを外す
        const unfollow = async() => {
            try {
                await axios.post('/api/unfollow/' + props.userId)
                execEmit()
            } catch (error) {
                alert("エラーが発生しました。")
            }
        }

        return{
            user,
            follow,
            unfollow,
            execEmit
        }
    }
}
</script>
