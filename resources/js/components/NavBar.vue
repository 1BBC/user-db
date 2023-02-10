<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link :to="{name: 'users'}" class="navbar-brand">
                User DB 💿
            </router-link>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li v-for="link in links" class="nav-item">
                        <router-link :to="{name: link.link_to}" exact-active-class="active" class="nav-link">
                            {{ link.title }}
                        </router-link>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "NavBar",
        data: () => ({
            links: [
                {
                    title: "Users",
                    link_to: "users",
                },
                {
                    title: "Add user",
                    link_to: "user-create",
                },
                {
                    title: "Positions",
                    link_to: "positions",
                }
            ]
        })
    }
</script>
