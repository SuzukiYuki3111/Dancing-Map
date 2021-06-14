<template>
<i v-if="name === 'star' " class="fas fa-star text-yellow-300"></i>
<i v-else-if="name === 'star-outline' " class="far fa-star"></i>
</template>

<script>
    export default {
        props: {
            name: String,
        }
    }
</script>
