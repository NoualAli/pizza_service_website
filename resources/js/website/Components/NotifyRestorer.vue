<template>
    <div>

    </div>
</template>

<script>
import { url } from '../Helpers/main'
export default {
    props: ['restaurants'],
    mounted() {
        this.restaurants.forEach(restaurant => {
            Notification.requestPermission()
            window.Echo.channel('private-ps-default-' + restaurant.id)
                .listen('OrderCreatedEvent', (e) => {
                    this.$swal({
                        icon: 'success',
                        html: '<p><b>' + restaurant.name + '</b> has a new order</p>',
                        position: 'center',
                    }).then(result => {
                        if (result.isConfirmed) {
                            window.location.href = url('ps/order/')
                        }
                    });
                    this.browserNotification(restaurant.name + ' has a new order')
                })
        })
    },
    methods: {
        browserNotification(message) {
            window.navigator.vibrate([100, 30, 100, 30, 100, 30, 200, 30, 200, 30, 200, 30, 100, 30, 100, 30, 100])
            this.playNotification()
            if (!Notification) {
                this.$swal({
                    icon: 'error',
                    text: 'Your browser doesn\'t support notifications.'
                })
            }
            if (Notification.permission == 'granted') {
                new Notification(message)
            }
        },
        playNotification() {
            const audio = new Audio('/notifications/new-order.wav')
            audio.play()
        },
    },
}
</script>
