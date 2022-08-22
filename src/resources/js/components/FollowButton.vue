<template>
    <div>
        <button type="button" class="btn rounded-pill" :class="[ isFollowing ? 'following' : 'follow' ]" @click="followAction">{{ isFollowing ? "フォロー中" : "フォロー" }}</button>
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

        const followAction = async() => {
            try {
                await axios.post('/api/followAction/' + props.userId)
                execEmit()
            } catch (error) {
                alert("エラーが発生しました。")
            }
        }

        return{
            user,
            followAction
        }
    }
}
</script>
