<template>
    <div class="d-flex justify-content-center">
        <i type="button" class="heart" :class="[ isLike ? 'fa fa-heart text-danger' : 'far fa-heart']" @click="likeAction"></i>
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

        const likeAction = async() => {
            try {
                await axios.post('/api/likeAction/' + props.tweetId)
                execEmit()
            } catch (error) {
                alert("エラーが発生しました。")
            }
        }

        return {
            likeAction
        }
    }
}
</script>
<style>
.heart {
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
