<template>
    <div class="settings">
        <div class="tabs row">
            <div
                class="col-lg-4 item"
                :class="activeTab === 1 ? 'active' : '' "
                @click="activeTab = 1">
                Добавить прием пищи
            </div>
            <div
                class="col-lg-4 item"
                :class="activeTab === 2 ? 'active' : '' "
                @click="activeTab = 2">
                Добавить блюдо
            </div>
            <div
                class="col-lg-4 item"
                :class="activeTab === 3 ? 'active' : '' "
                @click="activeTab = 3">
                Добавить ингредиент
            </div>
        </div>
        <div class="tab-content row">
            <div class="col-lg-12 item" v-if="activeTab === 1">
                <history></history>
            </div>
            <div class="col-lg-12 item" v-if="activeTab === 2">
                <receipts></receipts>
            </div>
            <div class="col-lg-12 item" v-if="activeTab === 3">
                <ingredients></ingredients>
            </div>
        </div>
    </div>
</template>

<script>
    import Ingredients from './ingredients';
    import Receipts from './receipts'
    import History from './history'

    export default {
        name: 'Settings',
        components: {
            Ingredients,
            Receipts,
            History
        },
        data() {
            return {
                activeTab: 1
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
