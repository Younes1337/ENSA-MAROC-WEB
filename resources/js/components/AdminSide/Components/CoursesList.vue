<template>
    <section class="section-admin">
        <v-col class="pa-3 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">{{$t('admin.title_docs')}}</p>
        </v-col>

        <v-col class="pa-3 mb-10">
            <v-data-table
                :headers="selectedHeaders"
                :items="modules"
                sort-by="title_module"
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
                                >
                                    <v-icon left> mdi-plus-thick </v-icon>
                                    {{$t('admin.btn_add.module')}}
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
                                                    <v-select
                                                        class="input-select"
                                                        v-model="editedItem.e_n_s_a_id"
                                                        :items="ensas"
                                                        placeholder="ENSA"
                                                        color="deep-orange darken-1"
                                                        item-text="title"
                                                        item-value="id"
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
                                                        v-model="editedItem.specialty"
                                                        :items="specialities"
                                                        item-text="title_specialty"
                                                        item-value="id"
                                                        placeholder="Specialty"
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
                                                        v-model="editedItem.cycle"
                                                        :items="cycles"
                                                        item-text="title_cycle"
                                                        item-value="id"
                                                        placeholder="Cycles"
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
                                                        v-model="editedItem.semester"
                                                        :items="semesters"
                                                        item-value="id"
                                                        item-text="title_semester"
                                                        placeholder="Semester"
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
                                                    <v-textarea
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        clear-icon="mdi-close"
                                                        v-model="editedItem.title_module"
                                                        placeholder="Module title"
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        clearable
                                                        required
                                                    ></v-textarea>
                                                </v-col>

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-combobox
                                                        class="input-text chips-input"
                                                        v-model="editedItem.elements"
                                                        :items="elements"
                                                        color="deep-orange darken-1"
                                                        placeholder="Elements title"
                                                        label="Elements title"
                                                        hint="Press 'Enter' key to create a new one"
                                                        chips
                                                        clearable
                                                        multiple
                                                        solo
                                                        rounded
                                                        dense
                                                        required
                                                    >
                                                        <template
                                                            v-slot:selection="{
                                                                attrs,
                                                                item,
                                                                select,
                                                                selected,
                                                            }"
                                                        >
                                                            <v-chip
                                                                class="my-1"
                                                                v-bind="attrs"
                                                                :input-value="selected"
                                                                close
                                                                @click="select"
                                                                @click:close="removeElement(item)"
                                                                >{{
                                                                    item
                                                                }}</v-chip
                                                            >
                                                        </template>
                                                    </v-combobox>
                                                </v-col>

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="12"
                                                    lg="12"
                                                    xl="12"
                                                >
                                                    <v-textarea
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        clear-icon="mdi-close"
                                                        v-model="editedItem.module_description"
                                                        placeholder="Module description"
                                                        rows="3"
                                                        row-height="15"
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        clearable
                                                        required
                                                    ></v-textarea>
                                                </v-col>

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="12"
                                                    lg="12"
                                                    xl="12"
                                                >
                                                    <coursesListInput :disabled="coursesListDisabled" :elements="editedItem.elements" :module="editedItem.id"/>
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
                                    {{$t('admin.text_remove.module_text')}}
                                </v-card-title>
                                <v-card-text>
                                    {{$t('admin.text_remove.module_subtext')}}
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
import CoursesListInput from "./Global/Courses_List_Input/CoursesListInput.vue";
export default {
    name: "DocumentsList",

    components: {
        CoursesListInput,
    },

    data() {
        return {
            loader: null,
            loading: false,
            valid: true,
            dialog: false,
            coursesListDisabled: true,
            dialogDelete: false,
            headers: [
                {
                    text: "Module title",
                    align: "center",
                    sortable: false,
                    value: "title_module",
                },
                {
                    text: "Description",
                    align: "center",
                    sortable: false,
                    value: "module_description",
                },
                {
                    text: "Speciality",
                    align: "center",
                    sortable: false,
                    value: "semester.speciality.title_specialty",
                },
                {
                    text: "Semester",
                    value: "semester.title_semester",
                    align: "center",
                    sortable: false,
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
            modules: [],
            specialities: [],
            cycles: [],
            semesters: [],
            elements: [],
            value: [],
            selectedHeaders: [],
            documents: [],
            editedIndex: -1,
            editedItem: {
                id: 0,
                title_module: "",
                module_description: "",
                id_semester: 1,
                elements: []
            },
            defaultItem: {
                id: 0,
                title_module: "",
                module_description: "",
                id_semester: 1,
                elements: []
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

    watch: {
        "elements": function (newValue, oldValue) {
            editedItem.elements.push({title_element: newValue});
        },
        'editedItem.e_n_s_a_id': async function (newVal, oldVal) {
            const { data } = await this.axios.get(`/api/speciality/${newVal}`);
            this.specialities = data
        },
        'editedItem.specialty': async function (newVal, oldVal) {
            const { data } = await this.axios.get(`/api/cycle/${newVal}`);
            this.cycles = data
        },
        'editedItem.cycle': async function (newVal, oldVal) {
            const { data } = await this.axios.get(`/api/semester/${newVal}`);
            this.semesters = data
        },

        // 'editedItem.semester': async function (newVal, oldVal) {
        //     const { data } = await this.axios.get(`/api/module/semester/${newVal}`);
        //     this.modules = data
        // },
        // 'editedItem.title_module': async function (newVal, oldVal) {
        //     const module = this.modules.filter(md => md.title_module === newVal);
        //     const { data } = await this.axios.get(`/api/element/${module.id}`);
        //     this.elements = data
        // },
        // 'editedItem.element': async function (newVal, oldVal) {
        //     const { data } = await this.axios.get(`/api/course/${newVal}`);
        //     this.documents = data
        // },
        loader() {
            const l = this.loader;
            this[l] = !this[l];

            setTimeout(() => (this[l] = false), 3000);

            this.loader = null;
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

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "admin.form_title_add.doc" : "admin.form_title_edit.doc";
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        async initialize() {
            const { data } = await this.axios.get(`/api/module`);
            this.modules = data;
        },

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

        removeElement(item) {
            this.editedItem.elements.splice(
                this.editedItem.elements.indexOf(item),
                1
            );
            this.editedItem.elements = [...this.editedItem.elements];
        },

        deleteItem(item) {
            this.editedIndex = this.modules.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.modules.splice(this.editedIndex, 1);
            this.axios
                .delete(`/api/admin/module/${this.editedItem.id}`)
                .then((res) => {
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
                            `/api/admin/module/${this.editedItem.id}`,
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
                        const { data, status } = await this.axios.post('/api/admin/module', this.editedItem);
                        if (status === 201) {
                            this.initialize();
                            this.coursesListDisabled = false;
                            this.editedItem.id = data.module.id;
                            this.editedItem.elements = data.elements;
                            // this.close();
                        }
                    } catch (error) {
                        console.log(error);
                    }
                }
            }

        }
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "admin.form_title_add.module" : "admin.form_title_edit.module";
        }
    },

    async mounted() {
        const toShow = [
            "title_module",
            "module_description",
            "actions",
        ];
        this.value = this.headers.filter((obj) => {
            return toShow.includes(obj.value);
        });

        const { data } = await this.axios.get(`/api/ensa`);
        this.ensas = data.map((ensa) => ({ title: ensa.title, id: ensa.id }));
    }
};
</script>
