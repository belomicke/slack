<script setup lang="ts">
import { ref, watch } from 'vue'
import { AuthFormGroup, AuthFormInput } from '@/shared/ui'
import debounce from 'lodash.debounce'
import { api } from '@/shared/api'

const emit = defineEmits(['update:isValid', 'update:username'])

defineModel('username')
defineModel('isValid')

const username = ref<string>('')
const isValid = ref<boolean>(false)
const message = ref<string>('')

const fetchedUsernames = ref<{ username: string, status: boolean }[]>([])

watch(username, (value) => {
    emit('update:username', value)

    if (value.length < 2) {
        emit('update:isValid', false)
        isValid.value = false
        message.value = 'Username is too short (minimum is 2 characters).'
        return
    }

    if (value.length > 255) {
        emit('update:isValid', false)
        isValid.value = false
        message.value = 'Username is too long (maximum is 255 characters).'
        return
    }

    if (!checkUsernameIsValid(value)) {
        emit('update:isValid', false)
        isValid.value = false
        message.value = 'Please create a username with only alphanumeric characters.'
        return
    }

    const fetchedUsername = fetchedUsernames.value.find(item => item.username === value)

    if (fetchedUsername) {
        emit('update:isValid', fetchedUsername.status)
        return
    }

    message.value = ''
    debouncedInputHandler(value)
})

const checkUsernameIsValid = (username: string) => {
    return /^[A-Za-z0-9-]*$/.exec(username)
}

const debouncedInputHandler = debounce(async (value: string) => {
    const res = await api.users.userWithUsernameExists(value)
    const data = res.data

    if (data.success) {
        isValid.value = !data.data.exists
        message.value = data.data.exists ? 'Username is already taken.' : 'Username is available.'
        emit('update:isValid', !data.data.exists)

        fetchedUsernames.value.push({
            username: value,
            status: !data.data.exists,
        })
    }
}, 500)
</script>

<template>
    <auth-form-group
        label="Username"
        label-for="new_user_username"
        :valid-feedback="isValid && message ? message : ''"
        :invalid-feedback="!isValid && message ? message : ''"
    >
        <auth-form-input
            id="new_user_username"
            autocomplete="off"
            v-model="username"
        />
    </auth-form-group>
</template>

<style scoped>

</style>
