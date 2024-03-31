import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default function useContacts() {
    const contacts = ref([]);
    const errors = ref('');

    const currentPage = ref(1);
    const totalPages = ref(1);

    const router = useRouter();

    const getContacts = async (page = 1) => {
        try {
            const response = await axios.get(`/api/contato?page=${page}`);
            
            contacts.value = response.data.data;
            currentPage.value = response.data.current_page;
            totalPages.value = response.data.last_page;

            console.log(response.data);
            
        } catch (error) {
            errors.value = 'Ocorreu um erro ao buscar os contatos.';
            console.error(error);
        }
    }

    const createContact = async (contactData) => {
        try {
            const response = await axios.post('/api/contato/store', contactData);
            getContacts();
            console.log(contactData);
            return response.data;
        } catch (error) {
            errors.value = 'Ocorreu um erro ao criar o contato.';
            console.error(error);
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

    return { contacts, getContacts, createContact, currentPage, totalPages, nextPage, prevPage };
}
