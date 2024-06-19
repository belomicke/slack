<script lang="ts">
export default {
    name: 'AuthLink',
    props: {
        href: {
            type: String,
            required: true,
        },
    },
}
</script>

<template>
    <router-link :to="href">
        <slot></slot>
    </router-link>
</template>

<style scoped>
a {
    color: #1f75cb;
    text-decoration: none;
    background-color: rgba(0, 0, 0, 0);

    &:hover {
        color: #1f75cb;
        text-decoration: underline;
    }
}
</style>
