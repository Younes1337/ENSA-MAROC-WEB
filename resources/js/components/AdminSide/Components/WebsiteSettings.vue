<template>
    <section class="section-admin">
        <v-col class="pa-3 pl-10 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">{{$t('admin.title_settings')}}</p>
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
                <v-row class="px-10">
                    <v-col cols="12" xs="12" sm="12" md="2" lg="2" xl="2">
                        <v-sheet
                            class="d-flex justify-center"
                            style="background-color: transparent"
                        >
                            <v-switch
                                class="pa-0 ma-0 pt-2"
                                color="deep-orange darken-1"
                                inset
                                v-model="languages"
                                :label="language_label"
                                @click="languageChange"
                            ></v-switch>
                            <!-- :label="websiteItem.language" -->
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="10" lg="10" xl="10">
                        <v-file-input
                            truncate-length="50"
                            v-model="websiteItem.logo"
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
                            required
                        ></v-file-input>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                        <v-text-field
                            v-model="websiteItem.title_long_introduction"
                            class="input-text"
                            color="deep-orange darken-1"
                            placeholder="Long introduction title"
                            :counter="1500"
                            :rules="rules.longTitleIntroRules"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                        <v-textarea
                            v-model="websiteItem.long_description"
                            class="input-text"
                            color="deep-orange darken-1"
                            clear-icon="mdi-close"
                            placeholder="Long introduction"
                            hint="This is a long introduction about ENSA website, it will be displayed on the about page."
                            rows="3"
                            row-height="15"
                            :counter="1200"
                            :rules="rules.longIntroRules"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-textarea>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                        <v-textarea
                            v-model="websiteItem.short_description"
                            class="input-text"
                            color="deep-orange darken-1"
                            clear-icon="mdi-close"
                            placeholder="Short introduction"
                            hint="This is a short introduction about ENSA website, it will be displayed on the footer."
                            rows="3"
                            row-height="15"
                            :counter="190"
                            :rules="rules.shortIntroRules"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-textarea>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <v-combobox
                            v-model="websiteItem.phones"
                            :items="websiteItem.phones"
                            class="input-text chips-input"
                            color="deep-orange darken-1"
                            placeholder="Phones"
                            label="Phones"
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
                                    @click:close="removePhone(item)"
                                    >{{ item.phone_number }}</v-chip
                                >
                            </template>
                        </v-combobox>
                    </v-col>
                    <!-- <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                        <v-combobox
                            v-model="websiteItem['fix']"
                            :items="websiteItem['fix']"
                            :item-text="(obj) => (obj)['phone_number']"
                            :item-value="(obj) => (obj)['phone_number']"
                            :return-object="false"
                            class="input-text chips-input"
                            color="deep-orange darken-1"
                            placeholder="Fix"
                            label="Fix"
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
                                    @click:close="removeFix(item)"
                                    >{{ item }}</v-chip
                                >
                            </template>
                        </v-combobox>
                    </v-col> -->
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <v-text-field
                            v-model="websiteItem.email"
                            class="input-text"
                            color="deep-orange darken-1"
                            placeholder="Email"
                            :rules="rules.emailRules"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <v-text-field
                            v-model="websiteItem.facebook_link"
                            class="input-text"
                            color="deep-orange darken-1"
                            placeholder="Facebook link"
                            :rules="rules.facebookLinkRules"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <v-text-field
                            v-model="websiteItem.instagram_link"
                            class="input-text"
                            color="deep-orange darken-1"
                            placeholder="Instagram link"
                            :rules="rules.instagramLinkRules"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <v-text-field
                            v-model="websiteItem.linkedin_link"
                            class="input-text"
                            color="deep-orange darken-1"
                            placeholder="LinkedIn link"
                            :rules="rules.linkedinLinkRules"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <v-text-field
                            v-model="websiteItem.youtube_link"
                            class="input-text"
                            color="deep-orange darken-1"
                            placeholder="Youtube link"
                            :rules="rules.youtubeLinkRules"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-text-field>
                    </v-col>
                </v-row>
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
                {{$t('admin.save')}}
            </v-btn>
        </v-col>
    </section>
</template>

<script>
import { mdiAccount } from "@mdi/js";

