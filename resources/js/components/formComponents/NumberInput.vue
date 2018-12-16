<template>
    <div :class="wrapperClass">
        <label :for="name" v-html="label"></label>
        <input
            :class="inputClass"
            :id="name"
            type="number"
            step="any"
            v-bind:value="value"
            v-on:input="$emit('input', $event.target.value)"
        >
    </div>
</template>

<script>
    export default {
        name: "NumberInput",
        props: {
            wrapperClass: {
                type: [String, Array],
                default: 'form-group'
            },
            value: {},
            inputClass: {
                type: [String, Array],
                default: 'form-control'
            },
            name: {
                type: String,
                required: true
            },
            label: String
        }
    }
</script>

<style scoped>

</style>
