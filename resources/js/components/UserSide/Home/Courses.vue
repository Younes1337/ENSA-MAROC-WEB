<template>
    <section>
        <v-container fill-height fluid>
            <v-layout class="years d-flex justify-center align-center" row wrap>
                <v-flex class="year-1 py-16" xs12 sm12 md2 xl2>
                    <img src="/img/courses/icon-1.svg" width="80" height="80">
                    <h3 class="my-6" v-html="$t('courses_title.year_1')"></h3>
                    <p class="my-6 px-3" v-html="$t('courses_description.year_1')"></p>
                    <v-btn class="btn-more-mini mt-9 text-center" rounded> About courses </v-btn>
                </v-flex>
                <v-flex class="year-2 py-16" xs12 sm12 md2 xl2>
                    <img src="/img/courses/icon-2.svg" width="80" height="80">
                    <h3 class="my-6" v-html="$t('courses_title.year_2')"></h3>
                    <p class="my-6 px-3" v-html="$t('courses_description.year_2')"></p>
                    <v-btn class="btn-more-mini mt-9 text-center" rounded> About courses </v-btn>
                </v-flex>
                <v-flex class="year-3 py-16" xs12 sm12 md2 xl2>
                    <img src="/img/courses/icon-3.svg" width="80" height="80">
                    <h3 class="my-6" v-html="$t('courses_title.year_3')"></h3>
                    <p class="my-6 px-3" v-html="$t('courses_description.year_3')"></p>
                    <v-btn class="btn-more-mini mt-9 text-center" rounded> About courses </v-btn>
                </v-flex>
                <v-flex class="year-4 py-16" xs12 sm12 md2 xl2>
                    <img src="/img/courses/icon-4.svg" width="80" height="80">
                    <h3 class="my-6" v-html="$t('courses_title.year_4')"></h3>
                    <p class="my-6 px-3" v-html="$t('courses_description.year_4')"></p>
                    <v-btn class="btn-more-mini mt-9 text-center" rounded> About courses </v-btn>
                </v-flex>
                <v-flex class="year-5 py-16" xs12 sm12 md2 xl2>
                    <img src="/img/courses/icon-5.svg" width="80" height="80">
                    <h3 class="my-6" v-html="$t('courses_title.year_5')"></h3>
                    <p class="my-6 px-3" v-html="$t('courses_description.year_5')"></p>
                    <v-btn class="btn-more-mini mt-9 text-center" rounded> About courses </v-btn>
                </v-flex>
            </v-layout>
        </v-container>
        <!-- <v-container fill-height fluid>
            <v-layout class="years d-flex justify-center align-center" style="height: 660px;">
                <v-flex class="year-1 py-16" xs12 sm12 md2 xl2>
                    <img src="/img/courses/icon-1.svg" width="80" height="80" />
                    <h3 class="my-6" v-html="$t('courses_title.year_1')"></h3>
                    <div style="height: 60%;">
                        <p class="my-6 px-3" v-html="$t('courses_description.year_1')"></p>
                    </div>
                    <v-btn class="btn-more-mini mt-9 text-center" rounded>
                        About courses
                    </v-btn>
                </v-flex>
                <v-flex class="year-2 py-16" xs12 sm12 md2 xl2>
                    <img src="/img/courses/icon-2.svg" width="80" height="80" />
                    <h3 class="my-6" v-html="$t('courses_title.year_2')"></h3>
                    <div style="height: 60%;">
                        <p class="my-6 px-3" v-html="$t('courses_description.year_2')"></p>
                    </div>
                    <v-btn class="btn-more-mini mt-9 text-center" rounded>
                        About courses
                    </v-btn>
                </v-flex>
                <v-flex class="year-3 py-16" xs12 sm12 md2 xl2>
                    <img src="/img/courses/icon-3.svg" width="80" height="80" />
                    <h3 class="my-6" v-html="$t('courses_title.year_3')"></h3>
                    <div style="height: 60%;">
                        <p class="my-6 px-3" v-html="$t('courses_description.year_3')"></p>
                    </div>
                    <v-btn class="btn-more-mini mt-9 text-center" rounded>
                        About courses
                    </v-btn>
                </v-flex>
                <v-flex class="year-4 py-16" xs12 sm12 md2 xl2>
                    <img src="/img/courses/icon-4.svg" width="80" height="80" />
                    <h3 class="my-6" v-html="$t('courses_title.year_4')"></h3>
                    <div style="height: 60%;">
                        <p class="my-6 px-3" v-html="$t('courses_description.year_4')"></p>
                    </div>
                    <v-btn class="btn-more-mini mt-9 text-center" rounded>
                        About courses
                    </v-btn>
                </v-flex>
                <v-flex class="year-5 py-16" xs12 sm12 md2 xl2>
                    <img src="/img/courses/icon-5.svg" width="80" height="80" />
                    <h3 class="my-6" v-html="$t('courses_title.year_5')"></h3>
                    <div style="height: 60%;">
                        <p class="my-6 px-3" v-html="$t('courses_description.year_5')"></p>
                    </div>
                    <v-btn class="btn-more-mini mt-9 text-center" rounded>
                        About courses
                    </v-btn>
                </v-flex>
            </v-layout>
        </v-container> -->
    </section>
</template>
<script>
export default {
    data: () => ({}),
};
</script>