export default {
    name: "WebsiteSettings",

    data() {
        return {
            valid: true,
            websiteItem: {
                title_long_introduction: "",
                long_description: "",
                short_description: "",
                phones: [],
                fix: [],
                email: "",
                language: "FR",
                logo: null,
                facebook_link: "",
                instagram_link: "",
                linkedin_link: "",
                youtube_link: "",
            },

            rules: {
                logoRules: [
                    (v) => !!v || "Avatar is required",
                    (v) => (v && v.size > 0) || 'Avatar is required',
                ],
                longTitleIntroRules: [
                    (v) => !!v || "Long introduction title is required",
                    (v) =>
                        (v && v.length >= 5) ||
                        "Long introduction title can't be less than 5 characters",
                ],
                longIntroRules: [
                    (v) => !!v || "Long introduction is required",
                    (v) =>
                        (v && v.length >= 5) ||
                        "Long introduction can't be less than 5 characters",
                ],
                shortIntroRules: [
                    (v) => !!v || "Short introduction is required",
                    (v) =>
                        (v && v.length >= 5) ||
                        "Short introduction can't be less than 5 characters",
                ],
                emailRules: [
                    (v) => (v && v.length >= 0)  || "E-mail is required",
                    (v) => /.+@.+\..+/.test(v) || "Email must be valid",
                ],
                facebookLinkRules: [
                    (v) => !!v || "Facebook URL is required",
                    (v) =>
                        (v && v.length >= 20) ||
                        "Facebook URL can't be less than 20 characters",
                    (v) => /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(v) || "Facebook URL must be valid",
                ],
                instagramLinkRules: [
                    (v) => !!v || "Instagram URL is required",
                    (v) =>
                        (v && v.length >= 20) ||
                        "Instagram URL can't be less than 20 characters",
                    (v) => /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(v) || "Instagram URL must be valid",
                ],
                linkedinLinkRules: [
                    (v) => !!v || "LinkedIn URL is required",
                    (v) =>
                        (v && v.length >= 20) ||
                        "LinkedIn URL can't be less than 20 characters",
                    (v) => /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(v) || "LinkedIn URL must be valid",
                ],
                youtubeLinkRules: [
                    (v) => !!v || "Youtube URL is required",
                    (v) =>
                        (v && v.length >= 20) ||
                        "Youtube URL can't be less than 20 characters",
                    (v) => /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(v) || "Youtube URL must be valid",
                ],
            },

            language_label: '',
            lang: localStorage.getItem("lang") || "fr",
            languages: false,
        };
    },

    watch: {
        websiteItem: {
            handler(val) {
                console.log("====================================");
                console.log(val);
                console.log("====================================");
            },
            deep: true,
        },
    },

    async mounted() {
        localStorage.setItem("lang", "fr");
        const { data } = await this.axios.get(`/api/website`);
        const phones = data[0].phones
            .filter((phone) => {
                return phone.type === "mobile";
            })
            .map((phone) => phone.phone_number);

        const fix = data[0].phones
            .filter((phone) => {
                return phone.type === "fix";
            })
            .map((fix) => fix.phone_number);

        this.websiteItem = {
            ...data[0],
            language: data[0].language.toUpperCase(),
            fix: fix,
            phones_list: phones,
        };
        this.languages = this.websiteItem.language.toUpperCase() == "EN";
    },

    methods: {
        languageChange: function () {
            if (this.languages == false) {
                this.language_label = 'fr';
                localStorage.setItem("lang", "fr");
                this.$i18n.locale = "fr";
            } else {
                this.language_label = 'en';
                localStorage.setItem("lang", "en");
                this.$i18n.locale = "en";
            }
        },

        async removePhone(item) {
            this.websiteItem.phones.splice(
                this.websiteItem.phones.indexOf(item),
                1
            );
            const { data } = await this.axios.delete(
                `/api/admin/phone/${item.id}`
            );
            console.log("====================================");
            console.log(data);
            console.log("====================================");
            this.websiteItem.phones = [...this.websiteItem.phones];
        },

        async removeFix(item) {
            this.websiteItem.fix.splice(this.websiteItem.fix.indexOf(item), 1);
            const { data } = await this.axios.delete(
                `/api/admin/phone/${item.id}`
            );
            console.log("====================================");
            console.log(data);
            console.log("====================================");
            this.websiteItem.fix = [...this.websiteItem.fix];
        },

        async save() {
            const valid = this.$refs.form.validate();

            var formData = new FormData();
            Object.entries(this.editedItem).forEach(([key, value]) => {
                formData.append(key, value);
            });

            if (valid) {
                try {
                    const id = this.websiteItem.id;

                    const { dataW } = await this.axios.patch(
                        `/api/admin/website/${id}`,
                        this.websiteItem
                    );

                    var dataForm = new FormData();
                    dataForm.append("logo", this.websiteItem.logo);
                    dataForm.append("id", id);
                    dataForm.append("model", "Website");

                    const { dataL } = await this.axios.get(
                        "/api/admin/image",
                        dataForm
                    );
                    console.log(dataW, dataL);
                    this.websiteItem = dataW;
                } catch (error) {
                    console.log(error);
                }
            }
        },
    },
};
</script>
