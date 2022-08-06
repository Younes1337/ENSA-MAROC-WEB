<template>
    <section class="section-admin">
        <v-col class="pa-3 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">{{$t('admin.title_faqs')}}</p>
        </v-col>

        <v-col class="pa-3 mb-10">
            <v-data-table
                :headers="selectedHeaders"
                :items="faqs"
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
                                >
                                    <v-icon left> mdi-plus-thick </v-icon>
                                    {{$t('admin.btn_add.faq')}}
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
                                                    md="12"
                                                    lg="12"
                                                    xl="12"
                                                >
                                                    <v-text-field
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        v-model="
                                                            editedItem.question
                                                        "
                                                        placeholder="Question"
                                                        :counter="500"
                                                        :rules="rules.questionRule"
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
                                                    md="12"
                                                    lg="12"
                                                    xl="12"
                                                >
                                                    <v-textarea
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        clear-icon="mdi-close"
                                                        v-model="
                                                            editedItem.answer
                                                        "
                                                        placeholder="Answer"
                                                        rows="3"
                                                        row-height="15"
                                                        :rules="rules.answerRule"
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        clearable
                                                        required
                                                    ></v-textarea>
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
                                    {{$t('admin.text_remove.faq_text')}}
                                </v-card-title>
                                <v-card-text>
                                    {{$t('admin.text_remove.faq_subtext')}}
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
                        @click="initialize; loader='loading';"
                        rounded
                        >{{$t('admin.reset')}}</v-btn
                    >
                </template>
                <template v-slot:[`item.published`]="{ item }">
                    <v-simple-checkbox
                        v-model="item.published"
                    ></v-simple-checkbox>
                </template>
            </v-data-table>
        </v-col>
    </section>
</template>

<script>
import { mdiAccount } from "@mdi/js";

export default {
    name: "FAQsList",

    data() {
        const self = this;
        return {
            loader: null,
            loading: false,
            valid: true,
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: "Question",
                    align: "center",
                    sortable: false,
                    value: "question",
                },
                {
                    text: "Answer",
                    value: "answer",
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
            faqs: [],
            editedIndex: -1,
            editedItem: {
                question: "",
                answer: "",
            },
            defaultItem: {
                question: "",
                answer: "",
            },

            rules: {
                questionRule: [
                    (v) => !!v || "Question is required",
                    (v) =>
                        (v && v.length >= 10) ||
                        "Question can't be less than 10 characters",
                    (v) => {
                        if (v.indexOf("?") > -1) {
                            return true;
                        } else {
                            return "Question mark is required";
                        }
                    },
                ],
                answerRule: [
                    (v) => !!v || "Answer content is required",
                ],
            },
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "admin.form_title_add.faq" : "admin.form_title_edit.faq";
        },
        era() {
            return JSON.parse(localStorage.getItem("auth")).to;
        },
    },

    mounted() {
        const toShow = [
            "question",
            "answer",
            "actions",
        ];
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

        loader() {
            const l = this.loader;
            this[l] = !this[l];

            setTimeout(() => (this[l] = false), 3000);

            this.loader = null;
        },

        // editedItem: {
        //     handler(val) {
        //         console.log("====================================");
        //         console.log(val);
        //         console.log("====================================");
        //     },
        //     deep: true,
        // },
    },

    created() {
        this.initialize();
    },

    methods: {
        async initialize() {
            const { data } = await this.axios.get(`/api/faq`);
            this.faqs = [];
            data.map(question => {
                this.faqs.push({...question, answer: question.response})
            })
        },

        editItem(item) {
            this.editedIndex = this.faqs.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.faqs.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.faqs.splice(this.editedIndex, 1);
            this.axios.delete(`/api/${this.era}/faq/${this.editedItem.id}`).then((res) => {
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
                        this.faqs[this.editedIndex],
                        this.editedItem
                    );
                    console.log(this.editedItem);
                    this.axios
                        .patch(
                            `/api/${this.era}/faq/${this.editedItem.id}`,
                            {...this.editedItem, response: this.editedItem.answer}
                        )
                        .then((res) => {
                            this.initialize();
                            this.close();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    try {
                        const { data } = await this.axios.post(
                            `/api/${this.era}/faq`,
                            {...this.editedItem, response: this.editedItem.answer}
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
