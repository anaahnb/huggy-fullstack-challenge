<template>
    <section>
        <h2>Contatos</h2>

        <div class="contact__list">
            <div class="contact__action">
                <input-component placeholder="Buscar contato" withIcon />
                <button-component type="primary" withIcon icon="add" text="Adicionar contato" />
            </div>
            <table>
                <th>
                    Nome
                    <south size=12 color="#505050" />
                </th>
                <th>Email</th>
                <th>Telefone</th>
            </table>
        </div>
    </section>
</template>

<script>

    import South from '/public/icons/South.vue'
    import ButtonComponent from '/resources/js/components/ButtonComponent.vue'
    import InputComponent from '/resources/js/components/InputComponent.vue'

    export default {
        components: {
            South,
            ButtonComponent,
            InputComponent
        }
    }

</script>

<style lang="scss" scoped>

    section {
        max-width: 58.125rem;
        margin: 0 auto;
        

        h2 {
            font-size: 1.25rem;
            font-weight: 500;
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
                padding: 1rem 1.5rem;
                width: 100%;
                border-bottom: 1px #E1E1E1 solid;

                th {
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
            }
        }
    }

</style>