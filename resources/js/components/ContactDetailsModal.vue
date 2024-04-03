<template>
    <modal-component>
        <template v-slot:header>
            <div class="header">
                <div class="header__name">
                    <div v-if="imageType(contact) === 'image'">
                        <img :src="`/storage/${contact.contatos_imagem}`" alt="Imagem do contato" class="contact-image">
                    </div>
                    <div v-else class="contact-placeholder">
                        {{ contact.contatos_imagem }}
                    </div>
                    <h2> {{ contact.contatos_nome }} </h2>

                </div>
                <div class="button__group">
                    <icon-button-component icon="trash" text="Excluir" @click="$emit('open-confirm-modal', contact)"/>
                    <icon-button-component aria-label="Botão para editar contato" icon="edit" @click="$emit('open-edit-modal', contact)"></icon-button-component>
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

            const imageType = (contato) => {
                if (contato.contatos_imagem.startsWith('images/')) {
                    return 'image';
                } else {
                    return 'placeholder';
                }
            };

            return {
                contacts,
                imageType
            };
        }
    }
</script>

<style lang="scss" scoped>

    .header {
        display: flex;
        justify-content: space-between; 
        
        .header__name {
            display: flex;
            align-items: center;

            .contact-placeholder {
                        width: 2rem;
                        height: 2rem;
                        background-color: #F8F7FD;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        margin-right: 1rem;
                        text-transform: uppercase;
                        color: #180D6E;
                        font-weight: 500;
                    }

                    .contact-image {
                        width: 2rem;
                        height: 2rem;
                        border-radius: 50%;
                        margin-right: 1rem;
                    }

        }

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