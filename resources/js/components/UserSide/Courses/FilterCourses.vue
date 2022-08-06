<template>
    <section class="mt-12">
        <v-form ref="formFilter">
            <v-container class="pa-5 py-8" fluid>
                <v-row>
                    <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                        <v-select
                            class="input-text"
                            v-model="formFilter.ensa"
                            prepend-inner-icon="mdi-town-hall"
                            placeholder="ENSA"
                            color="deep-orange darken-1"
                            :items="ensa_list"
                            item-text="title"
                            item-value="id"
                            solo
                            rounded
                            dense
                            clearable
                        ></v-select>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                        <v-select
                            class="input-text"
                            v-model="formFilter.cycle"
                            prepend-inner-icon="mdi-book-open-page-variant-outline"
                            placeholder="Cycles"
                            color="deep-orange darken-1"
                            :items="cycle_list"
                            item-text="title_cycle"
                            item-value="id"
                            :disabled="formFilter.ensa == null"
                            solo
                            rounded
                            dense
                            clearable
                        ></v-select>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                        <v-select
                            class="input-text"
                            v-model="formFilter.speciality"
                            prepend-inner-icon="mdi-source-branch"
                            placeholder="Specialties"
                            color="deep-orange darken-1"
                            :items="specialty_list"
                            item-text="title_specialty"
                            item-value="id"
                            :disabled="formFilter.ensa == null || formFilter.cycle == null"
                            solo
                            rounded
                            dense
                            clearable
                        ></v-select>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                        <v-select
                            class="input-text"
                            v-model="formFilter.semester"
                            prepend-inner-icon="mdi-source-branch"
                            placeholder="Semesters"
                            color="deep-orange darken-1"
                            :items="semester_list"
                            item-text="title_semester"
                            item-value="id"
                            :disabled="formFilter.ensa == null || formFilter.speciality == null || formFilter.cycle == null"
                            solo
                            rounded
                            dense
                            clearable
                        ></v-select>
                    </v-col>
                </v-row>
            </v-container>
        </v-form>
    </section>
</template>

<script>
export default {
    data() {
        return {
            formFilter: {
                ensa: null,
                speciality: null,
                cycle: null,
                semester: null
            },
            // list box modules :
            ensa_list: [],
            specialty_list: [],
            cycle_list: [],
            semester_list: [],
            modules: []
        };
    },

    watch: {
        'formFilter.ensa': async function (newVal, oldVal) {
            const { data } = await this.axios.get(`/api/cycle/${newVal}`);
            this.cycle_list = Array.from(data)
        },
        'formFilter.cycle': async function (newVal, oldVal) {
            const { data } = await this.axios.get(`/api/speciality/${this.formFilter.ensa}/${newVal}`);
            this.specialty_list = Array.from(data)
            console.log(data)

        },
        'formFilter.speciality': async function (newVal, oldVal) {
            const { data } = await this.axios.get(`/api/semester/${newVal}`);
            this.semester_list = Array.from(data)
        },
        'formFilter.semester': async function (newVal, oldVal) {
            const { data } = await this.axios.get(`/api/module/semester/${newVal}`);
            this.modules = Array.from(data)
            this.$emit('updateModules', this.modules);
        },
    },

    methods: {
        test() {
            console.log(this.formFilter);
        },
    },

    async mounted() {
        var { data } = await this.axios.get('/api/ensa');
        this.ensa_list = data.map( ensa => ({ title: ensa.title, id: ensa.id }));

        var { data } = await this.axios.get('/api/module');
        this.modules = data.map(module => ({ ...module, link:"/singleModule/" + module.id}));

        this.$emit('updateModules', this.modules);

        console.log(this.ensa_list)


    },

    updated() {},
};
</script>
