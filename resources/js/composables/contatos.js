import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default function useContacts() {
    const contacts = ref([]);
    const errors = ref('');
    const router = useRouter();

    const getContacts = async () => {
        try {
            const response = await axios.get('/api/contato');
            contacts.value = response.data.data;
            console.log(contacts.value);
            
        } catch (error) {
            errors.value = 'Ocorreu um erro ao buscar os contatos.';
            console.error(error);
        }
    }

    return {
        errors,
        contacts,
        showConfirmModal,
        getContacts,
    }
}
