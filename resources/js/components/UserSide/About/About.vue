<template>
    <section class="about-section mt-12" v-if="!isLoading">
        <v-container fluid>
            <v-row>
                <v-col cols="12" md="7">
                    <div class="about-text">
                        <div class="pl-10">
                            <!-- <v-img :src="cssLogo" style="border: 2px solid red;"></v-img> -->
                            <h2  class="mb-5" v-html="website.title_long_introduction"></h2>
                            <!-- <div :style="cssLogo" style="border: 2px solid yellow;"></div> -->
                            <p v-html="website.long_description"></p>
                        </div>
                    </div>
                </v-col>
                <v-col class="d-flex justify-center flex-column" cols="12" md="5">
                    <div class="about-info mb-8">
                        <v-card class="info-card d-flex justify-center align-center" elevation="0">
                            <div class="icon d-inline-flex justify-center mr-6">
                                <v-icon class="icons" size="30px">mdi-email</v-icon>
                            </div>
                            <div class="text-icon d-flex flex-column align-start">
                                <p class="ma-0"><a :href="'mailto' + website.email">{{ website.email }}</a></p>
                            </div>
                        </v-card>
                    </div>
                    <div class="about-info mb-8" v-if="website.mobilePhones.length">
                        <v-card class="info-card d-flex justify-center align-center" elevation="0">
                            <div class="icon d-inline-flex justify-center mr-6">
                                <v-icon class="icons" size="30px">mdi-phone</v-icon>
                            </div>
                            <div class="text-icon d-flex flex-column align-start">
                                <p class="ma-0" v-for="tel in website.mobilePhones" :key="tel.id"><a :href="formatTelHref(tel.phone_number)"> {{ formatTelContent(tel.phone_number) }} </a></p>
                            </div>
                        </v-card>
                    </div>
                    <div class="about-info mb-8" v-if="website.fixPhones.length">
                        <v-card class="info-card d-flex justify-center align-center" elevation="0">
                            <div class="icon d-inline-flex justify-center mr-6">
                                <v-icon class="icons" size="30px">mdi-phone-classic</v-icon>
                            </div>
                            <div class="text-icon d-flex flex-column align-start">
                                <!-- <p class="ma-0"><a href="tel:+212520171818">05 20 17 18 18</a></p> -->
                                <p class="ma-0" v-for="tel in website.fixPhones" :key="tel.id"><a :href="formatTelHref(tel.phone_number)"> {{ formatTelContent(tel.phone_number) }} </a></p>
                            </div>
                        </v-card>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>

<script>
    import _array from 'lodash/array'

    export default {
        data() {
            return {
                // logo_path: '/img/logo-notbg.webp',
                isLoading: true,
                website: {
                    "mobilePhones": [],
                    "fixPhones": []
                }
            }
        },
        computed: {
            cssLogo() {
                return {
                    'logo_path': this.logo_path,
                }
            }
        },
        methods: {
            formatTelContent(tel) {
                return _array.chunk(tel.split(''), 2).map(x => x[0] + '' + x[1]).join(' ')
            },
            formatTelHref(tel) {
                return "tel:" + tel.replace("0", "+212")
            }
        },
        async mounted () {
            const { data } = await this.axios.get('/api/website')
            const mobilePhones = data[0].phones.filter( phone => phone.type == "mobile" )
            const fixPhones = data[0].phones.filter( phone => phone.type == "fix" )

            this.website = {
                ...data[0],
                "mobilePhones": mobilePhones,
                "fixPhones": fixPhones
            }

            console.log('====================================');
            console.log(this.website);
            console.log('====================================');

            this.isLoading = false;
        },
    }
</script>