<template>
    <div class="max-w-xl mx-auto px-6">
        <Head title="Login" />
        <div class="text-center font-bold text-2xl mt-6">
            <p>Login</p>
        </div>
        <form class="mt-6 flex flex-col gap-6">
            <div class="flex flex-col gap-2">
                <label class="block font-bold text-xs text-gray-700" for="email">Email</label>
                <input id="email"
                       name="email"
                       type="email"
                       placeholder="Email"
                       class="border rounded border-gray-400 p-2 w-full"
                       v-model="form.email"
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
                       v-model="form.password"
                       :class="[passwordError && 'border-red-500']"
                />
                <p v-if="passwordError" class="text-xs text-red-500">{{ passwordError }}</p>
            </div>
            <div>
                <button
                    :disabled="form.processing"
                    @click.prevent="submit"
                    class="rounded bg-red-500 text-white p-2 w-full"
                    :class="[form.processing && 'bg-red-400']"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import {computed} from "vue";
import {useForm} from "@inertiajs/vue3";

defineOptions({
    layout: null
})

const form = useForm({
    email: '',
    password: ''
})

const emailError = computed(() => form.errors.email)
const passwordError = computed(() => form.errors.password)
const submit = () => {
    form.post('/login')
}
</script>

<style lang="scss" scoped>

</style>
