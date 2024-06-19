import { useMutation } from '@tanstack/vue-query'
import { api } from '@/shared/api'
import { CreateAccountDto } from '@/shared/api/types/dto/auth/CreateAccountDto'
import { AccessTokenResponse } from '@/shared/api/types/responses/auth/AccessTokenResponse'

export const useCreateAccount = () => {
    return useMutation({
        mutationKey: ['create-account'],
        mutationFn: async (data: CreateAccountDto) => {
            return await api.auth.createAccount(data)
        },
        onSuccess: (res: AccessTokenResponse) => {
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
