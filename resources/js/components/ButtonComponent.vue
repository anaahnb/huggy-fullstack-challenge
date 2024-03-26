<template>
    <div>
      <button :class="buttonClasses">
        <span v-if="withIcon" class="icon">
          <img :src="`/icons/${icon}.svg`" alt="Icon" />
        </span>
        {{ text }}
      </button>
    </div>
  </template>
  
<script>
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
            }
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

        cursor: pointer;
        transition: background-color 0.3s ease;

        display: flex;
        align-items: center;
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
  