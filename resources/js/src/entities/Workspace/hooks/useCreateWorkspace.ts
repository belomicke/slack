import { useMutation } from '@tanstack/vue-query'
import { api } from '@/shared/api'
import CreateWorkspaceDto from '@/shared/api/types/dto/workspace/CreateWorkspaceDto'
import { WorkspaceResponse } from '@/shared/api/types/responses/workspace/WorkspaceResponse'
import { useWorkspaceStore } from '@/entities/Workspace/store'
import { useWorkspaceProfileStore } from '@/entities/WorkspaceProfile/store'

export const useCreateWorkspace = () => {
    return useMutation({
        mutationKey: ['create-workspace'],
        mutationFn: async (data: CreateWorkspaceDto) => {
            return await api.workspaces.createWorkspace(data)
        },
        onSuccess(res: WorkspaceResponse) {
            const data = res.data

            if (!data.success) return

            const workspaceStore = useWorkspaceStore()
            const workspaceProfileStore = useWorkspaceProfileStore()

            workspaceProfileStore.addWorkspaceProfile(data.data.profile)
            workspaceStore.addWorkspace(data.data.workspace)
        },
    })
}
