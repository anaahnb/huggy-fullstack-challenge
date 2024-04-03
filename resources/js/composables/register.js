import { ref } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toastification';
import { useRouter } from 'vue-router';

export default function useRegister() {
    const name = ref('');
    const email = ref('');
    const password = ref('');
    const confirmPassword = ref('');
    const errors = ref({});
    const router = useRouter();
    const toast = useToast();

    const register = async () => {
        try {
            const response = await axios.post('/api/register', {
                name: name.value,
                email: email.value,
                password: password.value,
                password_confirmation: confirmPassword.value
            });
            toast.success('Registro realizado com sucesso!');
            router.push('/contatos');
        } catch (err) {
            if (err.response.status === 422) {
                errors.value = err.response.data.errors;
            } else {
                toast.error('Erro inesperado. Por favor, tente novamente mais tarde.');
            }
        }
    };

    return {
        name,
        email,
        password,
        confirmPassword,
        errors,
        register,
    };
}
