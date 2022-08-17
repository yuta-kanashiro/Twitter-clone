<template>
    <div>
        <button type="button" class="btn btn-outline-dark rounded-pill" @click="openModal">編集</button>

        <div id="overlay" v-show="showContent">
            <div id="content" class="container">
                <div class="row justify-content-center">
                    <div class="">
                        <form  enctype="multipart/form-data" @submit="updateUser">
                            <div class="form-group row">
                                <label for="account_name" class="col-lg-4 mt-2">アカウント名:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="account_name" v-model="loginUser.account_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_name" class="col-lg-4 mt-2">ユーザーネーム:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="account_name" v-model="loginUser.user_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile_text" class="col-lg-4 mt-2">プロフィール文:</label>
                                <div class="col-lg-6">
                                    <textarea type="text" class="form-control" id="account_name" v-model="loginUser.profile_text"></textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-outline-dark rounded-pill me-2" >更新する</button>
                                <button type="button" class="btn btn-dark rounded-pill" @click="closeModal">閉じる</button>
                            </div>
                            {{id}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue'

export default {
    props: {
        loginUser: Object,
        id: Number
    },
    setup(props, context){
        const showContent = ref(false);
        console.log(props.loginUser)
        console.log(props.id)

        // モーダルウィンドウを表示する
        const openModal = () => {
            showContent.value = true;
        };

        // モーダルウィンドウを閉じる
        const closeModal = () => {
            showContent.value = false;
        }; 

        const execEmit = () => {
            context.emit('loginUser', props.user);
        }

        // ログインユーザーの情報を取得
        const getLoginUser = async () => {
            const response = await axios.get('/getLoginUser')
            // loginUser.value = response.data
            // console.log(response)
        }

        // ユーザー情報を更新
        const updateUser = async () => {
            const response = await axios.post('/userProfile/update/' + loginUser.value.id)
            loginUser.value = response.data
            execEmit()
            closeModal()
        }

        onMounted(() => {
            getLoginUser()
        })

        return {
            // loginUser,
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
