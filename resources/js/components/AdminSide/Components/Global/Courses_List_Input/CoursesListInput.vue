<template>
    <section class="section-admin">
        <v-col
            cols="12"
            xs="12"
            sm="12"
            md="12"
            lg="12"
            xl="12"
            class="pa-3 mb-6"
        >
            <v-card-title class="customized-label pt-0">
                Documents list
            </v-card-title>
            <v-data-table
                :disabled="disabled"
                :headers="selectedHeaders"
                :items="courses"
                sort-by="doc_title"
                color="deep-orange darken-1"
                class="elevation-1"
            >
                <template v-slot:top>
                    <v-toolbar flat class="d-flex justify-end align-start">
                        <v-dialog v-model="dialog" persistent max-width="600px">
                            <template
                                v-slot:activator="{ on, attrs }"
                                fill-height
                                fluid
                            >
                                <v-btn
                                    :disabled="disabled"
                                    class="btn-more text-center mt-md-2 pa-4"
                                    v-bind="attrs"
                                    v-on="on"
                                    rounded
                                >
                                    <v-icon left> mdi-plus-thick </v-icon>
                                    {{$t('admin.btn_add.doc')}}
                                </v-btn>
                            </template>
                            <v-card class="bg-image-app">
                                <v-form
                                    ref="form"
                                    v-model="valid"
                                    lazy-validation
                                >
                                    <v-card-title>
                                        <span
                                            class="text-h6"
                                            style="color: var(--orange-color)"
                                            >{{ $t(formTitle) }}</span
                                        >
                                    </v-card-title>
                                    <v-card-text>
                                        <v-row class="mt-2">
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
                                                    v-model="editedItem.doc_title"
                                                    placeholder="Document title"
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
                                                md="6"
                                                lg="6"
                                                xl="6"
                                            >
                                                <v-select
                                                    class="input-select"
                                                    v-model="editedItem.doc_type"
                                                    :items="doc_types"
                                                    placeholder="Document type"
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
                                                md="6"
                                                lg="6"
                                                xl="6"
                                            >
                                                <v-select
                                                    class="input-select"
                                                    v-model="editedItem.element_id"
                                                    :items="elements"
                                                    item-value="id"
                                                    item-text="title_element"
                                                    placeholder="Element"
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
                                                md="12"
                                                lg="12"
                                                xl="12"
                                            >
                                                <v-text-field
                                                    class="input-text"
                                                    color="deep-orange darken-1"
                                                    v-model="editedItem.doc_link"
                                                    placeholder="Google drive link"
                                                    text
                                                    solo
                                                    rounded
                                                    dense
                                                    clearable
                                                    required
                                                ></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="deep-orange darken-1"
                                            text
                                            @click="close"
                                        >
                                            {{$t('snackbar.close')}}
                                        </v-btn>
                                        <v-btn
                                            color="deep-orange darken-1"
                                            text
                                            :disabled="!valid"
                                            @click="save"
                                        >
                                            {{$t('admin.validate')}}
                                        </v-btn>
                                    </v-card-actions>
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
                                    {{$t('admin.text_remove.doc_text')}}
                                </v-card-title>
                                <v-card-text>
                                    {{$t('admin.text_remove.doc_subtext')}}
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
            </v-data-table>
        </v-col>
    </section>
</template>
<script>
export default {
    name: "DocumentsList",

    data() {
        return {
            valid: true,
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: "Document title",
                    align: "center",
                    sortable: true,
                    value: "doc_title",
                    width: "300"
                },
                {
                    text: "Document type",
                    value: "doc_type",
                    align: "center",
                    sortable: false,
                    width: "250"
                },
                {
                    text: "Google drive link",
                    value: "doc_link",
                    align: "center",
                    sortable: false,
                    width: "400"
                },
                {
                    text: "Actions",
                    value: "actions",
                    align: "center",
                    sortable: false,
                    width: "150",
                },
            ],
            ensas: [],
            doc_types: [
                "Courses",
                "Practical work / Directed work",
                "Exams"
            ],
            value: [],
            selectedHeaders: [],
            courses: [],
            editedIndex: -1,
            editedItem: {
                doc_title: "",
                doc_type: "",
                doc_link: "",
                element_id: this.elements[0].id,
                module_id: this.module
            },
            defaultItem: {
                doc_title: "",
                doc_type: "",
                doc_link: "",
                element_id: this.elements[0].id,
                module_id: this.module
            },

            rules: {
                // lastNameRule: [
                //     (v) => !!v || "Last name is required",
                //     (v) =>
                //         (v && v.length >= 3) ||
                //         "Last name can't be less than 3 characters",
                // ],
                // emailRule: [
                //     (v) => !!v || "E-mail is required",
                //     (v) => /.+@.+\..+/.test(v) || "Email must be valid",
                // ],
                // messageRule: [
                //     (v) => !!v || "Message content is required",
                //     (v) =>
                //         (v && v.length <= 250) ||
                //         "Message content must be less than 250 characters",
                // ],
            },
        };
    },

    props: ['elements', 'disabled', 'module'],

    watch: {},

    created() {},

    methods: {
        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        editItem(item) {
            this.editedIndex = this.ensas.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.ensas.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.ensas.splice(this.editedIndex, 1);
            this.axios.delete(`/api/admin/course/${this.editedItem.id}`).then((res) => {
                this.initialize();
            });
            this.closeDelete();
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        async save () {
            const valid = this.$refs.form.validate();

            if (valid) {
                if (this.editedIndex > -1) {
                    Object.assign(
                        this.ensas[this.editedIndex],
                        this.editedItem
                    );
                    console.log(this.editedItem);
                    this.axios
                        .patch(
                            `/api/admin/course/${this.editedItem.id}`,
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
                        if (this.editedItem.doc_type === "Practical work / Directed work")
                            this.editedItem.doc_type = "practical_directed_work"
                        else
                            this.editedItem.doc_type = this.editedItem.doc_type.toLowerCase()

                        const { data, status } = await this.axios.post('/api/admin/course', this.editedItem);
                    } catch (error) {
                        console.log(error);
                    }
                }
            }
        }
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "admin.form_title_add.doc" : "admin.form_title_edit.doc";
        }
    },

    async mounted() {
        console.log('====================================');
        console.log(this.disabled);
        console.log('====================================');
        if (this.editedIndex === -1) {
            const { data } = await this.axios.get(`/api/course/${this.module}/${this.module}`);
            this.courses = data;
        }
    }
};
</script>
