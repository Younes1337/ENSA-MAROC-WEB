<template>
    <div class="bg-image-app">
        <NavigationMenu/>

        <Header/>

        <div class="headline-min">
            <h1 class="section-title text-center" v-html="$t('others.aim_for')"></h1>
            <AimFor/>
        </div>

        <div class="headline-min mb-12">
            <h1 class="section-title text-center mb-4" v-html="$t('others.courses')"></h1>
            <Courses/>
        </div>

        <div class="headline-min my-12">
            <h1 class="section-title text-center" v-html="$t('others.latest_news')"></h1>
            <LatestNews/>
        </div>

        <div class="headline-min my-12">
            <h1 class="section-title text-center" v-html="$t('others.latest_events')"></h1>
            <LatestEvents/>
        </div>

        <div class="headline-min my-12">
            <h1 class="section-title text-center" v-html="$t('others.clubs')"></h1>
            <PopularClubs/>
        </div>

        <div class="headline-min my-12">
            <h1 class="section-title text-center mb-3" v-html="$t('others.subscribe')"></h1>
            <Subscribe/>
        </div>

        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import Header from '../Home/Header.vue';
    import AimFor from '../Home/AimFor.vue';
    import Courses from '../Home/Courses.vue';
    import LatestNews from '../Home/LatestNews.vue';
    import LatestEvents from '../Home/LatestEvents.vue';
    import PopularClubs from '../Home/PopularClubs.vue';
    import Subscribe from '../Home/Subscribe.vue';
    import Footer from '../Global/Footer.vue';


    export default {
        mounted() {
            console.log('====================================');
            console.log(this.$router.options.routes);
            console.log('====================================');
        },
        components: {
            NavigationMenu,
            Header,
            AimFor,
            Courses,
            LatestNews,
            LatestEvents,
            PopularClubs,
            Subscribe,
            Footer
        }
    }
</script>
