<script setup lang="ts">
import { computed, PropType } from 'vue'
import { useWorkspaceProfiles } from '@/entities/WorkspaceProfile/hooks/useWorkspaceProfiles'
import { getDisplayName } from '@/entities/WorkspaceProfile/helpers/getDisplayName'
import ApiWorkspace from '@/shared/api/types/models/ApiWorkspace'

const props = defineProps({
    workspace: {
        type: Object as PropType<ApiWorkspace>,
        required: true,
    },
})

const { data: workspaceProfiles } = useWorkspaceProfiles(props.workspace.id)

const profile = computed(() => {
    return workspaceProfiles.find(item => item.is_self)
})

const displayName = computed(() => {
    if (!profile.value) return ''

    return getDisplayName(profile.value)
})
</script>

<template>
    <div class="workspace-item" v-if="profile">
        <div
            class="workspace-item__icon"
            :style="{
                'background-image': `url(${workspace.icon.icon_88})`
            }"
        />
        <div class="workspace-item__content">
            <div class="workspace-item__title">{{ workspace.name }}</div>
            <div class="workspace-item__members">
                <img
                    class="workspace-item__avatar"
                    :src="profile.icon.icon_48"
                    alt="User icon"
                />
                <div class="workspace-item__display-name">
                    {{ displayName }}
                </div>
                <div class="workspace-item__separator"></div>
                <div class="workspace-item__count">
                    {{ workspace.active_users }} участников в сети
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.workspace-item {
    display: flex;
    padding: 15px 25px;
    cursor: pointer;
    transition: .15s;

    &:hover {
        background-color: rgb(221, 221, 221);
    }

    &__icon {
        margin-top: 5px;
        margin-right: 15px;

        height: 44px;
        width: 44px;

        background-repeat: no-repeat;
        background-size: 100%;
        border-radius: 5px;
        position: relative;

        &::after {
            content: "";
            border-radius: 5px;
            display: block;
            position: absolute;
            inset: 0;
            box-shadow: inset 0 0 0 1px #00000014;
        }
    }

    &__content {
        display: flex;
        flex-direction: column;
    }

    &__title {
        white-space: nowrap;
        text-overflow: ellipsis;
        height: 27px;
        font-size: 18px;
        font-weight: 700;
        line-height: 27px;
        overflow: hidden;
    }

    &__members {
        display: flex;
        align-items: center;
        height: 20px;
        margin-top: 2px;
    }

    &__avatar {
        margin-right: 10px;
        width: 20px;
        height: 20px;
        border-radius: 4px;
        border: 1px solid #fff;
    }

    &__display-name {
        font-size: 13px;
    }

    &__separator {
        width: 2px;
        height: 2px;
        background-color: rgba(29, 28, 29, 0.7);
        border-radius: 50%;
        margin: auto 5px;
    }

    &__count {
        color: rgba(29, 28, 29, 0.7);
        font-size: 13px;
    }
}

</style>
