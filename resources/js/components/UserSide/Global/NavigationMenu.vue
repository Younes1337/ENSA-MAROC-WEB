<template>
    <v-layout class="overflow-hidden py-10 pt-8" row justify-center>
        <!-- Desktop Navbar ----------------------------------------------------- -->
        <v-toolbar elevation="0" class="menu-pc hidden-sm-and-down" dense>
            <v-toolbar-title class="mt-8 ml-6">
                <router-link :to="{ name: 'home' }">
                    <v-img
                        class="logo-ensa"
                        :src="logo_path"
                        alt="logo"
                        max-height="180"
                        max-width="140"
                        to="/"
                        contain
                    ></v-img>
                </router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn to="/">{{$t('navigation.home')}}</v-btn>

                <v-menu
                    rounded="rounded"
                    open-on-hover
                    offset-y
                    transition="slide-y-transition"
                    bottom
                    right
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn text v-bind="attrs" v-on="on"> {{$t('navigation.network')}} </v-btn>
                    </template>
                    <v-list dense>
                        <v-list-item
                            v-for="(item, index) in publishedNetwork"
                            :key="index"
                            router
                            :to="item.link"
                        >
                            <v-list-item-action>
                                <v-list-item-title>{{
                                    item.title
                                }}</v-list-item-title>
                            </v-list-item-action>
                        </v-list-item>
                    </v-list>
                </v-menu>

                <v-menu
                    rounded="rounded"
                    open-on-hover
                    offset-y
                    transition="slide-y-transition"
                    bottom
                    right
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn text v-bind="attrs" v-on="on"> {{$t('navigation.ensa_docs')}} </v-btn>
                    </template>
                    <v-list dense>
                        <v-list-item
                            v-for="(item, index) in docs"
                            :key="index"
                            router
                            :to="item.link"
                        >
                            <v-list-item-action>
                                <v-list-item-title>{{
                                    $t(item.title)
                                }}</v-list-item-title>
                            </v-list-item-action>
                        </v-list-item>
                    </v-list>
                </v-menu>

                <v-menu
                    rounded="rounded"
                    open-on-hover
                    offset-y
                    transition="slide-y-transition"
                    bottom
                    right
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn text v-bind="attrs" v-on="on">
                            {{$t('navigation.ensa_family')}}
                        </v-btn>
                    </template>
                    <v-list dense>
                        <v-list-item
                            v-for="(item, index) in ensa_family"
                            :key="index"
                            router
                            :to="item.link"
                        >
                            <v-list-item-action>
                                <v-list-item-title>{{$t(item.title)}}</v-list-item-title>
                            </v-list-item-action>
                        </v-list-item>
                    </v-list>
                </v-menu>

                <v-menu
                    rounded="rounded"
                    open-on-hover
                    offset-y
                    transition="slide-y-transition"
                    bottom
                    right
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn text v-bind="attrs" v-on="on">
                            {{$t('navigation.professional')}}
                        </v-btn>
                    </template>
                    <v-list dense>
                        <v-list-item
                            v-for="(item, index) in professional"
                            :key="index"
                            router
                            :to="item.link"
                        >
                            <v-list-item-action>
                                <v-list-item-title>{{
                                    $t(item.title)
                                }}</v-list-item-title>
                            </v-list-item-action>
                        </v-list-item>
                    </v-list>
                </v-menu>

                <v-menu
                    rounded="rounded"
                    open-on-hover
                    offset-y
                    transition="slide-y-transition"
                    bottom
                    right
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn text v-bind="attrs" v-on="on"> {{$t('navigation.about_us')}} </v-btn>
                    </template>
                    <v-list dense>
                        <v-list-item
                            v-for="(item, index) in about_us"
                            :key="index"
                            router
                            :to="item.link"
                        >
                            <v-list-item-action>
                                <v-list-item-title>{{
                                    $t(item.title)
                                }}</v-list-item-title>
                            </v-list-item-action>
                        </v-list-item>
                    </v-list>
                </v-menu>

                <v-btn to="/contact" text> {{$t('navigation.contact')}} </v-btn>

                <v-sheet class="pa-2 mt-md-1">
                    <v-switch
                        v-model="languages"
                        inset
                        :label="language_label"
                        @change="languageChange"
                    ></v-switch>
                </v-sheet>
            </v-toolbar-items>
        </v-toolbar>

        <!-- Mobile Navbar ----------------------------------------------------- -->
        <v-toolbar elevation="0" class="menu-pc hidden-md-and-up" dense>
            <v-toolbar-title>
                <router-link :to="{ name: 'home' }">
                    <v-img
                        class="logo-ensa"
                        :src="logo_path"
                        alt="logo"
                        max-height="160"
                        max-width="130"
                        contain
                    ></v-img>
                </router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>

            <v-dialog
                v-model="dialog"
                fullscreen
                hide-overlay
                transition="dialog-bottom-transition"
            >
                <template v-slot:activator="{ on }"
                    ><v-icon
                        v-on="on"
                        class="mr-3"
                        color="deep-orange darken-1"
                        size="30"
                        >mdi-menu</v-icon
                    ></template
                >
                <v-card class="bg-image-app">
                    <v-card-actions class="d-flex justify-space-between">
                        <v-btn icon @click="dialog = false">
                            <v-icon size="30" color="black">mdi-close</v-icon>
                        </v-btn>
                        <v-sheet
                            class="pa-2 mt-md-1"
                            style="background-color: transparent !important"
                        >
                            <v-switch
                                v-model="languages"
                                inset
                                :label="language_label"
                                @change="languageChange"
                            ></v-switch>
                        </v-sheet>
                    </v-card-actions>
                    <v-list
                        nav
                        style="background-color: transparent !important"
                    >
                        <v-list-item-group
                            v-model="selectedItem"
                            color="deep-orange darken-1"
                        >
                            <v-list-item to="/">
                                <v-list-item-content>
                                    <v-list-item-title>{{$t('navigation.home')}}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>

                            <v-list-group :value="false">
                                <template v-slot:activator>
                                    <v-list-item-title
                                        >{{$t('navigation.network')}}</v-list-item-title
                                    >
                                </template>
                                <v-list-item
                                    class="ml-10"
                                    v-for="(item, index) in publishedNetwork"
                                    :key="index"
                                    router
                                    :to="item.link"
                                >
                                    <v-list-item-content>
                                        <v-list-item-title>{{
                                            item.title
                                        }}</v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-group>

                            <v-list-group :value="false">
                                <template v-slot:activator>
                                    <v-list-item-title
                                        >{{$t('navigation.ensa_docs')}}</v-list-item-title
                                    >
                                </template>
                                <v-list-item
                                    class="ml-10"
                                    v-for="(item, index) in docs"
                                    :key="index"
                                    router
                                    :to="item.link"
                                >
                                    <v-list-item-content>
                                        <v-list-item-title>{{
                                            $t(item.title)
                                        }}</v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-group>

                            <v-list-group :value="false">
                                <template v-slot:activator>
                                    <v-list-item-title
                                        >{{$t('navigation.ensa_family')}}</v-list-item-title
                                    >
                                </template>
                                <v-list-item
                                    class="ml-10"
                                    v-for="(item, index) in ensa_family"
                                    :key="index"
                                    router
                                    :to="item.link"
                                >
                                    <v-list-item-content>
                                        <v-list-item-title>{{
                                            $t(item.title)
                                        }}</v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-group>

                            <v-list-group :value="false">
                                <template v-slot:activator>
                                    <v-list-item-title
                                        >{{$t('navigation.professional')}}</v-list-item-title
                                    >
                                </template>
                                <v-list-item
                                    class="ml-10"
                                    v-for="(item, index) in professional"
                                    :key="index"
                                    router
                                    :to="item.link"
                                >
                                    <v-list-item-content>
                                        <v-list-item-title>{{
                                            $t(item.title)
                                        }}</v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-group>

                            <v-list-group :value="false">
                                <template v-slot:activator>
                                    <v-list-item-title
                                        >{{$t('navigation.about_us')}}</v-list-item-title
                                    >
                                </template>
                                <v-list-item
                                    class="ml-10"
                                    v-for="(item, index) in about_us"
                                    :key="index"
                                    router
                                    :to="item.link"
                                >
                                    <v-list-item-content>
                                        <v-list-item-title>{{
                                            $t(item.title)
                                        }}</v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-group>

                            <v-list-item to="/contact">
                                <v-list-item-content>
                                    <v-list-item-title
                                        >{{$t('navigation.contact')}}</v-list-item-title
                                    >
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-card>
            </v-dialog>
        </v-toolbar>
    </v-layout>
