<script setup lang="ts">

</script>

<template>
    <div class="auth-page">
        <div class="auth-page-wrapper">
            <div class="auth-page-content">
                <div class="auth-page-header">
                    <img
                        class="auth-page-header__logo"
                        src="http://localhost/slack-logo.svg"
                        alt="Slack"
                    />
                    <div class="auth-page-header__title">slack.com</div>
                </div>
                <div class="auth-page-form">
                    <router-view />
                </div>
                <div class="auth-page-divider" />
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.auth-page {
    display: flex;
    flex-wrap: wrap;
    height: 100%;

    &-wrapper {
        max-width: 960px;
        align-self: center;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    &-content {
        margin: 16px 0;
    }

    &-header {
        text-align: center;
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;

        &__logo {
            background-image: url(https://a.slack-edge.com/bv1-13/slack_logo-ebd02d1.svg);
            height: 56px;
            background-size: cover;
        }

        &__title {
            margin-bottom: 16px;
            margin-top: 20px;
            font-size: 19px;
            font-weight: 600;
            line-height: 1.2;
            color: #333238;
        }
    }

    &-form {
        padding: 0.75rem;
        margin-bottom: 0.5rem;
    }
}

.auth-page-divider {
    height: 216px;
}
</style>
