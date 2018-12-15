<template>
    <div class="dashboard row">
        <summary-component class="col-lg-3"></summary-component>
        <settings-component class="col-lg-9"></settings-component>
        dashboard
    </div>
</template>

<script>
    import Summary from './summary'
    import Settings from './settings'
    export default {
        components: {
            'summary-component': Summary,
            'settings-component': Settings
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
