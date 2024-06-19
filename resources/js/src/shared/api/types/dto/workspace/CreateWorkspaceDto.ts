export default interface CreateWorkspaceDto {
    workspace_name: string
    workspace_profile_display_name: string
    workspace_profile_avatar_file: File | undefined
    workspace_profile_default_avatar_number: number | null
}
