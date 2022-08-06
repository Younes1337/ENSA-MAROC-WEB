<template>
    <section class="section-admin">
        <v-col class="pa-3 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">
                {{ $t("admin.title_clubs") }}
            </p>
        </v-col>

        <v-col class="pa-3 mb-10">
            <v-data-table
                :headers="selectedHeaders"
                :items="clubs"
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
                                    {{ $t("admin.btn_add.club") }}
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
                                                {{ $t("admin.validate") }}
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
                                                    md="6"
                                                    lg="6"
                                                    xl="6"
                                                >
                                                    <v-file-input
                                                        truncate-length="50"
                                                        v-model="
                                                            editedItem.image
                                                        "
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        placeholder="miniature"
                                                        accept="image/png, image/jpeg, image/jpg, image/webp, image/gif, image/svg"
                                                        prepend-icon="mdi-image-outline"
                                                        :rules="rules.miniatureRules"
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        counter
                                                        clearable
                                                        show-size
                                                    ></v-file-input>
                                                </v-col>

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="6"
                                                    lg="6"
                                                    xl="6"
                                                >
                                                    <v-text-field
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        v-model="
                                                            editedItem.title
                                                        "
                                                        placeholder="Title"
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
                                                    md="6"
                                                    lg="6"
                                                    xl="6"
                                                >
                                                    <v-select
                                                        class="input-select"
                                                        v-model="
                                                            editedItem.e_n_s_a_id
                                                        "
                                                        :items="ensas"
                                                        placeholder="ENSA"
                                                        color="deep-orange darken-1"
                                                        item-text="title"
                                                        item-value="id"
                                                        :rules="rules.ensaRules"
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
                                                    md="6"
                                                    lg="6"
                                                    xl="6"
                                                >
                                                    <v-select
                                                        class="input-select"
                                                        v-model="
                                                            editedItem.category
                                                        "
                                                        :items="[
                                                            'Arts',
                                                            'Business',
                                                            'Sports',
                                                            'Education',
                                                            'General Interest',
                                                            'Health Professions',
                                                            'Language and Culture',
                                                            'History, Law and Politics',
                                                            'Publications and Media',
                                                            'Service and Social Justice',
                                                            'Student Governance',
                                                            'Wellness',
                                                            'Other',
                                                        ]"
                                                        placeholder="Category"
                                                        color="deep-orange darken-1"
                                                        :rules="rules.categoryRules"
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
                                                    <v-textarea
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        clear-icon="mdi-close"
                                                        v-model="
                                                            editedItem.short_description
                                                        "
                                                        placeholder="Short description"
                                                        hint="This is a short introduction about club, it will be displayed on card."
                                                        rows="3"
                                                        row-height="15"
                                                        :counter="100"
                                                        :rules="rules.shortDescriptionRules"
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
                                                    <v-card-title
                                                        class="customized-label"
                                                    >
                                                        Description
                                                    </v-card-title>
                                                    <editor
                                                        v-model="
                                                            editedItem.description
                                                        "
                                                    />
                                                    <span v-text="errors[0]" style="color: red; font-size: 12px;"></span>
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
                                    {{ $t("admin.text_remove.club_text") }}
                                </v-card-title>
                                <v-card-text>
                                    {{ $t("admin.text_remove.club_subtext") }}
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="deep-orange darken-1"
                                        text
                                        @click="closeDelete"
                                        >{{ $t("admin.cancel") }}</v-btn
                                    >
                                    <v-btn
                                        color="deep-orange darken-1"
                                        text
                                        @click="deleteItemConfirm"
                                        >{{ $t("admin.remove") }}</v-btn
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
                        @click="
                            initialize;
                            loader = 'loading';
                        "
                        rounded
                        >{{ $t("admin.reset") }}</v-btn
                    >
                </template>
            </v-data-table>
        </v-col>
    </section>
</template>

<script>
import { mdiAccount } from "@mdi/js";
import Editor from "./Global/Rich_Text/Editor.vue";

export default {
    name: "ClubsList",

    components: {
        Editor,
    },

    data() {
        return {
            errors: [],
            ensas: [],
            loader: null,
            loading: false,
            valid: true,
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: "Title",
                    align: "center",
                    sortable: false,
                    value: "title",
                    width: "400",
                },
                {
                    text: "Category",
                    value: "category",
                    align: "center",
                    sortable: false,
                    width: "200",
                },
                {
                    text: "Description",
                    value: "description",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Short description",
                    value: "short_description",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "ENSA",
                    value: "ensa",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Miniatue",
                    value: "image",
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
            value: [],
            selectedHeaders: [],
            clubs: [],
            editedIndex: -1,
            editedItem: {
                image: null,
                title: "",
                description: "",
                short_description: "",
                e_n_s_a_id: 1,
                category: "",
            },
            defaultItem: {
                image: null,
                title: "",
                description: "",
                short_description: "",
                e_n_s_a_id: 1,
                category: "",
            },

            rules: {
                miniatureRules: [
                    (v) => !!v || "Miniature is required",
                    (v) => (v && v.size > 0) || 'Miniature is required',
                ],
                titleRules: [
                    (v) => !!v || "News title is required",
                    (v) =>
                        (v && v.length >= 2) ||
                        "News title can't be less than 2 characters",
                ],
                ensaRules: [
                    (v) => !!v || 'Please choose an ENSA, is required',
                ],
                categoryRules: [
                    (v) => !!v || 'Please choose a category, is required',
                ],
                shortDescriptionRules: [
                    (v) => !!v || 'Short description is required',
                    (v) =>
                        (v && v.length >= 50) ||
                        "Short description can't be less than 50 characters",
                ],
            },
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "admin.form_title_add.club"
                : "admin.form_title_edit.club";
        },
        era() {
            return JSON.parse(localStorage.getItem("auth")).to;
        },
    },

    async mounted() {
        const { data } = await this.axios.get(`/api/ensa`);
        this.ensas = data.map((ensa) => ({ title: ensa.title, id: ensa.id }));

        const toShow = ["title", "category", "e_n_s_a_id", "actions"];
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
            const { data } = await this.axios.get(`/api/clubs`);
            this.clubs = data;
        },

        editItem(item) {
            this.editedIndex = this.clubs.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.clubs.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.clubs.splice(this.editedIndex, 1);
            this.axios
                .delete(`/api/admin/club/${this.editedItem.id}`)
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
            if (this.editedItem.description.length == 0) {
                this.errors.push("Description is required");
            } else {
                this.errors.splice(this.errors.indexOf("Description is required"), 1);
            }

            const valid = this.$refs.form.validate();

            this.$delete(this.editedItem, "created_at");
            this.$delete(this.editedItem, "updated_at");
            this.$delete(this.editedItem, "ensa");

            var formData = new FormData();
            Object.entries(this.editedItem).forEach(([key, value]) => {
                formData.append(key, value);
            });

            if (valid) {
                if (this.editedIndex > -1) {
                    Object.assign(
                        this.clubs[this.editedIndex],
                        this.editedItem
                    );
                    this.axios
                        .put(
                            `/api/${this.era}/club/${this.editedItem.id}`,
                            formData
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
                            `/api/${this.era}/club`,
                            formData
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
