<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <HeaderFicheENSA :ENSAInfo="ENSAInfo"/>
        <section class="ficheensa-section">
            <v-app>
                <v-container fluid>
                    <v-row>
                        <v-col class="px-4" cols="12" xs="12" sm="12" md="8" lg="8" xl="8">
                            <RightCards :ENSAInfo="ENSAInfo"/>
                        </v-col>
                        <v-col class="px-4" cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                            <LeftCards :ENSAInfo="ENSAInfo"/>
                        </v-col>
                    </v-row>
                </v-container>
            </v-app>
        </section>
        <Footer/>
    </div>
</template>

<script>
    import NavigationMenu from '../Global/NavigationMenu.vue';
    import HeaderFicheENSA from '../FicheENSA/HeaderFicheENSA.vue';
    import RightCards from '../FicheENSA/RightCards.vue';
    import LeftCards from '../FicheENSA/LeftCards.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        data() {
            return {
                ENSAInfo: {}
            }
        },
        async mounted() {
            const id = this.$route.params.id
            const { data } = await this.axios.get('/api/ensa/' + id);
            this.ENSAInfo = data
        },
        components: {
            NavigationMenu,
            HeaderFicheENSA,
            LeftCards,
            RightCards,
            Footer
        }
    }
</script>