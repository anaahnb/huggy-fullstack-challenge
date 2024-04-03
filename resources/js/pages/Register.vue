<template>
    <section>
        <div class="form__card">

            <div class="header">
                <h2> Criar conta </h2>
            </div>

            <form @submit.prevent="register"> 
                <input-component v-model="name" :typeStyle="getErrorType('name')" :errorMessage="getErrorMessage('name')" placeholder="Nome" label="Nome" />
                <input-component v-model="email" :typeStyle="getErrorType('email')" :errorMessage="getErrorMessage('email')" typeInput="email" placeholder="Email" label="Email" />
                <input-component v-model="password" :typeStyle="getErrorType('password')" :errorMessage="getErrorMessage('password')" typeInput="password" placeholder="Senha" label="Senha" />
                <input-component v-model="confirmPassword" typeInput="password" placeholder="Confirmar senha" label="Confirmação de senha" />
                
                <div class="button_group">
                    <button-component text="Registrar" />
                    <button-component type="secondary" text="Possui conta? Entre" @click="handleButtonRedirect"/>
                </div>
            </form>
        </div>
    </section>
</template>

<script>

    import InputComponent from '/resources/js/components/InputComponent.vue'
    import ButtonComponent from '/resources/js/components/ButtonComponent.vue'
    import useRegister from '/resources/js/composables/register.js';

    import { useRouter } from 'vue-router';


    export default {
        name: "RegisterPage",
        components: {
            InputComponent,
            ButtonComponent
        },
        setup() {
            const { name, email, password, confirmPassword, errors, register } = useRegister();
            const router = useRouter();

            const handleButtonRedirect = () => {
                router.push('/login'); 
            }

            const getErrorType = (field) => {
                return errors.value && errors.value[field] ? 'danger' : 'default';
            };

            const getErrorMessage = (field) => {
                if (errors.value && errors.value[field]) {
                    return errors.value[field][0];
                }
                return '';
            };

            return {
                name,
                email,
                password,
                confirmPassword,
                errors,
                register,
                handleButtonRedirect,
                getErrorType,
                getErrorMessage,
            }
        }
    }
</script>

<style lang="scss" scoped>
    
    section {
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: center;
        flex-wrap: wrap;
    
        height: 100vh;

        .header {
            border-bottom: 1px solid #E1E1E1;
        }
    }
    
    .form__card {
        background-color: white;
        border-radius: .75rem;
  
        border: 1px solid #E1E1E1;
        box-shadow: 0px 1px 2px 0px #00000026;

        .header, form { padding: 1.5rem; }

        .button_group {
            display: flex;
            gap: 1.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;

        }
    }
</style>
