<template>
    <form>
        <div class="row">
            <!-- Client informations -->
            <div class="col-12">
                <h4 class="mb-3">Client informations</h4>

                <div class="row g-2 mb-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" v-model="clientInputs.firstname" id="firstname" class="form-control"
                                :class="{ 'border-danger': this.errors['client.firstname'] }"
                                placeholder="Your first name">
                            <label for="firstname" :class="{ 'text-danger': this.errors['client.firstname'] }">
                                First name
                                <span class="text-danger fw-bold">*</span>
                            </label>
                        </div>
                        <div class="form-text text-danger" v-if="this.errors['client.firstname']">
                            {{ this.errors['client.firstname'][0] }}
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" v-model="clientInputs.lastname" id="lastname" class="form-control"
                                :class="{ 'border-danger': this.errors['client.lastname'] }"
                                placeholder="Your last name">
                            <label for="lastname" class="form-label"
                                :class="{ 'text-danger': this.errors['client.lastname'] }">
                                Last name
                                <span class="text-danger fw-bold">*</span>
                            </label>
                        </div>
                        <div class="form-text text-danger" v-if="this.errors['client.lastname']">
                            {{ this.errors['client.lastname'][0] }}
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" class="form-control" v-model="clientInputs.email" id="email"
                                placeholder="you@example.com">
                            <label for="email" class="form-label"
                                :class="{ 'text-danger': this.errors['client.email'] }">
                                Email
                                <span class="text-muted">(Optional)</span>
                            </label>
                        </div>
                        <div class="form-text text-danger" v-if="this.errors['client.email']">
                            {{ this.errors['client.email'][0] }}
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" v-model="clientInputs.phone" id="phone" class="form-control"
                                :class="{ 'border-danger': this.errors['client.phone'] }"
                                placeholder="eg: 050 xx xx xx xx">
                            <label for="phone" class="form-label"
                                :class="{ 'text-danger': this.errors['client.phone'] }">
                                Phone
                                <span class="text-danger fw-bold">*</span>
                            </label>
                        </div>
                        <div class="form-text text-danger" v-if="this.errors['client.phone']">
                            {{ this.errors['client.phone'][0] }}
                        </div>
                    </div>
                </div>

                <h4 class="my-2" :class="{ 'text-danger': this.errors['order_type'] }">
                    Order type
                </h4>
                <order-configuration @orderTypeChanged="this.setOrderType" @clientPlaceChanged="this.setClientLocation"
                    :errors="this.errors" :checkoutForm="true" :showAddressInput="this.orderType == 'delivery'"
                    :showAutocompleteField="this.orderType == 'delivery'" :showDelivery="!!restaurant.delivery"
                    :showPickup="!!restaurant.pickup" :showOnTheSpot="!!restaurant.on_the_spot">
                </order-configuration>


                <hr class="my-4 d-block">
                <!-- Payment -->
                <div class="row g-3">
                    <div class="col-12">
                        <h4 class="mb-3" :class="{ 'text-danger': this.errors['payment_method'] }">Payment</h4>

                        <div class="my-3">
                            <span class="ps-radio-btn my-2" @click="this.setPaymentMethod('Online Banking')"
                                :class="{'active': this.isPaymentMethod('Online Banking')}">
                                <i class="las la-credit-card"></i>
                                Online Banking
                            </span>
                            <span class="ps-radio-btn" my-2 @click="this.setPaymentMethod('Credit / Debit card')"
                                :class="{'active': this.isPaymentMethod('Credit / Debit card')}">
                                <i class="las la-credit-card"></i>
                                Credit / Debit Card
                            </span>
                            <span class="ps-radio-btn my-2" @click="this.setPaymentMethod('Bank Card')"
                                :class="{'active': this.isPaymentMethod('Bank Card')}">
                                <i class="las la-credit-card"></i>
                                Bank Card (on delivery)
                            </span>
                            <span class="ps-radio-btn my-2" @click="this.setPaymentMethod('Cash')"
                                :class="{'active': this.isPaymentMethod('Cash')}">
                                <i class="las la-money-bill-wave"></i>
                                Cash (on delivery)
                            </span>
                            <div class="form-text text-danger" v-if="this.errors['client.firstname']">
                                {{ this.errors['payment_method'][0] }}
                            </div>
                        </div>

                        <!-- Card informations -->
                        <div class="row gy-3" v-if="paymentMethod == 'Credit / Debit Card'">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 d-block d-lg-none">
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4 d-none d-lg-block">
        <button class="w-100 btn btn-primary btn-lg text-white" type="submit"
            @click.prevent="(e) => this.checkout(e)">Submit</button>
    </form>
