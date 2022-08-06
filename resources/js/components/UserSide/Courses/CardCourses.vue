<template>
    <!-- <section class="section-auto mt-6">
        <v-container fluid grid-list-md>
            <v-row class="mb-6" justify="center">
                <v-col
                    class="pa-5 pl-10"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="10"
                    lg="10"
                    xl="10"
                >
                    <h2 class="text-center mb-4"> ENSA Safi </h2>
                    <v-expansion-panels inset>
                        <v-expansion-panel v-for="ensaSafi in ensaSafi" :key="ensaSafi.id">
                            <v-expansion-panel-header class="title-card"
                                >{{ ensaSafi.title }}</v-expansion-panel-header
                            >
                            <v-expansion-panel-content class="text-left">
                                {{ ensaSafi.coursTitle }}
                                <br><br>
                                <a :href="ensaSafi.link" target="_blank" class="link-course">{{ ensaSafi.link }}</a>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-col>
            </v-row>
        </v-container>
    </section> -->
    <section class="section-auto courses-section mt-6">
        <v-container fluid grid-list-md>
            <v-layout row wrap>
                <v-flex
                    v-for="module in modules"
                    :key="module.id"
                    cols12
                    xs12
                    sm6
                    md3
                    lg3
                    xl3
                >
                    <v-card
                        class="mx-auto cardCourses mb-5"
                        max-width="300"
                        min-height="160"
                    >
                        <div style="min-height: 160px !important">
                            <v-card-title
                                class="course-title"
                                v-text="module.title_module"
                            ></v-card-title>
                        </div>

                        <v-card-actions class="d-flex justify-start align-center">
                            <v-btn
                                class="course-explore-btn"
                                :to="module.link"
                                text
                            >
                                {{$t('others.explore')}}
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
        <div class="pagination mt-4 mb-2">
            <!--:total-visible="4" -->
            <v-pagination v-model="page" :length="pages" circle></v-pagination>
        </div>
    </section>
</template>
<script>
export default {
    data() {
        return {
            page: 1,
            pageSize: 8,
            listCount: 0,
            historyList: [],
            ensaSafi: [
                {
                    id: "1",
                    title: "Preparatory cycle",
                    coursTitle: "Lorem ipsum dolor sit amet",
                    link: "https://drive.google.com/drive/folders/15jdeXMjBZKFijI1NqmIA26ETfE7-FC_y?usp=sharing",
                },
                {
                    id: "2",
                    title: "Engineering cycle",
                    coursTitle: "Lorem ipsum dolor sit amet",
                    link: "https://drive.google.com/drive/folders/1IvZO1XVkSAKz72Nis2bj0pqJ19XSBc4C?usp=sharing",
                },
            ],
        };
    },

    props: ['modules'],

    computed: {
        pages() {
            return this.pageSize == this.modules.length
                ? 1
                : parseInt(this.modules.length / this.pageSize + 1);
        },
    },

    methods: {
        initPage: function () {
            this.listCount = this.modules.length;
            if (this.listCount < this.pageSize) {
                this.historyList = this.modules;
            } else {
                this.historyList = this.modules.slice(0, this.pageSize);
            }
        },
        updatePage: function (pageIndex) {
            let _start = (pageIndex - 1) * this.pageSize;
            let _end = pageIndex * this.pageSize;
            this.historyList = this.modules.slice(_start, _end);
            this.page = pageIndex;
        },
    },


};
</script>
<style>
    .link-course {
        font-size: 0.8rem;
        color: gray !important;
    }
</style>