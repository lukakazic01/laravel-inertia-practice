<template>
    <div class="my-6">
        <div v-if="isSuccess" class="p-4 rounded text-white font-semibold text-sm bg-green-500">
            {{ $page.props.flash.success }}
        </div>
        <div v-if="isError" class="p-4 rounded text-white font-semibold text-sm bg-red-500">
            <p v-if="!isFormError">{{ $page.props.flash?.error }}</p>
            <div v-else>
                <p v-for="(v, k) in page.props.flash.error.fields">
                    {{ k }}: {{ v }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
const page = usePage()
const isFormError = computed(() => page.props.flash?.error.fields)
const isError = computed(() => page.props.flash?.error)
const isSuccess = computed(() => page.props.flash?.success)
</script>

<style lang="scss" scoped>

</style>
