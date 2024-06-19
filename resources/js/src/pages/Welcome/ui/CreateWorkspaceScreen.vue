<script setup lang="ts">
import { computed, ref, watch } from 'vue'
import { storeToRefs } from 'pinia'
import { useWelcomePageStore } from '@/pages/Welcome/store'
import { useViewer } from '@/entities/Viewer/hooks/useViewer'
import { useCreateWorkspace } from '@/entities/Workspace/hooks/useCreateWorkspace'
import AvatarUploader from '@/shared/ui/components/auth/avatar-uploader/avatar-uploader.vue'
import { AuthButton, AuthFormGroup, AuthFormInput } from '@/shared/ui'

const welcomePageStore = useWelcomePageStore()
const { getWelcomePageScreen } = storeToRefs(welcomePageStore)

const welcomePageScreen = computed(() => {
    return getWelcomePageScreen.value
})

const { data: viewer } = useViewer()

const workspaceName = ref<string>('')
const workspaceProfileName = ref<string>(viewer.value?.username ?? '')

const avatarFile = ref<File | undefined>(undefined)
const defaultAvatarNumber = ref<number>(0)

const workspaceNameIsValid = computed(() => workspaceName.value.length >= 2)

const formIsValid = computed(() => {
    return workspaceNameIsValid.value
})

watch(welcomePageScreen, (screen) => {
    if (screen === 'create-new-workspace') return

    setTimeout(() => {
        workspaceName.value = ''
        workspaceProfileName.value = viewer.value?.username ?? ''
        avatarFile.value = undefined
    }, 150)
})

const closeHandler = () => {
    welcomePageStore.setWelcomePageScreen('get-started')
}

const { mutate, isPending } = useCreateWorkspace()

const submitHandler = () => {
    mutate({
        workspace_name: workspaceName.value,
        workspace_profile_display_name: workspaceProfileName.value,
        workspace_profile_avatar_file: avatarFile.value,
        workspace_profile_default_avatar_number: defaultAvatarNumber.value,
    }, {
        onSuccess() {
            closeHandler()
        },
    })
}
</script>

<template>
    <div class="create-workspace-screen">
        <div class="create-workspace-form">
            <div class="create-workspace-form-header">
                <div class="create-workspace-form-header__title">Создание нового рабочего окружения</div>
                <div
                    class="create-workspace-form-header__close"
                    @click="closeHandler"
                >
                    <auth-button icon="close" />
                </div>
            </div>
            <div class="create-workspace-form-body">
                <auth-form-group label="Название вашей команды или компании">
                    <template #description>
                        <span>
                            Это будет название вашего рабочего окружения в Slack.
                            <br />
                            Выберите то, чем ваша команда будет заниматься.
                        </span>
                    </template>
                    <auth-form-input
                        v-model="workspaceName"
                        placeholder="Например: Acme Marketing или Acme Co"
                    />
                </auth-form-group>
                <auth-form-group label="Ваше имя">
                    <template #description>
                        <span>
                            Добавление вашего имени и фото профиля
                            <br />
                            поможет вашим коллегам легче понять кто вы.
                        </span>
                    </template>
                    <auth-form-input
                        v-model="workspaceProfileName"
                        placeholder="Например: Acme Marketing или Acme Co"
                    />
                </auth-form-group>
                <auth-form-group>
                    <avatar-uploader
                        v-model:avatar-file="avatarFile"
                        v-model:default-avatar-number="defaultAvatarNumber"
                    />
                </auth-form-group>
            </div>
            <div class="create-workspace-form-footer">
                <auth-button
                    variant="confirm"
                    :disabled="!formIsValid"
                    :loading="isPending"
                    block
                    @click="submitHandler"
                >
                    Создать
                </auth-button>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.create-workspace-screen {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.create-workspace-form {
    min-width: 500px;
    border: 1px solid rgb(220, 220, 220);
    background-color: rgb(255, 255, 255);
    border-radius: 5px;

    &-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 15px;
        border-bottom: 1px solid rgb(220, 220, 220);

        &__close {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        &__title {
            font-size: 16px;
            font-weight: 700;
        }
    }

    &-body {
        padding: 15px 15px 0;
    }

    &-footer {
        border-top: 1px solid rgb(220, 220, 220);
        padding: 15px;
    }
}
</style>
