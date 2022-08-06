<template>
    <v-footer
        class="footer-s"
        fluid
        width="auto"
        style="box-shadow: 0px 0px 15px 0px rgba(131, 37, 60, 0.3)"
    >
        <v-container fluid>
            <v-row class="d-flex" flat tile>
                <v-col
                    class="padding-l short-intro"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="4"
                    lg="4"
                    xl="4"
                >
                    <!-- <h2 class="margin-b">{{ website.title_long_introduction }}</h2> -->
                    <h2 class="mb-5">{{ $t("footer.title_part_1") }}</h2>
                    <p
                        class="padding-r margin-b"
                        v-html="website.short_description"
                    ></p>
                    <a :href="website.facebook_link" target="_blank">
                        <v-icon class="icons" size="26px">mdi-facebook</v-icon>
                    </a>
                    <a :href="website.youtube_link" target="_blank">
                        <v-icon class="icons" size="26px">mdi-youtube</v-icon>
                    </a>
                    <a :href="website.instagram_link" target="_blank">
                        <v-icon class="icons" size="26px">mdi-instagram</v-icon>
                    </a>
                    <a :href="website.linkedin_link" target="_blank">
                        <v-icon class="icons" size="26px">mdi-linkedin</v-icon>
                    </a>
                </v-col>
                <v-col
                    class="padding-l"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="4"
                    lg="4"
                    xl="4"
                >
                    <h2 class="mb-5">{{ $t("footer.title_part_2") }}</h2>
                    <div class="contact-icon margin-b">
                        <v-icon class="icons" size="26px">mdi-email</v-icon>
                        <span class="caption">
                            <a :to="'mailto:' + website.email">
                                {{ website.email }}
                            </a>
                        </span>
                    </div>
                    <div class="contact-icon margin-b">
                        <v-icon class="icons" size="26px">mdi-phone</v-icon>
                        <!-- <p class="ma-0" ><a >  </a></p> -->
                        <span class="caption">
                            {{ website.formatedMPhones }}
                        </span>
                    </div>
                    <!-- <div class="contact-icon margin-b">
              <v-icon class="icons" size="26px">mdi-phone-classic</v-icon>
              <span class="caption">
                {{ website.formatedFPhones }}
              </span>
          </div> -->
                </v-col>
                <v-col
                    class="padding-l"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="4"
                    lg="4"
                    xl="4"
                >
                    <h2 class="mb-5">{{ $t("footer.title_part_3") }}</h2>
                    <ul class="inner-link">
                        <li>
                            <router-link :to="{ name: 'gallery' }">
                                <span
                                    class="caption"
                                    v-html="$t('navigation.gallery')"
                                ></span>
                                <v-icon class="icons" size="26px"
                                    >mdi-chevron-right</v-icon
                                >
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'contact' }">
                                <span
                                    class="caption"
                                    v-html="$t('navigation.contact')"
                                ></span>
                                <v-icon class="icons" size="26px"
                                    >mdi-chevron-right</v-icon
                                >
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'privacypolicy' }">
                                <span
                                    class="caption"
                                    v-html="$t('navigation.privacy_policy')"
                                ></span>
                                <v-icon class="icons" size="26px"
                                    >mdi-chevron-right</v-icon
                                >
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'termsconditions' }">
                                <span
                                    class="caption"
                                    v-html="$t('navigation.terms_conditions')"
                                ></span>
                                <v-icon class="icons" size="26px"
                                    >mdi-chevron-right</v-icon
                                >
                            </router-link>
                        </li>
                    </ul>
                </v-col>
            </v-row>
        </v-container>
        <v-container fluid>
            <v-row>
                <v-col>
                    <p align="center" class="p-mini margin-t">
                        {{ $t("footer.bottom_part_1") }} &copy;
                        {{ new Date().getFullYear() }}
                        {{ $t("footer.bottom_part_2") }}
                        <a href="https://yanecode.com/" target="_blanck"
                            >Yanecode</a
                        >
                    </p>
                </v-col>
            </v-row>
        </v-container>
    </v-footer>
</template>

<script>
import _array from "lodash/array";

export default {
    data: () => ({
        website: {},
    }),

    methods: {
        formatTelContent(tel) {
            return _array
                .chunk(tel.split(""), 2)
                .map((x) => x[0] + "" + x[1])
                .join("");
        },
        formatTelHref(tel) {
            return "tel:" + tel.replace("0", "+212");
        },
    },

    async mounted() {
        const { data } = await this.axios.get("/api/website");
        console.log("==================================== website");
        console.log(data);
        console.log("==================================== cccc");

        const mobilePhones = data[0].phones.filter(
            (phone) => phone.type == "mobile"
        );

        var formatedMPhones;
        if (mobilePhones.length)
            formatedMPhones =
                this.formatTelContent(mobilePhones[0].phone_number) +
                " / " +
                this.formatTelContent(mobilePhones[1].phone_number);

        const fixPhones = data[0].phones.filter((phone) => phone.type == "fix");

        var formatedFPhones;
        if (fixPhones.length)
            formatedFPhones =
                this.formatTelContent(fixPhones[0].phone_number) +
                " / " +
                this.formatTelContent(fixPhones[1].phone_number);

        this.website = {
            ...data[0],
            formatedMPhones: formatedMPhones,
            formatedFPhones: formatedFPhones,
        };
    },
};
</script>
