<template>
    <div :class="wrapperClass">
        <div class="upload-btn-wrapper">
            <button class="btn">Upload a Thumbnail</button>
            <input  type="file" @change="onFileChanged" />
        </div>
        <img v-if='uploaded_thumbnail_url' :src="uploaded_thumbnail_url" alt="" width="100px">
    </div>
</template>

<script>
    export default {
        name: "ImageUpload",
        props: {
            wrapperClass: {
                type: [String, Array],
                default: 'form-group'
            },
        },
        data () {
            return {
                uploaded_thumbnail_url: '',
            }
        },
        methods: {
            async onFileChanged (event) {
                const thumbnail = event.target.files[0]
                const formData = new FormData()
                formData.append('thumbnail', thumbnail, thumbnail.name)
                try {
                    const result = await axios.post('/file-upload', formData)
                    this.uploaded_thumbnail_url = result.data.url
                    this.$emit('uploaded', this.uploaded_thumbnail_url)
                } catch (e) {
                    console.error(e.message || e)
                }
            },
        }
    }
</script>

<style scoped>

</style>
