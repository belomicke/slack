<script setup lang="ts">

</script>

<template>
    <div class="loading-screen">
        <img
            class="loading-screen__logo"
            src="http://localhost/slack-logo.svg"
            alt="Slack"
        />
    </div>
</template>

<style lang="scss">
.loading-screen {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;

    &__logo {
        height: 256px;
    }
}
</style>
