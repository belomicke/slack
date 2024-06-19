<script lang="ts">
export default {
    name: 'AuthFormGroup',
    props: {
        id: {
            type: String,
            required: false,
            default: '',
        },
        labelFor: {
            type: String,
            required: false,
            default: '',
        },
        description: {
            type: String,
            required: false,
            default: '',
        },
        invalidFeedback: {
            type: String,
            required: false,
            default: '',
        },
        validFeedback: {
            type: String,
            required: false,
            default: '',
        },
        labelDescription: {
            type: String,
            required: false,
            default: '',
        },
        optional: {
            type: Boolean,
            required: false,
            default: false,
        },
        optionalText: {
            type: String,
            required: false,
            default: '(optional)',
        },
    },
    computed: {
        hasLabelDescription() {
            return Boolean(this.labelDescription || this.$slots['label-description'])
        },
    },
}
</script>

<template>
    <div
        class="form-group"
        v-bind="$attrs"
        :id="id"
    >
        <slot name="label">
            <label
                :for="labelFor"
                class="form-group__label"
                v-if="$attrs.label"
            >
                {{ $attrs.label }}
                <span class="form-group__label-optional" v-if="optional">{{ optionalText }}</span>
                <div class="form-group__label-description" v-if="hasLabelDescription">
                    <slot name="label-description">{{ labelDescription }}</slot>
                </div>
            </label>
        </slot>
        <div>
            <slot></slot>
            <div class="form-group__feedback invalid" v-if="invalidFeedback">{{ invalidFeedback }}</div>
            <div class="form-group__feedback valid" v-if="validFeedback">{{ validFeedback }}</div>
            <small class="form-group__description" v-if="description || $slots.description">
                <slot name="description">
                    {{ description }}
                </slot>
            </small>
        </div>
    </div>
</template>

<style lang="scss">
.form-group {
    margin-bottom: 16px;

    &__label {
        display: block;
        font-size: .875rem;
        font-weight: 600;
        line-height: 1rem;
        padding-top: 0;
        padding-bottom: .5rem;
    }

    &__label-optional {
        font-weight: 400;
    }

    &__label-description {
        font-weight: 400;
        margin-top: .5rem;
    }

    &__feedback {
        display: block;
        line-height: 1rem;
        font-size: .875rem;
        margin-top: .5rem;

        &.valid {
            color: #108548;
        }

        &.invalid {
            color: #dd2b0e;
        }
    }

    &__description {
        display: block;
        color: #737278;
        font-size: .875rem;
        font-weight: 400;
        line-height: 1rem;
        margin-top: .5rem;
    }
}
</style>
