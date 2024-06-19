<script setup lang="ts">
import { storeToRefs } from 'pinia'
import WelcomePageHeader from './WelcomePageHeader.vue'
import WelcomePageNewWorkspaceSection from './WelcomePageNewWorkspaceSection.vue'
import WelcomePageWorkspacesList from './WelcomePageWorkspacesList.vue'
import CreateWorkspaceScreen from './CreateWorkspaceScreen.vue'
import { useWelcomePageStore } from '../store'
import { useViewer } from '@/entities/Viewer/hooks/useViewer'

const { data: viewer } = useViewer()
const { getWelcomePageScreen } = storeToRefs(useWelcomePageStore())
</script>

<template>
    <div
        class="welcome-page-wrapper"
        v-if="viewer"
    >
        <div class="get-started-screen">
            <div :style="{ 'background-color': '#f4ede480' }">
                <welcome-page-header />
                <welcome-page-new-workspace-section />
            </div>
            <welcome-page-workspaces-list />
        </div>
        <div
            class="new-workspace-screen"
            :class="{
                'visible': getWelcomePageScreen === 'create-new-workspace'
            }"
        >
            <create-workspace-screen />
        </div>
    </div>
</template>

<style lang="scss">
.welcome-page-wrapper {
    position: relative;
    height: 100vh;
    overflow: hidden;
    user-select: none;
}

.welcome-page-screen {
    position: absolute;
    top: 0;
    left: 0;

    transition: opacity .15s, transform .15s;

    opacity: 0;
    pointer-events: none;

    &.visible {
        opacity: 1;
        pointer-events: all;
    }
}

.get-started-screen {
    overflow-y: auto;
}

.new-workspace-screen {
    position: absolute;
    top: 0;
    left: 0;

    width: 100vw;
    height: 100vh;

    background-color: rgba(0, 0, 0, .64);

    opacity: 0;
    pointer-events: none;
    transform: scale(1.2);

    transition: .15s;

    &.visible {
        opacity: 1;
        pointer-events: all;
        transform: scale(1);
    }
}
</style>
