<script setup lang="ts">
import { useViewer } from '@/entities/Viewer/hooks/useViewer'
import { useDeleteAccessToken } from '@/shared/api/hook/auth/useDeleteAccessToken'

const { data: viewer } = useViewer()

const { mutate: deleteAccessToken } = useDeleteAccessToken()

const logoutHandler = () => {
    deleteAccessToken()
}
</script>

<template>
    <div class="welcome-page-header" v-if="viewer">
        <img
            class="welcome-page-header__logo"
            src="http://localhost/slack-logo-with-name.svg"
            alt="Slack"
        />
        <div class="welcome-page-header-viewer-email">
            {{ 'Вы вошли как' }}
            <span class="welcome-page-header-viewer-email__email">{{ viewer.email }}</span>
            <button
                class="welcome-page-header-viewer-email__button"
                @click="logoutHandler"
            >
                {{ 'Выйти' }}
            </button>
        </div>
    </div>
</template>

<style lang="scss">
.welcome-page-header {
    display: flex;
    flex-direction: column;
    background: #f4ede480;
    padding: 48px 0 32px;

    &__logo {
        height: 26px;
    }

    &-viewer-email {
        display: flex;
        margin: 16px auto 0;
        background-color: #fffc;
        border-radius: 50px;
        white-space: pre;
        padding: 0 16px;
        height: 32px;
        font-size: 13px;
        line-height: 32px;
        color: #1d1c1d;
        width: fit-content;

        &__email {
            font-weight: 700;
            padding-right: 5px;
        }

        &__button {
            background-color: transparent;
            border: 0;
            outline: 0;
            padding: 0;
            color: rgb(97, 96, 97);

            &:hover {
                cursor: pointer;
                text-decoration: underline;
            }
        }
    }
}
</style>
