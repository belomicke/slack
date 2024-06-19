<script lang="ts">
import { PropType } from 'vue'

type FormInputWidths = 'xs' | 'sm' | 'md' | 'lg' | 'xl' | 'null'

export default {
    name: 'AuthFormInput',
    props: {
        modelValue: {
            type: String,
            required: false,
            default: '',
        },
        disabled: {
            type: Boolean,
            required: false,
            default: false,
        },
        readonly: {
            type: Boolean,
            required: false,
            default: false,
        },
        width: {
            type: String as PropType<FormInputWidths>,
            required: false,
            default: 'null',
        },
    },
    emits: ['update:modelValue'],
    methods: {
        inputHandler(e: InputEvent) {
            const target = e.target as HTMLInputElement

            this.$emit('update:modelValue', target.value)
        },
    },
}
</script>

<template>
    <input
        class="form-input"
        :class="{
            'xs': width === 'xs',
            'sm': width === 'sm',
            'md': width === 'md',
            'lg': width === 'lg',
            'xl': width === 'xl'
        }"
        :value="modelValue"
        @input="inputHandler"
        :disabled="disabled"
        :readonly="readonly"
    />
</template>

<style lang="scss" src="./form_input.scss" />
