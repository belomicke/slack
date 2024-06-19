import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import ApiWorkspaceProfile from '@/shared/api/types/models/ApiWorkspaceProfile'

export const useWorkspaceProfileStore = defineStore('workspace-profile', () => {
    const workspaceProfiles = ref<ApiWorkspaceProfile[]>([])

    const getWorkspaceProfiles = computed(() => {
        return (id: string) => {
            return workspaceProfiles.value.filter(item => item.workspace_id === id)
        }
    })

    const addWorkspaceProfile = (workspaceProfile: ApiWorkspaceProfile) => {
        if (!workspaceProfiles.value.find(item => item.id === workspaceProfile.id)) {
            workspaceProfiles.value.push(workspaceProfile)
        }
    }

    const addWorkspaceProfiles = (items: ApiWorkspaceProfile[]) => {
        items.forEach(item => {
            addWorkspaceProfile(item)
        })
    }

    return {
        // getters
        getWorkspaceProfiles,

        // actions
        addWorkspaceProfile,
        addWorkspaceProfiles,
    }
})
