<script lang="ts">
import { PropType } from 'vue'

type Sizes = 'sm' | 'md' | 'lg' | 'xl'
type Colors = 'dark' | 'light'
type Variants = 'spinner' | 'dots'

const sizes = [
    'sm',
    'md',
    'lg',
    'xl',
]
const colors = {
    dark: 'dark',
    light: 'light',
}

export default {
    name: 'SLoadingIcon',
    props: {
        label: {
            type: String,
            required: false,
            default: 'Loading',
        },
        size: {
            type: String as PropType<Sizes>,
            required: false,
            default: 'sm',
            validator: (value: string) => sizes.indexOf(value) !== -1,
        },
        color: {
            type: String as PropType<Colors>,
            required: false,
            default: 'dark',
            validator: (value: string) => Object.keys(colors).includes(value),
        },
        variant: {
            type: String as PropType<Variants>,
            required: false,
            default: 'spinner',
            validator: (value: string) => ['spinner', 'dots'].includes(value),
        },
        inline: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
    computed: {
        rootElementType() {
            return this.inline ? 'span' : 'div'
        },
        spinnerCssClasses() {
            const baseCssClass = 's-spinner'

            return [
                baseCssClass,
                `${baseCssClass}-${colors[this.color]}`,
                `${baseCssClass}-${this.size}`,
            ]
        },
        dotsCssClasses() {
            const baseCssClass = 's-dots-loader'

            return [
                baseCssClass,
                `${baseCssClass}-${colors[this.color]}`,
                `${baseCssClass}-${this.size}`,
            ]
        },
    },
}
</script>

<template>
    <component
        :is="rootElementType"
        v-if="variant === 'spinner'"
        :aria-label="label"
        class="s-spinner-container"
        role="status"
    >
        <span class="gl-vertical-align-text-bottom!" :class="spinnerCssClasses"></span>
    </component>
    <component :is="rootElementType" v-else :class="dotsCssClasses" role="status" :aria-label="label">
        <span></span>
    </component>
</template>

<style lang="scss" src="./loading_icon.scss" />