</template>

<script>
export default {
    data: function () {
        return {
            dialog: false,
            selectedItem: 1,

            language_label: '',
            lang: localStorage.getItem("lang") || "fr",
            languages: false,

            // nav: [
            //     {
            //         icon: "home",
            //         text: "Home",
            //         title: "Back to Home page",
            //         active: true,
            //     },
            //     {
            //         icon: "info",
            //         text: "About",
            //         title: "About this demo",
            //         active: false,
            //     },
            //     {
            //         icon: "assignment_turned_in",
            //         text: "Todos",
            //         title: "Some stuff that needs doing",
            //         active: false,
            //     },
            //     {
            //         icon: "email",
            //         text: "Contact",
            //         title: "Our Contact info",
            //         active: false,
            //     },
            // ],

            /******************************************************** Hada li tbadal */
            network: [],
            /******************************************************** Hada li tbadal */

            logo_path: "/img/logo-notbg.webp",

            professional: [
                {
                    title: "navigation.jobs",
                    link: "/jobs",
                },
                {
                    title: "navigation.internships",
                    link: "/internships",
                },
            ],
            docs: [
                {
                    title: "navigation.documents",
                    link: "/courses",
                },
                {
                    title: "navigation.orientation",
                    link: "/orientations",
                },
            ],
            ensa_family: [
                {
                    title: "navigation.news",
                    link: "/news",
                },
                {
                    title: "navigation.events",
                    link: { name: "events" },
                },
                {
                    title: "navigation.clubs",
                    link: { name: "clubs" },
                },
            ],
            about_us: [
                {
                    title: "navigation.ensa",
                    link: "/about",
                },
                {
                    title: "navigation.gallery",
                    link: "/gallery",
                },
                {
                    title: "navigation.faq",
                    link: "/faq",
                },
                {
                    title: "navigation.privacy_policy",
                    link: "/privacypolicy",
                },
                {
                    title: "navigation.terms_conditions",
                    link: "/termsconditions",
                },
            ],
        };
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
    },
    mounted() {
        localStorage.setItem("lang", "fr");
        this.axios.get(`/api/ensa`).then((res) => {
            this.network = res.data;
            this.network = this.network.map((ensa) => ({
                ...ensa,
                link: "/ensa/" + ensa.id,
            }));
        });
    },
    computed: {
        publishedNetwork: function () {
            return this.network.filter((ensa) => ensa.published);
        },
    },
};
</script>
<style>
.v-btn:not(.v-btn--round).v-size--default {
    padding: 0 10px !important;
}
/* Mobile Navbar */
.v-list-item--link:before {
    background-color: var(--orange-color) !important;
}
.v-item--active .v-list-item__content .v-list-item__title {
    color: var(--purple-color) !important;
    font-weight: 600;
}
.v-item-group .v-list-group.v-list-group--active.primary--text {
    color: var(--orange-color) !important;
}
.v-list-item__icon.v-list-group__header__append-icon span svg {
    color: var(--purple-color) !important;
}
</style>
