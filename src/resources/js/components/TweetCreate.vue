<template>
    <div>
        <i class="fas fa-plus-circle tweet-btn" @click="openModal"></i>

        <div id="overlay" v-if="showContent">
            <div id="content" class="container">
                <div class="justify-content-center">
                    <form @submit="createTweet">
                        <div class="text-center">
                            <div v-if="!loginUser.profile_image">
                                <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="60" height="60">
                            </div>
                            <div v-else>
                                <!-- プロフィール画像編集機能追加後、ここに記述を追加 -->
                            </div>
                            <div class="mt-2">
                                <textarea type="text" name="text" id="form" class="form-control" placeholder="ツイートしてみよう" maxlength="140" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" id="btn" class="btn btn-info text-white rounded-pill me-2">ツイートする</button>
                            <button type="button" class="btn btn-dark rounded-pill" @click="closeModal">閉じる</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue'

export default {
    setup(props, context){
        const showContent = ref(false);
        const loginUser = ref()

        // ログインユーザーの情報を取得
        const getLoginUser = async () => {
            const response = await axios.get('/api/loginUser')
            loginUser.value = response.data
            console.log(response.data)
        }

        // モーダルウィンドウを表示する
        const openModal = () => {
            showContent.value = true;
            getLoginUser()
        };
        // モーダルウィンドウを閉じる
        const closeModal = () => {
            showContent.value = false;
        }; 

        // ツイートを投稿
        const createTweet = async (e) => {
            btn.disabled = true;
            const tweetData = new FormData();
            const tweetText = e.target.text.value;
            tweetData.append("text", tweetText);

            try {
                await axios.post('/api/createTweet', tweetData)
            } catch (error) {
                console.log(error)
                alert("エラーが発生しました。")
            }
        }

        // onMounted(() => {
        //     getLoginUser()
        // })

        return {
            loginUser,
            showContent,
            openModal,
            closeModal,
            createTweet
        }
    }
}
</script>
<style>
#overlay{
    /*　要素を重ねた時の順番　*/
    z-index:1;
    /*　画面全体を覆う設定　*/
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background-color:rgba(0,0,0,0.5);
    /*　画面の中央に要素を表示させる設定　*/
    display: flex;
    align-items: center;
    justify-content: center;
}
#content{
    z-index:2;
    padding: 1em;
    margin: 1em;
    max-width: 500px;
    /* width: 70%; */
    background:#fff;
    border-radius: 20px;
}
</style>
