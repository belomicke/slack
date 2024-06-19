<script lang="ts">
import AuthButton from '@/shared/ui/components/auth/button/button.vue'
import { PropType } from 'vue'

export default {
    name: 'SAvatarUploader',
    components: {
        AuthButton,
    },
    props: {
        avatarFile: {
            type: Object as PropType<File | undefined>,
            required: false,
            default: undefined,
        },
        useDefaultAvatar: {
            type: Boolean,
            required: false,
            default: false,
        },
        defaultAvatarNumber: {
            type: Number,
            required: false,
            default: Math.ceil(Math.random() * 26),
        },
    },
    emits: [
        'update:default-avatar-number',
        'update:avatar-file',
    ],
    data() {
        return {
            file: undefined,
            avatarNumber: this.getAvatarNumber(26),
        }
    },
    computed: {
        avatarUrl() {
            if (this.file !== undefined) {
                return URL.createObjectURL(this.file)
            }

            return `http://localhost/workspace_profile_avatars/default/${this.avatarNumber}/96.png`
        },
    },
    watch: {
        avatarFile(file) {
            this.file = file
        },
    },
    mounted() {
        this.$emit('update:default-avatar-number', this.avatarNumber)
    },
    methods: {
        getAvatarNumber(range: number) {
            return Math.ceil(Math.random() * range)
        },
        uploadAvatar() {
            const input = document.createElement('input')

            input.type = 'file'
            input.accept = 'image/png, image/jpeg'

            input.addEventListener('input', (e: InputEvent) => {
                const target = e.target as HTMLInputElement
                const file = target.files ? target.files[0] : null

                this.setAvatar(file)
            })

            input.click()
        },
        setAvatar(file: File | null) {
            if (file === null) return
            if (file.size > 204800) return

            this.file = file
            this.$emit('update:avatar-file', file)
        },
        removeAvatar() {
            this.file = undefined
            this.$emit('update:avatar-file', undefined)
        },
    },
}
</script>

<template>
    <div class="s-avatar-uploader">
        <div
            class="s-avatar-uploader__avatar"
            :style="{
                'background-image': `url(${avatarUrl})`
            }"
        />
        <div class="s-avatar-uploader-body">
            <div class="s-avatar-uploader-body__title">Загрузите новый аватар (опционально)</div>
            <div class="s-avatar-uploader-body__actions">
                <auth-button @click="uploadAvatar">Выберите файл...</auth-button>
                <div
                    class="s-avatar-uploader-body__file"
                    v-if="file === undefined"
                >
                    Файл не выбран.
                </div>
                <auth-button
                    @click="removeAvatar"
                    variant="danger"
                    category="secondary"
                    v-else
                >
                    Удалить аватар
                </auth-button>
            </div>
            <div class="s-avatar-uploader-body__tip">
                Идеальный размер картинки 192 х 192 пикселя.
                <br />
                Максимальный размер файла 200 Кб
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.s-avatar-uploader {
    display: flex;
    align-items: center;
    gap: 15px;

    &__avatar {
        height: 96px;
        width: 96px;
        background-size: cover;
        border-radius: 50%;
    }

    &-body {
        &__title {
            font-weight: 600;
            margin-bottom: 10px;
        }

        &__actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0.5rem 0;
        }

        &__tip {
            color: #737278;
        }
    }
}
</style>
