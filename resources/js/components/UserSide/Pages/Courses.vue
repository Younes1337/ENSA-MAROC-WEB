<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max mt-12">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_docs')"></h1>
            <h2 class="section-subtitle text-center mb-10" v-html="$t('page_title.subtitle_docs')"></h2>
            <div class="f2"></div>
        </div>
        <div class="px-10">
            <FilterCourses @updateModules="updateModules"/>
            <CardCourses :modules="modules"/>
        </div>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import FilterCourses from '../Courses/FilterCourses.vue';
    import CardCourses from '../Courses/CardCourses.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        data() {
            return {
                modules: []
            }
        },
        mounted() {},
        components: {
            NavigationMenu,
            FilterCourses,
            CardCourses,
            Footer
        },
        methods: {
            updateModules(filteredModules) {
                console.log("On update modules");
                this.modules = filteredModules;
            }
        },
    }
</script>