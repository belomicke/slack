import { computed, ref } from 'vue'
import { defineStore } from 'pinia'

type WelcomePageScreens = 'get-started' | 'create-new-workspace'

export const useWelcomePageStore = defineStore('welcome-page', () => {
    const welcomePageScreen = ref<WelcomePageScreens>('get-started')

    const getWelcomePageScreen = computed(() => {
        return welcomePageScreen.value
    })

    const setWelcomePageScreen = (value: WelcomePageScreens) => {
        welcomePageScreen.value = value
    }

    return {
        getWelcomePageScreen,
        setWelcomePageScreen,
    }
})
