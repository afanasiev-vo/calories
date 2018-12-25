<template>
    <div class="modal-container">
        <div class="overlay" @click.self="onClose">
            <div class="content">
                <header>
                    <slot name="header"></slot>
                </header>
                <main>
                    <slot name="content"></slot>
                </main>
                <footer>
                    <slot name="footer">
                        <button v-if="actionConfirm" @click="onConfirm">{{ labelConfirm }}</button>
                        <button v-if="actionCancel" @click="onCancel">{{ labelCancel }}</button>
                    </slot>
                </footer>


            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModalBase",
        props: {
            actionConfirm: {
                type: Boolean,
                default: true,
            },
            actionCancel: {
                type: Boolean,
                default: false,
            },
            labelConfirm: {
                type: String,
                default: 'Ok',
            },
            labelCancel: {
                type: String,
                default: 'Cancel',
            }
        },
        methods: {
            onConfirm () {
                this.$emit('onConfirm')
            },
            onCancel () {
                this.$emit('onCancel')
            },
            onClose () {
                this.$emit('onClose')
            }
        }
    }
</script>

<style scoped lang="scss">
    .modal-container {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1050;
        overflow: hidden;
        outline: 0;
        .overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0 , 0, 0, 0.5);
            .content {
                background-color: #fff;
                margin: 10% auto;
                width: 600px;
                max-height: 400px;
                overflow-y: scroll;
            }
        }
    }
</style>
