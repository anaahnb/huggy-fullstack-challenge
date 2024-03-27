<template>
    <transition name="modal">
      <div class="modal-mask" @click="$emit('close')">
        <div class="modal-wrapper">
          <div class="modal-container">
            <div class="modal-header">
              <slot name="header">
                <h2>Default header</h2>
              </slot>
            </div>
  
            <div class="modal-body">
              <slot name="body">
                
              </slot>
            </div>
  
            <div class="modal-footer">
              <slot name="footer">
                <button-component text="Cancelar" type="secondary" @click="$emit('close')"></button-component>
                <button-component text="Salvar" type="primary"></button-component>
              </slot>
            </div>
          </div>
        </div>
      </div>
    </transition>
</template>

<script>

  import ButtonComponent from '/resources/js/components/ButtonComponent.vue'

  export default {
    name: "ModalComponent",
    components: {
      ButtonComponent
    }

  }
</script>

<style lang="scss" scoped>

  .modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
  }

  .modal-wrapper {
    display: table-cell;
    vertical-align: middle;

    .modal-container {
      max-width: 38.125rem;
      height: 60vh;
      margin: 0 auto;

      border: 1px solid #E1E1E1;
      box-shadow: 0px 1px 2px 0px #00000026;
      background-color: #fff;
      border-radius: 12px;

      transition: all 0.3s ease;

      .modal-header {
        border-bottom: 1px #E1E1E1 solid;

        h2 {
          margin: 0;
        }
      }

      .modal-footer {
        display: flex;
        gap: .5rem;
      
        justify-content: flex-end;
      }

      .modal-header, .modal-body, .modal-footer {
        padding: 1.5rem;
      }
    }

  }

</style>
  