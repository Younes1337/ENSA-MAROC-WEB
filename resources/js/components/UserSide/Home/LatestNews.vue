<template>
    <section>
        <slick
            class="slick"
            ref="slick"
            :options="slickOptions"
            v-if="latestNews.length"
        >
            <v-app
                v-for="item in latestNews"
                :key="item.id"
                class="cards-carousel"
            >
                <v-slide-item class="slide-item rounded-lg">
                    <v-card
                        class="ma-2 pa-3"
                        max-width="280"
                        height="390"
                    >
                        <v-img
                            :src="item.image"
                            class="white--text align-end rounded-lg"
                            height="150px"
                        ></v-img>
                        <v-card-text class="title-card pt-2 pb-0 px-0">
                            {{ item.title }}
                        </v-card-text>
                        <v-card-text class="text-card px-0">
                            {{ item.description }}
                        </v-card-text>
                        <v-card-actions
                            class="d-flex justify-space-between pa-0 pt-6"
                        >
                            <router-link
                                :to="{ name: 'news' }"
                                class="align-self-baseline read-more"
                            >
                                <span v-html="$t('others.more_infos')"></span>
                                <v-icon class="icons" size="20px"
                                    >mdi-chevron-right</v-icon
                                >
                            </router-link>
                            <p class="align-self-baseline ensa-location ma-0">
                                {{ item.created_at }}
                            </p>
                        </v-card-actions>
                    </v-card>
                </v-slide-item>
            </v-app>
        </slick>
        <v-btn
            class="btn-more text-center mt-6"
            :to="{ name: 'news' }"
            large
            rounded
        >
            {{$t('others.view_more')}}
        </v-btn>
    </section>
</template>

<script>
import Slick from "vue-slick";
export default {
    components: { Slick },
    data() {
        return {
            latestNews: [],
            slickOptions: {
                dots: false,
                autoplay: false,
                infinite: true,
                speed: 500,
                slidesToShow: 4,
                slidesToScroll: 1,
                adaptiveHeight: true,
                rtl: false,
                arrows: true,
                prevArrow: ".prev",
                nextArrow: ".next",
                centerMode: false,
                centerPadding: "50px",
                prevArrow:
                    '<button type="button" class="slick-prev"><div class="icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg></div></button>',
                nextArrow:
                    '<button type="button" class="slick-next"><div class="icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg></div></button>',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            centerPadding: "50px",
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        },
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            centerPadding: "5px",
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            centerPadding: "5px",
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            },
        };
    },
    methods: {
        next() {
            this.$refs.slick.next();
        },
        prev() {
            this.$refs.slick.prev();
        },
        reInit() {
            this.$nextTick(() => {
                this.$refs.slick.reSlick();
            });
        },
    },
    async mounted() {
        const { data } = await this.axios.get("/api/news/latest");
        data.map((item) => {
            const date = new Date(item.created_at);
            const FormatedDate = date.toUTCString().slice(3, 16);
            this.latestNews.push({ ...item, created_at: FormatedDate });
        });
    },
};
</script>
<style>
.icon-left {
    margin: 0 !important;
}
</style>