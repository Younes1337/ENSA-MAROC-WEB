<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max mt-12">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_events')"></h1>
            <h2 class="section-subtitle text-center mb-10" v-html="$t('page_title.subtitle_events')"></h2>
            <div class="f2"></div>
        </div>
        <div class="px-10">
            <FilterEvents/>
            <CardEvents/>
        </div>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import FilterEvents from '../Events/FilterEvents.vue';
    import CardEvents from '../Events/CardEvents.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        mounted() {},
        components: {
            NavigationMenu,
            FilterEvents,
            CardEvents,
            Footer
        }
    }
</script>