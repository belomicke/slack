import axios from 'axios'
import { EntityExistsResponse } from '../types/responses/global/EntityExistsResponse'
import { SingleUserResponse } from '../types/responses/user/SingleUserResponse'

export const userApi = {
    userWithUsernameExists: async (username: string): Promise<EntityExistsResponse> => {
        return await axios.get(`/users/exists/username`, { params: { username } })
    },
    userWithEmailExists: async (email: string): Promise<EntityExistsResponse> => {
        return await axios.get(`/users/exists/email`, { params: { email } })
    },
    getViewer: async (): Promise<SingleUserResponse> => {
        return await axios.get('/users/viewer')
    },
}
