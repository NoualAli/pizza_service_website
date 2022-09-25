<template>
    <div class="my-2" v-if="showOrderTypes" :class="{'text-center': !checkoutForm}">
        <span class="ps-radio-btn reset my-2" v-if="order_type && !checkoutForm" @click="this.setOrderType(null)">
            <i class="las la-ban"></i>
        </span>
        <span class="ps-radio-btn my-2" @click="this.setOrderType('delivery')"
            :class="{'active': this.order_type == 'delivery'}">
            Delivery
        </span>
        <span class="ps-radio-btn my-2" @click="this.setOrderType('pickup')"
            :class="{'active': this.order_type == 'pickup'}">
            Pickup
        </span>
        <span class="ps-radio-btn my-2" @click="this.setOrderType('on_the_spot')"
            :class="{'active': this.order_type == 'on_the_spot'}">
            On the spot
        </span>
    </div>

    <div class="form-floating" v-if="showAutocompleteField">
        <GMapAutocomplete class="form-control rounded-0" placeholder="Find a place" id="street_address" region="fi"
            :options="this.getGMapOptions()" @place_changed="place => this.setPlace(place)"
            :value="this.location.street_address" />
        <label for="street_address">Enter your street adress</label>
    </div>
    <!-- Google Autofill inputs with location result -->
    <Transition name="fade">
        <div class="row g-3 mt-3" v-if="location.street_address && showAddressInput">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" placeholder="Street" class="form-control" id="street"
                        v-model="this.location.street" :class="{ 'border-danger': hasError('client.location.street') }"
                        @input="e => this.setLocation('street', e.target.value)" />
                    <label for="street" class="form-label"
                        :class="{ 'text-danger': hasError('client.location.street') }">Street</label>
                </div>
                <div class="form-text text-danger" v-if="hasError('client.location.street')">
                    {{ this.errors['client.location.street'][0] }}
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" placeholder="Entrance" class="form-control" id="entrance"
                        v-model="this.location.entrance"
                        :class="{ 'border-danger': hasError('client.location.entrance') }"
                        @input="e => this.setLocation('entrance', e.target.value)" />
                    <label for="entrance" class="form-label"
                        :class="{ 'text-danger': hasError('client.location.entrance') }">Entrance</label>
                </div>
                <div class="form-text text-danger" v-if="hasError('client.location.entrance')">
                    {{ this.errors['client.location.entrance'][0] }}
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" placeholder="Appartment number" class="form-control" id="appartment_number"
                        :v-model="this.location.appartment_number"
                        :class="{ 'border-danger': hasError('client.location.appartment_number') }"
                        @input="e => this.setLocation('appartment_number', e.target.value)" />
                    <label for="appartment_number" class="form-label"
                        :class="{ 'text-danger': hasError('client.location.appartment_number') }">Appartment
                        number</label>
                </div>
                <div class="form-text text-danger" v-if="hasError('client.location.appartment_number')">
                    {{ this.errors['client.location.appartment_number'][0] }}
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="number" placeholder="Postal code" class="form-control" id="postal_code"
                        v-model="this.location.postal_code"
                        :class="{ 'border-danger': hasError('client.location.postal_code') }"
                        @input="e => this.setLocation('postal_code', e.target.value)" />
                    <label for="postal_code" class="form-label"
                        :class="{ 'text-danger': hasError('client.location.postal_code') }">Postal code</label>
                </div>
                <div class="form-text text-danger" v-if="hasError('client.location.postal_code')">
                    {{ this.errors['client.location.postal_code'][0] }}
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" placeholder="City" class="form-control" id="city" v-model="this.location.city"
                        :class="{ 'border-danger': hasError('client.location.city') }"
                        @input="e => this.setLocation('city', e.target.value)" />
                    <label for="city" class="form-label"
                        :class="{ 'text-danger': hasError('client.location.city') }">City</label>
                </div>
                <div class="form-text text-danger" v-if="hasError('client.location.city')">
                    {{ this.errors['client.location.city'][0] }}
                </div>
            </div>
        </div>
    </Transition>
    <Transition name="fade">
        <small class="text-muted mt-3" v-if="totalResults !== null && showOrderTypes">
            {{ totalResults }} restaurants was found.
        </small>
    </Transition>
