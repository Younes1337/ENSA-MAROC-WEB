<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max mt-12">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_contactus')"></h1>
            <h2 class="section-subtitle text-center mb-10" v-html="$t('page_title.subtitle_contactus')"></h2>
            <div class="f2"></div>
        </div>
        <FormContact/>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import FormContact from '../Contact/FormContact.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        mounted() {
        },
        components: {
            NavigationMenu,
            FormContact,
            Footer
        }
    }
</script>