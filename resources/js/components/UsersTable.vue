<template>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Position</th>
            <th scope="col" class="hide-on-phone">Email</th>
            <th scope="col" class="hide-on-phone">Phone</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users">
            <th scope="row">{{ user.id }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.position }}</td>
            <td class="hide-on-phone">{{ user.email }}</td>
            <td class="hide-on-phone">{{ user.phone }}</td>
            <td>
                <router-link
                    type="button"
                    aria-pressed="true"
                    class="btn btn-outline-dark btn-sm"
                    :to="{name: 'user', params: { id: user.id } }">
                    👁
                </router-link>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "UsersTable",
    props: {
        users: {
            type: Array
        }
    },
}
</script>

<style scoped>
    @media (max-width: 767px) {
        .hide-on-phone {
            display: none;
        }
    }
</style>
