<template>
    <div class="my-2 w-100">
        <div class="list-group-item d-flex gap-3 py-3" aria-current="true">
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">
                        {{ product.name }}
                        <small class="text-muted">{{ product.price_norm }} €</small>
                    </h6>
                    <p class="mb-0 text-muted">
                        {{ product.recipe }}
                    </p>
                </div>
                <small class="text-nowrap">
                    <i class="bi bi-plus-circle text-primary fs-5" role="button" @click="this.openPS()"
                        v-if="this.showAddButton"></i>
                </small>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: {
        product: Object,
        showAddButton: {
            type: Boolean,
            default: false
        },

    },
    data() {
        return {
            currentTab: null,
        }
    },
    methods: {
        openPS() {
            this.$emit('psOpened')
        },
        closePS() {
            this.$emit('psClosed')
        },
    }
}
</script>
(
