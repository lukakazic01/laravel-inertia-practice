<template>
    <nav class="p-4 bg-red-500 flex justify-between">
        <ul class="flex gap-4">
            <li>
                <NavLink :active="$page.component === 'Home'" href="/">
                    Home
                </NavLink>
            </li>
            <li>
                <NavLink :active="$page.component === 'Settings'" href="/settings">
                    Settings
                </NavLink>
            </li>
            <li>
                <NavLink :active="$page.component === 'Users'" href="/users">
                    Users
                </NavLink>
            </li>
            <li>
                <NavLink href="/logout" method="post" as="button" type="button">
                    Logout
                </NavLink>
            </li>
        </ul>
        <p class="text-white">Hello {{ username }}!</p>
    </nav>
</template>

<script setup>
import NavLink from "@/Shared/NavLink.vue";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

const page = usePage()

const username = computed(() => page.props.auth?.user?.username)
</script>

<style lang="scss" scoped>

</style>
