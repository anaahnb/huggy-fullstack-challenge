<template>
    <div class="pagination">
        <button @click="prevPage" :class="{ disabled: currentPage === 1 }">&laquo;</button>
        <button v-for="page in totalPages" :key="page" @click="goToPage(page)"
            :class="{ active: currentPage === page || currentPage === totalPages && page === totalPages }">{{
            page }}
        </button>
        <button @click="nextPage" :class="{ disabled: currentPage === totalPages }">&raquo;</button>
    </div>
</template>

<script>
    export default {
        name: "PaginationComponent",
        props: {
            currentPage: {
                type: Number,
                required: true
            },
            totalPages: {
                type: Number,
                required: true
            },
            nextPage: {
                type: Function,
                required: true
            },
            prevPage: {
                type: Function,
                required: true
            }
        },
        methods: {
            goToPage(page) {
                if (page !== this.currentPage) {
                    this.$emit('change-page', page);
                }
            }
        }
    };
</script>

<style lang="scss" scoped>
    .pagination {
        display: inline-block;

        button {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;

            &.active {
                background-color: #321BDE;
                color: white;
                border: 1px solid #321BDE;
            }

            &.disabled {
                background-color: #E1E1E1;
                color: #757575;
                cursor: not-allowed;
                pointer-events: none;
            }

            &:hover:not(.active) {
                background-color: #ddd;
            }

            &:first-child {
                border-top-left-radius: 0.5rem;
                border-bottom-left-radius: 0.5rem;
            }

            &:last-child {
                border-top-right-radius: 0.5rem;
                border-bottom-right-radius: 0.5rem;
            }
        }
    }

</style>
