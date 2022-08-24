<template>
    <div>
        <button type="button" class="btn btn-outline-dark rounded-pill" @click="openModal">編集</button>

        <div id="overlay" v-show="showContent">
            <div id="content" class="container">
                <div class="justify-content-center">
                    <div class="">
                        <form id="editForm" enctype="multipart/form-data" @submit="updateUser">
                            <div class="form-group text-center">
                                <label for="profile_image" class="mt-2">
                                    <div v-if="!loginUser.profile_image">
                                        <img id="icon" class="rounded-circle border" src="../img/default.png" alt="プロフィール画像" width="130" height="130">
                                    </div>
                                    <div v-else>
                                        <img id="icon" class="rounded-circle border" :src="url" width="130" height="130">
                                    </div>
                                    <input type="file" class="icon-update form-control" id="profile_image" name="profile_image" accept="image/*" style="display: none" @change="previewImage">
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="account_name" class="mt-2">アカウント名</label>
                                <input type="text" class="form-control" id="account_name" name="account_name" :value="loginUser.account_name" required maxlength="20">
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="mt-2">ユーザーネーム</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" :value="loginUser.user_name" required maxlength="10">
                            </div>
                            <div class="form-group">
                                <label for="profile_text" class="mt-2">プロフィール文</label>
                                <textarea type="text" class="form-control" id="profile_text" name="profile_text" :value="loginUser.profile_text" maxlength="120"></textarea>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" id="editBtn" class="btn btn-outline-dark rounded-pill me-2">更新する</button>
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
        const url = ref(props.loginUser.profile_image)
        const preview =ref()
        const showContent = ref(false);

        // モーダルウィンドウを表示する
        const openModal = () => {
            showContent.value = true;
        }

        // モーダルウィンドウを閉じる
        const closeModal = () => {
            showContent.value = false;
        }

        // プロフィール画像のプレビュー
        const previewImage = () => {
            const inputImage = document.getElementById('profile_image');
            preview.value = inputImage.files[0];
            const fileReader = new FileReader();
            
            fileReader.onload = (e) => {
                url.value = e.target.result;
            };
            fileReader.readAsDataURL(preview.value);
        }

        // ユーザー情報を更新
        const updateUser = async () => {
            editBtn.disabled = true;
            const loginUser = props.loginUser
            const userData = new FormData(editForm);
            try {
                const response = await axios.post('/api/userProfile/update', userData)
                loginUser.value = response.data
                closeModal()
            } catch (error) {
                alert("エラーが発生しました。")
            }
        }

        return {
            url,
            preview,
            showContent,
            openModal,
            closeModal,
            previewImage,
            updateUser
        }
    }
}
</script>
<style>
#overlay{
    z-index: 2;
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
    z-index: 3;
    padding: 1em;
    margin: 1em;
    max-width: 500px;
    background: #fff;
    border-radius: 20px;
}
</style>
