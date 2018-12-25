<template>
    <div class="ingredients">
        <button @click="showCreateForm = true">create</button>
        <div class="createIngredient" v-if="showCreateForm">
            <text-input
                v-model="ingredient_name"
                :name="ingredient_name"
                :label="'Название ингредиента'">
            </text-input>

            <image-upload @uploaded="onUpload"></image-upload>

            <drop-down v-model="state" name="state" label="Готовность ингредиента"></drop-down>

            <text-area-input :label="'Описание Ингредиента'" v-model="ingredient_description"></text-area-input>

            <number-input :label="'Калл / 100г'" v-model="calories"></number-input>
            <number-input :label="'Белки / 100г'" v-model="proteins"></number-input>
            <number-input :label="'Жиры / 100г'" v-model="fats"></number-input>
            <number-input :label="'Углеводы / 100г'" v-model="carbohydrates"></number-input>
            <number-input :label="'Гликемический индекс'" v-model="gi"></number-input>
            <input type="button" value="save" @click="save">
        </div>
        ingredientList
        <table>
            <tr>
                <td>name</td>
                <td>calories</td>
                <td>proteins</td>
                <td>fats</td>
                <td>carbohydrates</td>
                <td>thumbnail</td>
            </tr>
            <tr v-for="ingredient in ingredients">
                <td>{{ ingredient.name }}</td>
                <td>{{ ingredient.calories }}</td>
                <td>{{ ingredient.proteins }}</td>
                <td>{{ ingredient.fats }}</td>
                <td>{{ ingredient.carbohydrates }}</td>
                <td><img :alt="ingredient.name" :src="ingredient.thumbnail" /></td>
            </tr>
        </table>
    </div>
</template>

<script>
    import TextInput from '../formComponents/TextInput'
    import TextAreaInput from '../formComponents/TextAreaInput'
    import NumberInput from '../formComponents/NumberInput'
    import DropDown from '../formComponents/DropDown'
    import ImageUpload from '../formComponents/ImageUpload'
    export default {
        name: "ingredients",
        components: {
            TextInput,
            ImageUpload,
            TextAreaInput,
            NumberInput,
            DropDown
        },
        data() {
            return {
                showCreateForm: false,
                ingredients: [],
                ingredient_name: '',
                uploaded_thumbnail_url: '',
                ingredient_description: '',
                ingredient_status: 'ACTIVE',
                state: 1,
                calories: 0,
                proteins: 0,
                fats: 0,
                carbohydrates: 0,
                gi: 0,
                test: ''
            }
        },
        methods: {
            async getIngredients() {
                const result = await axios.get('/ingredient')
                this.ingredients = result.data.data
            },
            onUpload (path) {
                this.uploaded_thumbnail_url = path
            },
            async save() {
                try {
                    const result = await axios.post('/ingredient', {
                        name: this.ingredient_name,
                        thumbnail: this.uploaded_thumbnail_url,
                        description: this.ingredient_description,
                        status: this.ingredient_status,
                        state: 1,
                        calories: this.calories,
                        proteins: this.proteins,
                        fats: this.fats,
                        carbohydrates: this.carbohydrates,
                        gi: this.gi,
                    })
                    console.log(result)
                    this.$notify({
                        group: 'dashboard',
                        title: 'Ingredient saved!',
                        text: 'Your ingredient was saved'
                    });
                    this.showCreateForm = false;
                    this.getIngredients();
                } catch (e) {
                    this.$notify({
                        group: 'dashboard',
                        type: 'error',
                        title: 'Error',
                        text: 'Your ingredient was not saved!'
                    });
                    console.error(e.message || e)
                }
            }
        },
        mounted() {
            this.getIngredients()

        }
    }
</script>

<style scoped>

</style>
