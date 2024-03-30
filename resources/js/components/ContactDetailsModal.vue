<template>
    <modal-component>
        <template v-slot:header>
            <div class="header">
                <h2> {{ contact.contatos_nome }} </h2>
                <div class="button__group">
                    <icon-button-component aria-label="Botão para excluir contato" icon="trash"></icon-button-component>
                    <icon-button-component aria-label="Botão para editar contato" icon="edit"></icon-button-component>
                    <icon-button-component aria-label="Botão para fechar modal" icon="close" @click="$emit('close')"></icon-button-component>
                </div>
            </div>
        </template>

        <template v-slot:body>
            <div class="information">
                <p> <span> Email </span> {{ contact.contatos_email }} </p>
                <p> <span> Endereço </span> {{ contact.endereco.endereco_rua }} </p>
                <p> <span> Bairro </span> {{ contact.endereco.endereco_bairro }} </p>
                <p> <span> Cidade </span> {{ contact.endereco.cidade.cidade_nome }} </p>
                <p> <span> Estado </span> {{ contact.endereco.cidade.estado.estado_nome }} </p>
            </div>
        </template>
        
    </modal-component>


</template>

<script>
    import ModalComponent from '/resources/js/components/ModalComponent.vue'
    import IconButtonComponent from '/resources/js/components/IconButtonComponent.vue'

    import useContacts from '/resources/js/composables/contatos.js';

    export default {
        name: "ContactDetailsModal",
        components: {
            ModalComponent,
            IconButtonComponent
        },
        props: {
            contact: {
                type: Object,
                required: true
            }
        },
        setup() {
            const { contacts } = useContacts();

            return {
                contacts,
            };
        }
    }
</script>

<style lang="scss" scoped>

    .header {
        display: flex;
        justify-content: space-between;   

        .button__group {
            display: flex;
            gap: 1.5rem; 
        }
    }

    .information {
        padding: 0 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    
        p {
            font-size: 14px;

            span {
                color: #757575;
                font-weight: 500;
                margin-right: 1rem;
        
            }
        }
        
    }
    
</style>