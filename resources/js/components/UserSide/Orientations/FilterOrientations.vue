<template>
    <section class="mt-12">
        <v-form ref="formFilter">
            <v-container class="pa-5 py-8" fluid>
                <v-row>
                    <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                        <v-select
                            class="input-text"
                            v-model="formFilter.level"
                            prepend-inner-icon="mdi-source-branch"
                            placeholder="Level"
                            color="deep-orange darken-1"
                            :items="level_list"
                            solo
                            rounded
                            dense
                            clearable
                        ></v-select>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                        <v-select
                            class="input-text"
                            v-model="formFilter.ensa"
                            prepend-inner-icon="mdi-town-hall"
                            placeholder="ENSA"
                            color="deep-orange darken-1"
                            :items="ensa_list"
                            :disabled="formFilter.level == null || formFilter.level == 'Baccalaureate'"
                            item-text="title"
                            item-value="id"
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
                level: null,
            },
            ensa_list: [],
            level_list: [
                "Baccalaureate",
                "Baccalaureate +2"
            ],
            orientations: []
        };
    },

    watch: {
        'formFilter.ensa': async function (newVal, oldVal) {
            if (newVal !== null) {
                const { data } = await this.axios.get(`/api/orientations/${newVal}/${this.formFilter.level}`);
                this.orientations = data

                this.$emit('updateOrientations', this.orientations);
            }
        },
    },

    // methods: {
    //     test() {
    //         console.log(this.formFilter);
    //     },
    // },

    async mounted() {
        var { data } = await this.axios.get('/api/ensa');
        this.ensa_list = data.map( ensa => ({ title: ensa.title, id: ensa.id }));

        var { data } = await this.axios.get(`/api/orientations`);
        this.orientations = data

        this.$emit('updateOrientations', this.orientations);
    },

    updated() {},
};
</script>