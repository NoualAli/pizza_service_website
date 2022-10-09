<template>
    <div class="my-2" v-if="showOrderTypes" :class="{'text-center': !checkoutForm}">
        <span class="ps-radio-btn reset my-2" v-if="order_type && !checkoutForm" @click="this.setOrderType(null)">
            <i class="las la-ban"></i>
        </span>
        <span v-if="showDelivery || this.order_type == 'delivery'" class="ps-radio-btn my-2"
            @click="this.setOrderType('delivery')" :class="{'active': this.order_type == 'delivery'}">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" viewBox="0 0 406.783 406.783" style="enable-background:new 0 0 406.783 406.783;"
                xml:space="preserve">
                <g>
                    <g>
                        <path d="M127.12,256.572c-19.742,0-35.741,15.993-35.741,35.737c0,19.745,15.999,35.738,35.741,35.738
			c19.749,0,35.744-15.993,35.744-35.738C162.864,272.565,146.869,256.572,127.12,256.572z M127.12,307.846
			c-8.582,0-15.536-6.955-15.536-15.537c0-8.586,6.954-15.537,15.536-15.537c8.583,0,15.542,6.951,15.542,15.537
			C142.662,300.891,135.703,307.846,127.12,307.846z" />
                        <path d="M315.588,256.572c-19.742,0-35.74,15.993-35.74,35.737c0,19.745,15.998,35.738,35.74,35.738
			c19.75,0,35.744-15.993,35.744-35.738C351.332,272.565,335.338,256.572,315.588,256.572z M315.588,307.846
			c-8.582,0-15.535-6.955-15.535-15.537c0-8.586,6.953-15.537,15.535-15.537c8.584,0,15.543,6.951,15.543,15.537
			C331.131,300.891,324.172,307.846,315.588,307.846z" />
                        <path d="M167.329,146.759c0,5.008-4.098,9.105-9.105,9.105H32.579c-5.008,0-9.104-4.097-9.104-9.105v-5.463
			c0-5.007,4.097-9.104,9.104-9.104h125.645c5.008,0,9.105,4.097,9.105,9.104V146.759z" />
                        <path d="M385.623,200.066c-13.105-3.407-20.604-5.549-25.75-15.487l-17.207-34.839c-5.148-9.938-18.518-18.07-29.707-18.07
			h-23.535c0,0-3.166,0.066-3.166-3.12c0-7.305,0-29.219,0-29.219c0-11.327-6.41-20.595-20.045-20.595H74.405
			c-19.521,0-28.789,9.269-28.789,20.595v18.311c0,0,0,5.446,5.271,5.446c26.834,0,107.337,0,107.337,0
			c10.041,0,18.21,8.168,18.21,18.209v5.463c0,10.041-8.169,18.209-18.21,18.209H50.887c0,0-5.271-0.438-5.271,5.252
			c0,2.826,0,4.723,0,6.297c0,5.008,6.864,5.005,6.864,5.005h72.254c10.041,0,18.21,8.169,18.21,18.209v5.463
			c0,10.041-8.169,18.209-18.21,18.209H53.62c0,0-8.004-0.148-8.004,6.225c0,11.062,0,44.246,0,44.246
			c0,11.326,9.268,20.595,20.595,20.595c0,0,8.532,0,11.376,0c2.58,0,2.96-1.437,2.96-2.159c0-25.679,20.894-46.568,46.574-46.568
			c25.682,0,46.575,20.891,46.575,46.568c0,0.725-0.206,2.159,1.767,2.159c22.55,0,91.806,0,91.806,0
			c1.82,0,1.746-1.534,1.746-2.159c0-25.679,20.893-46.568,46.574-46.568s46.574,20.891,46.574,46.568
			c0,0.725-0.018,2.159,1.121,2.159c10.34,0,23.146,0,23.146,0c11.195,0,20.352-9.157,20.352-20.351v-38.664
			C406.783,202.894,396.502,202.894,385.623,200.066z M346.896,198.255c0,0-43.219,0-57.928,0c-2.393,0-2.711-2.33-2.711-2.33
			V147.67c0,0-0.135-1.853,2.938-1.853c4.133,0,16.529,0,16.529,0c9.959,0,21.855,7.236,26.434,16.079l15.312,31
			c0.645,1.248,1.334,2.356,2.072,3.349C350.086,196.973,349.174,198.255,346.896,198.255z" />
                        <path d="M133.838,205.195c0,5.008-4.097,9.105-9.104,9.105H9.104C4.096,214.3,0,210.203,0,205.195v-5.463
			c0-5.007,4.097-9.104,9.104-9.104h115.63c5.008,0,9.104,4.097,9.104,9.104V205.195z" />
                    </g>
                </g>
            </svg>
            Delivery
        </span>
        <span v-if="showPickup" class="ps-radio-btn my-2" @click="this.setOrderType('pickup')"
            :class="{'active': this.order_type == 'pickup'}">
            <svg viewBox="-96 0 512 512" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M208 96c26.5 0 48-21.5 48-48S234.5 0 208 0s-48 21.5-48 48 21.5 48 48 48zm94.5 149.1l-23.3-11.8-9.7-29.4c-14.7-44.6-55.7-75.8-102.2-75.9-36-.1-55.9 10.1-93.3 25.2-21.6 8.7-39.3 25.2-49.7 46.2L17.6 213c-7.8 15.8-1.5 35 14.2 42.9 15.6 7.9 34.6 1.5 42.5-14.3L81 228c3.5-7 9.3-12.5 16.5-15.4l26.8-10.8-15.2 60.7c-5.2 20.8.4 42.9 14.9 58.8l59.9 65.4c7.2 7.9 12.3 17.4 14.9 27.7l18.3 73.3c4.3 17.1 21.7 27.6 38.8 23.3 17.1-4.3 27.6-21.7 23.3-38.8l-22.2-89c-2.6-10.3-7.7-19.9-14.9-27.7l-45.5-49.7 17.2-68.7 5.5 16.5c5.3 16.1 16.7 29.4 31.7 37l23.3 11.8c15.6 7.9 34.6 1.5 42.5-14.3 7.7-15.7 1.4-35.1-14.3-43zM73.6 385.8c-3.2 8.1-8 15.4-14.2 21.5l-50 50.1c-12.5 12.5-12.5 32.8 0 45.3s32.7 12.5 45.2 0l59.4-59.4c6.1-6.1 10.9-13.4 14.2-21.5l13.5-33.8c-55.3-60.3-38.7-41.8-47.4-53.7l-20.7 51.5z" />
            </svg>
            Pickup
        </span>
        <span v-if="showOnTheSpot" class="ps-radio-btn my-2" @click="this.setOrderType('on_the_spot')"
            :class="{'active': this.order_type == 'on_the_spot'}">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 298.748 298.748"
                style="enable-background:new 0 0 298.748 298.748;" xml:space="preserve">
                <g id="XMLID_1429_">
                    <g>
                        <g>
                            <path d="M89.486,99.966l5.118,2.999l10.451-6.427c1.463-0.9,2.999-1.573,4.57-2.038l-12.606-7.387
				c-3.552-2.081-8.113-0.889-10.193,2.661C84.746,93.323,85.937,97.887,89.486,99.966z" />
                            <path d="M194.008,187.239c5.392,0,9.764-4.372,9.764-9.764c0-5.393-4.372-9.764-9.764-9.764H99.344
				c-5.393,0-9.764,4.372-9.764,9.764c0,5.393,4.372,9.764,9.764,9.764h39.885v46.522h-7.948c-4.113,0-7.447,3.334-7.447,7.447
				c0,4.113,3.334,7.447,7.447,7.447h30.791c4.113,0,7.447-3.334,7.447-7.447c0-4.113-3.334-7.447-7.447-7.447h-7.949v-46.522
				H194.008z" />
                            <path d="M80.72,177.226c-1.169-3.279-3.799-5.825-7.112-6.888l-10.951-3.51l7.194-25.11l-18.93-16.393l30.517,14.102
				c2.778,1.283,6.078,1.142,8.782-0.521l29.67-18.248c4.379-2.694,5.746-8.427,3.052-12.806c-2.694-4.379-8.427-5.746-12.806-3.052
				l-25.418,15.634l-25.987-12.009l13.749,2.106c-1.581-1.776-3.658-3.147-6.112-3.851l-21.263-6.092
				c-3.485-0.998-7.227-0.497-10.326,1.384c-3.099,1.881-5.271,4.97-5.993,8.522l-12.821,63.063
				c-0.664,3.266,0.174,6.657,2.283,9.237c0.327,0.4,0.686,0.764,1.06,1.11H7.621c-0.541,0-1.067,0.061-1.576,0.17
				C2.603,184.73,0,187.751,0,191.384v49.815c0,4.113,3.334,7.447,7.447,7.447s7.447-3.334,7.447-7.447v-42.401H49.29v42.401
				c0,4.113,3.334,7.447,7.447,7.447s7.447-3.334,7.447-7.447v-43.818l15.626,43.848c2.072,5.815,8.466,8.843,14.272,6.772
				c5.812-2.071,8.844-8.461,6.773-14.273L80.72,177.226z" />
                            <circle cx="66.103" cy="76.449" r="19.243" />
                            <circle cx="252.446" cy="69.335" r="19.243" />
                            <path d="M291.129,183.905h-14.077c0.415-0.256,0.819-0.532,1.201-0.844c2.579-2.111,4.073-5.268,4.07-8.6l-0.054-64.353
				c-0.006-7.573-6.471-13.548-14.029-12.947l-22.049,1.752c-7.156,0.569-12.498,6.831-11.929,13.988l0.922,11.603l1.781-0.025
				l16.473-14.381l-15.502,24.067l-29.838,0.426c-5.14,0.073-9.248,4.3-9.175,9.441c0.073,5.095,4.226,9.176,9.305,9.176
				c0.045,0,0.091,0,0.136-0.001l34.828-0.498c3.117-0.044,6.005-1.646,7.693-4.267l18.205-28.263l-10.052,33.515
				c-1.559,5.197-6.287,8.576-11.439,8.655c-5.26,0.071-3.13,0.042-9.398,0.131l0.362,4.555l-12.661,3.092
				c-3.652,0.892-6.611,3.561-7.872,7.102l-20.136,56.505c-2.072,5.812,0.961,12.201,6.773,14.273
				c5.812,2.072,12.202-0.963,14.272-6.772l15.626-43.85v43.82c0,4.113,3.335,7.447,7.447,7.447c4.113,0,7.447-3.334,7.447-7.447
				v-42.401h34.395v42.401c0,4.113,3.335,7.447,7.447,7.447s7.447-3.334,7.447-7.447v-49.815
				C298.748,187.265,295.406,183.905,291.129,183.905z" />
                            <path
                                d="M104.088,144.815c-0.057,0.25-0.09,0.502-0.09,0.757c0,4.239,6.881,7.896,16.812,9.586v1.397
				c0,2.202,1.786,3.988,3.988,3.988h16.795c2.203,0,3.988-1.786,3.988-3.988v-1.396c9.931-1.69,16.812-5.346,16.812-9.586
				c0-0.255-0.032-0.506-0.088-0.755c-0.11-0.487-0.933-0.854-1.915-0.854h-54.387C105.024,143.963,104.2,144.33,104.088,144.815z" />
                        </g>
                    </g>
                </g>
            </svg>
            On the spot
        </span>
        <div class="form-text text-danger" v-if="hasError('order_type')">
            {{ this.errors['order_type'][0] }}
        </div>
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
        },
        showDelivery: {
            type: Boolean,
            default: true,
        },
        showPickup: {
            type: Boolean,
            default: true,
        },
        showOnTheSpot: {
            type: Boolean,
            default: true,
        },
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
            if (this.errors) {
                return Object.hasOwnProperty.call(this.errors, key)
            }
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
                this.$emit('orderTypeChanged', {
                    order_type: this.order_type
                })
            })
        },
        async getOrderType() {
            await axios.get(url('api/order-type')).then(result => {
                this.order_type = result.data.order_type
            })
        },
    }

}
</script>
