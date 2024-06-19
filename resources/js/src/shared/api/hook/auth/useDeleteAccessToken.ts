import { useMutation } from '@tanstack/vue-query'
import { api } from '@/shared/api'
import { EmptyResponse } from '@/shared/api/types/responses/global/EmptyResponse'

export const useDeleteAccessToken = () => {
    return useMutation({
        mutationKey: ['delete-access-token'],
        mutationFn: async () => {
            return await api.auth.deleteAccessToken()
        },
        onSuccess(res: EmptyResponse) {
            const data = res.data

            if (data.success) {
                localStorage.removeItem('token')
                window.location.reload()
            }
        },
    })
}
