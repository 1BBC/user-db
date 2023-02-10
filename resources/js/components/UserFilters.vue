<template>
    <form @submit.prevent @change="this.$emit('filter-change', this.filter)">
        <div class="input-group mb-3">
            <span class="input-group-text">🔎</span>
            <input v-model.trim="filter.name" type="text" aria-label="Name" name="name" placeholder="Name" class="form-control">
            <input v-model.trim="filter.position" type="text" aria-label="Position" name="position" placeholder="Position" class="form-control">
            <input v-model.trim="filter.email" type="text" aria-label="Email" name="email" placeholder="Email" class="form-control">
            <input v-model.trim="filter.phone" type="text" aria-label="Phone" name="phone" placeholder="Phone" class="form-control">
        </div>
    </form>
</template>

<script>
export default {
    name: "UserFilters",
    data: () => ({
        filter: {
            name: '',
            position: '',
            email: '',
            phone: ''
        }
    }),
}
</script>

<style scoped>

</style>
