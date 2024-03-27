<template>
    <div>
      <button :class="buttonClasses">
        <span v-if="withIcon" class="icon">
            <icon-button :size="iconSize" :color="iconColor" :path="iconPath" />
        </span>
        {{ text }}
      </button>
    </div>
  </template>
  
<script>

    import IconButton from '../../../public/icons/IconButton.vue';

    export default {
        props: {
            type: {
                type: String,
                default: "primary"
            },
            withIcon: {
                type: Boolean,
                default: false
            },
            icon: {
                type: String,
                default: "add"
            },
            text: {
                type: String,
                default: "Button"
            }
        },
        computed: {
            buttonClasses() {
                return {
                primary: this.type === "primary",
                secondary: this.type === "secondary",
                danger: this.type === "danger",
                "with-icon": this.withIcon
                };
            },
            iconSize() {
                return this.type === "primary" ? 12 : 16;
            },
            iconColor() {
                return this.type === "primary" ? "#FFF" : "#505050";
            },
            iconPath() {
                return this.icon === "add" ? "M13 8H8V13C8 13.55 7.55 14 7 14C6.45 14 6 13.55 6 13V8H1C0.45 8 0 7.55 0 7C0 6.45 0.45 6 1 6H6V1C6 0.45 6.45 0 7 0C7.55 0 8 0.45 8 1V6H13C13.55 6 14 6.45 14 7C14 7.55 13.55 8 13 8Z" : "M1 16C1 17.1 1.9 18 3 18H11C12.1 18 13 17.1 13 16V6C13 4.9 12.1 4 11 4H3C1.9 4 1 4.9 1 6V16ZM13 1H10.5L9.79 0.29C9.61 0.11 9.35 0 9.09 0H4.91C4.65 0 4.39 0.11 4.21 0.29L3.5 1H1C0.45 1 0 1.45 0 2C0 2.55 0.45 3 1 3H13C13.55 3 14 2.55 14 2C14 1.45 13.55 1 13 1Z";
            }
        },
        components: {
            IconButton
        }

    };
</script>
  
<style scoped lang="scss">
    button {
        border: 0;
        padding: 0.5625rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        letter-spacing: 1.25px;

        cursor: pointer;
        transition: background-color 0.3s ease;

        display: flex;
        gap: 0.5rem;

        &.primary {
            background-color: #321BDE;
            color: #FFF;

            &:hover { background-color: #5946E4; }
            &:focus { background-color: #2715B0; }
            &:active { background-color: #2715B0; }
        }

        &.secondary {
            background-color: #FFFFFF;
            color: #505050;

            &:hover { background-color: #F8F8F8; }
            &:focus { background-color: #E1E1E1; }
            &:active { background-color: #E1E1E1; }
        }

        &.danger {
            background-color: #FFFFFF;
            color: #DE321B;

            &:hover { background-color: #FAECE3; }
            &:focus { background-color: #F4CAB6; }
            &:active { background-color: #F4CAB6; }
        }
    }
</style>
  