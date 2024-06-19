import ApiWorkspace from '@/shared/api/types/models/ApiWorkspace'
import ApiWorkspaceProfile from '@/shared/api/types/models/ApiWorkspaceProfile'

export default interface WorkspaceItem {
    workspace: ApiWorkspace
    profile: ApiWorkspaceProfile
}
