<script setup lang="ts">
import { ref } from 'vue'
import { AuthButton, AuthForm, AuthFormGroup, AuthFormInput, AuthFormParagraph, AuthLink } from '@/shared/ui'
import { useCreateAccessToken } from '@/shared/api'

const login = ref<string>('')
const password = ref<string>('')

const isLoading = ref<boolean>(false)

const { mutate: createAccessToken } = useCreateAccessToken()

const submitHandler = () => {
    isLoading.value = true

    createAccessToken({
        login: login.value,
        password: password.value,
    })

    isLoading.value = false
}
</script>

<template>
    <auth-form>
        <auth-form-group label="Username or primary email">
            <auth-form-input v-model="login" />
        </auth-form-group>
        <auth-form-group label="Password">
            <auth-form-input v-model="password" type="password" />
        </auth-form-group>
        <auth-button
            variant="confirm"
            :loading="isLoading"
            block
            @click="submitHandler"
        >
            Login
        </auth-button>
        <auth-form-paragraph>
            Don't have an account yet?
            <auth-link href="/auth/signup">Register now</auth-link>
        </auth-form-paragraph>
    </auth-form>
</template>
