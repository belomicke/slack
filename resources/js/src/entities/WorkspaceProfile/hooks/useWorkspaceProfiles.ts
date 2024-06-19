import { computed } from 'vue'
import { storeToRefs } from 'pinia'
import { useWorkspaceProfileStore } from '@/entities/WorkspaceProfile/store'

export const useWorkspaceProfiles = (id: string) => {
    const workspaceProfileStore = useWorkspaceProfileStore()
    const { getWorkspaceProfiles } = storeToRefs(workspaceProfileStore)

    const workspaceProfiles = computed(() => {
        return getWorkspaceProfiles.value(id)
    })

    return {
        data: workspaceProfiles.value,
    }
}