</template>

<script>
import { Autocomplete as GMapAutocomplete } from "@fawmi/vue-google-maps"
import { url } from '../Helpers/main'
export default {
    emits: ['orderTypeChanged', 'clientPlaceChanged'],
    props: {
        showAutocompleteField: {
            type: Boolean,
            default: true,
        },
        showAutoFilledInputs: {
            type: Boolean,
            default: false,
        },
        showAddressInput: {
            tyoe: Boolean,
            default: true
        },
        checkoutForm: {
            type: Boolean,
            default: false,
        },
        showOrderTypes: {
            default: true,
            type: Boolean
        },
        errors: {
            type: Object,
            default: null,
        }
    },
    components: { GMapAutocomplete },
    data() {
        return {
            location: {
                street_address: null,
                street: null,
                entrance: null,
                appartment_number: null,
                postal_code: null,
                city: null,

                latitude: null,
                longitude: null,
            },
            addressComponets: {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                postal_code: 'short_name'
            },
            order_type: null,
            totalResults: null
        }
    },
    mounted() {
        this.getPlace()
        this.getOrderType()
    },
    methods: {
        hasError(key) {
            return Object.hasOwnProperty.call(this.errors, key)
        },
        setLocation(key, value) {
            console.log(value);
            this.location[key] = value
            this.$emit('clientPlaceChanged', this.location)
        },
        getGMapOptions() {
            return {
                componentRestrictions: { country: "fi" },
                fields: ['name', 'vicinity', 'geometry', 'address_components'],
                strictBounds: false,
            }
        },
        getPlaceDetails(place) {
            for (const key in this.location) {
                if (Object.hasOwnProperty.call(this.location, key)) {
                    this.location[key] = null
                }
            }

            if (Object.hasOwnProperty.call(place, 'address_components')) {
                const { route: street, street_number: entrance, postal_code, locality: city } = this.addressComponetsToObject(place.address_components)

                this.location.street = street
                this.location.entrance = entrance
                this.location.postal_code = postal_code
                this.location.city = city
            }
        },
        addressComponetsToObject(address_components) {
            let location = []
            for (var i = 0; i < address_components.length; i++) {
                var addressType = address_components[i].types[0];
                if (this.addressComponets[addressType]) {
                    location[addressType] = address_components[i][this.addressComponets[addressType]];
                }
            }
            return location
        },
        async getPlace() {
            await axios.get(url('api/client-location')).then(result => {
                for (const key in result.data) {
                    if (Object.hasOwnProperty.call(result.data, key)) {
                        this.location[key] = result.data[key];
                    }
                }
                if (this.location.street_address) {
                    this.$emit('clientPlaceChanged', this.location)
                }
            })
        },
        async setPlace(place) {
            this.getPlaceDetails(place)
            if (Object.hasOwnProperty.call(place, 'address_components')) {
                const street_address = `${place.name}, ${place.vicinity}`
                this.location.street_address = street_address
                this.location.longitude = place.geometry.location.lng()
                this.location.latitude = place.geometry.location.lat()
                await axios.post(url('api/client-location'), {
                    location: this.location
                }).then(result => {
                    this.totalResults = result.data
                    this.$emit('clientPlaceChanged', this.location)
                })
            }
        },
        async setOrderType(type) {
            this.order_type = type
            await axios.post(url('api/order-type'), {
                order_type: this.order_type
            }).then(result => {
                this.$emit('orderTypeChanged', this.order_type)
            })
        },
        async getOrderType() {
            await axios.get(url('api/order-type')).then(result => {
                this.order_type = result.data
            })
        },
    }

}
</script>
