<template>
    <v-card>
        <v-navigation-drawer
            v-model="_drawer"
            :mini-variant.sync="_drawer"
            permanent
            app
            expand-on-hover
            left
        >
            <v-list-item class="pa-0">
                <v-row justify="center" align="center">
                    <v-menu bottom min-width="200px" rounded offset-y dense>
                        <template v-slot:activator="{ on }">
                            <div class="d-flex justify-center align-center">
                                <v-btn class="mr-2" icon x-large v-on="on">
                                    <v-avatar
                                        color="deep-orange darken-3"
                                        size="36"
                                    >
                                        <v-img :src="user.avatar" />
                                    </v-avatar>
                                </v-btn>
                                <h4>{{ $t("admin.welcome") }}</h4>
                            </div>
                        </template>
                        <v-card>
                            <v-list-item-content class="justify-center">
                                <div class="mx-auto text-center">
                                    <v-avatar
                                        color="deep-orange darken-3"
                                        size="64"
                                    >
                                        <v-img :src="user.avatar" />
                                    </v-avatar>
                                    <h4>{{ user.first_name }}</h4>
                                    <p class="text-caption mt-1">
                                        {{ user.email }}
                                    </p>
                                    <v-divider class="my-3"></v-divider>
                                    <v-btn
                                        depressed
                                        rounded
                                        text
                                        link
                                        to="profile"
                                    >
                                        {{ $t("admin.title_account") }}
                                    </v-btn>
                                    <v-divider class="my-2"></v-divider>
                                    <v-btn
                                        depressed
                                        rounded
                                        text
                                        @click="logOut()"
                                    >
                                        {{ $t("admin.logout") }}
                                    </v-btn>
                                </div>
                            </v-list-item-content>
                        </v-card>
                    </v-menu>
                </v-row>
                <v-btn icon @click.stop="$emit('toggleDrawer')">
                    <v-icon>mdi-chevron-left</v-icon>
                </v-btn>
            </v-list-item>

            <v-divider></v-divider>

            <v-list dense rounded nav>
                <v-list-item
                    v-for="(item, index) in _items"
                    :key="index"
                    :to="item.route"
                    link
                    color="deep-orange darken-3"
                >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title
                            >{{ $t(item.title) }}
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-list class="pt-0" dense rounded nav>
                <v-list-group :value="false" color="deep-orange darken-3">
                    <template v-slot:activator dense rounded nav>
                        <v-list-item-icon>
                            <v-icon>mdi-text-box-multiple-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Ressources</v-list-item-title>
                    </template>
                    <v-list-item
                        class="ml-5"
                        v-for="(resource, index) in _resources"
                        :key="index"
                        :to="resource.route"
                        link
                        dense
                        rounded
                        nav
                    >
                        <v-list-item-content>
                            <v-list-item-title>{{
                                $t(resource.title)
                            }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-group>
            </v-list>

            <v-list class="pt-0" dense rounded nav>
                <v-list-group :value="false" color="deep-orange darken-3">
                    <template v-slot:activator dense rounded nav>
                        <v-list-item-icon>
                            <v-icon>mdi-lightbulb-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Others</v-list-item-title>
                    </template>
                    <v-list-item
                        class="ml-5"
                        v-for="(other, index) in _others"
                        :key="index"
                        :to="other.route"
                        link
                        dense
                        rounded
                        nav
                    >
                        <v-list-item-content>
                            <v-list-item-title>{{
                                $t(other.title)
                            }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-group>
            </v-list>

            <v-list class="pt-0" dense rounded nav>
                <v-list-item link to="faqs">
                    <v-list-item-icon>
                        <v-icon>mdi-comment-question-outline</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>
                            {{ $t("admin.title_faqs") }}
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <template v-slot:append>
                <v-list dense rounded nav>
                    <v-list-item link to="contactmessages">
                        <v-list-item-icon>
                            <v-icon>mdi-message-processing-outline</v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title>
                                {{ $t("admin.title_msgs") }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-divider></v-divider>
                    <v-list-item link to="websitesettings">
                        <v-list-item-icon>
                            <v-icon>mdi-cog-outline</v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title>
                                {{ $t("admin.title_settings") }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </template>
        </v-navigation-drawer>
    </v-card>
</template>

<script>
import { mapActions, mapMutations } from "vuex";

export default {
    props: ["drawer", "admin"],
    data() {
        return {
            items: [
                {
                    title: "admin.title_dashboard",
                    icon: "mdi-view-dashboard-outline",
                    admin: true,
                    route: "/dashboard",
                },
                {
                    title: "admin.title_users",
                    icon: "mdi-account-supervisor-outline",
                    admin: true,
                    route: "/users",
                },
                {
                    title: "admin.title_ensas",
                    icon: "mdi-town-hall",
                    admin: true,
                    route: "/ensas",
                },
                {
                    title: "admin.title_opportunities",
                    icon: "mdi-briefcase-outline",
                    admin: true,
                    route: "/opportunities",
                },
                {
                    title: "moderator.ensa",
                    icon: "mdi-briefcase-outline",
                    admin: false,
                    route: "/ensas",
                },
            ],
            resources: [
                {
                    title: "admin.title_docs",
                    // icon: "mdi-book-open-outline",
                    route: "/coursesdocs",
                },
                {
                    title: "admin.title_exams",
                    // icon: "mdi-text-box-multiple-outline",
                    route: "/orientationdocs",
                },
            ],
            others: [
                {
                    title: "admin.title_news",
                    // icon: "mdi-newspaper",
                    route: "/news",
                },
                {
                    title: "admin.title_events",
                    // icon: "mdi-calendar-outline",
                    route: "/events",
                },
                {
                    title: "admin.title_clubs",
                    // icon: "mdi-lightbulb-outline",
                    route: "/clubs",
                },
            ],
            mini: true,
        };
    },

    computed: {
        _drawer: {
            set() {
                this.$emit("toggleDrawer");
            },
            get() {
                return this.drawer;
            },
        },
        _items: function () {
            let area = this.admin ? "/admin" : "/moderator";
            this.items = this.items.filter(item => item.admin === this.admin);
            console.log('====================================');
            console.log(this.items);
            console.log('====================================');
            return this.items.map((item) => ({
                ...item,
                route: area + item.route,
            }));
        },
        _resources: function () {
            let area = this.admin ? "/admin" : "/moderator";
            return this.resources.map((resource) => ({
                ...resource,
                route: area + resource.route,
            }));
        },
        _others: function () {
            let area = this.admin ? "/admin" : "/moderator";
            return this.others.map((other) => ({
                ...other,
                route: area + other.route,
            }));
        },
        user() {
            return this.$store.state.usedByAll.user;
        },
    },

    methods: {
        async logOut() {
            // await this.axios.get("http://localhost:8000/sanctum/csrf-cookie");

            try {
                const { data, status } = await this.axios.post("/api/logout");
                if (status === 201) {
                    localStorage.removeItem("auth");
                    this.$router.push({ name: "login" });
                }
            } catch (error) {
                this.errors.push(error.response.data.message);
            }
        },
    },
};
</script>
<style>
.user-name {
    font-size: 0.8rem;
}
.user-email {
    font-size: 0.8rem;
}
.v-navigation-drawer.v-navigation-drawer--fixed.v-navigation-drawer--mini-variant
    .v-navigation-drawer__content {
    overflow-y: hidden;
    overflow-x: hidden;
}
.v-navigation-drawer.v-navigation-drawer--fixed.v-navigation-drawer--is-mouseover
    .v-navigation-drawer__content {
    overflow-y: auto;
    overflow-x: hidden;
}
</style>
