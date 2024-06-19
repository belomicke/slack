<script lang="ts">
export default {
    name: 'AuthFormParagraph',
}
</script>

<template>
    <p class="auth-form-paragraph">
        <slot></slot>
    </p>
</template>

<style>
.auth-form-paragraph {
    text-align: center;
    margin-top: .5rem;
    margin-bottom: 1rem;
}
</style>
