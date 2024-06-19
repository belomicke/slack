import { computed } from 'vue'
import { useWorkspaceStore } from '@/entities/Workspace/store'
import { useFetch } from '@/shared/hooks/useFetch'

export const useWorkspaces = () => {
    const workspaceStore = useWorkspaceStore()

    const workspaces = computed(() => {
        return workspaceStore.getWorkspaces
    })

    const { fetch, isLoading } = useFetch(async () => {
        await workspaceStore.fetchWorkspaces()
    })

    return {
        data: workspaces,
        fetch,
        isLoading,
    }
}
