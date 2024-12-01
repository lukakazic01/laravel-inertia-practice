<template>
    <Nav />
    <div class="px-8 max-w-3xl mx-auto">
        <Toast />
        <slot />
    </div>
</template>

<script setup>
import Nav from "@/Shared/Nav.vue";
import Toast from "@/Shared/Toast.vue";
</script>

<style lang="scss" scoped>

</style>
