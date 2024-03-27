<template>
    <modal-component>
        <template v-slot:header>
            <h2>Adicionar novo contato</h2>
        </template>

        <template v-slot:body>
            <div>   
                <input-component label="Nome" placeholder="Nome completo"></input-component>
                <input-component label="Email" placeholder="Email"></input-component>
                <input-component label="Telefone" placeholder="Telefone"></input-component>
                <input-component label="Celular" placeholder="Endereço"></input-component>
                <div class="input__row">
                    <input-component label="Bairro" placeholder="Bairro"></input-component>
                    <input-component label="Estado" placeholder="Estado"></input-component>
                </div>
            </div>
        </template>
        <template v-slot:footer>
            <button-component text="Cancelar" type="secondary" @click="$emit('close')"></button-component>
            <button-component text="Salvar" type="primary"></button-component>
        </template>
    </modal-component>
</template>

<script>
    import ModalComponent from '/resources/js/components/ModalComponent.vue'
    import InputComponent from '/resources/js/components/InputComponent.vue'
    import ButtonComponent from '/resources/js/components/ButtonComponent.vue'


    export default {
        name: "CreateModal",
        components: {
            ModalComponent,
            InputComponent,
            ButtonComponent
        }
    }
</script>

<style>

    .modal-footer {
        border-top: 1px solid #E1E1E1;
        display: flex;
        gap: .5rem;
        justify-content: flex-end;
    }

    .input__row {
        display: flex;
        gap: 1.5rem;
    }

</style>