<template>
    <section class="section-admin">

        <v-col class="pa-3 mt-5 d-inline-flex">

            <div class="vertical-div"></div>

            <p class="page-admin-title ma-0 ml-2">

                {{ $t("admin.title_ensas") }}

            </p>

        </v-col>



        <v-col class="pa-3 mb-10">

            <v-data-table :headers="selectedHeaders" :items="ensas" sort-by="title" color="deep-orange darken-1" class="elevation-1">

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
                            <template v-slot:activator="{ on, attrs }" fill-height fluid>
                                <v-btn class="btn-more text-center mt-md-2 pa-4" v-bind="attrs" v-on="on" rounded>

                                    <v-icon left> mdi-plus-thick </v-icon>

                                    {{ $t("admin.btn_add.ensa") }}

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
                                                        v-model="editedItem.logo"
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        placeholder="Logo"
                                                        accept="image/png, image/jpeg, image/jpg, image/webp, image/gif, image/svg"
                                                        prepend-icon="mdi-image-outline"
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
                                                        v-model="
                                                            editedItem.cover_picture
                                                        "
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        placeholder="Cover picture"
                                                        accept="image/png, image/jpeg, image/jpg, image/webp, image/gif, image/svg"
                                                        prepend-icon="mdi-image-outline"
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
                                                        @changed="handleImages"
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
                                                        style="
                                                            background-color: transparent;
                                                        "
                                                    >
                                                        <v-switch
                                                            class="pa-0 ma-0 pt-2"
                                                            v-model="
                                                                editedItem.published
                                                            "
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
                                                        v-model="editedItem.title"
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
                                                        v-model="editedItem.city"
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
                                                        v-model="editedItem.specialities"
                                                        :items="editedItem.specialities"
                                                        color="deep-orange darken-1"
                                                        placeholder="Specialities"
                                                        label="Specialities"
                                                        hint="Press 'Enter' key to create a new one"
                                                        chips
                                                        clearable
                                                        multiple
                                                        solo
                                                        rounded
                                                        dense
                                                        required
                                                    >
                                                        <template v-slot:selection="{ attrs, item, select, selected, }">
                                                            <v-chip class="my-1" v-bind="attrs" :input-value="selected" close @click="select"
                                                                @click:close="removeSpecialty(item)">
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
                                                        v-model="editedItem.emails"
                                                        :items="editedItem.emails"
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
                                                    sm="6"
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-combobox
                                                        class="input-text chips-input"
                                                        v-model="editedItem.phones"
                                                        :items="editedItem.phones"
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
                                                    sm="6"
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-combobox
                                                        class="input-text chips-input"
                                                        v-model="editedItem.fixes"
                                                        :items="editedItem.fixes"
                                                        color="deep-orange darken-1"
                                                        placeholder="Fixes"
                                                        label="Fixes"
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
                                                                @click:close="removeFix(item)"
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
                                                    sm="6"
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-text-field
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        v-model="
                                                            editedItem.website
                                                        "
                                                        placeholder="Website"
                                                        :rules="
                                                            rules.websiteRules
                                                        "
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
                                                        v-model="
                                                            editedItem.address
                                                        "
                                                        placeholder="Adresse"
                                                        rows="1"
                                                        row-height="15"
                                                        :counter="200"
                                                        :rules="
                                                            rules.addressRules
                                                        "
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
                                                        v-model="
                                                            editedItem.campus
                                                        "
                                                        :items="[
                                                            'girls and boys',
                                                            'girls',
                                                            'boys',
                                                            'none'
                                                        ]"
                                                        placeholder="Campus"
                                                        color="deep-orange darken-1"
                                                        :rules="
                                                            rules.compusRules
                                                        "
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
                                                        v-model="editedItem.restaurants"
                                                        :items="[
                                                            'girls and boys',
                                                            'girls',
                                                            'boys',
                                                            'none'
                                                        ]"
                                                        placeholder="Restaurants"
                                                        color="deep-orange darken-1"
                                                        :rules="
                                                            rules.restaurantRules
                                                        "
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
                                                            editedItem.carte
                                                        "
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
                                                    <v-card-title
                                                        class="customized-label"
                                                    >
                                                        Introduction
                                                    </v-card-title>
                                                    <editor
                                                        v-model="
                                                            editedItem.intro
                                                        "
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
                                                    <v-card-title
                                                        class="customized-label"
                                                    >
                                                        Cooperation
                                                    </v-card-title>
                                                    <editor
                                                        v-model="
                                                            editedItem.cooperation
                                                        "
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
                                                    <v-card-title
                                                        class="customized-label"
                                                    >
                                                        Initial education
                                                    </v-card-title>
                                                    <editor
                                                        v-model="
                                                            editedItem.initial_education
                                                        "
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
                                                    <v-card-title
                                                        class="customized-label"
                                                    >
                                                        Continuing education
                                                    </v-card-title>
                                                    <editor
                                                        v-model="editedItem.continuing_education"
                                                        required
                                                    />
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
                                    {{ $t("admin.text_remove.ensa_text") }}
                                </v-card-title>
                                <v-card-text>
                                    {{ $t("admin.text_remove.ensa_subtext") }}
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="deep-orange darken-1"
                                        text
                                        @click="closeDelete"
                                    >
                                        {{ $t("admin.cancel") }}
                                    </v-btn>
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
    <v-btn class="ma-1" color="deep-purple darken-3" fab x-small @click="editItem(item)">

        <v-icon color="white">mdi-pencil</v-icon>

    </v-btn>

    <v-btn class="ma-1" color="deep-purple darken-3" fab x-small @click="deleteItem(item)">

        <v-icon color="white">mdi-delete</v-icon>

    </v-btn>
