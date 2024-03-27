<template>
    <section class="home__section">
        <h1>Login</h1>

        <button-component text="Fazer login com a Huggy" type="primary"></button-component>
    </section>
</template>

<script>
    import ButtonComponent from '/resources/js/components/ButtonComponent.vue'

    export default {
        components: {
            ButtonComponent
        }
    }
</script>

<style lang="scss" scoped>

    .home__section {
        background-color: #F8F8F8;
        height: 100vh;

        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

        h1 {
            font-size: 1.5rem;
            font-weight: 500;

        }
    }

</style>