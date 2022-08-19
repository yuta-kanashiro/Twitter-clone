<template>
    <div class="d-flex justify-content-center">
        <i type="button" v-if="!isLike" class="far fa-heart heart" @click="like"></i>
        <i type="button" v-if="isLike" class="fa fa-heart text-danger heart" @click="unlike"></i>
    </div>
</template>

<script>

import axios from 'axios';

export default {
    props: {
        tweetId: Number,
        isLike: Boolean
    },
    setup(props, context) {

        const execEmit = () => {
            context.emit('emitLike', !props.isLike);
        }

        const like = async () => {
            try {
                await axios.post('/api/like/' + props.tweetId)
                execEmit()
            } catch (error) {
                alert("エラーが発生しました。")
            }
        }

        const unlike = async() => {
            try {
                await axios.post('/api/unlike/' + props.tweetId)
                execEmit()
            } catch (error) {
                alert("エラーが発生しました。")
            }
        }

        return {
            like,
            unlike
        }
    }
}
</script>
<style>
i {
    font-size:1.5em;
}

.heart:active {
    animation: small 0.1s;
    animation-fill-mode: forwards;
}

@keyframes small 
{
    100% {transform: scale(0.9);}
}
</style>
