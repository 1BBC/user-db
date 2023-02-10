<template>
    <my-spin v-if="loading" class="mt-3"></my-spin>
    <div v-else class="user mt-3">
        <h1>{{ user.name }}</h1>
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-3">
                    <img :src="user.photo" class="rounded-circle img-thumbnail user-photo" :alt="user.name">
                </div>
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th scope="row">ID:</th>
                        <td>{{ user.id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Name:</th>
                        <td>{{ user.name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email:</th>
                        <td>{{ user.email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone:</th>
                        <td>{{ user.phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Position:</th>
                        <td><code>#{{ user.position_id }}</code> {{ user.position }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Registration Date:</th>
                        <td>{{ regDate }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>

<script>
import MySpin from "../components/UI/MySpin.vue";
import axios from "axios";

export default {
    name: "User",
    components: {MySpin},

    data: () => ({
        loading: true,
        user: []
    }),

    mounted() {
        this.loadUser();
    },

    computed: {
        regDate() {
            const date = new Date(this.user.registration_timestamp * 1000);
            return date.getHours() + ":" + date.getMinutes() + ", "+ date.toDateString();
        }
    },

    methods: {
        loadUser() {
            this.loading = true;
            axios.get('/api/v1/users/' + this.$route.params.id)
                .then((response) => {
                    this.user = response.data.user;
                })
                .catch((error) => {
                    if (error.response.status === 404) {
                        this.$toast.warning('User not found');
                        this.$router.push({ name: 'users' });
                        return;
                    }
                    this.$toast.error('Data fetch error');
                });
            this.loading = false;
        },
    }
}
</script>

<style scoped>
    .user-photo {
        width: 70px;
    }
</style>
