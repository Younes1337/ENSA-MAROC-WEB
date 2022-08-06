<template>
    <section class="section-auto internships-section mt-6">
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
                    <v-card class="mx-auto cardInternship mb-5" max-width="300" min-height="250">
                        <div style="min-height: 190px !important;">
                            <v-card-title
                            class="internship-title"
                            v-text="cardJob.title"
                        ></v-card-title>
                        <v-card-subtitle
                            class="internship-type"
                            v-text="cardJob.type"
                        ></v-card-subtitle>
                        </div>

                        <v-card-actions>
                            <v-btn
                                class="internship-explore-btn"
                                href="#"
                                target="_blank"
                                text
                            >
                               {{$t('others.explore')}}
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn
                                class="internship-details-btn"
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
                                    class="internship-details"
                                    v-text="cardJob.description"
                                ></v-card-text>
                                <v-card-subtitle
                                    class="internship-location"
                                    v-text="cardJob.location"
                                ></v-card-subtitle>
                            </div>
                        </v-expand-transition>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
        <div class="pagination mt-4 mb-2">
            <!--:total-visible="4" -->
            <v-pagination
                v-model="page"
                :length="pageSize"
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

    props: ["cardsInternships"],

    methods: {},
    mounted() {},
    computed: {},
};
</script>
