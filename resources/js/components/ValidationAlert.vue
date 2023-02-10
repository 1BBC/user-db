<template>
    <my-card class="text-danger border-danger mb-2">
        <ul>
            <li v-for="reason in reasons">{{ reason }}</li>
        </ul>
    </my-card>
</template>

<script>
import MyCard from "./UI/MyCard.vue";

export default {
    components: {MyCard},
    props: {
        fails: {},
    },
    computed: {
        reasons() {
            let result = [];
            for (const key in this.fails) {
                result.push(this.fails[key][0]);
            }

            return result;
        }
    }
}
</script>

<style scoped>
    ul {
        margin-bottom: 0;
    }
</style>
