<template>
    <div>
        <h1 class="mt-3">List of positions</h1>
        <my-card>
            <positions-table :positions="positions"></positions-table>
            <my-spin v-show="loading"></my-spin>
        </my-card>
    </div>
</template>

<script>
import axios from "axios";
import MySpin from "../components/UI/MySpin.vue";
import PositionsTable from "../components/PositionsTable.vue";
import MyCard from "../components/UI/MyCard.vue";

export default {
    name: "Positions",
    components: {MyCard, PositionsTable, MySpin},

    data: () => ({
        loading: true,
        positions: []
    }),

    mounted() {
        this.loadPositions();
    },

    methods: {
        loadPositions() {
            this.loading = true;
            axios.get('/api/v1/positions')
                .then((response) => {
                    this.positions = response.data.positions
                })
                .catch((error) => {
                    console.log(error);
                });
            this.loading = false;
        },
    }
}
</script>

<style scoped>

</style>
