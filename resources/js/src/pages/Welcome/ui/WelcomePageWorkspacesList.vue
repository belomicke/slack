<script setup lang="ts">
import { onMounted } from 'vue'
import { useViewer } from '@/entities/Viewer/hooks/useViewer'
import { useWorkspaces } from '@/entities/Workspace/hooks/useWorkspaces'
import WorkspaceItem from '@/pages/Welcome/ui/WorkspaceItem.vue'

const { data: viewer } = useViewer()
const { data: workspaces, fetch, isLoading } = useWorkspaces()

onMounted(() => {
    fetch()
})
</script>

<template>
    <div class="welcome-page-workspaces" v-if="viewer">
        <template v-if="isLoading === false">
            <div
                class="welcome-page-workspaces-list"
                v-if="workspaces.length > 0"
            >
                <workspace-item
                    :workspace="workspace"
                    v-for="workspace in workspaces"
                    :key="workspace.id"
                />
            </div>
            <div class="welcome-page-workspaces-empty-list" v-else>
                <div class="welcome-page-workspaces-empty-list-text">
                    <div class="welcome-page-workspaces-empty-list-text__title">
                        Ваша команда уже использует Slack?
                    </div>
                    <div class="welcome-page-workspaces-empty-list-text__subtitle">
                        Мы не смогли найти существующих окружений для электронной почты {{ viewer.email }}
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<style scoped lang="scss">
.welcome-page-workspaces {
    display: flex;
    max-width: 700px;
    margin: 0 auto;
    padding: 48px 0;
}

@media (min-width: 850px) {
    .welcome-page-workspaces {
        max-width: 800px;
    }
}

@media only screen and (max-width: 850px) {
    .welcome-page-workspaces {
        width: auto;
    }
}

@media only screen and (max-width: 700px) {
    .welcome-page-workspaces {
        padding: 48px 24px;
    }
}

.welcome-page-workspaces-list {
    display: flex;
    flex-direction: column;
    border: 1px solid rgb(221, 221, 221);
    border-radius: 4px;
    width: 100%;
    padding: 10px 0;
}

.welcome-page-workspaces-empty-list {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 40px 24px 48px;
    border: 1px solid rgb(221, 221, 221);
    border-radius: 4px;
    width: 100%;

    &-text {
        text-align: center;
        color: rgba(var(--sk_foreground_max_solid, 97, 96, 97), 1);
        max-width: 400px;

        &__title {
            font-size: 18px;
            line-height: 1.50001;
            letter-spacing: normal;
            font-weight: 700;
            opacity: .9;
        }

        &__subtitle {
            margin-top: 4px;
        }
    }
}

@media (min-width: 850px) {
    .welcome-page-workspaces {
        max-width: 800px;
        margin: 0 auto;
    }
}
</style>
