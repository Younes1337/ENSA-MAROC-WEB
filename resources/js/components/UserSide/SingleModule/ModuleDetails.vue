<template>
    <section class="singleModule-section">
        <v-card class="module-infos mb-8">
            <v-card-title class="card-title">{{ module.title_module }}</v-card-title>
            <v-card-text>
                <div class="card-content">
                    <v-row>
                        <v-col
                            class="pa-0 pl-3 my-3"
                            cols="12"
                            xs="12"
                            sm="12"
                            md="12"
                            lg="12"
                            xl="12"
                        >
                            <v-card
                                class="d-flex justify-start align-center"
                                elevation="0"
                                style="background-color: transparent"
                            >
                                <div
                                    class="d-flex flex-column align-start text-left"
                                >
                                    <!-- <p class="ma-0">
                                        {{ module.description }}
                                    </p> -->
                                </div>
                            </v-card>
                        </v-col>
                        <v-col
                            class="pa-0 pl-3 mb-3"
                            cols="12"
                            xs="12"
                            sm="12"
                            md="12"
                            lg="12"
                            xl="12"
                        >
                            <v-card
                                class="d-flex justify-start align-center"
                                elevation="0"
                                style="background-color: transparent"
                            >
                                <div class="d-inline-flex justify-center mr-3">
                                    <h4>ENSA:</h4>
                                </div>
                                <div class="d-flex flex-column align-start">
                                    <!-- <p class="ma-0">{{ ensaTitle }}</p> -->
                                </div>
                            </v-card>
                        </v-col>
                        <v-col
                            class="pa-0 pl-3 mb-3"
                            cols="12"
                            xs="12"
                            sm="12"
                            md="12"
                            lg="12"
                            xl="12"
                        >
                            <v-card
                                class="d-flex justify-start align-center"
                                elevation="0"
                                style="background-color: transparent"
                            >
                                <div class="d-inline-flex justify-center mr-3">
                                    <h4>Speciality:</h4>
                                </div>
                                <div class="d-flex flex-column align-start">
                                    <!-- <p class="ma-0">{{ speciality }}</p> -->
                                </div>
                            </v-card>
                        </v-col>
                        <v-col
                            class="pa-0 pl-3 mb-3"
                            cols="12"
                            xs="12"
                            sm="12"
                            md="12"
                            lg="12"
                            xl="12"
                        >
                            <v-card
                                class="d-flex justify-start align-center"
                                elevation="0"
                                style="background-color: transparent"
                            >
                                <div class="d-inline-flex justify-center mr-3">
                                    <h4>Semester:</h4>
                                </div>
                                <div class="d-flex flex-column align-start">
                                    <!-- <p class="ma-0">
                                        {{ semester }} - {{ cycle }}
                                    </p> -->
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </div>
            </v-card-text>
        </v-card>
    </section>
</template>
<script>
export default {
    data() {
        return {};
    },

    props: ['module'],

    computed: {
        ensaTitle() {
            return this.module.semester.cycle.speciality.ensa.title
            //console.log('ensatitle mounted')
        },
        speciality() {
            return this.module.semester.cycle.speciality.title_specialty;
            //console.log('speciality mounted')
        },
        semester() {
            return this.module.semester.title_semester
            //console.log('semester mounted')
        },
        cycle() {
            return this.module.semester.cycle.title_cycle
            //console.log('cycle mounted')

        },
    },
};
</script>

