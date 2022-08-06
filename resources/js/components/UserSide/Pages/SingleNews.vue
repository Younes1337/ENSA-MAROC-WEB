<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <HeaderSingleNews :newsInfo="newsInfo"/>
        <BodySingleNews :description="newsInfo.description"/>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import HeaderSingleNews from '../FicheNews/HeaderSingleNews.vue';
    import BodySingleNews from '../FicheNews/BodySingleNews.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        data() {
            return {
                newsInfo: {}
            }
        },
        components: {
            NavigationMenu,
            HeaderSingleNews,
            BodySingleNews,
            Footer
        },
        async mounted () {
            const id = this.$route.params.id
            const { data } = await this.axios.get(`/api/news/${id}`);
            this.newsInfo = data;
        }
    }
</script>