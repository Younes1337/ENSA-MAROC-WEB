<template>
    <section class="section-admin">
        <v-col class="pa-3 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">{{$t('admin.title_exams')}}</p>
        </v-col>

        <v-col class="pa-3 mb-10">
            <v-data-table
                :headers="selectedHeaders"
                :items="orientations"
                sort-by="title"
                color="deep-orange darken-1"
                class="elevation-1"
            >
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-select
                            class="input-select table-select mt-md-8 mb-0 pa-0"
                            v-model="value"
                            :items="headers"
                            label="Select Item"
                            color="deep-orange darken-1"
                            multiple
                            return-object
                            solo
                            rounded
                            dense
                        >
                            <template v-slot:selection="{ item, index }">
                                <v-chip v-if="index === 0">
                                    <span>{{ item.text }}</span>
                                </v-chip>
                                <span
                                    v-if="index === 1"
                                    class="grey--text caption"
                                    color="deep-orange darken-1"
                                    >(+{{ value.length - 1 }} others)</span
                                >
                            </template>
                        </v-select>
                        <v-spacer></v-spacer>
                        <v-dialog
                            v-model="dialog"
                            fullscreen
                            hide-overlay
                            persistent
                            transition="dialog-bottom-transition"
                            :retain-focus="false"
                        >
                            <template
                                v-slot:activator="{ on, attrs }"
                                fill-height
                                fluid
                            >
                                <v-btn
                                    class="btn-more text-center mt-md-2 pa-4"
                                    v-bind="attrs"
                                    v-on="on"
                                    rounded
                                    ><v-icon left> mdi-plus-thick </v-icon>
                                    {{$t('admin.btn_add.exam')}}
                                </v-btn>
                            </template>
                            <v-card class="bg-image-app">
                                <v-form
                                    ref="form"
                                    v-model="valid"
                                    lazy-validation
                                >
                                    <v-toolbar
                                        dark
                                        color="deep-orange darken-1"
                                    >
                                        <v-btn icon dark @click="close">
                                            <v-icon>mdi-close</v-icon>
                                        </v-btn>
                                        <v-toolbar-title>{{
                                            $t(formTitle)
                                        }}</v-toolbar-title>
                                        <v-spacer></v-spacer>
                                        <v-toolbar-items>
                                            <v-btn
                                                dark
                                                text
                                                :disabled="!valid"
                                                @click="save"
                                            >
                                                {{$t('admin.validate')}}
                                            </v-btn>
                                        </v-toolbar-items>
                                    </v-toolbar>
                                    <v-card-text>
                                        <v-container>
                                            <v-row>
                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-text-field
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        v-model="editedItem.title_exam"
                                                        placeholder="Exam title"
                                                        :counter="40"
                                                        :rules="rules.titleRules"
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        clearable
                                                        required
                                                    ></v-text-field>
                                                </v-col>

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-select
                                                        class="input-select"
                                                        v-model="editedItem.level_exam"
                                                        :items="levels"
                                                        :rules="rules.levelRules"
                                                        placeholder="Level exam"
                                                        color="deep-orange darken-1"
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        clearable
                                                        required
                                                    ></v-select>
                                                </v-col>

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-select
                                                        class="input-select"
                                                        v-model="editedItem.e_n_s_a_id"
                                                        :rules="rules.ensaRules"
                                                        :items="ensas"
                                                        item-value="id"
                                                        item-text="title"
                                                        placeholder="ENSA"
                                                        color="deep-orange darken-1"
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        required
                                                    ></v-select>
                                                </v-col>

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="12"
                                                    lg="12"
                                                    xl="12"
                                                >
                                                    <v-text-field
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        v-model="editedItem.link_exam"
                                                        placeholder="Google drive link"
                                                        :rules="rules.linkRules"
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        clearable
                                                        required
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-card-text>
                                </v-form>
                            </v-card>
                        </v-dialog>
                        <v-dialog
                            v-model="dialogDelete"
                            max-width="300px"
                            persistent
                        >
                            <v-card>
                                <v-card-title class="text-h5">
                                    {{$t('admin.text_remove.exam_text')}}
                                </v-card-title>
                                <v-card-text>
                                    {{$t('admin.text_remove.exam_subtext')}}
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="deep-orange darken-1"
                                        text
                                        @click="closeDelete"
                                        >{{$t('admin.cancel')}}</v-btn
                                    >
                                    <v-btn
                                        color="deep-orange darken-1"
                                        text
                                        @click="deleteItemConfirm"
                                        >{{$t('admin.remove')}}</v-btn
                                    >
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>
                <template v-slot:[`item.actions`]="{ item }">
                    <v-btn
                        class="ma-1"
                        color="deep-purple darken-3"
                        fab
                        x-small
                        @click="editItem(item)"
                    >
                        <v-icon color="white">mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn
                        class="ma-1"
                        color="deep-purple darken-3"
                        fab
                        x-small
                        @click="deleteItem(item)"
                    >
                        <v-icon color="white">mdi-delete</v-icon>
                    </v-btn>
                </template>
                <template v-slot:no-data>
                    <v-btn
                        class="btn-more-mini text-center"
                        :loading="loading"
                        :disabled="loading"
                        @click="initialize;loader = 'loading';"
                        rounded
                        >{{$t('admin.reset')}}</v-btn
                    >
                </template>
            </v-data-table>
        </v-col>
    </section>
