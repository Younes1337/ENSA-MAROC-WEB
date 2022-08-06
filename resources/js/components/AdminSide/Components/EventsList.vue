<template>
    <section class="section-admin">
        <v-col class="pa-3 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">
                {{ $t("admin.title_events") }}
            </p>
        </v-col>

        <v-col class="pa-3 mb-10">
            <v-data-table
                :headers="selectedHeaders"
                :items="events"
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
                                    {{ $t("admin.btn_add.event") }}
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
                                                        placeholder="Miniature"
                                                        accept="image/png, image/jpeg, image/jpg, image/webp, image/gif, image/svg"
                                                        prepend-icon=""
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
                                                        :counter="90"
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
                                                        v-model="
                                                            editedItem.e_n_s_a_id
                                                        "
                                                        :items="ensas"
                                                        placeholder="ENSA"
                                                        color="deep-orange darken-1"
                                                        item-text="title"
                                                        item-value="id"
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
                                                        v-model="editedItem.short_description"
                                                        placeholder="Short description"
                                                        hint="This is a short introduction about event, it will be displayed on card."
                                                        rows="3"
                                                        row-height="15"
                                                        :counter="100"
                                                        :rules="rules.shortDescription"
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
                                                        v-model="editedItem.description"
                                                        required
                                                    />
                                                </v-col>

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="6"
                                                    lg="6"
                                                    xl="6"
                                                >
                                                    <v-combobox
                                                        class="input-text chips-input"
                                                        v-model="
                                                            editedItem.tags
                                                        "
                                                        color="deep-orange darken-1"
                                                        placeholder="Tags"
                                                        label="Tags"
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
                                                                @click:close="removeTags(item)"
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
                                                    md="3"
                                                    lg="3"
                                                    xl="3"
                                                >
                                                    <v-text-field
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        v-model="
                                                            editedItem.city
                                                        "
                                                        placeholder="City"
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        clearable
                                                        required
                                                    ></v-text-field>
                                                </v-col>

                                                <!-- <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="3"
                                                    lg="3"
                                                    xl="3"
                                                >
                                                    <v-dialog
                                                        ref="dialog"
                                                        v-model="editedItem.event_date"
                                                        :return-value.sync="editedItem.event_date"
                                                        persistent
                                                        width="290px"
                                                    >
                                                        <template
                                                            v-slot:activator="{
                                                                on,
                                                                attrs,
                                                            }"
                                                        >
                                                            <v-text-field
                                                                class="input-text"
                                                                color="deep-orange darken-1"
                                                                v-model="editedItem.event_date"
                                                                v-bind="attrs"
                                                                v-on="on"
                                                                placeholder="Event Date"
                                                                solo
                                                                rounded
                                                                dense
                                                                clearable
                                                            ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                            v-model="currentDate"
                                                            color="deep-orange darken-1"
                                                            scrollable
                                                        >
                                                            <v-spacer></v-spacer>
                                                            <v-btn
                                                                text
                                                                color="deep-orange darken-1"
                                                                @click="
                                                                    modal_date = false
                                                                "
                                                            >
                                                                Cancel
                                                            </v-btn>
                                                            <v-btn
                                                                text
                                                                color="deep-orange darken-1"
                                                                @click="
                                                                    $refs.dialog.save(
                                                                        date
                                                                    )
                                                                "
                                                            >
                                                                OK
                                                            </v-btn>
                                                        </v-date-picker>
                                                    </v-dialog>
                                                </v-col> -->

                                                <!-- <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="6"
                                                    lg="6"
                                                    xl="6"
                                                >
                                                <v-card-title
                                                        class="customized-label"
                                                    >
                                                        Start time
                                                    </v-card-title>
                                                    <v-time-picker
                                                        class="input-text time-picker"
                                                        color="deep-orange darken-1"
                                                        format="24hr"
                                                        v-model="editedItem.start_at"
                                                        landscape
                                                        scrollable
                                                        placeholder="End time"
                                                        solo
                                                        rounded
                                                        dense
                                                        clearable
                                                        full-width
                                                    ></v-time-picker>
                                                </v-col>

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="6"
                                                    lg="6"
                                                    xl="6"
                                                >
                                                <v-card-title
                                                        class="customized-label"
                                                    >
                                                        End time
                                                    </v-card-title>
                                                    <v-time-picker
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        format="24hr"
                                                        v-model="editedItem.end_at"
                                                        landscape
                                                        scrollable
                                                        placeholder="End time"
                                                        solo
                                                        rounded
                                                        dense
                                                        clearable
                                                        full-width
                                                    ></v-time-picker>
                                                </v-col> -->
                                                <v-datetime-picker
                                                    v-model="editedItem.start_at"
                                                    label="Event start date and time"
                                                >
                                                    <template slot="dateIcon">
                                                        <v-icon
                                                            >mdi-calendar-outline</v-icon
                                                        >
                                                    </template>
                                                    <template slot="timeIcon">
                                                        <v-icon
                                                            >mdi-clock-outline</v-icon
                                                        >
                                                    </template></v-datetime-picker
                                                >
                                                <v-datetime-picker
                                                    v-model="editedItem.end_at"
                                                    label="Event end date and time"
                                                >
                                                    <template slot="dateIcon">
                                                        <v-icon
                                                            >mdi-calendar-outline</v-icon
                                                        >
                                                    </template>
                                                    <template slot="timeIcon">
                                                        <v-icon
                                                            >mdi-clock-outline</v-icon
                                                        >
                                                    </template></v-datetime-picker
                                                >
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
                                    {{ $t("admin.text_remove.event_text") }}
                                </v-card-title>
                                <v-card-text>
                                    {{ $t("admin.text_remove.event_subtext") }}
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
    name: "EventsList",

    components: {
        Editor,
    },

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
                    text: "Title",
                    value: "title",
                    align: "center",
                    sortable: false,
                    width: "300",
                },
                {
                    text: "Description",
                    value: "description",
                    align: "center",
                    sortable: false,
                    width: "600",
                },
                {
                    text: "Short description",
                    value: "short_description",
                    align: "center",
                    sortable: false,
                    width: "600",
                },
                {
                    text: "Miniature",
                    value: "image",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "City",
                    value: "city",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Tags",
                    value: "tags",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Start at",
                    value: "start_at",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "End at",
                    value: "end_at",
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
            events: [],
            editedIndex: -1,
            editedItem: {
                image: null,
                title: "",
                description: "",
                short_description: "",
                city: "",
                tags: [],
                start_at: null,
                end_at: null,
                e_n_s_a_id: "",
            },
            defaultItem: {
                image: null,
                title: "",
                description: "",
                short_description: "",
                city: "",
                tags: [],
                start_at: null,
                end_at: null,
                e_n_s_a_id: "",
            },

            rules: {
                shortDescription: [
                    (v) => !!v || "short description is required",
                    (v) =>
                        (v && v.length >= 100) ||
                        "short description can't be more than 100 characters",
                ]
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

    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "admin.form_title_add.event"
                : "admin.form_title_edit.event";
        },
        era() {
            return JSON.parse(localStorage.getItem("auth")).to;
        },
    },

    async mounted() {
        const { data } = await this.axios.get(`/api/ensa`);
        this.ensas = data.map((ensa) => ({ title: ensa.title, id: ensa.id }));

        const toShow = ["title", "city", "start_at", "end_at", "actions"];
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
    },

    created() {
        this.initialize();
    },

    methods: {
        async initialize() {
            const { data } = await this.axios.get(`/api/events`);
            this.events = data;
        },

        removeTags(item) {
            this.editedItem.tags.splice(this.editedItem.tags.indexOf(item), 1);
            this.editedItem.tags = [...this.editedItem.tags];
        },

        editItem(item) {
            this.editedIndex = this.events.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.events.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.events.splice(this.editedIndex, 1);
            this.axios
                .delete(`/api/${this.era}/event/${this.editedItem.id}`)
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

        formatDateTime(dateTime) {
            return dateTime.getUTCFullYear() + "/" +
                ("0" + (dateTime.getUTCMonth()+1)).slice(-2) + "/" +
                ("0" + dateTime.getUTCDate()).slice(-2) + " " +
                ("0" + dateTime.getUTCHours()).slice(-2) + ":" +
                ("0" + dateTime.getUTCMinutes()).slice(-2) + ":" +
                ("0" + dateTime.getUTCSeconds()).slice(-2);
        },

        async save() {
            const valid = this.$refs.form.validate();

            var start_at = this.formatDateTime(this.editedItem.start_at);
            var end_at = this.formatDateTime(this.editedItem.end_at);

            this.editedItem.start_at = start_at;
            this.editedItem.end_at = end_at;

            let formData = new FormData();

            Object.entries(this.editedItem).forEach(([key, value]) => {
                formData.append(key, value);
            });

            if (valid) {
                if (this.editedIndex > -1) {
                    Object.assign(
                        this.events[this.editedIndex],
                        this.editedItem
                    );
                    console.log(this.editedItem);
                    this.axios
                        .patch(
                            `/api/${this.era}/event/${this.editedItem.id}`,
                            this.editedItem
                        )
                        .then((res) => {
                            console.log(res.data);
                            // this.close();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    try {
                        const { data } = await this.axios.post(
                            `/api/${this.era}/event`,
                            formData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }
                        );
                        console.log(data);
                        this.events.push(data);
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
