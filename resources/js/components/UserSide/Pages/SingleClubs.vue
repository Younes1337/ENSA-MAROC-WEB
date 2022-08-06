<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <HeaderSingleClubs :clubInfo="clubInfo"/>
        <BodySingleClubs :description="clubInfo.description"/>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import HeaderSingleClubs from '../FicheClubs/HeaderSingleClubs.vue';
    import BodySingleClubs from '../FicheClubs/BodySingleClubs.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        data() {
            return {
                clubInfo: {}
            }
        },
        components: {
            NavigationMenu,
            HeaderSingleClubs,
            BodySingleClubs,
            Footer
        },
        async mounted () {
            const id = this.$route.params.id
            const { data } = await this.axios.get(`/api/club/${id}`);
            this.clubInfo = data;
        },
    }
</script>