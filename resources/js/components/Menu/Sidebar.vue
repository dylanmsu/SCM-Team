<template>
    <div class="sidebar">
        <div class="sidebar-backdrop" @click="closeSidebarPanel" v-if="isPanelOpen"></div>
        <transition name="slide">
            <div v-if="isPanelOpen"
                 class="sidebar-panel">
                <slot></slot>
            </div>
        </transition>
    </div>
</template>
<script>
    import { store, mutations } from '@/store.js'

    export default {
        methods: {
            closeSidebarPanel: mutations.toggleNav
        },
        computed: {
            isPanelOpen() {
                return store.isNavOpen
            },
        }
    }
</script>
<style>
/* logo in nav bar */
.sidebar-panel > img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 15%;
    width: 50%;
}

/* slide in and out animation of the nav bar */
.slide-enter-active, .slide-leave-active {
    transition: transform 0.2s ease;
}

.slide-enter, .slide-leave-to {
    transform: translateX(-100%);
    transition: all 150ms ease-in 0s;
}

/* blurry backdrop */
.sidebar-backdrop {
    transition: all 1s ease-in-out;
    background-color: rgba(0,0,0,0.5);
    backdrop-filter: blur(10px);
    width: 100vw;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    cursor: pointer;
}

/* the panel itself */
.sidebar-panel {
    overflow-y: auto;
    background-color: rgb(178, 190, 195);
    position: fixed;
    left: 0;
    top: 0;
    height: 100vh;
    z-index: 900;
    padding: 3rem 20px 2rem 20px;
    width: 300px;
    font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
    font-size: 16px;
}

/* list of items in the panel */
ul.sidebar-panel-nav {
    list-style-type: none;
    text-align: center;
    padding-right: 3em;
    margin-top: 5%;
}


/* individual list items */
ul.sidebar-panel-nav > li > a {
    position: relative;
    color: gray;
    text-decoration: none;
    font-size: 1.5rem;
    display: inline;
    padding-bottom: 0;
}

/* individual list items on hover */
ul.sidebar-panel-nav > li > a:hover {
    color: black;
}


ul.sidebar-panel-nav > li > a::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: red;
    visibility: hidden;
    transform: scaleX(0);
    transition: all .2s ease-in-out 0s;
    z-index: 900;
}

ul.sidebar-panel-nav > li > a:hover::before {
    visibility: visible;
    transform: scaleX(1);
}
</style>