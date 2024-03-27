<template>
    <div>
        <div class="input-wrapper">
            <label v-if="!withIcon">{{ label }}</label>
            <div class="input-container">
                <input :class="inputClasses" :placeholder="placeholder" v-model="inputValue" />
                <span v-if="withIcon" class="icon">
                    <search size=14 color="#757575"></search>
                </span>
            </div>
            <span v-if="type === 'danger'" class="error-message"> {{ errorMessage }} </span>
        </div>
    </div>
</template>

<script>
    import Search from '../../../public/icons/Search.vue';

    export default {
        name: "InputComponent",
        props: {
            type: {
                type: String,
                default: "default"
            },
            withIcon: {
                type: Boolean,
                default: false
            },
            label: {
                type: String,
                default: "Label"
            },
            placeholder: {
                type: String,
                default: "Placeholder"
            },
            errorMessage: {
                type: String,
                default: "Error message"
            }
        },
        data() {
            return {
                inputValue: ""
            };
        },
        computed: {
            inputClasses() {
                return {
                    danger: this.type === "danger",
                    'with-icon': this.withIcon
                };
            }
        },
        components: {
            Search,
        }
    };
</script>

<style scoped lang="scss">
    .input-wrapper {
        margin-bottom: 1rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
    }

    .input-container {
        position: relative;
    }

    input {
        border: 1px solid #E1E1E1;
        background-color: #F8F8F8;
        border-radius: 0.5rem;
        padding: 0.5625rem 0.75rem;
        font-size: 0.875rem;
        transition: border-color 0.3s ease;
        width: 100%;

        &::placeholder {
            color: #949494;
        }

        &:focus {
            outline: none;
            border-color: #321BDE;
        }

        &.danger {
            border-color: #AD2213;
        }

        &.with-icon {
            padding-left: 40px;
        }
    }

    .icon {
        position: absolute;
        top: 50%;
        left: 0.75rem;
        transform: translateY(-50%);
        margin-top: 2px;

        img {
            fill: #757575;
        }
    }

    .error-message {
        font-size: 0.75rem;
        color: #AD2213;
    }
</style>
