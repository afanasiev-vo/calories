<template>
    <div class="ingredients">
        <button @click="showCreateForm = true">create</button>
        <div class="createIngredient" v-if="showCreateForm">
            <div>
                <label for="ingredient_name">ingredient_name</label>
                <input id='ingredient_name' type="text" v-model="ingredient_name">
            </div>
            <div>
                <div class="upload-btn-wrapper">
                    <button class="btn">Upload a file</button>
                    <input type="file" @change="onFileChanged" />
                </div>
                <img v-if='uploaded_thumbnail_url' :src="uploaded_thumbnail_url" alt="" width="100px">
            </div>
            <div>
                <label for="ingredient_status">ingredient_status</label>
                <select name="" id="ingredient_status" v-model="ingredient_status">
                    <option value="ACTIVE">active</option>
                    <option value="HOLD">hold</option>
                </select>
            </div>
            <div>
                <label for="ingredient_description">ingredient_description</label>
                <textarea id='ingredient_description' v-model="ingredient_description">
            </textarea>
            </div>
            <input type="button" value="save" @click="save">
        </div>
        ingredients
    </div>
</template>

<script>
    export default {
        name: "ingredients",
        data() {
            return {
                showCreateForm: false,
                ingredients: [],
                ingredient_name: '',
                ingredient_thumbnail: '',
                uploaded_thumbnail_url: '',
                ingredient_description: '',
                ingredient_status: ''
            }
        },
        methods: {
            async getIngredients() {
                const result = await axios.get('/ingredient')
                this.ingredients = result.data
                console.log(this.ingredients)
            },
            async onFileChanged (event) {
                this.ingredient_thumbnail = event.target.files[0]
                const formData = new FormData()
                formData.append('thumbnail', this.ingredient_thumbnail, this.ingredient_thumbnail.name)
                try {
                    const result = await axios.post('/file-upload', formData)
                    this.uploaded_thumbnail_url = result.data.url
                    console.log('this.uploaded_thumbnail_url', this.uploaded_thumbnail_url)
                } catch (e) {
                    console.error(e.message || e)
                }

            },
            async save() {
                try {
                    const result = await axios.post('/ingredient', {
                        name: this.ingredient_name,
                        thumbnail: this.uploaded_thumbnail_url,
                        description: this.ingredient_description,
                        status: this.ingredient_status
                    })
                    console.log(result)
                } catch (e) {
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