import { authApi } from './auth'
import { userApi } from './users'
import { workspacesApi } from './workspaces'

export const api = {
    auth: authApi,
    users: userApi,
    workspaces: workspacesApi,
}
