<template>
    <transition name="modal">
      <div class="modal-mask">
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
              </slot>
            </div>
          </div>
        </div>
      </div>
    </transition>
</template>

<script>

  export default {
    name: "ModalComponent"
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

    -webkit-animation: scale-in 0.2s cubic-bezier(0.250, 0.460, 0.450, 0.940);
	        animation: scale-in 0.2s cubic-bezier(0.250, 0.460, 0.450, 0.940);

    .modal-container {
      max-width: 38.125rem;
      height: 80vh;
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

      .modal-header, .modal-body, .modal-footer {
        padding: 1.5rem;
      }
    }

  }

</style>
  