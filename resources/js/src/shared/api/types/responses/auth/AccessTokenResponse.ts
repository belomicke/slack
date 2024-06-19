import { ApiResponse } from '@/shared/api/types/responses/global/ApiResponse'

export type AccessTokenResponse = ApiResponse<{
    token: string
}>
