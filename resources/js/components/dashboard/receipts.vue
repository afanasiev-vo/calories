<template>
    <div class="receipts">
        <button @click="showCreateForm = true">Add receipt</button>
        <modal-base
            v-if="showCreateForm"
            :action-confirm="true"
            :label-confirm="'Save receipt'"
            @onConfirm="saveReceipt"
            @onClose="onCreateFormClose"
        >
            <template slot="header">Create new receipt</template>
            <template slot="content">
                <div class="createReceipt">
                    <text-input
                        v-model="receipt.name"
                        name="receipt_name"
                        :label="'Название рецепта'">
                    </text-input>

                    <image-upload @uploaded="onUpload"></image-upload>

                    <text-area-input
                        label="Короткое описание рецепта"
                        v-model="receipt.description"
                        name="receipt_description"
                    ></text-area-input>

                    <text-area-input
                        label="Полное описание рецепта"
                        v-model="receipt.receipt"
                        name="receipt_body"
                    ></text-area-input>
                    Total: calories: {{ total.calories }} | proteins: {{ total.proteins }} | carbohydrates: {{ total.carbohydrates }} | fats: {{ total.fats }} | gi: {{ total.gi }}
                    <ul>
                        <li v-for="ingredient in receipt.ingredients">
                            {{ ingredient.data.name }} - {{ ingredient.weight }} [x]
                        </li>
                    </ul>
                    <div class="form-group">
                        <div class="row">
                            <select name="" class="form-control col-8" v-model="ingredient.data">
                                <option value="0">Select ingredient</option>
                                <option v-for="ingredient in ingredientsList" :value="ingredient">{{ ingredient.name }} - {{ ingredient.state }}</option>
                            </select>
                            <input type="number" class="form-control col-2" v-model="ingredient.weight">
                            <input type="button" value="+" class="form-control col-2" @click="addIngredient">
                        </div>
                    </div>
                </div>
            </template>
        </modal-base>
    </div>
</template>

<script>
    import ModalBase from './../modals/base'
    import TextInput from './../formComponents/TextInput'
    import ImageUpload from '../formComponents/ImageUpload'
    import TextAreaInput from '../formComponents/TextAreaInput'
    export default {
        name: "receipts",
        components: {
            ModalBase,
            TextInput,
            ImageUpload,
            TextAreaInput
        },
        data () {
            return {
                showCreateForm: false,
                receipt: {
                    name: '',
                    thumbnail: '',
                    description: '',
                    ingredients: []
                },
                ingredient: {
                    data: '',
                    weight: 0
                },
                ingredientsList: [],
                total: {
                    calories: 0,
                    fats: 0,
                    carbohydrates: 0,
                    proteins: 0,
                    gi: 0
                }
            }
        },
        methods: {
            saveReceipt () {
                console.log('saveReceipt', { receipt: this.receipt })
            },
            onCreateFormClose () {
                this.setDefaultFormField()
                this.showCreateForm = false
                console.log('close')
            },
            setDefaultFormField () {
                this.receipt.name = ''
                this.receipt.description = ''
                // @TODO Удалить изображение с сервера
                this.receipt.thumbnail = ''
            },
            onUpload (path) {
                this.receipt.thumbnail = path
            },
            addIngredient () {
                this.receipt.ingredients.push({
                    data: this.ingredient.data,
                    weight: parseFloat(this.ingredient.weight)
                })

                this.total.calories = Math.round(Number(this.total.calories) * 100 +
                    Number(this.ingredient.data.calories) * Number(this.ingredient.weight)) / 100

                this.total.fats = Math.round(Number(this.total.fats) * 100 +
                    Number(this.ingredient.data.fats) * Number(this.ingredient.weight)) / 100

                this.total.carbohydrates = Math.round(Number(this.total.carbohydrates) * 100 +
                    Number(this.ingredient.data.carbohydrates) * Number(this.ingredient.weight)) / 100

                this.total.proteins = Math.round(Number(this.total.proteins) * 100 +
                    Number(this.ingredient.data.proteins) * Number(this.ingredient.weight)) / 100

                this.total.gi = Math.round(Number(this.total.gi) * 100 +
                    Number(this.ingredient.data.gi) * Number(this.ingredient.weight)) / 100

                this.ingredient.id = 0
                this.ingredient.weight = 0
            },
            async getIngredients () {
                const result = await axios.get('/ingredient')
                this.ingredientsList = result.data.data
            }
        },
        mounted () {
            this.getIngredients()
        }
    }
</script>

<style scoped>

</style>
