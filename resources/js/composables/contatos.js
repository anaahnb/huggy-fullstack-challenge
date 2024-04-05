import { ref } from 'vue';
import axios from 'axios';

export default function useContacts() {
    const contacts = ref([]);
    const errors = ref({});

    const currentPage = ref(1);
    const totalPages = ref(1);

    const getContacts = async (page = 1) => {
        try {
            const response = await axios.get(`/api/contato?page=${page}`);
            
            contacts.value = response.data.data;
            currentPage.value = response.data.current_page;
            totalPages.value = response.data.last_page;
                    
        } catch (error) {
            errors.value = 'Ocorreu um erro ao buscar os contatos.';
            console.error(error);
        }
    }

    const createContact = async (newContact) => {
        try {
            const formData = new FormData();
            for (const key in newContact) {
                formData.append(key, newContact[key]);
            }

            console.log('formdata', formData);
    
            const response = await axios.post('/api/contato/store', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
    
            if (response.status === 201) {

                getContacts();
                return true;
            }
        } catch (error) {
            if (error.response) {
                console.error('Erro ao criar contato:', error.response.data);
                errors.value = error.response.data;
            }
             else {
                console.error('Erro ao criar contato:', error.message);
                errors.value = { message: 'Ocorreu um erro ao criar o contato.' };
            }
            return false;
        }        
    };

    const updateContact = async (contact) => {
        try {
            const formData = new FormData();
            for (const key in contact) {
                formData.append(key, contact[key]);
            }
            const response = await axios.post(`/api/contato/update/${contact.contato_id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
    
            if (response.status === 200) {
                getContacts();
                return true;
            }
        } catch (error) {
            if (error.response) {
                console.error('Erro ao atualizar contato:', error.response.data);
                errors.value = error.response.data;
            } else {
                console.error('Erro ao atualizar contato:', error.message);
                errors.value = { message: 'Ocorreu um erro ao atualizar o contato.' };
            }
            return false;
        }
    };

    const deleteContact = async (contactId) => {
        try {
            await axios.delete(`/api/contato/delete/${contactId}`);
            getContacts(); 
            return true; 
        } catch (error) {
            console.error(error);
            errors.value = { message: 'Ocorreu um erro ao excluir o contato.' };
            return false;
        }
    }; 
    
    function nextPage() {
        if (currentPage.value < totalPages.value) {
            getContacts(currentPage.value + 1);
        }
    }

    function prevPage() {
        if (currentPage.value > 1) {
            getContacts(currentPage.value - 1);
        }
    }

    return { contacts, getContacts, createContact, updateContact, deleteContact, currentPage, totalPages, nextPage, prevPage, errors };
}
