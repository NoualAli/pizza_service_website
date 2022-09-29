<template>
    <div class="container mb-5 text-center d-lg-block d-flex flex-column">
        <span class="ps-radio-btn reset my-2" v-if="currentCategory" @click="this.clearCategory">
            <i class="las la-ban"></i>
        </span>
        <span class="ps-radio-btn my-2" :class="{'active': currentCategory?.id == category.id}"
            v-for="category in categories" :key="category.id" @click="this.setCategory(category)">
            {{ category.name }}
        </span>
    </div>

</template>

<script>
import { url } from '../Helpers/main'
export default {
    data() {
        return {
            categories: {},
            currentCategory: null,
        }
    },
    mounted() {
        this.fetchCategories()
    },
    methods: {
        async fetchCategories() {
            await axios.get(url('api/categories')).then(result => {
                this.categories = result.data.categories
            })
        },
        clearCategory() {
            this.currentCategory = null
            this.$emit('categoryCleared')
        },
        setCategory(category) {
            this.currentCategory = category
            this.$emit('categoryChanged', {
                category: this.currentCategory
            })
        }
    }
}
</script>
