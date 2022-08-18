<template>
    <div class="d-flex justify-content-center">
        <i type="button" v-if="!isLike" class="far fa-heart fa-lg" @click="like"></i>
        <i type="button" v-if="isLike" class="fa fa-heart fa-lg text-danger" @click="unlike"></i>
    </div>
</template>

<script>

import axios from 'axios';
import { ref } from 'vue'

export default {
    setup() {
        const isLike = ref(false)
    
        const like = async () => {
            await axios.post('/api/like/' + 1)
            isLike.value = true
        }

        const unlike = async() => {
            await axios.post('/api/unlike/' + 1)
            isLike.value = false
        }

        return {
            isLike,
            like,
            unlike
        }
    }
}
</script>
