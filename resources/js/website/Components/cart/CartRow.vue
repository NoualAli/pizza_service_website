<template>
    <div class="d-flex w-100 justify-content-between align-items-center">
        <div class="d-flex justify-content-between align-items-center flex-grow-1">
            <b>{{ item.quantity }} x {{ item.title }}</b>
            <b>{{ item.total_price }} €</b>
        </div>
        <div>
            <span class="mx-1">
                |
            </span>
            <i class="bi bi-trash text-danger fs-5" role="button" @click="this.removeFromCart(item)">
            </i>
            <span class="mx-1" v-if="rowUpdate">
                |
            </span>
            <i class="bi bi-pencil text-dark fs-5" role="button" @click="this.openPS()" v-if="rowUpdate"></i>
        </div>
    </div>
    <p class="m-0">
        <small>{{ item.options.size }}</small>
    </p>
    <p class="m-0" v-for="(price, name) in item.options.extras" :key="name">
        <small class="text-muted">
            + {{ name }} {{ price }} €
        </small>
    </p>
</template>

<script>
import {url} from '../../Helpers/main'

export default {
    emits: ['itemDeleted', 'itemUpdated', 'psOpened'],
    props: {
        item: Object,
        rowUpdate: Boolean
    },
    data() {
        return {
            currentProduct: {}
        }
    },
    methods: {
            openPS() {
                this.fetchProduct()
            },
            async fetchProduct(){
                axios.get(url(`api/products/${this.item.id}`)).then(result => {
                        this.$emit('psOpened', {
                        product: result.data,
                        item: this.item
                    })
                })
            },
            async removeFromCart(item) {
                    await this.$swal({
                        icon: 'error',
                        html: '<p>Are you sure you want to remove <b>' + item.title + ' ?</b></p>',
                        customClass: {
                            confirmButton: 'btn btn-success mx-1',
                            cancelButton: 'btn btn-danger mx-1'
                        },
                        buttonsStyling: false,
                        confirmButtonText: 'Yes, remove it!',
                        cancelButtonText: 'No, cancel!',
                        showCancelButton: true,
                    }).then(result => {
                        if (result.isConfirmed) {
                            axios.delete(url('api/cart?product=' + item.hash)).then(result => {
                                this.$emit('itemDeleted')
                                this.$swal({
                                    icon: 'success',
                                    text: result.data.message,
                                    toast: true,
                                    position: 'bottom-right',
                                    button: false,
                                    showConfirmButton: false,
                                    timer: 7000,
                                });
                            })
                        }
                    })
                },
            async updateCartItem(data) {
                console.log(JSON.stringify(data));
                this.psActive = false
                await axios.put(url('api/cart'), {
                    'item_hash': this.item.hash,
                    'settings': JSON.stringify(data.settings),
                    'quantity': data.quantity,
                    'additional_informations': data.additionalInformations
                }).then(result => {
                    this.$emit('itemUpdated')
                    this.$swal({
                        icon: 'success',
                        text: result.data.message,
                        toast: true,
                        position: 'bottom-right',
                        button: false,
                        showConfirmButton: false,
                        timer: 7000,
                    });
                    this.$emit('cartUpdated');
                }).catch(error => {
                    console.error(error.response);
                })
            }
        }
}
</script>
