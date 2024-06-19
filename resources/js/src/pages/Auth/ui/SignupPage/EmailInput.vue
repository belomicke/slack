<script setup lang="ts">
import { ref, watch } from 'vue'
import debounce from 'lodash.debounce'
import { AuthFormGroup, AuthFormInput } from '@/shared/ui'
import { api } from '@/shared/api'

const emit = defineEmits(['update:isValid', 'update:email'])

defineModel('email')
defineModel('isValid')

const email = ref<string>('')
const isValid = ref<boolean>(false)
const message = ref<string>('')

const descriptionIsHidden = ref<boolean>(false)

const fetchedEmails = ref<{ email: string, status: boolean }[]>([])

watch(email, (value) => {
    descriptionIsHidden.value = true
    emit('update:email', value)

    if (!checkEmailIsValid(value)) {
        emit('update:isValid', false)
        isValid.value = false
        message.value = 'Please provide a valid email address.'
        return
    }

    const fetchedEmail = fetchedEmails.value.find(item => item.email === value)

    if (fetchedEmail) {
        emit('update:isValid', fetchedEmail.status)
        message.value = ''
        return
    }

    message.value = ''
    debouncedInputHandler(value)
})

const checkEmailIsValid = (email: string) => {
    return /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/.exec(email)
}

const debouncedInputHandler = debounce(async (value: string) => {
    const res = await api.users.userWithEmailExists(value)
    const data = res.data

    if (data.success) {
        isValid.value = !data.data.exists
        message.value = data.data.exists ? 'Email is already taken.' : 'Email is available.'
        emit('update:isValid', !data.data.exists)

        fetchedEmails.value.push({
            email: value,
            status: !data.data.exists,
        })
    }
}, 500)
</script>

<template>
    <auth-form-group
        label="Email"
        :invalid-feedback="!isValid && message ? message : ''"
        :description="descriptionIsHidden ? '' : 'We recommend a work email address.'"
    >
        <auth-form-input v-model="email" />
    </auth-form-group>
</template>

<style scoped>

</style>
