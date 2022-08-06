<template>
    <!-- <section class="section-auto jobs-section mt-6">
        <v-container fluid grid-list-md>
            <v-layout row wrap v-if="historyList.length">
                <v-flex
                    v-for="cardJob in historyList"
                    :key="cardJob.id"
                    xs12
                    sm6
                    md6
                    lg3
                    xl3
                >
                    <v-card class="mx-auto cardJob mb-5" max-width="300" min-height="250">
                        <div style="min-height: 190px !important;">
                            <v-card-title
                            class="job-title"
                            v-text="cardJob.title"
                        ></v-card-title>
                        <v-card-subtitle
                            class="job-type"
                            v-text="cardJob.type"
                        ></v-card-subtitle>
                        </div>

                        <v-card-actions>
                            <v-btn
                                class="job-explore-btn"
                                href="#"
                                target="_blank"
                                text
                            >
                                {{$t('others.explore')}}
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn
                                class="job-details-btn"
                                text
                                @click="cardJob.show = !cardJob.show"
                            >
                                {{
                                    cardJob.show
                                        ? "less details"
                                        : "more details"
                                }}
                            </v-btn>
                        </v-card-actions>

                        <v-expand-transition>
                            <div v-show="cardJob.show">
                                <v-divider></v-divider>
                                <v-card-text
                                    class="job-details"
                                    v-text="cardJob.description"
                                ></v-card-text>
                                <v-card-subtitle
                                    class="job-location"
                                    v-text="cardJob.location"
                                ></v-card-subtitle>
                            </div>
                        </v-expand-transition>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
        <div class="pagination mt-4 mb-2">
            <v-pagination
                v-model="page"
                :length="pages"
                @input="updatePage"
                circle
            ></v-pagination>
        </div>
    </section> -->
<section class="section-auto jobs-section mt-6">
        <v-container fluid grid-list-md>
            <v-layout row wrap v-if="historyList.length">
                <v-flex
                    v-for="cardJob in historyList"
                    :key="cardJob.id"
                    xs12
                    sm6
                    md6
                    lg3
                    xl3
                >
                    <v-card class="mx-auto cardJob mb-5" max-width="300" min-height="250">
                        <div style="min-height: 190px !important;">
                            <v-card-title
                            class="job-title"
                            v-text="cardJob.title"
                        ></v-card-title>
                        <v-card-subtitle
                            class="job-type"
                            v-text="cardJob.type"
                        ></v-card-subtitle>
                        </div>

                        <v-card-actions>
                            <v-btn
                                class="job-explore-btn"
                                href="#"
                                target="_blank"
                                text
                            >
                                {{$t('others.explore')}}
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn
                                class="job-details-btn"
                                text
                                @click="cardJob.show = !cardJob.show"
                            >
                                {{
                                    cardJob.show
                                        ? "less details"
                                        : "more details"
                                }}
                            </v-btn>
                        </v-card-actions>

                        <v-expand-transition>
                            <div v-show="cardJob.show">
                                <v-divider></v-divider>
                                <v-card-text
                                    class="job-details"
                                    v-text="cardJob.description"
                                ></v-card-text>
                                <v-card-subtitle
                                    class="job-location"
                                    v-text="cardJob.location"
                                ></v-card-subtitle>
                            </div>
                        </v-expand-transition>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
        <div class="pagination mt-4 mb-2">
            <v-pagination
                v-model="page"
                :length="pages"
                @input="updatePage"
                circle
            ></v-pagination>
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
        };
    },

    props: ["cardsJobs"],

    methods: {
        initPage: function () {
            this.listCount = this.cardsJobs.length;
            if (this.listCount < this.pageSize) {
                this.historyList = this.cardsJobs;
            } else {
                this.historyList = this.cardsJobs.slice(0, this.pageSize);
            }
        },
        updatePage: function (pageIndex) {
            let _start = (pageIndex - 1) * this.pageSize;
            let _end = pageIndex * this.pageSize;
            this.historyList = this.cardsJobs.slice(_start, _end);
            this.page = pageIndex;
        },
    },
    mounted() {
        this.initPage();
        this.updatePage(this.page);
    },
    computed: {
        pages() {
            return this.pageSize == this.cardsJobs.length
                ? 1
                : parseInt(this.cardsJobs.length / this.pageSize + 1);
        },
    },
};
// export default {
//     data() {
//         return {
//             page: 1,
//             pageSize: 8,
//             listCount: 0,
//             historyList: [],
//         };
//     },

//     props: ["cardsJobs"],

//     methods: {
//         initPage: function () {
//             this.listCount = this.cardsJobs.length;
//             if (this.listCount < this.pageSize) {
//                 this.historyList = this.cardsJobs;
//             } else {
//                 this.historyList = this.cardsJobs.slice(0, this.pageSize);
//             }
//         },
//         updatePage: function (pageIndex) {
//             let _start = (pageIndex - 1) * this.pageSize;
//             let _end = pageIndex * this.pageSize;
//             this.historyList = this.cardsJobs.slice(_start, _end);
//             this.page = pageIndex;
//         },
//     },
//     mounted() {
//         console.log("====================================");
//         console.log(this.cardsJobs);
//         console.log("====================================");
//         this.initPage();
//         this.updatePage(this.page);
//     },
//     computed: {
//         pages() {
//             return this.pageSize == this.cardsJobs.length
//                 ? 1
//                 : parseInt(this.cardsJobs.length / this.pageSize + 1);
//         },
//     },
// };
</script>
