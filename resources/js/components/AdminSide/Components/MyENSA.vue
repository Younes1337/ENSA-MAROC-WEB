<template>
    <section class="section-admin">
        <v-col class="pa-3 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">
                {{ $t("admin.title_my_ensa") }}
            </p>
        </v-col>

        <v-col
            class="pa-3 text-center"
            cols="12"
            xs="12"
            sm="12"
            md="12"
            lg="12"
            xl="12"
        >
            <v-form ref="form" v-model="valid" lazy-validation>
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
                                    v-model="myensa.logo"
                                    class="input-text"
                                    color="deep-orange darken-1"
                                    placeholder="Logo"
                                    accept="image/png, image/jpeg, image/jpg, image/webp, image/gif, image/svg"
                                    prepend-icon="mdi-image-outline"
                                    :rules="rules.logoRules"
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
                                <v-file-input
                                    truncate-length="50"
                                    v-model="myensa.cover_picture"
                                    class="input-text"
                                    color="deep-orange darken-1"
                                    placeholder="Cover picture"
                                    accept="image/png, image/jpeg, image/jpg, image/webp, image/gif, image/svg"
                                    prepend-icon="mdi-image-outline"
                                    :rules="rules.coverRules"
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
                                class="uploadP mb-3"
                                cols="12"
                                xs="12"
                                sm="12"
                                md="12"
                                lg="12"
                                xl="12"
                            >
                                <UploadImages
                                    uploadMsg="Upload ENSA pictures (These pictures will be displayed in the gallery page and in the single page of the ENSA)"
                                    fileError="Images files only accepted"
                                    clearAll="Remove all ENSA pictures"
                                />
                            </v-col>

                            <v-col
                                cols="12"
                                xs="12"
                                sm="6"
                                md="2"
                                lg="2"
                                xl="2"
                            >
                                <v-sheet
                                    class="d-flex justify-center"
                                    style="background-color: transparent"
                                >
                                    <v-switch
                                        class="pa-0 ma-0 pt-2"
                                        v-model="myensa.published"
                                        color="deep-orange darken-1"
                                        inset
                                        :label="`${publish}`"
                                        @click="publishChange"
                                    ></v-switch>
                                </v-sheet>
                            </v-col>

                            <v-col
                                cols="12"
                                xs="12"
                                sm="6"
                                md="2"
                                lg="2"
                                xl="2"
                            >
                                <v-text-field
                                    class="input-text"
                                    color="deep-orange darken-1"
                                    prefix="ENSA"
                                    v-model="myensa.title"
                                    placeholder="Title"
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
                                sm="6"
                                md="4"
                                lg="4"
                                xl="4"
                            >
                                <v-text-field
                                    class="input-text"
                                    color="deep-orange darken-1"
                                    v-model="myensa.city"
                                    placeholder="City"
                                    :rules="rules.cityRules"
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
                                sm="6"
                                md="4"
                                lg="4"
                                xl="4"
                            >
                                <v-combobox
                                    class="input-text chips-input"
                                    v-model="myensa.title_specialty"
                                    color="deep-orange darken-1"
                                    placeholder="Specialties"
                                    label="Specialties"
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
                                            @click:close="removeSpecialty(item)"
                                        >
                                            {{ item }}
                                        </v-chip>
                                    </template>
                                </v-combobox>
                            </v-col>

                            <v-col
                                cols="12"
                                xs="12"
                                sm="6"
                                md="4"
                                lg="4"
                                xl="4"
                            >
                                <v-combobox
                                    class="input-text chips-input"
                                    v-model="myensa.emails"
                                    :items="myensa.emails"
                                    color="deep-orange darken-1"
                                    placeholder="Emails"
                                    label="Emails"
                                    hint="Press 'Enter' key to create a new one"
                                    :rules="rules.emailRules"
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
                                            @click:close="removeEmail(item)"
                                            >{{ item.email }}</v-chip
                                        >
                                    </template>
                                </v-combobox>
                            </v-col>

                            <v-col
                                cols="12"
                                xs="12"
                                sm="6"
                                md="4"
                                lg="4"
                                xl="4"
                            >
                                <v-combobox
                                    class="input-text chips-input"
                                    v-model="myensa.phones"
                                    :items="myensa.phones"
                                    color="deep-orange darken-1"
                                    placeholder="Phones"
                                    label="Phones"
                                    hint="Press 'Enter' key to create a new one"
                                    :rules="rules.phoneRules"
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
                                            @click:close="removePhone(item)"
                                            >{{ item.phone_number }}</v-chip
                                        >
                                    </template>
                                </v-combobox>
                            </v-col>

                            <v-col
                                cols="12"
                                xs="12"
                                sm="6"
                                md="4"
                                lg="4"
                                xl="4"
                            >
                                <v-text-field
                                    class="input-text"
                                    color="deep-orange darken-1"
                                    v-model="myensa.website"
                                    placeholder="Website"
                                    :rules="rules.websiteRules"
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
                                <v-textarea
                                    class="input-text"
                                    color="deep-orange darken-1"
                                    clear-icon="mdi-close"
                                    v-model="myensa.address"
                                    placeholder="Adresse"
                                    rows="1"
                                    row-height="15"
                                    :counter="200"
                                    :rules="rules.addressRules"
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
                                <v-select
                                    class="input-select"
                                    v-model="myensa.campus"
                                    :items="['girls and boys', 'girls', 'boys']"
                                    placeholder="Campus"
                                    color="deep-orange darken-1"
                                    :rules="rules.compusRules"
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
                                md="4"
                                lg="4"
                                xl="4"
                            >
                                <v-select
                                    class="input-select"
                                    v-model="myensa.restaurants"
                                    :items="['girls and boys', 'girls', 'boys']"
                                    placeholder="Restaurants"
                                    color="deep-orange darken-1"
                                    :rules="rules.restaurantRules"
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
                                    v-model="myensa.carte"
                                    placeholder="Map"
                                    rows="2"
                                    row-height="15"
                                    :rules="rules.mapRules"
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
                                <v-card-title class="customized-label">
                                    Introduction
                                </v-card-title>
                                <editor v-model="myensa.intro" required />
                            </v-col>

                            <v-col
                                cols="12"
                                xs="12"
                                sm="12"
                                md="12"
                                lg="12"
                                xl="12"
                            >
                                <v-card-title class="customized-label">
                                    Cooperation
                                </v-card-title>
                                <editor
                                    v-model="myensa.cooperation"
                                    required
                                />
                            </v-col>
                            <v-col
                                cols="12"
                                xs="12"
                                sm="12"
                                md="12"
                                lg="12"
                                xl="12"
                            >
                                <v-card-title class="customized-label">
                                    Initial education
                                </v-card-title>
                                <editor
                                    v-model="myensa.initial_education"
                                    required
                                />
                            </v-col>
                            <v-col
                                cols="12"
                                xs="12"
                                sm="12"
                                md="12"
                                lg="12"
                                xl="12"
                            >
                                <v-card-title class="customized-label">
                                    Continuing education
                                </v-card-title>
                                <editor
                                    v-model="myensa.continuing_education"
                                    required
                                />
                            </v-col>
                        </v-row>
                    </v-container>
            </v-form>
        </v-col>

        <v-col
            class="pa-3 text-center"
            cols="12"
            xs="12"
            sm="12"
            md="12"
            lg="12"
            xl="12"
        >
            <v-btn
                class="btn-more text-center pa-4 mb-8"
                rounded
                :disabled="!valid"
                @click="save"
            >
                {{ $t("admin.save") }}
            </v-btn>
        </v-col>
    </section>
