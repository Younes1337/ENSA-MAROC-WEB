<template>
    <section class="headline-min">
        <slick
            class="slick"
            ref="slick"
            :options="slickOptions"
            v-if="clubs.length"
        >
            <v-app v-for="club in clubs" :key="club.id" class="cards-carousel">
                <v-slide-item
                    class="slide-item rounded-lg"
                    v-slot:default="{ toggle }"
                >
                    <v-card
                        class="ma-2 pa-3"
                        max-width="280"
                        height="390"
                        @click="toggle"
                    >
                        <v-img
                            :src="club.image"
                            class="white--text align-end rounded-lg"
                            height="150px"
                        ></v-img>

                        <v-card-text class="title-card pt-2 pb-0 px-0">
                            {{ club.title }}
                        </v-card-text>

                        <v-card-text class="text-card px-0">
                            {{ club.description }}
                        </v-card-text>

                        <v-card-actions
                            class="d-flex flex-row justify-space-between pa-0 pt-6">
                            <a href="#" class="align-self-baseline read-more">
                                <span class="caption" v-html="$t('others.more_infos')"></span>
                                <v-icon class="icons" size="20px"
                                    >mdi-chevron-right</v-icon
                                >
                            </a>
                            <p class="align-self-baseline ensa-location ma-0">
                                {{ club.ensa }}
                            </p>
                        </v-card-actions>
                    </v-card>
                </v-slide-item>
            </v-app>
        </slick>
        <v-btn
            class="btn-more text-center mt-6"
            :to="{ name: 'clubs' }"
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
            clubs: [],
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
        const res = await this.axios.get("/api/clubs");
        this.clubs = res.data;
    },
};
</script>
