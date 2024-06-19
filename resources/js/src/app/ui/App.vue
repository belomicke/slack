<script setup lang="ts">
import { onMounted, ref } from 'vue'
import LoadingScreen from './LoadingScreen.vue'
import { useViewer } from '@/entities/Viewer/hooks/useViewer'
import '../styles/index.scss'

const { fetch: fetchViewer } = useViewer()

const isLoading = ref<boolean>(true)

onMounted(() => {
    fetchViewer().then(() => {
        isLoading.value = false
    })
})
</script>

<template>
    <loading-screen v-if="isLoading" />
    <router-view v-else />
</template>
