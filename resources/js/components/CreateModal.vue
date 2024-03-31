<template>
    <form @submit.prevent="submitCreateContactForm">
        <modal-component>
            <template v-slot:header>
                <h2>Adicionar novo contato</h2>
            </template>


            <template v-slot:body>
                <div>   
                    <input-component v-model="newContact.contatos_nome" label="Nome" placeholder="Nome completo" :error-message="errors.contatos_nome && errors.contatos_nome[0]" :typeStyle="errors.contatos_nome ? 'danger' : 'default'"></input-component>
                    <input-component typeInput="email" v-model="newContact.contatos_email" label="Email" placeholder="Email" :errorMessage="errors.contatos_email && errors.contatos_email[0]"></input-component>
                    <input-component typeInput="file" @change="handleFileUpload" label="Imagem"></input-component>
                    <div class="input__row">
                        <input-component typeInput="number" v-model="newContact.contatos_telefone" label="Telefone" placeholder="Telefone" :errorMessage="errors.contatos_telefone && errors.contatos_telefone[0]" :typeStyle="errors.contatos_telefone ? 'danger' : 'default'"></input-component>
                        <input-component typeInput="number" v-model="newContact.contatos_celular" label="Celular" placeholder="Celular"></input-component>
                    </div>
                    <input-component v-model="newContact.endereco_rua" label="Endereço" placeholder="Endereço" :errorMessage="errors.endereco_rua && errors.endereco_rua[0]" :typeStyle="errors.endereco_rua ? 'danger' : 'default'"></input-component>
                    <div class="input__row">
                        <input-component v-model="newContact.cidade_id" label="Cidade" placeholder="Cidade" :errorMessage="errors.cidade_id && errors.cidade_id[0]" :typeStyle="errors.cidade_id ? 'danger' : 'default'"></input-component>
                        <input-component v-model="newContact.endereco_bairro" label="Bairro" placeholder="Bairro" :errorMessage="errors.endereco_bairro && errors.endereco_bairro[0]" :typeStyle="errors.endereco_bairro ? 'danger' : 'default'"></input-component>
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

    import useContacts from '/resources/js/composables/contatos.js';

    export default {
        name: "CreateModal",
        components: {
            ModalComponent,
            InputComponent,
            ButtonComponent
        },
        setup(props, { emit } ) {
            const { createContact, errors } = useContacts();

            const toast = useToast();

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
                try {
                    if (errors) {
                        toast.error("Por favor, preencha todos os campos do formulário.");
                        return; 
                    } else {
                        const formData = new FormData();
                        for (const key in newContact.value) {
                            formData.append(key, newContact.value[key]);
                        }
                        await createContact(formData);
                        toast.success("Contato criado com sucesso!", { timeout: 2000 });
                        emit('close');
                    }

                } catch (error) {
                    console.error(error);
                }
            };


            return {
                newContact,
                toast,
                errors,
                submitCreateContactForm,
                handleFileUpload,
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