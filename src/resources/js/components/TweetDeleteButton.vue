<template>
    <button v-if="isLoginUser" type="button" id="deleteBtn" class="btn btn-outline-danger rounded-pill" @click="deleteTweet">削除</button>
</template>

<script>
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
    props: {
        tweetId: Number,
        isLoginUser: Boolean
    },
    setup(props) {
        const router = useRouter();

        const deleteTweet = async () => {
            deleteBtn.disabled = true;

            if (confirm('ツイートを削除しますか？')) {
                try {
                    await axios.post('/api/deleteTweet/' + props.tweetId)
                    router.push({ path: '/home' });
                } catch (error) {
                    console.log(error)
                    alert("エラーが発生しました。")
                    deleteBtn.disabled = false;
                }
            }
        }

        return {
            deleteTweet
        }
    }
}
</script>
