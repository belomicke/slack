import { ApiResponse } from '@/shared/api/types/responses/global/ApiResponse'
import WorkspaceItem from '@/shared/api/types/responses/workspace/WorkspaceResponseItem'


export type WorkspacesResponse = ApiResponse<{
    workspaces: WorkspaceItem[],
    count: number
}>
