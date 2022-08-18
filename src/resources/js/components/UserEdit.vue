<template>
    <div>
        <button type="button" class="btn btn-outline-dark rounded-pill" @click="openModal">編集</button>

        <div id="overlay" v-show="showContent">
            <div id="content" class="container">
                <div class="row justify-content-center">
                    <div class="">
                        <form enctype="multipart/form-data" @submit="updateUser">
                            <div class="form-group row">
                                <label for="account_name" class="col-lg-4 mt-2">アカウント名:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="account_name" name="account_name" :value="loginUser.account_name" required maxlength="20">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_name" class="col-lg-4 mt-2">ユーザーネーム:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="user_name" name="user_name" :value="loginUser.user_name" required maxlength="10">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile_text" class="col-lg-4 mt-2">プロフィール文:</label>
                                <div class="col-lg-6">
                                    <textarea type="text" class="form-control" id="profile_text" name="profile_text" :value="loginUser.profile_text" maxlength="120"></textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-outline-dark rounded-pill me-2">更新する</button>
                                <button type="button" class="btn btn-dark rounded-pill" @click="closeModal">閉じる</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue'

export default {
    props: {
        loginUser: Object
    },
    setup(props) {
        const showContent = ref(false);

        // モーダルウィンドウを表示する
        const openModal = () => {
            showContent.value = true;
        };

        // モーダルウィンドウを閉じる
        const closeModal = () => {
            showContent.value = false;
        }; 

        // ユーザー情報を更新
        const updateUser = async (e) => {
            const loginUser = props.loginUser
            const userData = new FormData();
            userData.append("account_name", e.target.account_name.value);
            userData.append("user_name", e.target.user_name.value);
            userData.append("profile_text", e.target.profile_text.value);
            try {
                const response = await axios.post('/api/userProfile/update', userData)
                loginUser.value = response.data
                closeModal()
            } catch (error) {
                alert("エラーが発生しました。")
            }
        }

        return {
            showContent,
            openModal,
            closeModal,
            updateUser
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
    width:50%;
    padding: 1em;
    background:#fff;
    border-radius: 20px;
}
</style>
