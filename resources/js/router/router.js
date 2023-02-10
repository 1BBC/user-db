import {createRouter, createWebHistory} from "vue-router";
import Users from "../pages/Users.vue"
import UserCreate from "../pages/UserCreate.vue"
import Positions from "../pages/Positions.vue"
import User from "../pages/User.vue";

const routes = [
    {
        path: '/',
        component: Users,
        name: 'users',
    },
    {
        path: '/users/:id',
        component: User,
        name: 'user',
    },
    {
        path: '/users/create',
        component: UserCreate,
        name: 'user-create',
    },
    {
        path: '/positions',
        component: Positions,
        name: 'positions',
    }
];

const router = createRouter({
    routes,
    history: createWebHistory()
});

export default router;
