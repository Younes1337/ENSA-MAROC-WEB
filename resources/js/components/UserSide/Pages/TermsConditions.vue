<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max mt-12">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_terms')"></h1>
            <div class="f2"></div>
        </div>
        <TermsConditions/>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import TermsConditions from '../TermsConditions/Terms.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        mounted() {
        },
        components: {
            NavigationMenu,
            TermsConditions,
            Footer
        }
    }
</script>