import { computed, ref } from 'vue'
import { defineStore } from 'pinia'
import { ApiUser } from '@/shared/api'
import { useViewerStore } from '@/entities/Viewer/store'

export const useUserStore = defineStore('users', () => {
    const users = ref<ApiUser[]>([])

    const getViewer = computed(() => {
        const viewerStore = useViewerStore()

        return users.value.find(item => item.id === viewerStore.viewerId)
    })

    const addUser = (user: ApiUser) => {
        if (!users.value.find(item => item.id === user.id)) {
            users.value.push(user)
        }
    }

    return {
        // getters
        getViewer,

        // actions
        addUser,
    }
})
