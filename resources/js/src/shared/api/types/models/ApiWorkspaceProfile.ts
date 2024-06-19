export default interface ApiWorkspaceProfile {
    id: string
    email: string
    display_name: string
    first_name: string
    last_name: string
    title: string
    is_self: boolean
    icon: {
        icon_20: string
        icon_36: string
        icon_72: string
        icon_96: string
        icon_192: string
        icon_256: string
    }
    workspace_id: string
}
