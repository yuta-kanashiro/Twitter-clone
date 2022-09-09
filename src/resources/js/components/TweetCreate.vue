<template>
    <div>
        <i class="fas fa-plus-circle tweet-btn" @click="openModal"></i>

        <div id="overlay" v-if="showContent">
            <div id="content" class="container">
                <div class="justify-content-center">
                    <form id="tweetForm" action="" method="">
                        <div class="text-center">
                            <div v-if="!loginUser.profile_image">
                                <img class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="60" height="60">
                            </div>
                            <div v-else>
                                <img class="rounded-circle border" :src="loginUser.profile_image" alt="プロフィール画像" width="60" height="60">
                            </div>
                            <div class="mt-2">
                                <textarea type="text" name="text" id="tweetText" class="form-control" placeholder="ツイートしてみよう" maxlength="140" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" id="tweetBtn" class="btn btn-info text-white rounded-pill me-2" @click="createTweet">ツイートする</button>
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
import { ref } from 'vue'

export default {
    setup(){
        const showContent = ref(false);
        const loginUser = ref()

        // ログインユーザーの情報を取得
        const getLoginUser = async () => {
            const response = await axios.get('/api/loginUser')
            loginUser.value = response.data
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

        // // ツイートを投稿
        const createTweet = async () => {
            tweetBtn.disabled = true;
            const tweetForm  = document.getElementById('tweetForm')
            const tweetData = new FormData(tweetForm);

            try {
                await axios.post('/api/createTweet', tweetData)
                location.href('/home')
            } catch (error) {
                alert("エラーが発生しました。")
                tweetBtn.disabled = false;
            }
        }

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
    z-index: 1;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}
#content{
    z-index: 2;
    padding: 1em;
    margin: 1em;
    max-width: 500px;
    background: #fff;
    border-radius: 20px;
}
</style>
