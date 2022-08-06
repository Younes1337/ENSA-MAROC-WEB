<template>
    <section class="section-admin">
        <v-col class="pa-3 pl-10 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">{{$t('admin.title_profile')}}</p>
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
            <v-form ref="form" v-model="valid" lazy-validation v-if="profileItem">
                <v-row class="px-10">
                    <v-col cols="12" xs="12" sm="12" md="2" lg="2" xl="2">
                        <avatarUpload/>
                    </v-col>

                    <v-col cols="12" xs="12" sm="12" md="10" lg="10" xl="10">
                        <v-row>
                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <v-text-field
                            class="input-text"
                            color="deep-orange darken-1"
                            v-model="profileItem.first_name"
                            placeholder="First name"
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
                            class="input-text"
                            color="deep-orange darken-1"
                            v-model="profileItem.last_name"
                            placeholder="Last name"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-text-field>
                    </v-col>

                    <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                        <v-text-field
                            class="input-text"
                            color="deep-orange darken-1"
                            v-model="profileItem.role"
                            placeholder="Role"
                            text
                            solo
                            rounded
                            dense
                            disabled
                        ></v-text-field>
                    </v-col>

                    <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                        <v-text-field
                            class="input-text"
                            color="deep-orange darken-1"
                            v-model="profileItem.email"
                            placeholder="Email"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-text-field>
                    </v-col>

                    <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                        <v-text-field
                            class="input-text"
                            color="deep-orange darken-1"
                            v-model="profileItem.phone_number"
                            placeholder="Phone number"
                            text
                            solo
                            rounded
                            dense
                            clearable
                            required
                        ></v-text-field>
                    </v-col>

                    <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                        <v-text-field
                            class="input-text"
                            v-model="profileItem.password"
                            placeholder="Password"
                            color="deep-orange darken-1"
                            :append-icon="showPWD ? 'mdi-eye' : 'mdi-eye-off'"
                            
                            :type="showPWD ? 'text' : 'password'"
                            @click:append="showPWD = !showPWD"
                            password
                            text
                            solo
                            rounded
                            dense
                            required
                        ></v-text-field>
                        <!-- :rules="[rules.required, rules.min]" -->
                    </v-col>

                    <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                        <v-text-field
                            class="input-text"
                            v-model="profileItem.password_confirmation"
                            placeholder="Password confirmation"
                            color="deep-orange darken-1"
                            :append-icon="showPWDC ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="showPWDC ? 'text' : 'password'"
                            @click:append="showPWDC = !showPWDC"
                            password
                            text
                            solo
                            rounded
                            dense
                            required
                        ></v-text-field>
                        <!-- :rules="[rules.required, rules.min, rules.passwordConfirmation]" -->
                    </v-col>
                    </v-row>
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
import { mapActions } from "vuex";
import AvatarUpload from "./Global/Avatar_Upload/AvatarUpload.vue";

export default {
    name: "ProfileSettings",

    components: {
        AvatarUpload,
    },

    data: () => ({
        valid: true,
        showPWD: false,
        showPWDC: false,
        profileItem: {
            first_name: "",
            last_name: "",
            email: "",
            password: "",
            password_confirmation: "",
            phone_number: "",
            role: "",
            avatar: null
        },
        rules: {
            passwordConfirmation: (v) => (v === this.profileItem.password) || "Password and confirmation mismatch",
            required: (value) => !!value || "Required.",
            min: (value) => value.length >= 8 || "Min 8 characters",
        },
    }),

    mounted () {
        this.initialize();
    },

    watch: {
    },

    methods: {
        ...mapActions({
            refreshUser: "usedByAll/refreshUser"
        }),

        initialize() {
            this.profileItem = this.$store.state.usedByAll.user;
        },

        async save() {
            delete this.profileItem.role;
            await this.axios.patch(`/api/admin/user/${this.profileItem.id}`, this.profileItem);
            await this.refreshUser();
        }
    },
};
</script>
