<template>
    <button v-if="isLoginUser" type="button" class="btn btn-outline-danger rounded-pill">削除</button>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue'

export default {
    props: {
        isLoginUser: Boolean
    },
    setup(){
        const users = ref([]);

        // ユーザー一覧取得
        const getUserList = async() => {
            const response = await axios.get('/api/usersList')
            users.value = response.data
        }


        return{
            users,
        }
    }
}
</script>
