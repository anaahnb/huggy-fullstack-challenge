<template>
    <section>
        <h2>Contatos</h2>

        <create-modal v-if="showModal" @close="closeModalAndRefreshContacts" />
        <contact-details-modal v-if="showContactDetailsModal" :contact="currentContact" @open-confirm-modal="openConfirmModal" @open-edit-modal="openEditModal" @close="closeContactDetailsModal"/>
        <confirm-modal v-if="showConfirmModal" :contato-para-excluir="currentContact" @close="closeConfirmModal" @confirm-delete="handleDeleteContact" />
        <edit-modal v-if="showEditModal" :contato-para-editar="currentContact" @close="closeEditModal"/>

        <div class="contact__list">
            <div class="contact__action">
                <input-component placeholder="Buscar contato" withIcon v-model="searchQuery" />
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

                <tbody v-if="filteredContacts.length > 0">
                    <tr v-for="contato in filteredContacts" :key="contato.contato_id" @click="openModal(contato)" @mouseenter="hoveredRow = contato.contato_id" @mouseleave="hoveredRow = null">
                        <td> 
                            <div v-if="imageType(contato) === 'image'">
                                <img :src="`/storage/${contato.contatos_imagem}`" alt="Imagem do contato" class="contact-image">
                            </div>
                            <div v-else class="contact-placeholder">
                                {{ contato.contatos_imagem }}
                            </div>
                            {{ contato.contatos_nome }}
                        </td>
                        <td> {{ contato.contatos_email }} </td>
                        <td> {{ contato.contatos_telefone }} </td>

                        <div class="action-buttons" v-if="hoveredRow === contato.contato_id">
                            <icon-button-component icon="edit" text="Editar"/>
                            <icon-button-component icon="trash" text="Excluir"/>
                        </div>
                    </tr>
                </tbody>
            </table>

            
            <div class="empty-state" v-if="filteredContacts.length === 0">
                <img src="/images/empty-image.svg">
                <button-component type="primary" withIcon icon="add" text="Adicionar contato" :handleClick="openModal"/>
            </div>
        </div>

        <pagination-component :currentPage="currentPage" :totalPages="totalPages" :nextPage="nextPage" :prevPage="prevPage" @change-page="changePage"/>
        
    </section>
</template>

<script>
    import { ref, onMounted, watch } from 'vue';
    import South from '/public/icons/South.vue';
    import useContacts from '/resources/js/composables/contatos.js';

    import ButtonComponent from '/resources/js/components/ButtonComponent.vue';
    import IconButtonComponent from '/resources/js/components/IconButtonComponent.vue';
    import PaginationComponent from '/resources/js/components/PaginationComponent.vue';

    import InputComponent from '/resources/js/components/InputComponent.vue';
    import CreateModal from '/resources/js/components/CreateModal.vue';
    import ContactDetailsModal from '/resources/js/components/ContactDetailsModal.vue';
    import ConfirmModal from '/resources/js/components/ConfirmModal.vue';
    import EditModal from '/resources/js/components/EditModal.vue';

    export default {
        name: "ContactsPage",
        components: {
            South,
            ButtonComponent,
            IconButtonComponent,
            InputComponent,
            CreateModal,
            ContactDetailsModal,
            ConfirmModal,
            EditModal,
            PaginationComponent,
        },
        setup() {
            const showModal = ref(false);
            const showContactDetailsModal = ref(false);
            const showConfirmModal = ref(false);
            const showEditModal = ref(false);

            const currentContact = ref(null);
            const { contacts, getContacts, deleteContact, currentPage, totalPages, nextPage, prevPage } = useContacts();

            const hoveredRow = ref(null);
            const searchQuery = ref('');
            const filteredContacts = ref([]);

            onMounted(() => {
                getContacts().then(() => {
                    filteredContacts.value = contacts.value;
                });
            });

            const imageType = (contato) => {
                if (contato.contatos_imagem.startsWith('images/')) {
                    return 'image';
                } else {
                    return 'placeholder';
                }
            };

            function openModal(contato = null) {
                if (contato) {
                    currentContact.value = contato;
                    showContactDetailsModal.value = true;
                } else {
                    showModal.value = true;
                }
            }

            function openEditModal(contato) {
                if (contato) {
                    currentContact.value = contato;
                    showContactDetailsModal.value = false;
                    showEditModal.value = true;
                } else {
                    console.error('Contato não definido');
                }
            }

            function openConfirmModal(contato) {
                if (contato) {
                    currentContact.value = contato;
                    showContactDetailsModal.value = false;
                    showConfirmModal.value = true;
                } else {
                    console.error('Contato não definido');
                }
            }

            function closeEditModal() {
                showEditModal.value = false;
            }

            function closeConfirmModal() {
                showConfirmModal.value = false;
            }

            function handleDeleteContact(contactId) {
                deleteContact(contactId);
                closeConfirmModal();
            }

            function closeModalAndRefreshContacts() {
                showModal.value = false;
                getContacts().then(() => {
                    filteredContacts.value = contacts.value;
                });
            }

            function closeContactDetailsModal() {
                showContactDetailsModal.value = false;
            }

            const changePage = (page) => {
                getContacts(page).then(() => {
                    filteredContacts.value = contacts.value;
                });
            };

            watch(searchQuery, (newValue) => {
                if (newValue) {
                    filteredContacts.value = contacts.value.filter(contato =>
                        contato.contatos_nome.toLowerCase().includes(newValue.toLowerCase()) ||
                        contato.contatos_email.toLowerCase().includes(newValue.toLowerCase()) ||
                        contato.contatos_telefone.toLowerCase().includes(newValue.toLowerCase())
                    );
                } else {
                    filteredContacts.value = contacts.value;
                }
            });

            return {
                imageType,
                showModal,
                openModal,
                closeModalAndRefreshContacts,

                hoveredRow,
                showContactDetailsModal,
                closeContactDetailsModal,

                contacts,
                currentPage,
                totalPages,
                nextPage,
                changePage,
                prevPage,
                currentContact,
                showConfirmModal,
                openConfirmModal,
                closeConfirmModal,
                handleDeleteContact,

                openEditModal,
                closeEditModal,
                showEditModal,
                searchQuery,
                filteredContacts
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
            overflow-x:auto;

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
                    word-break: keep-all;

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



                    &:first-child { 
                        border-top-left-radius: 1rem; 
                        border-bottom-left-radius: 1rem;
                        display: inline-flex;
                        
                        align-items: center;
                        justify-content: center;
                        vertical-align: baseline;
                        margin-right: 1rem;

                        vertical-align: -50%;
                    }

                    &:last-child {
                        border-bottom-right-radius: 1rem; 
                        border-top-right-radius: 1rem; 
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

        .pagination {
                display: flex;
                justify-content: flex-end;
                margin-top: 1rem;
                align-items: center;
                
                span {
                    margin: 0 6px;
                }

                button {
                    padding: 4px 2px;
                }
            }
    }
</style>