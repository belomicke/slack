export default interface ApiWorkspace {
    id: string
    name: string
    icon: {
        icon_36: string
        icon_44: string
    }
    active_users: number
}

// const example = {
//     associated_user: 'U0782N4BUQP',
//     domain: 'dasdasdadasda-34f7761',
//     ia_version: 4,
//     image_default: false,
//     is_logged_out: false,
//     last_login_ts: 1718713112,
//     profile_photos: [],
//     sso_required: false,
//     two_factor_required: false,
//     url: 'https://dasdasdadasda-34f7761.slack.com/ssb/redirect',
//     user_14d_messages: 0,
//     user_email: 'rellmanwinner@gmail.com',
//     user_name: 'rellmanwinner',
//     user_title: '',
//     user_type: 'owner',
//     user_workspace_signal_score: 0,
//     variant: 'commercial',
// }
