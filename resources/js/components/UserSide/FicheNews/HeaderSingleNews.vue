<template>
    <section class="ficheCEN-section mt-12">
        <v-container fluid>
            <v-row>
                <v-col cols="12" sm="12" md="12" lg="12" xl="12">
                    <v-card class="header-ficheCEN d-flex">
                        <v-row style="position: relative; z-index: 10;" class="pa-4">
                            <v-col cols="12" sm="12" md="5" lg="5" xl="5">
                                <v-img :src="newsInfo.image" cover style="opacity: 1; border-radius: 20px;" min-height="300" max-width="450"></v-img>
                            </v-col>
                            <v-col cols="12" sm="12" md="7" lg="7" xl="7" class="d-flex align-center">
                                <h1 style="position: relative;">{{ newsInfo.title }}</h1>
                            </v-col>
                        </v-row>
                        <v-img
                            :src="newsInfo.image"
                            class="cover-picturee"
                            style="z-index: 1;"
                            cover
                        >
                            <div class="bg-overlay"></div>
                        </v-img>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>
<script>
export default {
    data() {
        return {
            bg_img: "https://www.info-afrique.com/wp-content/uploads/2012/10/news-info-afrique.jpg",
        };
    },
    methods: {},

    props: ["newsInfo"],

    async mounted() {},
};
</script>
