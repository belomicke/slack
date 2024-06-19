<script lang="ts">
import { PropType } from 'vue'
import SLoadingIcon from '../loading_icon'
import SIcon from '@/shared/ui/components/auth/icon/icon.vue'

type ButtonCategories = 'primary' | 'secondary' | 'tertiary'
export const buttonCategoryOptions = {
    primary: 'primary',
    secondary: 'secondary',
    tertiary: 'tertiary',
}

type ButtonVariants = 'default' | 'confirm' | 'success' | 'danger' | 'dashed' | 'link' | 'reset'
export const buttonVariantOptions = {
    default: 'default',
    confirm: 'confirm',
    success: 'success',
    danger: 'danger',
    dashed: 'dashed',
    link: 'link',
    reset: 'reset',
}

type ButtonSizes = 'small' | 'medium'
export const buttonSizeOptions = {
    small: 'sm',
    medium: 'md',
}

export default {
    name: 'AuthButton',
    components: {
        SIcon,
        SLoadingIcon,
    },
    props: {
        category: {
            type: String as PropType<ButtonCategories>,
            required: false,
            default: 'primary',
            validator: (value: string) => Object.keys(buttonCategoryOptions).includes(value),
        },
        variant: {
            type: String as PropType<ButtonVariants>,
            required: false,
            default: 'default',
            validator: (value: ButtonVariants) => Object.keys(buttonVariantOptions).includes(value),
        },
        size: {
            type: String as PropType<ButtonSizes>,
            required: false,
            default: 'medium',
            validator: (value: string) => Object.keys(buttonSizeOptions).includes(value),
        },
        selected: {
            type: Boolean,
            required: false,
            default: false,
        },
        label: {
            type: Boolean,
            required: false,
            default: false,
        },
        loading: {
            type: Boolean,
            required: false,
            default: false,
        },
        block: {
            type: Boolean,
            required: false,
            default: false,
        },
        disabled: {
            type: Boolean,
            required: false,
            default: false,
        },
        buttonTextClasses: {
            type: String,
            required: false,
            default: '',
        },

        icon: {
            type: String,
            required: false,
            default: '',
        },
    },
    computed: {
        hasIcon() {
            return this.icon !== ''
        },
        hasIconOnly() {
            return !this.$slots.default && this.hasIcon
        },
        isButtonDisabled() {
            return this.disabled || this.loading
        },
        displayBlock() {
            return !this.label && this.block
        },
        buttonClasses() {
            const classes = ['s-button']

            if (this.category !== buttonCategoryOptions.primary) {
                classes.push(`btn-${this.variant}-${this.category}`)
            } else {
                classes.push(`btn-${this.variant}`)
            }

            if (this.label) classes.push('btn-label')
            if (this.displayBlock) classes.push('btn-block')
            if (this.size === 'small') classes.push('btn-sm')
            if (this.isButtonDisabled) classes.push('disabled')
            if (this.hasIconOnly) classes.push('btn-icon')

            return classes
        },
    },
}
</script>

<template>
    <component
        :is="label ? 'span' : 'button'"
        :class="buttonClasses"
        :disabled="isButtonDisabled"
    >
        <s-loading-icon
            v-if="loading"
            inline
            class="s-button-icon s-button-loading-indicator"
        />
        <s-icon
            v-if="hasIcon && !(hasIconOnly && loading)"
            class="s-button-icon"
            :name="icon"
        />
        <span
            :class="buttonTextClasses"
            class="s-button-text"
        >
            <slot></slot>
        </span>
    </component>

</template>

<style lang="scss" src="./scss/button.scss" />
