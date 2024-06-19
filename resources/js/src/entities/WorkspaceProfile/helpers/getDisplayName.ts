import ApiWorkspaceProfile from '@/shared/api/types/models/ApiWorkspaceProfile'

export const getDisplayName = (workspaceProfile: ApiWorkspaceProfile): string => {
    if (workspaceProfile.display_name !== '') {
        return workspaceProfile.display_name
    } else {
        return workspaceProfile.first_name + ' ' + workspaceProfile.last_name
    }
}