</template>
<script>
import { mdiAccount } from "@mdi/js";
import Editor from "./Global/Rich_Text/Editor.vue";
import UploadImages from "vue-upload-drop-images";

export default {
    name: "EnsasList",

    components: {
        Editor,
        UploadImages,
    },

    data() {
        const self = this;
        return {
            loader: null,
            loading: false,
            valid: true,
            dialog: false,
            dialogDelete: false,
            value: [],
            selectedHeaders: [],
            ensas: [],
            editedIndex: -1,
            publish: "Not published",
            myensa: {
                id: "",
                title: "",
                type: "Ecole d'ingenieur",
                intro: "",
                emails: [],
                phones: [],
                city: "",
                continuing_education: "",
                initial_education: "",
                carte: "",
                website: "",
                address: "",
                campus: "",
                title_specialty: [],
                restaurants: "",
                published: false,
                logo: null,
                cover_picture: null,
                cooperation: "",
            },

            rules: {
                logoRules: [
                    (v) => !!v || "Avatar is required",
                    (v) => (v && v.size > 0) || "Avatar is required",
                ],
                coverRules: [
                    (v) => !!v || "Avatar is required",
                    (v) => (v && v.size > 0) || "Avatar is required",
                ],
                titleRules: [
                    (v) => !!v || "ENSA title is required",
                    (v) =>
                        (v && v.length >= 2) ||
                        "ENSA title can't be less than 2 characters",
                ],
                cityRules: [
                    (v) => !!v || "City is required",
                    (v) =>
                        (v && v.length >= 2) ||
                        "City can't be less than 2 characters",
                ],
                websiteRules: [
                    (v) => !!v || "Website URL is required",
                    (v) =>
                        (v && v.length >= 20) ||
                        "Website URL can't be less than 20 characters",
                    (v) =>
                        /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(
                            v
                        ) || "Website URL must be valid",
                ],
                addressRules: [
                    (v) =>
                        (v && v.length >= 10) ||
                        "Address can't be less than 10 characters",
                ],
                compusRules: [
                    (v) => !!v || "Please choose a compus, is required",
                ],
                restaurantRules: [
                    (v) => !!v || "Please choose a restaurant, is required",
                ],
                mapRules: [
                    (v) => !!v || "Map tag is required",
                    (v) =>
                        (v && v.length >= 50) ||
                        "Map tag can't be less than 50 characters",
                ],
                emailRules: [
                    (v) => (v && v.length >= 0) || "E-mail is required",
                    (v) => /.+@.+\..+/.test(v) || "Email must be valid",
                ],
            },
        };
    },

    computed: {
        era() {
            return JSON.parse(localStorage.getItem("auth")).to;
        },
    },

    mounted() {},

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
    },

    created() {
        this.initialize();
    },

    methods: {
        async initialize() {
            const { data } = await this.axios.get(`/api/ensa`);
            this.ensas = data;
        },
        removeEmail(item) {
            this.myensa.emails.splice(this.myensa.emails.indexOf(item), 1);
            this.myensa.emails = [...this.myensa.emails];
        },

        async removePhone(item) {
            this.myensa.phones.splice(this.myensa.phones.indexOf(item), 1);
            const { data } = await this.axios.delete(
                `/api/admin/phone/${item.id}`
            );
            this.myensa.phones = [...this.myensa.phones];
        },
        removeSpecialty(item) {
            this.myensa.title_specialty.splice(
                this.myensa.title_specialty.indexOf(item),
                1
            );
            this.myensa.title_specialty = [...this.myensa.title_specialty];
        },

        publishChange: function () {
            if (this.myensa.published == false) {
                this.publish = "Not published";
            } else {
                this.publish = "Published";
            }
        },

        async save() {},
    },
};
</script>
