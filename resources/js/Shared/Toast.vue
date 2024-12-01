<template>
    <div class="my-6">
        <div v-if="isSuccess" class="p-4 rounded text-white font-semibold text-sm bg-green-500">
            {{ $page.props.flash.success }}
        </div>
        <div v-if="isError || isFormError" class="p-4 rounded text-white font-semibold text-sm bg-red-500">
            <p v-if="!isFormError">{{ $page.props.flash?.error }}</p>
            <div class="flex flex-col gap-4" v-else>
                <p v-if="isFormError > 1">There are {{ isFormError }} errors in the form</p>
                <p v-else>There is 1 error in the form</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
const page = usePage()
const isError = computed(() => page.props.flash?.error)
const isFormError = computed(() => Object.keys(page.props.errors).length)
const isSuccess = computed(() => page.props.flash?.success)
</script>

<style lang="scss" scoped>

</style>
