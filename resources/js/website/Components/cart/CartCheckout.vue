<template>
    <form>
        <div class="row">
            <!-- Client informations -->
            <div class="col-12">
                <h4 class="mb-3">Client informations</h4>

                <!-- Personal informations -->
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
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

                    <div class="col-md-6">
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

                    <div class="col-md-6">
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

                    <div class="col-md-6">
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
                    :errors="this.errors" :checkoutForm="true" :showAddressInput="this.order_type == 'delivery'"
                    :showAutocompleteField="this.order_type == 'delivery'" :showDelivery="!!restaurant.delivery"
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
                            <div class="form-text text-danger" v-if="this.errors['payment_method']">
                                {{ this.errors['payment_method'][0] }}
                            </div>
                        </div>

                        <!-- Card informations -->
                        <div class="row gy-3" v-if="this.paymentMethod == 'Credit / Debit card'">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" v-model="this.cardInformations.cc_card" id="cc_card"
                                        class="form-control"
                                        :class="{ 'border-danger': this.errors['cc_informations.cc_card'] }">
                                    <label for="cc_card" class="form-label"
                                        :class="{ 'text-danger': this.errors['cc_informations.cc_card'] }">
                                        Name on card
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                </div>
                                <div class="form-text text-danger" v-if="this.errors['cc_informations.cc_card']">
                                    {{ this.errors['cc_informations.cc_card'][0] }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" v-model="this.cardInformations.cc_number" id="cc_number"
                                        class="form-control"
                                        :class="{ 'border-danger': this.errors['cc_informations.cc_number'] }">
                                    <label for="cc_number" class="form-label"
                                        :class="{ 'text-danger': this.errors['cc_informations.cc_number'] }">
                                        Credit card number
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                </div>
                                <div class="form-text text-danger" v-if="this.errors['cc_informations.cc_number']">
                                    {{ this.errors['cc_informations.cc_number'][0] }}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" v-model="this.cardInformations.cc_year" id="cc_year"
                                        class="form-control"
                                        :class="{ 'border-danger': this.errors['cc_informations.cc_year'] }">
                                    <label for="cc_year" class="form-label"
                                        :class="{ 'text-danger': this.errors['cc_informations.cc_year'] }">
                                        Year
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                </div>
                                <div class="form-text text-danger" v-if="this.errors['cc_informations.cc_year']">
                                    {{ this.errors['cc_informations.cc_year'][0] }}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select class="form-select" v-model="this.cardInformations.cc_month" id="cc_month"
                                        :class="{ 'border-danger': this.errors['cc_informations.cc_month'] }"
                                        aria-label="Select month">
                                        <option selected>Please choose a month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <label for="cc_month" class="form-label"
                                        :class="{ 'text-danger': this.errors['cc_informations.cc_month'] }">
                                        Month
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                </div>
                                <div class="form-text text-danger" v-if="this.errors['cc_informations.cc_month']">
                                    {{ this.errors['cc_informations.cc_month'][0] }}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" v-model="this.cardInformations.cc_cvc" id="cc_cvc"
                                        class="form-control"
                                        :class="{ 'border-danger': this.errors['cc_informations.cc_cvc'] }">
                                    <label for="cc_cvc" class="form-label"
                                        :class="{ 'text-danger': this.errors['cc_informations.cc_cvc'] }">
                                        CVC
                                        <span class="text-danger fw-bold">*</span>
                                    </label>
                                </div>
                                <div class="form-text text-danger" v-if="this.errors['cc_informations.cc_cvc']">
                                    {{ this.errors['cc_informations.cc_cvc'][0] }}
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
            order_type: null,
            paymentMethod: null,
            cardInformations: {},
            errors: [],
            showAddressInput: true,
        }
    },
    mounted() {
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
            this.order_type = data.order_type
            await axios.post(url('api/order-type'), {
                order_type: this.order_type
            }).then(result => {
                this.$emit('orderTypeChanged', {
                    order_type: this.order_type
                })
            })
        },
        async getOrderType() {
            await axios.get(url('api/order-type')).then(result => {
                this.order_type = result.data.order_type
                this.$emit('orderTypeChanged', {
                    order_type: this.order_type
                })
            })
        },
        // Reset all data
        reset() {
            this.clientInputs = {}
            this.order_type = null
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
            console.log(this.cardInformations);
            e.target.disabled = true
            await axios.post(url('cart-checkout'), {
                order_type: this.order_type,
                client: this.clientInputs,
                payment_method: this.paymentMethod,
                cc_informations: this.cardInformations
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
