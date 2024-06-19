<script setup lang="ts">
import { computed, ref } from 'vue'
import { AuthButton, AuthForm, AuthFormInput, AuthFormGroup, AuthFormParagraph, AuthLink } from '@/shared/ui'
import UsernameInput from '@/pages/Auth/ui/SignupPage/UsernameInput.vue'
import EmailInput from '@/pages/Auth/ui/SignupPage/EmailInput.vue'
import { useCreateAccount } from '@/shared/api'

const firstName = ref<string>('')
const lastName = ref<string>('')
const username = ref<string>('')
const email = ref<string>('')
const password = ref<string>('')

const usernameIsValid = ref<boolean>(false)
const emailIsValid = ref<boolean>(false)

const isLoading = ref<boolean>(false)
const feedbacksIsVisible = ref<boolean>(false)

const firstNameFeedback = computed(() => {
    if (!feedbacksIsVisible.value) return ''

    return firstName.value.length === 0 ? 'This field is required.' : ''
})

const lastNameFeedback = computed(() => {
    if (!feedbacksIsVisible.value) return ''

    return lastName.value.length === 0 ? 'This field is required.' : ''
})

const formIsValid = computed(() => {
    return firstName.value.length > 0 &&
        lastName.value.length > 0 &&
        usernameIsValid.value &&
        emailIsValid.value &&
        password.value.length >= 8
})

const { mutate: createAccount } = useCreateAccount()

const submitHandler = () => {
    if (!formIsValid.value) {
        feedbacksIsVisible.value = true
        return
    }

    isLoading.value = true

    createAccount({
        first_name: firstName.value,
        last_name: lastName.value,
        username: username.value,
        email: email.value,
        password: password.value,
    })
}
</script>

<template>
    <auth-form>
        <div class="form-row">
            <auth-form-group
                label="First name"
                :invalid-feedback="firstNameFeedback"
            >
                <auth-form-input v-model="firstName" />
            </auth-form-group>
            <auth-form-group
                label="Last name"
                :invalid-feedback="lastNameFeedback"
            >
                <auth-form-input v-model="lastName" />
            </auth-form-group>
        </div>
        <username-input
            v-model:username="username"
            v-model:is-valid="usernameIsValid"
        />
        <email-input
            v-model:email="email"
            v-model:is-valid="emailIsValid"
        />
        <auth-form-group
            label="Password"
            description="Minimum length is 8 characters."
        >
            <auth-form-input
                autocomplete="new-password"
                v-model="password"
                type="password"
            />
        </auth-form-group>
        <auth-button
            category="primary"
            variant="confirm"
            :loading="isLoading"
            @click="submitHandler"
            block
        >
            Register
        </auth-button>
        <auth-form-paragraph>
            Already have an account?
            <auth-link href="/auth/login">Sign in</auth-link>
        </auth-form-paragraph>
    </auth-form>
</template>

<style scoped>
.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 10px;
}
</style>
