<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max mt-12">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_orientations')"></h1>
            <h2 class="section-subtitle text-center mb-10" v-html="$t('page_title.subtitle_orientations')"></h2>
            <div class="f2"></div>
        </div>
        <div class="px-10">
            <FilterOrientations @updateOrientations="updateOrientations"/>
            <CardOrientations :orientations="orientations"/>
        </div>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import FilterOrientations from '../Orientations/FilterOrientations.vue';
    import CardOrientations from '../Orientations/CardOrientations.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        data() {
            return {
                orientations: []
            }
        },
        mounted() {},
        components: {
            NavigationMenu,
            FilterOrientations,
            CardOrientations,
            Footer
        },
        methods: {
            updateOrientations(filteredOrientations) {
                console.log("On update orientations");
                this.orientations = filteredOrientations;
            }
        },
    }
</script>