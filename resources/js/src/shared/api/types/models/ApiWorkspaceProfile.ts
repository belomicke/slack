export default interface ApiWorkspaceProfile {
    id: string
    email: string
    display_name: string
    first_name: string
    last_name: string
    title: string
    is_self: boolean
    icon: {
        icon_24: string
        icon_32: string
        icon_48: string
        icon_64: string
        icon_96: string
        icon_192: string
        icon_512: string
    }
    workspace_id: string
}
