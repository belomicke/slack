import { useMutation } from '@tanstack/vue-query'
import { api } from '@/shared/api'
import { CreateAccessTokenDto } from '@/shared/api/types/dto/auth/CreateAccessTokenDto'
import { AccessTokenResponse } from '@/shared/api/types/responses/auth/AccessTokenResponse'

export const useCreateAccessToken = () => {
    return useMutation({
        mutationKey: ['create-access-token'],
        mutationFn: async (data: CreateAccessTokenDto) => {
            return await api.auth.createAccessToken(data)
        },
        onSuccess(res: AccessTokenResponse) {
            const data = res.data

            if (!data.success) {
                return
            }

            const token = data.data.token

            localStorage.setItem('token', token)
            window.location.reload()
        },
    })
}
