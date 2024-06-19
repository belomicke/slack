<script lang="ts">
import { PropType } from 'vue'

type iconSizes = 8 | 12 | 14 | 16 | 24 | 32 | 48 | 72

const iconsPath = 'http://localhost/icons.svg'

export default {
    name: 'SIcon',
    props: {
        ariaLabel: {
            type: String,
            required: false,
            default: undefined,
        },
        name: {
            type: String,
            required: true,
        },
        size: {
            type: Number as PropType<iconSizes>,
            required: false,
            default: 16,
        },
    },
    computed: {
        spriteHref() {
            return `${iconsPath}#${this.name}`
        },
        iconSizeClass() {
            return `s-${this.size}`
        },
    },
}
</script>

<template>
    <svg
        :data-testid="`${name}-icon`"
        role="img"
        :class="['s-icon', 's-fill-current', iconSizeClass]"
        :aria-label="ariaLabel"
    >
        <use :href="spriteHref" />
    </svg>
</template>

<style lang="scss">
$iconSizes: 8, 12, 14, 16, 24, 32, 48, 72;

.s-icon {
    @each $size in $iconSizes {
        &.s-#{$size} {
            width: #{$size}px;
            height: #{$size}px;

        }
    }
}

.s-fill-current {
    fill: currentColor;
}
</style>
