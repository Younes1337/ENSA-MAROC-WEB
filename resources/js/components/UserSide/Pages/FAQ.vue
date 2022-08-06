<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_faq')"></h1>
            <h2 class="section-subtitle text-center mb-10" v-html="$t('page_title.subtitle_faq')"></h2>
            <div class="f2"></div>
        </div>
        <QuestionsAnswer/>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import QuestionsAnswer from '../FAQ/QuestionsAnswer.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        mounted() {
        },
        components: {
            NavigationMenu,
            QuestionsAnswer,
            Footer
        }
    }
</script>