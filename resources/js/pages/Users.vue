<template>
    <div>
        <h1 class="mt-3">List of users</h1>
        <my-card>
            <user-filters @filter-change="handleFilterChange"></user-filters>
            <users-table :users="users"></users-table>

            <div v-show="Object.keys(meta).length && nextPage" class="text-center">
                <p>Page <b>{{ meta.page }}</b> of <b>{{ meta.total_pages }}</b></p>
                <my-submit-btn :loading="loading" @btn-click="loadUsers">⤵ Show more</my-submit-btn>
            </div>
        </my-card>

    </div>
</template>

<script>
import axios from "axios";
import UserFilters from "../components/UserFilters.vue";
import UsersTable from "../components/UsersTable.vue";
import MySubmitBtn from "../components/UI/MySubmitBtn.vue";
import MyCard from "../components/UI/MyCard.vue";

export default {
    name: "Users",
    components: {MyCard, MySubmitBtn, UsersTable, UserFilters},

    data: () => ({
        loading: true,
        users: [],
        meta: {
            page: null,
            total_pages: null,
            total_users: null,
            count: null,
        },
        filter: {},
    }),

    mounted() {
        this.loadUsers();
    },

    computed: {
        params() {
            const data = {
                ...{page: this.nextPage},
                ...this.filter
            };
            const filteredData = Object.entries(data)
                .filter(([key, value]) => value !== null && value !== '' && value !== 0);

            return  Object.fromEntries(filteredData);
        },
        nextPage() {
            if (!Object.keys(this.meta).length) {
                return 1;
            }

            if (this.meta.page >= this.meta.total_pages) {
                return null;
            }

            return this.meta.page + 1;
        },
    },

    methods: {
        async loadUsers() {
            this.loading = true;

            axios.get('/api/v1/users', {params: this.params})
                .then((response) => {
                    this.users = [...this.users, ...response.data.users];
                    this.meta.page = response.data.page;
                    this.meta.total_pages = response.data.total_pages;
                    this.meta.total_users = response.data.total_users;
                    this.meta.count = response.data.count;
                })
                .catch((error) => {
                    if (error.response.status === 404) {
                        this.$toast.show('Empty list');
                        return;
                    }
                    this.$toast.error('Data fetch error');
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        handleFilterChange(filter) {
            this.filter = filter;
            this.users = [];
            this.meta = {};
            this.loadUsers();
        }
    }
}
</script>
