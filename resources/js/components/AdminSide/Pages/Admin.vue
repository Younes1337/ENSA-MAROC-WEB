<template>
    <v-main>
        <SideBar @toggleDrawer="toggleDrawer" :drawer="drawer" :admin="admin"/>
        <router-view />
    </v-main>
</template>

<script>
// import AppBar from "../Components/AppBar.vue";
import { mapActions } from "vuex";
import SideBar from "../Components/SideBar.vue";
import EnsasList from '../Components/EnsasList.vue';

export default {
    data() {
        return {
            drawer: false,
            admin: true,
        };
    },
    methods: {
        ...mapActions({
            refreshUser: "usedByAll/refreshUser"
        }),
        toggleDrawer() {
            this.drawer = !this.drawer;
        }
    },
    async mounted() {
        const data = await this.refreshUser();
    },
    components: {
        // AppBar,
        SideBar,
        EnsasList
    },
};
</script>
