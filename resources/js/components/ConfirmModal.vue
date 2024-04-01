<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                        <h2>Excluir este contato?</h2>
                    </div>
        
                    <div class="modal-body">
                        <div class="button__group">
                            <button-component text="Cancelar" type="secondary" @click="$emit('close')"></button-component>
                            <button-component text="Excluir" type="danger" @click="contatoParaExcluir && $emit('confirm-delete', contatoParaExcluir.contato_id)"></button-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>

    import ModalComponent from '/resources/js/components/ModalComponent.vue'
    import ButtonComponent from '/resources/js/components/ButtonComponent.vue'


    export default {
        name: 'ConfirmModal',
        components: {
            ModalComponent,
            ButtonComponent
        },
        props: {
            contatoParaExcluir: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style lang="scss" scoped>

  @keyframes scale-in {
      0% {
        -webkit-transform: scale(0);
                transform: scale(0);
      }
      100% {
        -webkit-transform: scale(1);
                transform: scale(1);
    }
  }

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
    padding: 1rem;

    -webkit-animation: scale-in 0.2s cubic-bezier(0.250, 0.460, 0.450, 0.940);
	        animation: scale-in 0.2s cubic-bezier(0.250, 0.460, 0.450, 0.940);

    .modal-container {
      max-width: 38.125rem;
      margin: 0 auto;

      border: 1px solid #E1E1E1;
      box-shadow: 0px 1px 2px 0px #00000026;
      background-color: #fff;
      border-radius: 12px;

      transition: all 0.3s ease;

      .modal-header {
        h2 {
          margin: 0;
        }
      }

      .modal-header, .modal-body {
        padding: 1.5rem;
      }

      .button__group {
        display: flex;
        justify-content: end;
      }
    }

  }
</style>