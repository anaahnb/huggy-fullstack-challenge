import { ref } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toastification';
import { useRouter } from 'vue-router';

export default function useLogin() {
    const email = ref('');
    const password = ref('');
    const errors = ref({});
    const router = useRouter();
    const toast = useToast();


    const login = async () => {
        try {
            const response = await axios.post('/api/login', {
                email: email.value,
                password: password.value
            });
            localStorage.setItem('token', response.data.token);
            router.push('/contatos');
        } catch (err) {
            if (err.response.status === 422) {
                errors.value = err.response.data.errors;
            } else {
                console.log(err.response.data.errors.email);
                toast.error('Usuário ou senha inválido');
                errors.value._general = 'Erro inesperado. Por favor, tente novamente mais tarde.';
            }
        }
    };

    return {
        email,
        password,
        errors,
        login,
    };
}
