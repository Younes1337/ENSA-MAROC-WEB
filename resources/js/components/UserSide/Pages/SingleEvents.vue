<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <HeaderSingleEvents :EventInfo="EventInfo" />
        <BodySingleEvents :description="EventInfo.description" v-if="EventInfo.description"/>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import HeaderSingleEvents from '../FicheEvents/HeaderSingleEvents.vue';
    import BodySingleEvents from '../FicheEvents/BodySingleEvents.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        data() {
            return {
                EventInfo: {}
            }
        },
        components: {
            NavigationMenu,
            HeaderSingleEvents,
            BodySingleEvents,
            Footer
        },
        async mounted () {
            const id = this.$route.params.id
            const { data } = await this.axios.get(`/api/event/${id}`);
            this.EventInfo = data;
        },
    }
</script>