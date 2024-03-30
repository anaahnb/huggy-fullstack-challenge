<template>
    <section>
        <h2>Contatos</h2>

        <create-modal v-if="showModal" @close="closeModal" />

        <div class="contact__list">
            <div class="contact__action">
                <input-component placeholder="Buscar contato" withIcon />
                <button-component type="primary" withIcon icon="add" text="Adicionar contato" :handleClick="openModal"/>
            </div>
            <table>
                <thead class="table__header">
                    <tr>
                        <th>
                            Nome
                            <south size=12 color="#505050" />
                        </th>
                        <th>Email</th>
                        <th>Telefone</th>
                    </tr>
                </thead>

                <tbody v-if="contacts.length > 0">
                    <tr v-for="contato in contacts" :key="contato.contato_id" @click="openModal(contato)" @mouseenter="hoveredRow = contato.contato_id" @mouseleave="hoveredRow = null">
                        <td> {{ contato.contatos_nome }} </td>
                        <td> {{ contato.contatos_email }} </td>
                        <td> {{ contato.contatos_telefone }} </td>

                        <div class="action-buttons" v-if="hoveredRow === contato.contato_id">
                            <icon-button-component type="secondary" icon="edit" text="Editar" :handleClick="() => editContact(contato)"/>
                            <icon-button-component type="danger" icon="trash" text="Excluir" :handleClick="() => deleteContact(contato)"/>
                        </div>
                    </tr>
                </tbody>
            </table>

            <div class="empty-state" v-if="contacts.length === 0">
                <img src="/img/empty-image.svg">
                <button-component type="primary" withIcon icon="add" text="Adicionar contato" :handleClick="openModal"/>
            </div>
        </div>
    </section>
</template>

<script>
    import { ref, onMounted } from 'vue';
    import South from '/public/icons/South.vue';
    import useContacts from '/resources/js/composables/contatos.js';

    import ButtonComponent from '/resources/js/components/ButtonComponent.vue';
    import IconButtonComponent from '/resources/js/components/IconButtonComponent.vue';

    import InputComponent from '/resources/js/components/InputComponent.vue';
    import CreateModal from '/resources/js/components/CreateModal.vue';
    import ContactDetailsModal from '/resources/js/components/ContactDetailsModal.vue';

    export default {
        name: "ContactsPage",
        components: {
            South,
            ButtonComponent,
            IconButtonComponent,
            InputComponent,
            CreateModal,
            ContactDetailsModal 
        },
        setup() {
            const showModal = ref(false);
            const showContactDetailsModal = ref(false);

            const currentContact = ref(null);
            const { contacts, getContacts } = useContacts();

            const hoveredRow = ref(null);

            onMounted(getContacts);

            function openModal(contato = null) {
                if (contato) {
                    currentContact.value = contato;
                    showContactDetailsModal.value = true;
                } else {
                    showModal.value = true;
                }
            }

            function closeModal() {
                showModal.value = false;
            }

            function closeContactDetailsModal() {
                showContactDetailsModal.value = false;
            }

            return {
                showModal,
                hoveredRow,
                showContactDetailsModal,
                contacts,
                currentContact,
                openModal,
                closeModal,
                closeContactDetailsModal
            };
        }
    };
</script>

<style lang="scss" scoped>
    section {
        max-width: 58.125rem;
        margin: 0 auto;

        h2 {
            margin: 1rem 0;
        }
        
        .contact__list {
            background-color: white;
            border: 1px #E1E1E1 solid;
            border-radius: 1rem;
            box-shadow: 0px 1px 2px 0px #00000026;
            height: 90vh;

            .contact__action {
                display: flex;
                justify-content: space-between;
                padding: 1rem;
                flex-wrap: wrap;

                input {
                    padding: 8px 12px;
                    border: 1px solid #E1E1E1;
                    border-radius: .5rem;
                    background-color: #F8F8F8;
                    color: #949494;
                    font-size: .875rem;
                }
            }

            table {
                width: 100%;
                border-spacing: 0;
                padding: 6px;
                
                th {
                    padding: 1rem;
                    font-size: .75rem;
                    color: #505050;
                    text-align: left;
                    font-weight: 600;

                    &:first-child { 
                        width: 40%;

                        display: flex;
                        align-items: center;
                        gap: 4px;
                    }
                    &:nth-child(2) { width: 35%; }
                    &:last-child { width: 25%; }

                    span img {
                        height: 1rem;
                        fill: #505050;
                    }

                }

                td {
                    font-size: .875rem;
                    padding: 1rem;
                    border-collapse: collapse;
                    cursor: pointer;

                    &:first-child { 
                        border-top-left-radius: 1rem; 
                        border-bottom-left-radius: 1rem;
                    }

                    &:last-child {
                        border-bottom-right-radius: 1rem; 
                        border-top-right-radius: 1rem; 
                    }

                    &:first-child::before {
                        content: '';
                        display: inline-block;
                        width: 2rem;
                        height: 2rem;
                        -moz-border-radius: 100%;
                        -webkit-border-radius: 100%;
                        border-radius: 100%;
                        background-color: #F8F7FD;
                        align-items: center;
                        justify-content: center;
                        vertical-align: baseline;
                        margin-right: 1rem;

                        vertical-align: -50%;

                    }
                }

                tbody tr {
                    position: relative;

                    .action-buttons {
                        display: none;
                        position: absolute;
                        right: 0;
                        top: 0;
                        bottom: 0;
                        align-items: center;
                        transition: background-color 0.3s ease;
                    }

                    &:hover {
                        background-color: #F8F8F8;
                        transition: ease-in-out 0.3s;  
                        -moz-border-radius: 1rem !important;
                        -webkit-border-radius: 1rem !important;
                        border-radius: 1rem !important; 

                        .action-buttons {
                            display: flex;
                            justify-content: space-between;
                            padding: 0 1rem;
                        }
                    }
                }
                
            }

            .empty-state {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column;
                    height: 70%;
                    gap: 1.5rem;
                }
        }
    }
</style>
