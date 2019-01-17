<template>
    <div class="history">
        history
    </div>
</template>

<script>
    export default {
        name: "history",
        mounted() {
            axios.get('/eats')
                .then(result => {
                    console.log(result.data)
                })
                .catch(error => {
                    console.log('error', error)
                    console.error(error.message || error)
                    this.$notify({
                        group: 'dashboard',
                        type: error,
                        title: 'Ooops!',
                        text: error.message || error
                    });
                })
        }
    }
</script>

<style scoped>

</style>
