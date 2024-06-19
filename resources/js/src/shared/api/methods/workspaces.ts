import axios from 'axios'
import { WorkspacesResponse } from '@/shared/api/types/responses/workspace/WorkspacesResponse'
import CreateWorkspaceDto from '@/shared/api/types/dto/workspace/CreateWorkspaceDto'
import { WorkspaceResponse } from '@/shared/api/types/responses/workspace/WorkspaceResponse'

export const workspacesApi = {
    createWorkspace: async (data: CreateWorkspaceDto): Promise<WorkspaceResponse> => {
        const formData = new FormData()

        formData.append('workspace_name', data.workspace_name)
        formData.append('workspace_profile_display_name', data.workspace_profile_display_name)
        formData.append('workspace_profile_default_avatar_number', String(data.workspace_profile_default_avatar_number))

        if (data.workspace_profile_avatar_file !== undefined) {
            formData.append('workspace_profile_avatar_file', data.workspace_profile_avatar_file)
        }

        return await axios.post('/workspaces', formData)
    },
    getWorkspaces: async (): Promise<WorkspacesResponse> => {
        return await axios.get('/workspaces')
    },
}
