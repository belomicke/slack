import axios from 'axios'
import { CreateAccountDto } from '@/shared/api/types/dto/auth/CreateAccountDto'
import { AccessTokenResponse } from '@/shared/api/types/responses/auth/AccessTokenResponse'
import { CreateAccessTokenDto } from '@/shared/api/types/dto/auth/CreateAccessTokenDto'
import { EmptyResponse } from '@/shared/api/types/responses/global/EmptyResponse'

export const authApi = {
    createAccount: async (data: CreateAccountDto): Promise<AccessTokenResponse> => {
        return await axios.post('/auth/create-account', data)
    },
    createAccessToken: async (data: CreateAccessTokenDto): Promise<AccessTokenResponse> => {
        return await axios.post('/auth/create-access-token', data)
    },
    deleteAccessToken: async (): Promise<EmptyResponse> => {
        return await axios.delete('/auth/delete-access-token')
    },
}
