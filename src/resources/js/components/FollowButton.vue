<template>
    <div>
        <button type="button" class="btn btn-outline-info rounded-pill" v-if="!isFollowing" @click="followAction">フォロー</button>
        <button type="button" class="btn btn-info text-white rounded-pill" v-else @click="followAction">フォロー中</button>
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

        // const follow = async() => {
        //     try {
        //         await axios.post('/api/follow/' + props.userId)
        //         execEmit()
        //     } catch (error) {
        //         alert("エラーが発生しました。")
        //     }
        // }

        // const unfollow = async() => {
        //     try {
        //         await axios.post('/api/unfollow/' + props.userId)
        //         execEmit()
        //     } catch (error) {
        //         alert("エラーが発生しました。")
        //     }
        // }

        const followAction = async() => {
            // if (props.isFollowing === false) {
            //     // フォローする
            //     try {
            //         await axios.post('/api/follow/' + props.userId)
            //         execEmit()
            //     } catch (error) {
            //         alert("エラーが発生しました。")
            //     }
            // } else {
            //     // フォローを外す
            //     try {
            //         await axios.post('/api/unfollow/' + props.userId)
            //         execEmit()
            //     } catch (error) {
            //         alert("エラーが発生しました。")
            //     }
            // }
            try {
                await axios.post('/api/followAction/' + props.userId)
                execEmit()
            } catch (error) {
                alert("エラーが発生しました。")
            }
        }

        return{
            user,
            // follow,
            // unfollow,
            followAction
        }
    }
}
</script>