</template>

<script>
import { url } from '../../Helpers/main'
import { Autocomplete as GMapAutocomplete } from "@fawmi/vue-google-maps"
import OrderConfiguration from '../OrderConfiguration.vue'
export default {
    emits: ['checkoutSuccess'],
    props: {
        user: {
            type: [Object, null, String]
        },
        restaurant: {
            type: Object
        }
    },
    components: [GMapAutocomplete, OrderConfiguration],
    data() {
        return {
            clientInputs: {},
            clientLocation: {},
            orderType: null,
            paymentMethod: null,
            errors: [],
            showAddressInput: true,
        }
    },
    created() {
        this.getOrderType()
        this.loadClientInfo()
    },
    methods: {
        setClientLocation(data) {
            for (const key in data) {
                if (Object.hasOwnProperty.call(data, key)) {
                    const element = data[key];
                    this.clientLocation[key] = element
                }
            }
            this.clientInputs.location = this.clientLocation
        },
        setPaymentMethod(method) {
            this.paymentMethod = method
        },
        isPaymentMethod(method) {
            return this.paymentMethod == method
        },
        getExtraList(options) {
            return Object.keys(JSON.parse(JSON.stringify(options.extra))).join(', ')
        },
        async setOrderType(data) {
            this.orderType = data
            await axios.post(url('api/order-type'), {
                order_type: this.orderType
            }).then(result => { })
        },
        async getOrderType() {
            await axios.get(url('api/order-type')).then(result => {
                this.orderType = result.data
            })
        },
        // Reset all data
        reset() {
            this.clientInputs = {}
            this.orderType = null
            this.errors = []
        },
        loadClientInfo() {
            if (Object.entries(this.user).length) {
                for (const key in this.user) {
                    if (Object.hasOwnProperty.call(this.user, key)) {
                        this.clientInputs[key] = this.user[key]
                    }
                }
            }
        },
        async checkout(e) {
            e.target.disabled = true
            await axios.post(url('cart-checkout'), {
                order_type: this.orderType,
                client: this.clientInputs,
                payment_method: this.paymentMethod
            }).then(result => {
                if (result.data.payment_type == 'on delivery') {
                    this.onDelivery(result)
                }
                if (result.data.payment_type == 'stripe') {
                    this.stripe(result)
                }
                e.target.disabled = false
            }).catch(error => {
                e.target.disabled = false
                if (error.response.status == 422) {
                    this.$swal({
                        icon: 'error',
                        text: error.response.data.message,
                        toast: true,
                        position: 'bottom-right',
                        button: false,
                        showConfirmButton: false,
                        timer: 7000,
                    });
                    this.errors = error.response.data.errors
                } else {
                    console.error(error.response);
                }
            })

        },
        onDelivery(result) {
            if (result.data.success) {
                this.$swal({
                    icon: 'success',
                    text: result.data.message,
                    position: 'center',
                    showConfirmButton: true,
                }).then(result => {
                    if (result.isConfirmed) {
                        window.location.href = url(`restaurants/${this.restaurant.id}`)
                        this.reset()
                        this.$emit('checkoutSuccess')
                    }
                });
            } else {
                this.$swal({
                    icon: 'error',
                    text: result.data.message,
                    position: 'center',
                });
            }
        },
        stripe(result) {
            if (result.data.success) {
                window.location.href = result.data.url_redirection
            } else {
                this.$swal({
                    icon: 'error',
                    text: result.data.message,
                    position: 'center',
                });
            }
        }
    }
}
</script>
