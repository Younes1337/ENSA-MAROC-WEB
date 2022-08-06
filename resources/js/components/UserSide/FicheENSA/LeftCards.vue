<template>
    <div>
        <v-card class="ficheENSA-card-left mb-8">
            <v-card-title class="card-title" v-html="$t('fiche_ensa.infos')"></v-card-title>
            <v-card-text>
                <div class="card-content">
                    <v-card class="d-flex justify-start align-center mb-3" elevation="0">
                        <div class="d-inline-flex justify-center mr-3">
                            <h3 v-html="$t('fiche_ensa.sub_infos.city') + ':'"></h3>
                        </div>
                        <div class="d-flex flex-column align-start">
                            <p class="ma-0">{{ ENSAInfo.city }}</p>
                        </div>
                    </v-card>

                    <v-card class="d-flex justify-start align-start mb-3" elevation="0">
                        <div class="d-inline-flex justify-center mr-3">
                            <h3 v-html="$t('fiche_ensa.sub_infos.phone') + ':'"></h3>
                        </div>
                        <div class="d-flex flex-column align-start">
                            <p class="ma-0" v-for="phone of ENSAInfo.phones" :key="phone.id">
                                <a :href="formatTelHref(phone.phone_number)">{{ formatTelContent(phone.phone_number) }}</a>
                            </p>
                        </div>
                    </v-card>

                    <v-card class="d-flex justify-start align-start mb-3" elevation="0">
                        <div class="d-inline-flex justify-center mr-3">
                            <h3 v-html="$t('fiche_ensa.sub_infos.email') + ':'"></h3>
                        </div>
                        <div class="d-flex flex-column align-start">
                            <p class="ma-0">{{ENSAInfo.email}}</p>
                        </div>
                    </v-card>

                    <v-card class="d-flex justify-start align-center mb-3" elevation="0">
                        <div class="d-inline-flex justify-center mr-3">
                            <h3 v-html="$t('fiche_ensa.sub_infos.website') + ':'"></h3>
                        </div>
                        <div class="d-flex flex-column align-start">
                            <p class="ma-0"><a :href="ENSAInfo.website" target="_blank">{{ENSAInfo.website}}</a></p>
                        </div>
                    </v-card>

                    <v-card class="d-flex justify-start align-center mb-3" elevation="0">
                        <div class="d-inline-flex justify-center mr-3">
                            <h3 v-html="$t('fiche_ensa.sub_infos.establishment') + ':'"></h3>
                        </div>
                        <div class="d-flex flex-column align-start">
                            <p class="ma-0">{{ENSAInfo.type}}</p>
                        </div>
                    </v-card>

                    <v-card class="d-flex justify-start align-start mb-3" elevation="0">
                        <div class="d-inline-flex justify-center mr-3">
                            <h3 v-html="$t('fiche_ensa.sub_infos.address') + ':'"></h3>
                        </div>
                        <div class="d-flex flex-column align-start">
                            <p class="ma-0">{{ENSAInfo.address}}</p>
                        </div>
                    </v-card>

                    <v-card class="d-flex justify-start align-center mb-3" elevation="0">
                        <div class="d-inline-flex justify-center mr-3">
                            <h3 v-html="$t('fiche_ensa.sub_infos.campus') + ':'"></h3>
                        </div>
                        <div class="d-flex flex-column align-start">
                            <p class="ma-0" v-if="ENSAInfo.campus === 'girls_and_boys'">for girls and boys</p>
                            <p class="ma-0" v-else>{{ENSAInfo.campus}}</p>
                        </div>
                    </v-card>

                    <v-card class="d-flex justify-start align-center mb-3" elevation="0">
                        <div class="d-inline-flex justify-center mr-3">
                            <h3 v-html="$t('fiche_ensa.sub_infos.restaurants') + ':'"></h3>
                        </div>
                        <div class="d-flex flex-column align-start">
                            <p class="ma-0" v-if="ENSAInfo.restaurants === 'girls_and_boys'">for girls and boys</p>
                            <p class="ma-0" v-else>{{ENSAInfo.restaurants}}</p>
                        </div>
                    </v-card>
                </div>
            </v-card-text>
        </v-card>
        <v-card class="ficheENSA-card-left mb-8">
            <v-card-title class="card-title" v-html="$t('fiche_ensa.map')"></v-card-title>
            <v-card-text>
                <div class="card-content">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13485.770343854805!2d-9.2636605!3d32.326826!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8f039c8e14c1a1af!2s%C3%89cole%20nationale%20des%20sciences%20appliqu%C3%A9es%20de%20Safi!5e0!3m2!1sfr!2sma!4v1644542428807!5m2!1sfr!2sma" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </v-card-text>
        </v-card>
        <v-card class="ficheENSA-card-left mb-8">
            <v-card-title class="card-title" v-html="$t('fiche_ensa.clubs')"></v-card-title>
            <v-card-text>
                <div class="card-content">
                    <v-card v-for="club in latestClubs" :key="club.id"  class="pa-0 mb-3" elevation="0">
                        <v-list-item class="pa-0">
                            <v-list-item-avatar
                                class="ma-0 mr-3"
                                rounded
                                width="150"
                                height="auto"
                            >
                                <v-img :src="club.image" cover></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <div class="card-mini-title mb-4">
                                    {{club.title}}
                                </div>
                                <v-list-item-title class="mb-1">
                                    <router-link :to="{ name: 'news' }" class="align-self-baseline read-more">
                                        <span v-html="$t('others.more_infos')"></span>
                                        <v-icon class="icons" size="20px">mdi-chevron-right</v-icon>
                                    </router-link>
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-card>
                </div>
            </v-card-text>
            <v-btn class="btn-more text-center mb-5 pa-0 px-3" to="/clubs" rounded> {{$t('others.view_more')}} </v-btn>
        </v-card>
        <v-card class="ficheENSA-card-left mb-8">
            <v-card-title class="card-title" v-html="$t('fiche_ensa.events')"></v-card-title>
            <v-card-text>
                <div class="card-content">
                    <v-card v-for="event in latestEvents" :key="event.id" class="pa-0 mb-3" elevation="0">
                        <v-list-item class="pa-0">
                            <v-list-item-avatar
                                class="ma-0 mr-3"
                                rounded
                                width="150"
                                height="auto"
                            >
                                <v-img src="https://transcribeprint.co.uk/wp-content/uploads/2017/03/event.jpg" cover></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <div class="card-mini-title mb-4">
                                    Lorem ipsum dolor
                                </div>
                                <v-list-item-title class="mb-1">
                                    <a href="#" class="align-self-baseline read-more">
                                        <span v-html="$t('others.more_infos')"></span>
                                        <v-icon class="icons" size="20px">mdi-chevron-right</v-icon>
                                    </a>
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-card>
                </div>
            </v-card-text>
            <v-btn class="btn-more text-center mb-5 pa-0 px-3" :to="{ name: 'events' }" rounded> {{$t('others.view_more')}} </v-btn>
        </v-card>
    </div>
</template>
<script>
    import _array from 'lodash/array'
    export default {
        data: () => ({}),

        props: ["ENSAInfo"],

        methods: {
            formatTelContent(tel) {
                return _array.chunk(tel.split(''), 2).map(x => x[0] + '' + x[1]).join(' ')
            },
            formatTelHref(tel) {
                return "tel:" + tel.replace("0", "+212")
            }
        },

        mounted () {
        },

        computed: {
            latestClubs() {
                return this.ENSAInfo.clubs.slice(this.ENSAInfo.clubs.length - 3)
            },
            latestEvents() {
                return this.ENSAInfo.events.slice(this.ENSAInfo.events.length - 3)
            }
        },
    }
</script>