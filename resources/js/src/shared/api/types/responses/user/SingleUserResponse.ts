import { ApiResponse } from '@/shared/api/types/responses/global/ApiResponse'
import { ApiUser } from '@/shared/api/types/models/ApiUser'

export type SingleUserResponse = ApiResponse<{
    user: ApiUser
}>
