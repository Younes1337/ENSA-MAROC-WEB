<template>
    <section class="section-auto clubs-section mt-6">
        <v-container fluid grid-list-md>
            <v-layout row wrap>
                <v-flex
                    v-for="club in historyList"
                    :key="club.id"
                    xs12
                    sm6
                    md6
                    lg3
                    xl3
                >
                    <v-card class="ma-2 pa-3" max-width="280"
                        height="390">
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
                            class="d-flex justify-space-between pa-0 pt-6"
                        >
                            <router-link
                                :to="'/singleClub/' + club.id"
                                class="align-self-baseline read-more"
                            >
                                <span class="caption" v-html="$t('others.more_infos')"></span>
                                <v-icon class="icons" size="20px"
                                    >mdi-chevron-right</v-icon
                                >
                            </router-link>
                            <p class="align-self-baseline ensa-location ma-0">
                                {{ club.ensa }}
                            </p>
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
            clubs: [],
            listCount: 0,
            historyList: [],
        };
    },
    methods: {
        initPage: function () {
            this.listCount = this.clubs.length;
            if (this.listCount < this.pageSize) {
                this.historyList = this.clubs;
            } else {
                this.historyList = this.clubs.slice(0, this.pageSize);
            }
        },
        updatePage: function (pageIndex) {
            let _start = (pageIndex - 1) * this.pageSize;
            let _end = pageIndex * this.pageSize;
            this.historyList = this.clubs.slice(_start, _end);
            this.page = pageIndex;
        },
    },
    async mounted() {
        const { data } = await this.axios.get("/api/clubs");
        data.map((club) => {
            this.clubs.push({
                ...club,
                show: false,
            });
        });
        this.initPage();
        this.updatePage(this.page);
    },
    computed: {
        pages() {
            return this.pageSize == this.clubs.length
                ? 1
                : parseInt(this.clubs.length / this.pageSize + 1);
        },
    },
};
</script>
