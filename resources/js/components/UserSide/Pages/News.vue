<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max mt-12">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_news')"></h1>
            <h2 class="section-subtitle text-center mb-10" v-html="$t('page_title.subtitle_news')"></h2>
            <div class="f2"></div>
        </div>
        <div class="px-10">
            <FilterNews/>
            <CardNews/>
        </div>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import FilterNews from '../News/FilterNews.vue';
    import CardNews from '../News/CardNews.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        mounted() {},
        components: {
            NavigationMenu,
            FilterNews,
            CardNews,
            Footer
        }
    }
</script>