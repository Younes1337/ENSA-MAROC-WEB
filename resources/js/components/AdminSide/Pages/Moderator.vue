<template>
    <v-main>
        <SideBar @toggleDrawer='toggleDrawer' :drawer='drawer' :admin="moderator" />
        <router-view/>
    </v-main>
</template>

<script>
    import AppBar from '../Components/AppBar.vue';
    import SideBar from '../Components/SideBar.vue';

    export default {
        data() {
            return {
                drawer: false,
                admin: false
            }
        },
        mounted() {
        },
        methods: {
            toggleDrawer() {
                this.drawer = !this.drawer
            }
        },
        components: {
            AppBar,
            SideBar
        }
    }
</script>
