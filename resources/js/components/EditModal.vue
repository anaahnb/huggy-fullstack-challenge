<template>
    <form @submit.prevent="submitEditContactForm">
        <modal-component>
            <template v-slot:header>
                <h2>Editar contato</h2>
            </template>

            <template v-slot:body>
                <div>
                    <input-component v-model="editContact.contatos_nome" :typeStyle="getErrorType('contatos_nome')" :errorMessage="getErrorMessage('contatos_nome')" label="Nome" placeholder="Nome completo"></input-component>
                    <input-component typeInput="email" v-model="editContact.contatos_email" :typeStyle="getErrorType('contatos_email')" :errorMessage="getErrorMessage('contatos_email')" label="Email" placeholder="Email"></input-component>
                    <input-component typeInput="file" @change="handleFileUpload" :typeStyle="getErrorType('contatos_imagem')" :errorMessage="getErrorMessage('contatos_imagem')" label="Imagem"></input-component>
                    
                    <div class="input__row">
                        <input-component v-model="editContact.contatos_telefone" :typeStyle="getErrorType('contatos_telefone')" :errorMessage="getErrorMessage('contatos_telefone')" label="Telefone" placeholder="Telefone"></input-component>
                        <input-component v-model="editContact.contatos_celular" :typeStyle="getErrorType('contatos_celular')" :errorMessage="getErrorMessage('contatos_celular')" label="Celular" placeholder="Celular"></input-component>
                    </div>
                    
                    <input-component v-model="editContact.endereco_endereco_rua" :typeStyle="getErrorType('endereco_rua')" :errorMessage="getErrorMessage('endereco_rua')" label="Endereço" placeholder="Endereço"></input-component>
                    <div class="input__row">
                        <select-component v-model="editContact.endereco_cidade_id" :options="cidades" label="Cidade" placeholder="Selecione uma cidade" :typeStyle="getErrorType('cidade_id')" :errorMessage="getErrorMessage('cidade_id')"></select-component>
                        <input-component v-model="editContact.endereco_endereco_bairro" :typeStyle="getErrorType('endereco_bairro')" :errorMessage="getErrorMessage('endereco_bairro')" label="Bairro" placeholder="Bairro"></input-component>
                    </div>
                </div>
            </template> 

            <template v-slot:footer>
                <button-component text="Cancelar" type="secondary" @click="$emit('close')"></button-component>
                <button-component text="Salvar" type="primary"></button-component>
            </template>
        </modal-component>
    </form>
</template>

<script>
    import { ref } from 'vue';
    import { useToast } from 'vue-toastification';

    import ModalComponent from '/resources/js/components/ModalComponent.vue'
    import InputComponent from '/resources/js/components/InputComponent.vue'
    import ButtonComponent from '/resources/js/components/ButtonComponent.vue'
    import SelectComponent from '/resources/js/components/SelectComponent.vue'


    import useContacts from '/resources/js/composables/contatos.js'
    import useCidades from '/resources/js/composables/cidades.js'


    export default {
        name: "EditModal",
        components: {
            ModalComponent,
            InputComponent,
            ButtonComponent,
            SelectComponent
        },
        props: {
            contatoParaEditar: {
                type: Object,
                required: true
            }
        },

        setup(props, { emit }) {
            const { updateContact, errors } = useContacts();
            const { cidades } = useCidades();


            const toast = useToast();
            const selectedCity = ref('');


            const editContact = ref({...props.contatoParaEditar});

            console.log(editContact)
            
            const handleFileUpload = (event) => {
                editContact.value.contatos_imagem = event.target.files[0];
            };

            const submitEditContactForm = async () => {
                const result = await updateContact(editContact.value);
                if (result) {
                    toast.success('Contato editado com sucesso!');
                    emit('close');
                } else {
                    toast.error('Não foi possível editar o contato.');
                }
            };

            const getErrorMessage = (field) => {
                if (errors.value && errors.value.errors && errors.value.errors[field]) {
                    return errors.value.errors[field][0];
                }
                return '';
            };

            const getErrorType = (field) => {
                return errors.value && errors.value.errors && errors.value.errors[field] ? 'danger' : 'default';
            };

            return {
                editContact,
                toast,
                errors,
                handleFileUpload,
                submitEditContactForm,
                getErrorMessage,
                getErrorType,
                cidades,
                selectedCity,
            };
        }
    }
</script>