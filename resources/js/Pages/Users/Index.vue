<template>
    <div class="mt-6">
        <div class="flex justify-between items-center">
            <Link v-if="canEdit" href="/users/create" class="bg-blue-500 text-white p-2 rounded">Create user</Link>
            <input type="text" v-model="searchValue" placeholder="Search..." class="p-2 outline-0 border border-gray-200 rounded" />
        </div>
        <div class="relative overflow-x-auto mt-6">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                           Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="user in users.data" :key="user.id">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ user.id }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ user.name }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ user.email }}
                        </th>
                        <th v-if="user.can.edit" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <Link :href="`/users/${user.id}/edit`" class="bg-red-500 block text-center text-white p-2 rounded outline-0 w-full">Edit</Link>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-center">
            <Pagination v-if="users.links" :links="users.links" class="mt-6" />
        </div>
    </div>
</template>

<script setup>
import Pagination from "@/Shared/Pagination.vue";
import {computed, ref, watch} from "vue";
import {router, usePage} from "@inertiajs/vue3"
import {Link} from "@inertiajs/vue3";
import debounce from 'lodash.debounce';

const page = usePage()
const props = defineProps({
    users: Object,
    filters: Object
})

const searchValue = ref(props.filters.search)
const canEdit = computed(() => page.props.auth.user.can.create)

watch(searchValue, debounce(() => {
    router.get('/users', { search: searchValue.value }, { preserveState: true, replace: true })
}, 500))
</script>

<style lang="scss" scoped>

</style>
