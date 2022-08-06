<template>
    <section class="event-section headline-min">
        <slick
            class="slick"
            ref="slick"
            :options="slickOptions"
            v-if="latestEvents.length"

        >
            <v-slide-item
                class="slide-item rounded-lg"
                v-for="event in latestEvents"
                :key="event.id"
            >
                <v-card class="ma-2 pa-3" max-width="1050">
                    <v-row>
                        <v-col cols="12" md="4">
                            <v-img
                                :src="event.image"
                                class="white--text align-start rounded-lg"
                                height="300px"
                            ></v-img>
                        </v-col>
                        <!-- cols="12" md="8" -->
                        <v-col class="py-3">
                            <v-chip-group column>
                                <v-chip
                                    v-for="(tag, index) in event.tags"
                                    :key="index"
                                    small
                                    label
                                    >{{ tag }}</v-chip
                                >
                            </v-chip-group>

                            <v-card-text class="title-card pt-1 pb-0 px-0">
                                {{ event.title }}
                            </v-card-text>

                            <v-card-text class="text-card px-0">
                                {{ event.description }}
                            </v-card-text>

                            <v-card-actions
                                class="d-flex justify-space-between pa-0"
                            >
                                <v-btn
                                    class="btn-more-mini text-center pa-0"
                                    max-width="130"
                                    rounded
                                >
                                    {{$t('others.read_more')}}
                                </v-btn>
                            </v-card-actions>
                        </v-col>
                    </v-row>
                </v-card>
            </v-slide-item>
        </slick>
        <v-btn class="btn-more text-center mt-6" :to="{ name: 'events' }" large rounded> {{$t('others.view_more')}} </v-btn>
    </section>
</template>
<script>
import Slick from 'vue-slick';
export default {
    components: { Slick },
    data() {
        return {
            latestEvents: [],
            slickOptions: {
                dots: false,
                autoplay: false,
                infinite: true,
                speed: 0,
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: true,
                rtl: false,
                arrows: true,
                prevArrow:".prev",
                nextArrow:".next",
                centerMode: true,
                fade: true,
                cssEase: 'linear',
                prevArrow: '<button type="button" class="slick-prev"><div class="icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg></div></button>',
                nextArrow: '<button type="button" class="slick-next"><div class="icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg></div></button>',
                responsive: [
                    {
                    breakpoint: 1024,
                    settings: {
                        centerPadding: '50px',
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        centerPadding: '5px',
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                    },
                    {
                    breakpoint: 480,
                    settings: {
                        centerPadding: '5px',
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                    }
                ]
            },
        };
        // reInit() {
        //     this.$nextTick(() => {
        //         this.$refs.slick.reSlick();
        //     });
        // };
    },
    async mounted () {
        const res = await this.axios.get('/api/events/latest')
        res.data.map(event => {
            const tags = event.tags.split(",")
            this.latestEvents.push({...event, tags: tags})
        })
    },
}
</script>
