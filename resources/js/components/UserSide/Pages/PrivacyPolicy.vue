<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max mt-12">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_privacypolicy')"></h1>
            <div class="f2"></div>
        </div>
        <PrivacyPolicy/>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import PrivacyPolicy from '../PrivacyPolicy/Privacy.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        mounted() {
        },
        components: {
            NavigationMenu,
            PrivacyPolicy,
            Footer
        }
    }
</script>