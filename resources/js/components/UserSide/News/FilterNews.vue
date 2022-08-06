<template>
    <section class="mt-12" style="background-color: transparent !important;">
        <v-form ref="formFilter">
            <v-container class="pa-5 py-8" fluid>
                <v-row>
                    <v-col cols="12" xs="12" sm="6" md="4" lg="4">
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
                                    @click="formFilter0modal = false"
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
            date: "",
        });

        return {
            formFilter: Object.assign({}, defaultForm),
            currentDate: new Date(
                Date.now() - new Date().getTimezoneOffset() * 60000
            )
                .toISOString()
                .substr(0, 10),
        };
    },

};
</script>
