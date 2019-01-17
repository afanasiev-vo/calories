<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                receipts component
                <span v-for="rec in normalizedReceipt"> {{ rec.id }}</span>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'receipts-list',
        props: {
            receipt: {
                type: String
            }
        },
        computed: {
            normalizedReceipt: function () {
                return JSON.parse(this.receipt)
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
