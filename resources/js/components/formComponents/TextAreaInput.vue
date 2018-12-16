<template>
    <div :class="wrapperClass">
        <label :for="name" v-html="label"></label>
        <textarea
            :class="inputClass"
            :id="name"
            type="text"
            v-bind:value="value"
            v-on:input="$emit('input', $event.target.value)"
        ></textarea>
    </div>
</template>

<script>
    export default {
        name: "TextAreaInput",
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
