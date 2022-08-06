<template>
    <section class="ficheENSA-section mt-12">
        <v-container fluid>
            <v-row>
                <v-col cols="12" sm="12" md="12" lg="12" xl="12">
                    <v-card class="header-ficheENSA d-flex">
                        <v-img
                            :src="ENSAInfo.cover_picture"
                            class="cover-picture"
                            cover
                        >
                            <div class="bg-overlay"></div>
                        </v-img>
                        <v-row
                            class="ensa-short-info d-flex justify-start align-end"
                        >
                            <div class="d-flex justify-start align-center">
                                <img
                                    :src="ENSAInfo.logo"
                                    class="ensa-logo ml-sm-8 ml-md-12 ml-lg-12 ml-xl-12 ml-xs-12"
                                    alt="logo ensa"
                                />
                                <h1
                                    class="ensa-city ml-sm-4 ml-md-6 ml-lg-6 ml-xl-6 mr-sm-12 mr-md-5 mr-lg-5 mr-xl-5"
                                >
                                    {{ ENSAInfo.title }}
                                </h1>
                                <v-tooltip color="deep-orange darken-1" top>
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                            to="/courses"
                                            class="btn-more-mini align-center text-center pa-sm-3 pa-md-6 pa-lg-6 pa-xl-6"
                                            v-bind="attrs"
                                            v-on="on"
                                            rounded
                                            icon
                                        >
                                            <v-icon color="white"
                                                >mdi-book-open-page-variant-outline</v-icon
                                            >
                                        </v-btn>
                                    </template>
                                    <span class="text-uppercase" v-html="$t('fiche_ensa.explore_docs')"></span
                                    >
                                </v-tooltip>
                            </div>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
            <v-row>
                <v-col
                    class="slick-image"
                    cols="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <slick
                        class="slick"
                        ref="slick"
                        :options="slickOptions"
                        v-if="ENSAInfo.images.length"
                    >
                        <v-slide-item
                            v-for="image of ENSAInfo.images"
                            :key="image.id"
                            class="slide-item rounded-lg"
                        >
                        <div class="spotlight" :data-src="image.path" data-animation="scale" data-title="false">
                            <v-img
                                :src="image.path"
                                class="white--text align-center rounded-lg"
                                width="300px"
                                height="200px"
                                max-width="300px"
                                cover
                            ></v-img>
                        </div>
                        </v-slide-item>
                    </slick>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>
<script>
import { mdiFlaskEmptyMinus } from "@mdi/js";
import Slick from "vue-slick";
export default {
    components: { Slick },
    data() {
        return {
            slickOptions: {
                dots: false,
                infinite: true,
                autoplay: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                cssEase: "ease",
                variableWidth: true,
                variableHeight: true,
                speed: 800,
                adaptiveHeight: true,
                arrows: true,
                centerMode: false,
                prevArrow: ".prev",
                nextArrow: ".next",
                centerPadding: "50px",
                prevArrow:
                    '<button type="button" class="slick-prev"><div class="icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg></div></button>',
                nextArrow:
                    '<button type="button" class="slick-next"><div class="icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg></div></button>',
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

    props: {
        ENSAInfo: {
            type: Object,
            default: {
                coverPath: "/img/cover-ensa.jpg",
                logoPath: "/img/logos_ensa/ENSA-Safi.webp",
                title: "ENSA Safi",
            },
        },
    },
};
</script>