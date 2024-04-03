<template>
    <form @submit.prevent="submitCreateContactForm">
        <modal-component>
            <template v-slot:header>
                <h2>Adicionar novo contato</h2>
            </template>

            <template v-slot:body>
                <div>
                    <input-component v-model="newContact.contatos_nome" :typeStyle="getErrorType('contatos_nome')" :errorMessage="getErrorMessage('contatos_nome')" label="Nome" placeholder="Nome completo"></input-component>
                    
                    <input-component typeInput="email" v-model="newContact.contatos_email" :typeStyle="getErrorType('contatos_email')" :errorMessage="getErrorMessage('contatos_email')" label="Email" placeholder="Email"></input-component>
                    <input-component typeInput="file" @change="handleFileUpload" :typeStyle="getErrorType('contatos_imagem')" :errorMessage="getErrorMessage('contatos_imagem')" label="Imagem"></input-component>
                    <div class="input__row">
                        <input-component typeInput="number" v-model="newContact.contatos_telefone" :typeStyle="getErrorType('contatos_telefone')" :errorMessage="getErrorMessage('contatos_telefone')" label="Telefone" placeholder="Telefone"></input-component>
                        <input-component typeInput="number" v-model="newContact.contatos_celular" :typeStyle="getErrorType('contatos_celular')" :errorMessage="getErrorMessage('contatos_celular')" label="Celular" placeholder="Celular"></input-component>
                    </div>
                    <input-component v-model="newContact.endereco_rua" :typeStyle="getErrorType('endereco_rua')" :errorMessage="getErrorMessage('endereco_rua')" label="Endereço" placeholder="Endereço"></input-component>
                    <div class="input__row">

                        <select-component v-model="newContact.cidade_id" :options="cidades" label="Cidade" placeholder="Selecione uma cidade" :typeStyle="getErrorType('cidade_id')" :errorMessage="getErrorMessage('cidade_id')"></select-component>
                        <input-component v-model="newContact.endereco_bairro" :typeStyle="getErrorType('endereco_bairro')" :errorMessage="getErrorMessage('endereco_bairro')" label="Bairro" placeholder="Bairro"></input-component>
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
    import { ref, computed } from 'vue';
    import { useToast } from 'vue-toastification';

    import ModalComponent from '/resources/js/components/ModalComponent.vue'
    import InputComponent from '/resources/js/components/InputComponent.vue'
    import SelectComponent from '/resources/js/components/SelectComponent.vue'

    import ButtonComponent from '/resources/js/components/ButtonComponent.vue'

    import useContacts from '/resources/js/composables/contatos.js';
    import useCidades from '/resources/js/composables/cidades.js';


    export default {
        name: "CreateModal",
        components: {
            ModalComponent,
            InputComponent,
            ButtonComponent,
            SelectComponent
        },
        setup(props, { emit } ) {
            const { createContact, errors } = useContacts();
            const { cidades } = useCidades();

            const toast = useToast();
            const selectedCity = ref('');

            const newContact = ref({
                contatos_nome: '',
                contatos_email: '',
                contatos_telefone: '',
                contatos_celular: '',
                endereco_rua: '',
                cidade_id: '',
                endereco_bairro: '',
                contatos_imagem: ''                
            });

            const handleFileUpload = (event) => {
                newContact.value.contatos_imagem = event.target.files[0];
            };

            const submitCreateContactForm = async () => {
                const result = await createContact(newContact.value);
                console.log('Resultado da criação do contato:', result);
                console.log('Dados de erro após a tentativa de criação:', JSON.stringify(errors.value));

                console.log('Cidades', cidades);


                if (result) {
                    toast.success('Contato criado com sucesso!');
                    emit('close');
                } else {
                    toast.error('Não foi possível criar o contato.');
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
                newContact,
                toast,
                errors,
                handleFileUpload,
                submitCreateContactForm,
                getErrorMessage,
                getErrorType,
                cidades,
                selectedCity,
            };
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
        gap: 0 1.5rem;
        flex-wrap: wrap
    }
</style>
