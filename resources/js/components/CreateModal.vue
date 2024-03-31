<template>
    <form @submit.prevent="submitCreateContactForm">
        <modal-component>
            <template v-slot:header>
                <h2>Adicionar novo contato</h2>
            </template>


            <template v-slot:body>
                <div>   
                    <input-component v-model="newContact.contatos_nome" label="Nome" placeholder="Nome completo"></input-component>
                    <input-component typeInput="email" v-model="newContact.contatos_email" label="Email" placeholder="Email"></input-component>
                    <input-component typeInput="file" @change="handleFileUpload" label="Imagem"></input-component>
                    <div class="input__row">
                        <input-component typeInput="number" v-model="newContact.contatos_telefone" label="Telefone" placeholder="Telefone"></input-component>
                        <input-component typeInput="number" v-model="newContact.contatos_celular" label="Celular" placeholder="Celular"></input-component>
                    </div>
                    <input-component v-model="newContact.endereco_rua" label="Endereço" placeholder="Endereço"></input-component>
                    <div class="input__row">
                        <input-component v-model="newContact.cidade_id" label="Cidade" placeholder="Cidade"></input-component>
                        <input-component v-model="newContact.endereco_bairro" label="Bairro" placeholder="Bairro"></input-component>
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
            const { createContact } = useContacts();
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
                    const formData = new FormData();
                    for (const key in newContact.value) {
                        formData.append(key, newContact.value[key]);
                    }
                    await createContact(formData);
                    toast.success("Contato criado com sucesso!", { timeout: 2000 });
                    emit('close');
                } catch (error) {
                    console.error(error);
                }
            };

            return {
                newContact,
                toast,
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