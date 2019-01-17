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
        ingredientList (Найдено {{ total }} ингредиентов)
        <div>
            <button @click="getIngredients(first_page_url)"> <<< в начало </button>
            <button @click="getIngredients(prev_page_url)"> << prev </button>
            current page: {{ current_page }}
            <button @click="getIngredients(next_page_url)"> next >> </button>
            <button @click="getIngredients(last_page_url)"> в конец >>> </button>
        </div>

        <table id="ingredients">
            <tr>
                <th>name</th>
                <th>calories</th>
                <th>proteins</th>
                <th>fats</th>
                <th>carbohydrates</th>
                <th>thumbnail</th>
                <th></th>
            </tr>
            <tr v-for="ingredient in ingredients">
                <td>{{ ingredient.name }}</td>
                <td>{{ ingredient.calories }}</td>
                <td>{{ ingredient.proteins }}</td>
                <td>{{ ingredient.fats }}</td>
                <td>{{ ingredient.carbohydrates }}</td>
                <td><img :alt="ingredient.name" :src="ingredient.thumbnail"/></td>
                <td><button @click='remove(ingredient.id)'>Delete</button></td>
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
                test: '',
                next_page_url: null,
                prev_page_url: null,
                total: 0,
                first_page_url: null,
                last_page_url: null,
                current_page: 1
            }
        },
        methods: {
            async getIngredients(url) {
                const result = await axios.get( url ? url: '/ingredient')
                this.ingredients = result.data.data
                this.next_page_url = result.data.next_page_url
                this.prev_page_url = result.data.next_page_url
                this.first_page_url = result.data.first_page_url
                this.last_page_url = result.data.last_page_url
                this.current_page = result.data.current_page
                this.total = result.data.total
            },
            onUpload(path) {
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
                    this.clearForm()
                } catch (e) {
                    this.$notify({
                        group: 'dashboard',
                        type: 'error',
                        title: 'Error',
                        text: 'Your ingredient was not saved!'
                    });
                    console.error(e.message || e)
                }
            },
            async remove (id) {
                try {
                    await axios.delete(`/ingredient/${id}`);

                    this.$notify({
                        group: 'dashboard',
                        title: 'Ingredient removed!',
                        text: `Your ingredient ${id} was removed`
                    });
                    this.getIngredients();
                } catch (error) {
                    this.$notify({
                        group: 'dashboard',
                        type: 'error',
                        title: 'Error',
                        text: 'Your ingredient was not saved!'
                    });
                    console.error(e.message || e)
                }
            },
            clearForm() {
                this.ingredient_name = ''
                this.uploaded_thumbnail_url = ''
                this.ingredient_description = ''
                this.ingredient_status = 'ACTIVE'
                this.calories = ''
                this.proteins = ''
                this.fats = ''
                this.carbohydrates = ''
                this.gi = ''
            }
        },
        mounted() {
            this.getIngredients()

        }
    }
</script>

<style scoped>
    #ingredients {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #ingredients td, #ingredients th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #ingredients tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #ingredients tr:hover {
        background-color: #ddd;
    }

    #ingredients th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }

</style>
