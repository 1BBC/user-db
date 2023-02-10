<template>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="position in positions">
            <th scope="row">{{ position.id }}</th>
            <td>{{ position.name }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "PositionsTable",
    props: {
        positions: {
            type: Array
        }
    }
}
</script>

<style scoped>

</style>
