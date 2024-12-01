<template>
    <Head title="Edit User" />
    <div class="text-center font-bold text-2xl mt-6">
        <p>Edit User</p>
    </div>
    <form class="mt-6 flex flex-col gap-6">
        <div class="flex flex-col gap-2">
            <label class="block font-bold text-xs text-gray-700" for="name">Name</label>
            <input name="name"
                   id="name"
                   type="text"
                   placeholder="Name"
                   class="border rounded border-gray-400 p-2 w-full"
                   v-model="editForm.name"
                   :class="[nameError && 'border-red-500']"
            />
            <p v-if="nameError" class="text-xs text-red-500">{{ nameError }}</p>
        </div>
        <div class="flex flex-col gap-2">
            <label class="block font-bold text-xs text-gray-700" for="email">Email</label>
            <input id="email"
                   name="email"
                   type="email"
                   placeholder="Email"
                   class="border rounded border-gray-400 p-2 w-full"
                   v-model="editForm.email"
                   :class="[emailError && 'border-red-500']"
            />
            <p v-if="emailError" class="text-xs text-red-500">{{ emailError }}</p>
        </div>
        <div class="flex flex-col gap-2">
            <label class="block font-bold text-xs text-gray-700" for="password">Password</label>
            <input id="password"
                   name="password"
                   type="text"
                   placeholder="Password"
                   class="border rounded border-gray-400 p-2 w-full"
                   v-model="editForm.password"
                   :class="[passwordError && 'border-red-500']"
            />
            <p v-if="passwordError" class="text-xs text-red-500">{{ passwordError }}</p>
        </div>
        <div>
            <button
                :disabled="editForm.processing"
                @click.prevent="editUser"
                class="rounded bg-blue-500 text-white p-2 w-full"
                :class="[editForm.processing && '!bg-blue-400']"
            >
                Edit
            </button>
            <button
                :disabled="deleteForm.processing"
                @click.prevent="deleteUser"
                class="rounded mt-6 bg-red-500 text-white p-2 w-full"
                :class="[deleteForm.processing && '!bg-red-400']"
            >
                Delete
            </button>
        </div>
    </form>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import {computed} from "vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    email: String,
    name: String,
    id: Number
})

const editForm = useForm({
    name: props.name,
    email: props.email,
    password: ''
})

const deleteForm = useForm({});

const emailError = computed(() => editForm.errors.email)
const nameError = computed(() => editForm.errors.name)
const passwordError = computed(() => editForm.errors.password)

const editUser = () => {
    editForm.patch(`/users/${props.id}`)
}

const deleteUser = () => {
    deleteForm.delete(`/users/${props.id}`)
}
</script>

<style lang="scss" scoped>

</style>
