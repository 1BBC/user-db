<template>
    <div class="card">
        <div v-show="header" class="card-header">
            {{ header }}
        </div>
        <div class="card-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "MyCard",
    props: {
        header: '',
    }
}
</script>

<style scoped>

</style>
