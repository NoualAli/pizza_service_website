<template>
    <div class="hero-component" :class="{'bg-image' : this.src}" :style="this.calculatedStyle">
        <div class="slot-container">
            <slot></slot>
        </div>
        <div class="overlay" v-if="this.src"></div>
    </div>
</template>

<script>
export default {
    props: {
        src: {
            type: String,
            default: null
        },
        background: {
            type: String,
            default: '#F6F6F6'
        },
        color: {
            type: String,
            default: '#fcfcfc'
        },
        height: {
            type: String,
            default: '50vh',
        }
    },
    computed: {
        calculatedHeight() {
            return 'calc(' + this.height + ' - 61px)'
        },
        calculatedStyle() {
            let style = `background-color: ${this.background}; height: ${this.height}; color:${this.color};`
            if (this.src) {
                style += `background-image:url(${this.src});`
            }
            return style
        }
    }
}
</script>

<style>
.hero-component {
    position: relative;
}

.bg-image {
    color: #fff;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
    object-fit: cover;
}

.slot-container {
    position: absolute;
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    z-index: 10;
}

.overlay {
    z-index: 9;
    position: absolute;
    height: 100%;
    width: 100%;
}

.overlay::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: rgba(0, 0, 0, .5);
}
</style>
