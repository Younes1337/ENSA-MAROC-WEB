<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max mt-12">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_internships')"></h1>
            <h2 class="section-subtitle text-center mb-10" v-html="$t('page_title.subtitle_internships')"></h2>
            <div class="f2"></div>
        </div>
        <div class="px-10">
            <FilterInternships/>
            <CardInternships/>
        </div>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import FilterInternships from '../Internships/FilterInternships.vue';
    import CardInternships from '../Internships/CardInternships.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        components: {
            NavigationMenu,
            FilterInternships,
            CardInternships,
            Footer,
        },

        data() {
            return {
                cardsInternships: []
            }
        },

        mounted () {
            // const { data } = await this.axios.get('/api/jobs');
        },

        methods: {},
    }
</script>