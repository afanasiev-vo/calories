<template>
    <div :class="wrapperClass">
        <label :for="name" v-html="label"></label>
        <select
            :class="inputClass"
            :id="name"
            type="text"
            v-bind:value="value"
            v-on:input="$emit('input', $event.target.value)"
        >
            <option value="1">raw</option>
            <option value="2">boiled</option>
            <option value="3">fried</option>
            <option value="4">steamed</option>
        </select>
    </div>
</template>

<script>
    // @TODO добавить массив выпадающих элементов через пропсы
    export default {
        name: "DropDown",
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
