import { ref } from 'vue'

export const useFetch = (callback: () => Promise<void>) => {
    const isLoading = ref<boolean>(false)

    const fetch = async () => {
        if (isLoading.value) return

        isLoading.value = true

        try {
            await callback()
        } finally {
            isLoading.value = false
        }
    }

    return {
        fetch,
        isLoading,
    }
}
