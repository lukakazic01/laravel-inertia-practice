<template>
    <Link :class="{'font-bold underline': active }" class="text-white hover:underline" href="/">
        <slot />
    </Link>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    active: {
        type: Boolean,
        required: false
    }
})
</script>

<style lang="scss" scoped>

</style>
