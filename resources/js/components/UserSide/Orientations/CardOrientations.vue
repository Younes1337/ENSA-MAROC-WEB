<template>
    <section class="section-auto courses-section mt-6">
        <v-container fluid grid-list-md>
            <v-layout row wrap>
                <v-flex
                    v-for="orientation in orientations"
                    :key="orientation.id"
                    xs12
                    sm6
                    md6
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
                                v-text="orientation.title_exam"
                            ></v-card-title>
                        </div>

                        <v-card-actions class="d-flex justify-start align-center">
                            <v-btn
                                class="course-explore-btn"
                                :href='orientation.link_exam' target="_blank"
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
        };
    },
    methods: {
        initPage: function () {
            this.listCount = this.orientations.length;
            if (this.listCount < this.pageSize) {
                this.historyList = this.orientations;
            } else {
                this.historyList = this.orientations.slice(0, this.pageSize);
            }
        },
        updatePage: function (pageIndex) {
            let _start = (pageIndex - 1) * this.pageSize;
            let _end = pageIndex * this.pageSize;
            this.historyList = this.orientations.slice(_start, _end);
            this.page = pageIndex;
        },
    },
    props: ['orientations'],
    computed: {
        pages() {
            return this.pageSize == this.orientations.length
                ? 1
                : parseInt(this.orientations.length / this.pageSize + 1);
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