<template>
    <div>
        <template v-for="link in links">
            <Component
                :is="link.url ? 'Link' : 'span'"
                :href="link.url"
                v-html="link.label"
                class="px-1"
                :class="[link.url && 'text-gray-500', link.active && '!text-blue-500 underline font-bold']"
            />
        </template>
    </div>
</template>

<script setup>
defineProps({
    links: Array
})
</script>

<style lang="scss" scoped>

</style>