</template>
<template v-slot:no-data>
    <v-btn class="btn-more-mini text-center" :loading="loading" :disabled="loading" @click="

                                initialize;

                                loader = 'loading';

                            " rounded>

        {{ $t("admin.reset") }}</v-btn>
</template>
<template v-slot:[`item.published`]="{ item }">
    <v-simple-checkbox v-model="item.published">

    </v-simple-checkbox>
</template>
            </v-data-table>
        </v-col>
    </section>
    <!-- <div data-app></div> -->
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
            headers: [{
                    text: "Title",
                    align: "center",
                    sortable: false,
                    value: "title",
                    width: "100",
                },
                {
                    text: "Logo",
                    value: "logo",
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
                    text: "Cover picture",
                    value: "cover_picture",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Introduction",
                    value: "intro",
                    align: "center",
                    sortable: false,
                    width: "900",
                },
                {
                    text: "E-mail",
                    value: "emails",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Type",
                    value: "type",
                    align: "center",
                    sortable: false,
                    width: "200",
                },
                {
                    text: "Continuing education",
                    value: "continuing_education",
                    align: "center",
                    sortable: false,
                    width: "900",
                },
                {
                    text: "Initial education",
                    value: "initial_education",
                    align: "center",
                    sortable: false,
                    width: "900",
                },
                {
                    text: "Website",
                    value: "website",
                    align: "center",
                    sortable: false,
                    width: "250",
                },
                {
                    text: "Address",
                    value: "address",
                    align: "center",
                    sortable: false,
                    width: "300",
                },
                {
                    text: "Campus",
                    value: "campus",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Restaurants",
                    value: "restaurants",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Carte",
                    value: "carte",
                    align: "center",
                    sortable: false,
                    width: "200",
                },
                {
                    text: "Cooperation",
                    value: "cooperation",
                    align: "center",
                    sortable: false,
                    width: "900",
                },
                {
                    text: "Published",
                    value: "published",
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
            ensas: [],
            editedIndex: -1,
            publish: "Not published",
            editedItem: {
                id: "",
                title: "",
                type: "Ecole d'ingenieur",
                intro: "",
                emails: [],
                phones: [],
                fixes: [],
                images: [],
                specialities: [],
                city: "",
                continuing_education: "",
                initial_education: "",
                carte: "",
                website: "",
                address: "",
                campus: "",
                restaurants: "",
                published: false,
                logo: null,
                cover_picture: null,
                cooperation: "",
            },
            defaultItem: {
                title: "",
                type: "Ecole d'ingenieur",
                intro: "",
                emails: [],
                phones: [],
                fixes: [],
                specialities: [],
                images: [],
                city: "",
                continuing_education: "",
                initial_education: "",
                carte: "",
                website: "",
                address: "",
                campus: null,
                restaurants: null,
                logo: null,
                published: false,
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
                    // (v) => !!v || "Address is required",
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
        formTitle() {
            return this.editedIndex === -1 ?
                "admin.form_title_add.ensa" :
                "admin.form_title_edit.ensa";
        },
        era() {
            return JSON.parse(localStorage.getItem("auth")).to;
        },
    },
    mounted() {
        const toShow = [
            "title",
            "type",
            "Address",
            "campus",
            "restaurants",
            "website",
            "published",
            "actions",
        ];
        this.value = this.headers.filter((obj) => {
            return toShow.includes(obj.value);
        });
    },
    watch: {
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
            const { data } = await this.axios.get(`/api/ensa`);
            this.ensas = data;
        },

        removeEmail(item) {
            this.editedItem.emails.splice(
                this.editedItem.emails.indexOf(item),
                1
            );
            this.editedItem.emails = [...this.editedItem.emails];
        },

        async removePhone(item) {
            this.editedItem.phones.splice(
                this.editedItem.phones.indexOf(item),
                1
            );
            const { data } = await this.axios.delete(
                `/api/admin/phone/${item.id}`
            );
            this.editedItem.phones = [...this.editedItem.phones];
        },

        async removeFix(item) {
            this.editedItem.fixes.splice(
                this.editedItem.fixes.indexOf(item),
                1
            );
            const { data } = await this.axios.delete(
                `/api/admin/phone/${item.id}`
            );
            this.editedItem.fixes = [...this.editedItem.fixes];
        },

        removeSpecialty(item) {
            this.editedItem.specialities.splice(
                this.editedItem.specialities.indexOf(item),
                1
            );
            this.editedItem.specialities = [
                ...this.editedItem.specialities,
            ];
        },

        publishChange: function() {
            if (this.editedItem.published == false) {
                this.publish = "Not published";
            } else {
                this.publish = "Published";
            }
        },

        editItem(item) {
            this.editedIndex = this.ensas.indexOf(item);
            delete item.logo;
            delete item.cover_picture;
            item.title = item.title.replace("ENSA ", "");
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
            this.axios
                .delete(`/api/admin/ensa/${this.editedItem.id}`)
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

        capitalize(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },

        handleImages(files){
            this.editedItem.images = files;
        },

        async save() {
            const valid = this.$refs.form.validate();
            var formData = new FormData();

            this.editedItem.campus = this.editedItem.campus
                .trim()
                .replace(/ /g, "_");
            this.editedItem.restaurants = this.editedItem.restaurants
                .trim()
                .replace(/ /g, "_");
            if (this.editedItem.title.length > 0 && !this.editedItem.title.includes("ENSA")) {
                this.editedItem.title = "ENSA " + this.capitalize(this.editedItem.title);
            }

            this.editedItem.phones.forEach((phone, i) => formData.append(`phones[${i}]`, phone));
            this.editedItem.emails.forEach((email, i) => formData.append(`emails[${i}]`, email));
            this.editedItem.images.forEach((image, i) => formData.append(`images[${i}]`, image));
            this.editedItem.fixes.forEach((fix, i) => formData.append(`fixes[${i}]`, fix));
            this.editedItem.specialities.forEach((speciality, i) => formData.append(`specialities[${i}]`, speciality));

            Object.entries(this.editedItem).map(([key, value]) => {
                if (key !== "phones" && key !== "emails" && key !== "images" && key !== "specialities" && key !== "fixes") {
                    console.log(key);
                    formData.append(key, value);
                }
            });

            if (valid) {
                if (this.editedIndex > -1) {
                    Object.assign(
                        this.ensas[this.editedIndex],
                        this.editedItem
                    );
                    console.log(this.editedItem);
                    this.axios
                        .patch(
                            `/api/admin/ensa/${this.editedItem.id}`,
                            this.editedItem
                        )
                        .then(async res => {
                            console.log(res.data);
                            var dataForm = new FormData();

                            dataForm.append("logo", this.editedItem.logo);
                            dataForm.append("id", this.editedItem.id);
                            dataForm.append("model", "ENSA");
                            var { data, status } = await this.axios.post(`/api/admin/image`, dataForm);

                            dataForm.append("cover_picture", this.editedItem.cover_picture);
                            dataForm.delete("logo");
                            var { data, status } = await this.axios.post(`/api/admin/image`, dataForm);
                            if (status === 201) {
                                this.initialize();
                                this.close();
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                } else {
                    try {
                        const config = {
                            headers: {
                                'content-type': 'multipart/form-data'
                            }
                        };
                        const { data } = await this.axios.post(
                            `/api/admin/ensa`,
                            formData,
                            config
                        );
                        console.log(data);
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