<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max mt-12">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_aboutus')"></h1>
            <h2 class="section-subtitle text-center mb-10" v-html="$t('page_title.subtitle_aboutus')"></h2>
            <div class="f2"></div>
        </div>
        <About/>
        <AimFor/>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import About from '../About/About.vue';
    import AimFor from '../Home/AimFor.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        mounted() {
        },
        components: {
            NavigationMenu,
            About,
            AimFor,
            Footer
        }
    }
</script>