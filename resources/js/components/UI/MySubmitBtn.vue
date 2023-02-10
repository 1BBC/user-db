<template>
    <button v-if="loading" class="btn btn-primary" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        ⏳ Loading...
    </button>
    <button v-else class="btn btn-outline-primary" type="button" @click="this.$emit('btn-click');">
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: "MySubmitBtn",
    props: {
        loading: true,
    },
}
</script>

<style scoped>

</style>