</template>

<script>
import { mdiAccount } from "@mdi/js";

export default {
    name: "OrientationsList",

    data() {
        return {
            ensas: [],
            loader: null,
            loading: false,
            valid: true,
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: "Exam title",
                    align: "center",
                    sortable: false,
                    value: "title_exam",
                    width: "400",
                },
                {
                    text: "Exam type",
                    value: "level_exam",
                    align: "center",
                    sortable: false,
                    width: "250",
                },
                {
                    text: "Google drive link",
                    value: "link_exam",
                    align: "center",
                    sortable: false,
                    width: "400",
                },
                {
                    text: "Actions",
                    value: "actions",
                    align: "center",
                    sortable: false,
                    width: "150",
                },
            ],
            levels: [
                "Baccalaureate",
                "Baccalaureate +2"
            ],
            value: [],
            selectedHeaders: [],
            orientations: [],
            editedIndex: -1,
            editedItem: {
                e_n_s_a_id: "",
                title_exam: "",
                level_exam: "",
                link_exam: "",
            },
            defaultItem: {
                e_n_s_a_id: "",
                title_exam: "",
                level_exam: "",
                link_exam: "",
            },

            rules: {
                titleRules: [
                    (v) => !!v || "Exam title is required",
                    (v) =>
                        (v && v.length >= 3) ||
                        "Title can't be less than 3 characters",
                ],
                levelRules: [
                    (v) => !!v || "Please choose a level, is required",
                ],
                ensaRules: [
                    (v) => !!v || "Please choose an ENSA, is required",
                ],
                linkRules: [
                    (v) => !!v || "Link of exam is required",
                    (v) =>
                        (v && v.length >= 20) ||
                        "Link of exam can't be less than 20 characters",
                    (v) => /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(v) || "Link of exam must be valid",
                ],
            },
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "admin.form_title_add.exam" : "admin.form_title_edit.exam";
        }
    },

    async mounted() {
        const { data } = await this.axios.get(`/api/ensa`);
        this.ensas = data.map(ensa => ({title: ensa.title, id: ensa.id}))

        const toShow = ["title_exam", "level_exam", "link_exam", "actions"];
        this.value = this.headers.filter((obj) => {
            return toShow.includes(obj.value);
        });
    },

    watch: {
        editedItem: {
            handler(val) {
                console.log("====================================");
                console.log(val);
                console.log("====================================");
            },
            deep: true,
        },
        value(val) {
            this.selectedHeaders = val;
        },
        created() {
            this.selectedHeaders = this.headers;
        },

        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        async initialize() {
            const { data } = await this.axios.get(`/api/admin/orientation`);
            this.orientations = data;
        },

        editItem(item) {
            this.editedIndex = this.orientations.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.orientations.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.orientations.splice(this.editedIndex, 1);
            this.axios
                .delete(`/api/admin/orientation/${this.editedItem.id}`)
                .then((res) => {
                    this.initialize();
                });
            this.closeDelete();
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        async save() {
            const valid = this.$refs.form.validate();

            if (valid) {
                if (this.editedIndex > -1) {
                    Object.assign(
                        this.orientations[this.editedIndex],
                        this.editedItem
                    );
                    this.axios
                        .put(
                            `/api/admin/orientation/${this.editedItem.id}`,
                            this.editedItem
                        )
                        .then((res) => {
                            console.log(res.data);
                            this.close();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    try {
                        const { data } = await this.axios.post(
                            `/api/admin/orientation`,
                            this.editedItem
                        );
                        this.initialize();
                        this.close();
                    } catch (error) {
                        console.log(error);
                    }
                }
            }
        },
    },
};
</script>
<style>
.input-select.table-select {
    max-width: 50%;
}
</style>
