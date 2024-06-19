import { useViewerStore } from '@/entities/Viewer/store'
import { computed, ref } from 'vue'
import { useUserStore } from '@/entities/User/store'
import { storeToRefs } from 'pinia'
import { useFetch } from '@/shared/hooks/useFetch'

export const useViewer = () => {
    const viewerStore = useViewerStore()
    const { getViewer } = storeToRefs(useUserStore())

    const viewer = computed(() => {
        return getViewer.value
    })

    const { fetch } = useFetch(async () => {
        await viewerStore.fetchViewer()
    })

    return {
        data: viewer,
        fetch,
    }
}
