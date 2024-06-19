import { computed, ref } from 'vue'
import { defineStore } from 'pinia'
import { useWorkspaceProfileStore } from '@/entities/WorkspaceProfile/store'
import ApiWorkspace from '@/shared/api/types/models/ApiWorkspace'
import { api } from '@/shared/api'

export const useWorkspaceStore = defineStore('workspaces', () => {
    const workspaces = ref<ApiWorkspace[]>([])
    const workspacesCount = ref<number>(0)
    const wasFetched = ref<boolean>(false)

    const getWorkspaces = computed(() => {
        return workspaces.value
    })

    const fetchWorkspaces = async () => {
        if (workspaces.value.length === 0 &&
            workspacesCount.value === 0 &&
            wasFetched.value === true
        ) return

        const res = await api.workspaces.getWorkspaces()
        const data = res.data

        if (!data.success) return
        if (data.data.workspaces.length === 0) return

        const workspaceProfileStore = useWorkspaceProfileStore()

        const profiles = data.data.workspaces.map(item => item.profile)
        const fetchedWorkspaces = data.data.workspaces.map(item => item.workspace)

        workspaceProfileStore.addWorkspaceProfiles(profiles)
        workspaces.value.push(...fetchedWorkspaces)

        workspacesCount.value = data.data.count
        wasFetched.value = true
    }

    const addWorkspace = (data: ApiWorkspace) => {
        if (!workspaces.value.find(item => item.id === data.id)) {
            workspaces.value.push(data)
            workspacesCount.value += 1
        }
    }

    return {
        // getters
        getWorkspaces,

        // actions
        addWorkspace,
        fetchWorkspaces,
    }
})
