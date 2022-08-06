<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <div class="headline-max mt-12">
            <div class="f1"></div>
            <h1 class="section-title text-center" v-html="$t('page_title.title_jobs')"></h1>
            <h2 class="section-subtitle text-center mb-10" v-html="$t('page_title.subtitle_jobs')"></h2>
            <div class="f2"></div>
        </div>
        <div class="px-10">
            <FilterJobs @updateJobs="updateJobs"/>
            <CardJob :cardsJobs="cardsJobs"/>
        </div>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import FilterJobs from '../Jobs/FilterJobs.vue';
    import CardJob from '../Jobs/CardJob.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        components: {
            NavigationMenu,
            FilterJobs,
            CardJob,
            Footer,
        },

        data() {
            return {
                cardsJobs: []
            }
        },

        mounted () {
            // const { data } = await this.axios.get('/api/jobs');
        },

        methods: {
            updateJobs(filteredJobs) {
                console.log("On update");
                this.cardsJobs = [];
                filteredJobs.map(job => {
                    this.cardsJobs.push({
                        ...job,
                        location: job.country + "/" + job.city,
                        show: false
                    })
                })
            }
        },
    }
</script>
