<template>
    <section class="mt-12">
        <v-form ref="formFilter">
            <v-container class="pa-5 py-8" fluid>
                <v-row>
                    <v-col cols="12" xs="12" sm="6" md="3" lg="3">
                        <v-dialog
                            ref="dialog"
                            v-model="formFilter.modal"
                            :return-value.sync="formFilter.date"
                            persistent
                            width="290px"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    class="input-text"
                                    color="deep-orange darken-1"
                                    v-model="formFilter.date"
                                    prepend-inner-icon="mdi-calendar-month-outline"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                    placeholder="Publication date"
                                    solo
                                    rounded
                                    dense
                                    clearable
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="formFilter.date"
                                color="deep-orange darken-1"
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    text
                                    color="deep-orange darken-1"
                                    @click="formFilter.modal = false"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    text
                                    color="deep-orange darken-1"
                                    @click="$refs.dialog.save(formFilter.date)"
                                >
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-dialog>
                    </v-col>
                    <v-col cols="12" xs="12" sm="6" md="3" lg="3">
                        <v-text-field
                            class="input-text"
                            v-model="formFilter.title"
                            color="deep-orange darken-1"
                            prepend-inner-icon="mdi-briefcase-outline"
                            placeholder="Profile title"
                            text
                            solo
                            rounded
                            dense
                            clearable
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" xs="12" sm="6" md="3" lg="3">
                        <v-text-field
                            class="input-text"
                            v-model="formFilter.city"
                            color="deep-orange darken-1"
                            prepend-inner-icon="mdi-city-variant-outline"
                            placeholder="City"
                            text
                            solo
                            rounded
                            dense
                            clearable
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" xs="12" sm="6" md="3" lg="3">
                        <v-select
                            class="input-text"
                            v-model="formFilter.contract"
                            prepend-inner-icon="mdi-file-document-edit-outline"
                            placeholder="Employment contract"
                            color="deep-orange darken-1"
                            :items="contracts"
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
        const defaultForm = Object.freeze({
            modal: false,
            date: '',
            title: null,
            city: null,
            contract: null,
        });

        return {
            formFilter: Object.assign({}, defaultForm),
            currentDate: new Date(
                Date.now() - new Date().getTimezoneOffset() * 60000
            )
                .toISOString()
                .substr(0, 10),

            contracts: [
                "Full-time",
                "Part-time",
                "Freelance",
                "Study contract",
            ],
        };
    },

    watch: {
        formFilter: {
            handler(val) {
                this.send(val);
            },
            deep: true,
        },
    },

    methods: {
        async send(val) {
            console.log("====================================");
            console.log("before request");
            console.log("====================================");
            const { data } = await this.axios.get("/api/jobs", {
                params: { ...val },
            });
            console.log("====================================");
            console.log("after request");
            console.log("====================================");

            //Emitting data to parent
            this.$emit("updateJobs", data);
        },
    },

    mounted() {
        this.send(this.formFilter);
    },

    updated() {},
};
</script>
