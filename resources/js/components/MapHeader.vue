<template>
    <header id="header" class="header is-home">
        <div class="map-wrapper">
            <div class="row no-gutters h-100">
                <div class="col-lg-8 p-0">
                    <map-box></map-box>
                </div>
                <div class="col-lg-4 p-0 accordion-wrapper">
                    <restaurants-map-listing :restaurants="restaurants"></restaurants-map-listing>
                </div>
            </div>
        </div>
    </header>

</template>

<script>
import MapBox from './MapBox'
import RestaurantsMapListing from './RestaurantsMapListing.vue'
import axios from 'axios'

export default {
    components: [
        MapBox,
        RestaurantsMapListing
    ],
    data() {
        return {
            clientLocation: null,
            defaultLocation: null,
            accessToken: 'pk.eyJ1Ijoibm91YWwiLCJhIjoiY2w2b280Y2E2MGNyczNjbDlzdTU3Mmh3bSJ9.wlaP5NJ_RrfYlkCw3_S4fQ',
            restaurants: []
        }
    },
    created() {
        this.getRestaurants()
    },
    mounted() {
        this.handleClientLocation()
        // this.defaultLocation = this.clientLocation ? this.clientLocation : [24.9384, 60.1699]
        this.defaultLocation = [24.9384, 60.1699]
        this.setMap(this.defaultLocation)
    },

    methods: {
        // Initialisation de la map
        setMap(clientLocation = null, latLang = 13) {
            mapboxgl.accessToken = this.accessToken;
            let map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: clientLocation,
                zoom: latLang
            });
            map.addControl(new mapboxgl.NavigationControl());
            const clientMarker = new mapboxgl.Marker()
                .setLngLat(clientLocation)
                .addTo(map);
            this.restaurants.forEach(restaurant => {
                new mapboxgl.Marker()
                    .setLngLat([restaurant.longitude, restaurant.latitude])
                    .addTo(map);
            })

            const geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken, // Set the access token
                mapboxgl: map, // Set the mapbox-gl instance
                marker: false, // Use the geocoder's default marker style
            });

            map.addControl(geocoder, 'top-left');

            geocoder.on('result', (e) => {
                this.defaultLocation = e.result.geometry.coordinates
                const searchResult = e.result.geometry
                const options = { units: 'kilometers' };
                for (const restaurant of this.restaurants) {
                    restaurant.distance = Math.round(turf.distance(
                        searchResult,
                        [restaurant.longitude, restaurant.latitude],
                        options
                    ));
                }
                this.restaurants = this.filterByDistance(30)
                this.restaurants = this.sortByDistance()
                this.setRestaurantsMarkups(map)
                this.updateRestaurantsList()
            })
        },

        setRestaurantsMarkups(map) {
            this.restaurants.forEach(restaurant => {
                new mapboxgl.Marker()
                    .setLngLat([restaurant.longitude, restaurant.latitude])
                    .addTo(map);
            })
        },

        filterByDistance(distance) {
            return this.restaurants.filter((restaurant) => {
                return restaurant.distance <= distance
            });
        },

        sortByDistance() {
            return this.restaurants.sort((a, b) => {
                if (a.distance > b.distance) {
                    return 1;
                }
                if (a.distance < b.distance) {
                    return -1;
                }
                return 0; // a must be equal to b
            });
        },

        // Géstion de la localistaion du client
        handleClientLocation() {
            if (!this.clientLocation) {
                if (navigator.geolocation) {
                    this.getClientLocation()
                } else {
                    console.error("Your browser does not support geolocation API");
                }
            } else {
                this.setMap(this.clientLocation)
            }
        },

        // Récupération de la localisation du client
        getClientLocation() {
            const options = {
                enableHighAccuracy: false
            }
            navigator.geolocation.getCurrentPosition(this.locationRetrievedWithSuccess, this.unableToRetrieveLocation, options)
        },

        // Récupération de la localisation avec succès
        locationRetrievedWithSuccess(result) {
            // this.storeClientLocation([result.coords.longitude, result.coords.latitude])
            // this.setMap(this.retrieveClientLocation())
            this.clientLocation = [result.coords.longitude, result.coords.latitude]
            this.setMap([result.coords.longitude, result.coords.latitude])
        },

        // Erreur lors de la tentative de récupération de la localisation
        unableToRetrieveLocation(error) {
            this.setMap(this.defaultLocation)
            console.error(error);
        },

        // Récupère la liste des restaurant
        async getRestaurants() {
            try {
                const response = await axios.get('api/restaurants-list')
                this.restaurants = response.data.data
            } catch (error) {
                console.error(error);
            }
        },

        updateRestaurantsList() {
            const listings = document.querySelector('#restaurantsMapList')
            while (listings.firstChild) {
                listings.removeChild(listings.firstChild)
            }

            this.buildLocationList(listings)
        },

        buildLocationList(listings) {
            this.restaurants.forEach(restaurant => {
                if (restaurant.distance) {
                    const roundedDistance = Math.round(restaurant.distance * 100) / 100;
                    listings.innerHTML += `
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading-${restaurant.id}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse-${restaurant.id}" aria-expanded="false" aria-controls="flush-collapes-${restaurant.id}">
                                    ${restaurant.name}
                                </button>
                            </h2>
                            <div id="flush-collapse-${restaurant.id}" class="accordion-collapse collapse show" aria-labelledby="flush-heading-${restaurant.id}"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <p>${restaurant.address}</p>
                                    <p><b>Distance: ${roundedDistance} Km</b></p>
                                    <a href="restaurant/${restaurant.id}" class="btn btn-primary text-white d-block">Menu</a>
                                </div>
                            </div>
                        </div>
                    `;
                }
            })
        }

        // // Récupérer la localisation du client à partir de sessionStorage
        // retrieveClientLocation() {
        //     return window.sessionStorage.getItem('clientLocation')
        // },

        // // Enregistrement de la localisation du client dans le sessionStorage
        // storeClientLocation(clientLocation) {
        //     this.clientLocation = clientLocation
        //     window.sessionStorage.setItem('clientLocation', JSON.stringify(clientLocation))
        // },
    }
}
</script>

<style>
.mapboxgl-ctrl-geocoder {
    border: 0;
    border-radius: 0;
    position: relative;
    top: 0;
    width: 800px;
    margin-top: 0;
}

.mapboxgl-ctrl-geocoder>div {
    min-width: 100%;
    margin-left: 0;
}
</style>
