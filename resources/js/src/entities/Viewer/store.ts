import { ref } from 'vue'
import { defineStore } from 'pinia'
import { api } from '@/shared/api'
import { useUserStore } from '@/entities/User/store'

export const useViewerStore = defineStore('viewer', () => {
    const viewerId = ref<number>(0)
    const isAuth = ref<boolean>(false)
    const token = ref<string>(localStorage.getItem('token') ?? '')

    const fetchViewer = async () => {
        if (viewerId.value !== 0 || token.value === '') return

        const res = await api.users.getViewer()
        const data = res.data

        if (!data.success || !data.data.user) return undefined

        const userStore = useUserStore()

        const user = data.data.user

        viewerId.value = user.id
        isAuth.value = true
        userStore.addUser(user)

        return user
    }

    return {
        viewerId,
        fetchViewer,
    }
})
