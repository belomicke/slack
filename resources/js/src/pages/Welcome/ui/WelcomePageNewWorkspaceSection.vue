<script setup lang="ts">
import LandingViewSvg from './LandingViewSvg.vue'
import { useWelcomePageStore } from '../store'

const welcomePageStore = useWelcomePageStore()

const newWorkspaceHandler = () => {
    welcomePageStore.setWelcomePageScreen('create-new-workspace')
}
</script>

<template>
    <div class="welcome-page-new-workspace-section">
        <div class="welcome-page-new-workspace-section-container">
            <div class="create-new-workspace">
                <h2 class="create-new-workspace__title">Создайте новое окружение</h2>
                <div class="create-new-workspace__subtitle">
                    Slack даёт вашей команде дом - место, где вы можете общаться и работать сообща. Чтобы создать новое
                    рабочее окружение, кликните на кнопку ниже.
                </div>
                <div
                    class="create-new-workspace__button"
                    @click="newWorkspaceHandler"
                >
                    Создать окружение
                </div>
            </div>
            <div class="landing-view">
                <landing-view-svg />
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.welcome-page-new-workspace-section {
    background: #f4ede480;
    padding-top: 12px;
    padding-bottom: 48px;

    &-container {
        display: grid;
        grid-template-columns: 1fr 350px;
        max-width: 700px;
        margin: 0 auto;
    }
}

.create-new-workspace {
    display: flex;
    flex-direction: column;

    &__title {
        letter-spacing: -.25px;
        margin-bottom: 12px;
        padding-right: 24px;
        font-family: Slack-Larsseit, Helvetica Neue, Helvetica, Segoe UI, Tahoma, Arial, sans-serif;
        font-size: 44px;
        font-weight: 700;
        line-height: 48px;
    }

    &__subtitle {
        flex-grow: 1;
        width: 80%;
        margin-bottom: 20px;
        font-size: 18px;
        line-height: 27px;
    }

    &__button {
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        color: #fff;
        background-color: #611f69;
        border: none;
        max-width: max-content;
        height: 44px;
        margin-bottom: 16px;
        padding: 0 16px;
        min-width: 56px;
        font-size: 18px;
        font-weight: 700;
        border-radius: 12px;
        transition: all .150s;

        &:hover {
            background-color: #611f69e6;
            border: none;
            box-shadow: 0 1px 3px #00000014;
        }
    }
}

@media (min-width: 850px) {
    .welcome-page-new-workspace-section-container {
        max-width: 800px;
        margin: 0 auto;
    }
}

@media only screen and (max-width: 850px) {
    .landing-view {
        width: auto;
    }
}

@media only screen and (max-width: 700px) {
    .welcome-page-new-workspace-section-container {
        display: flex;
        padding: 0 24px;
    }

    .landing-view {
        display: none;
    }

    .create-new-workspace__subtitle {
        width: 100%;
    }
}
</style>
