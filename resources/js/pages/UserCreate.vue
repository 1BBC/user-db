<template>
    <my-card :header="'Create new user'" class="mt-3">
        <form @submit.prevent>
            <validation-alert v-show="showErrors" :fails="fails"></validation-alert>
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input v-model="form.name" name="name" type="text" class="form-control" id="name" aria-describedby="name" placeholder="Jane Doe">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input v-model="form.email" name="email" type="email" class="form-control" id="email" aria-describedby="email" placeholder="example@mail.com">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="phone">Phone</label>
                    <input v-model="form.phone" name="phone" type="text" class="form-control" id="phone" aria-describedby="phone" placeholder="+380...">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="position-id">Position</label>
                    <select v-model="form.position_id" name="position_id" class="form-control" id="position-id">
                        <option v-for="position in positions" :value="position.id">{{ position.name }}</option>
                    </select>
                </div>

                <div class="form-group col-md-6 mb-3">
                    <div>
                        <label for="Photo">Photo 📷</label>
                    </div>
                    <input @change="setPhoto" name="photo" type="file" class="form-control-file mt-1" id="Photo">
                </div>
            </div>
            <div class="text-center">
                <my-submit-btn :loading="loading" @btn-click="store">💾 Save</my-submit-btn>
            </div>

        </form>
    </my-card>
</template>

<script>
import axios from "axios";
import MySubmitBtn from "../components/UI/MySubmitBtn.vue";
import MyCard from "../components/UI/MyCard.vue";
import ValidationAlert from "../components/ValidationAlert.vue";

export default {
    name: "UserCreate",
    components: {ValidationAlert, MyCard, MySubmitBtn},

    data: () => ({
        loading: true,
        positions: [],
        token: null,
        form: {
            name: "",
            email: "",
            phone: "",
            position_id: null,
            photo: null
        },
        fails: {},
    }),

    mounted() {
        this.loadPositions();
        this.loadToken();
    },

    computed: {
        showErrors() {
            return JSON.stringify(this.fails) !== '{}';
        }
    },

    methods: {
        async loadPositions() {
            this.loading = true;
            axios.get('/api/v1/positions')
                .then((response) => {
                    this.positions = response.data.positions;
                    this.loading = false;
                })
                .catch((error) => {
                    this.$toast.error('Data fetch error');
                });
        },
        loadToken() {
            this.loading = true;
            axios.get('/api/v1/token')
                .then((response) => {
                    this.token = response.data.token;
                    this.loading = false;
                    this.$toast.show(`Your token has been verified`);
                })
                .catch((error) => {
                    this.$toast.error(`Your token has not been validated`);
                });
        },
        store () {
            axios.post('/api/v1/users', this.form,
                {
                    headers: {
                        Token: this.token,
                        "Content-Type": "multipart/form-data",
                    }
                })
                .then((response) => {
                    this.$toast.success(`Successfully added a new user`);
                    this.$router.push({ name: 'users' });
                })
                .catch((error) => {
                    if (error.response) {
                        if (!error.response.data.message) {
                            this.$toast.error('Form submission error');
                            return;
                        }

                        this.$toast.error(error.response.data.message);

                        if (error.response.data.fails) {
                            this.fails = error.response.data.fails;
                        }
                    }
                });
        },
        setPhoto(event) {
            this.form.photo = event.target.files[0];
        }
    }
}
</script>

<style scoped>

</style>
