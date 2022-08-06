<template>
    <section class="ficheCEN-section mt-12">
        <v-container fluid>
            <v-row>
                <v-col cols="12" sm="12" md="12" lg="12" xl="12">
                    <v-card class="header-ficheCEN d-flex">
                        <v-row style="position: relative; z-index: 10;" class="pa-4">
                            <v-col cols="12" sm="12" md="5" lg="5" xl="5">
                                <v-img :src="EventInfo.image" cover style="opacity: 1; border-radius: 20px;" min-height="300" max-width="450"></v-img>
                            </v-col>
                            <v-col cols="12" sm="12" md="7" lg="7" xl="7" class="d-flex align-center">
                                <h1 style="position: relative;">{{ EventInfo.title }}</h1>
                            </v-col>
                        </v-row>
                        <v-img
                            :src="EventInfo.image"
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
            bg_img: "https://media.istockphoto.com/photos/man-speaking-at-a-business-conference-picture-id499517325?b=1&k=20&m=499517325&s=170667a&w=0&h=jMCaZov25c5VR1CP-4axUdJPEKSpBWbzzWAubQS3-oo=",
        };
    },
    methods: {},

    props: ['EventInfo'],

    async mounted() {},
};
</script>