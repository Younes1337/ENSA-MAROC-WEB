<template>
    <div class="bg-image-app">
        <NavigationMenu/>
        <section class="mt-10">
            <v-app>
                <v-container fluid>
                    <v-row class="px-8">
                        <v-col class="px-4" cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                            <ModuleDetails :module="module"/>
                        </v-col>
                        <v-col class="px-4" cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                            <ModuleCourses :elements="module.elements" :documents="module.documents"/>
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
    import ModuleDetails from '../SingleModule/ModuleDetails.vue';
    import ModuleCourses from '../SingleModule/ModuleCourses.vue';
    import Footer from '../Global/Footer.vue';

    export default {
        data() {
            return {
                module: {
                    elements: [],
                    documents: [],
                }
            }
        },
        components: {
            NavigationMenu,
            ModuleDetails,
            ModuleCourses,
            Footer
        },
        async mounted () {
            const id = this.$route.params.id;
            const { data } = await this.axios.get(`/api/module/${id}`);
            this.module = data
            
        }
    }
</script>

<style>
    .v-application.v-application--is-ltr.theme--light {
        background-color: transparent !important;
    }
</style>