<template>
    <section>
        <div class="form__card">

            <div class="header">
                <h2> Criar conta </h2>
            </div>

            <form action=""> 
                <input-component placeholder="Nome" label="Nome" />
                <input-component placeholder="Email" label="Email" />
                <input-component type="password" placeholder="Senha" label="Senha" />
                <input-component type="password" placeholder="Confirmar senha" label="Confirmação de senha" />

                <div class="button_group">
                    <button-component text="Registrar" />
                    <button-component type="secondary" text="Possui conta? Entre" />
                </div>
            </form>
        </div>
    </section>
</template>

<script>

    import InputComponent from '/resources/js/components/InputComponent.vue'
    import ButtonComponent from '/resources/js/components/ButtonComponent.vue'


    export default {
        name: "LoginPage",
        components: {
            InputComponent,
            ButtonComponent
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