<template>
    <div id="scrollSection" class="scroll-down-btn-container">
        <a :href="'#' + this.section" class="scroll-down-btn">
            <span></span><span></span><span></span>
            {{ title }}
        </a>
    </div>
</template>

<script>
export default {
    props: {
        section: {
            type: String,
            required: true
        },
        title: {
            type: String,
            default: 'Scroll'
        }
    },
}
</script>

<style scoped>
.scroll-down-btn-container .scroll-down-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 2;
    display: inline-block;
    color: #fff;
    font: normal 400 20px/1 'Josefin Sans', sans-serif;
    letter-spacing: .1em;
    text-decoration: none;
    transition: opacity .3s;
}

.scroll-down-btn-container .scroll-down-btn:hover {
    opacity: .5;
}

.scroll-down-btn-container a {
    padding-top: 80px;
}

.scroll-down-btn-container a span {
    position: absolute;
    top: 0;
    left: 50%;
    width: 24px;
    height: 24px;
    margin-left: -12px;
    border-left: 1px solid #fff;
    border-bottom: 1px solid #fff;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
    -webkit-animation: sdb07 2s infinite;
    animation: sdb07 2s infinite;
    opacity: 0;
    box-sizing: border-box;
}

.scroll-down-btn-container a span:nth-of-type(1) {
    -webkit-animation-delay: 0s;
    animation-delay: 0s;
}

.scroll-down-btn-container a span:nth-of-type(2) {
    top: 16px;
    -webkit-animation-delay: .15s;
    animation-delay: .15s;
}

.scroll-down-btn-container a span:nth-of-type(3) {
    top: 32px;
    -webkit-animation-delay: .3s;
    animation-delay: .3s;
}

@-webkit-keyframes sdb07 {
    0% {
        opacity: 0;
    }

    50% {
        opacity: 1;
    }

    100% {
        opacity: 0;
    }
}

@keyframes sdb07 {
    0% {
        opacity: 0;
    }

    50% {
        opacity: 1;
    }

    100% {
        opacity: 0;
    }
}
</style>
