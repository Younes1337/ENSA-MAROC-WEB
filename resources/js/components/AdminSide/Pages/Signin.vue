<template>
    <v-main class="bg-sign bg-image-app" style="height: 100vh">
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs10 sm6 md4 lg4 xl4 align-self-center>
                <v-snackbar
                    v-model="snackbar_error"
                    bottom
                    right
                    :timeout="2000"
                    color="error"
                >
                    <v-icon dark> mdi-alert </v-icon>
                    <span v-text="errors[0]"></span>
                    <template v-slot:action="{ attrs }">
                        <v-btn
                            color="white"
                            text
                            v-bind="attrs"
                            @click="snackbar = false"
                        >
                            {{ $t("snackbar.close") }}
                        </v-btn>
                    </template>
                </v-snackbar>
                    <v-row>
                        <v-col cols="12" sm="12" md="12" lg="12" xl="12">
                            <v-card class="elevation-0 transparent">
                                <v-toolbar
                                    class="elevation-0 transparent d-flex align-center justify-center"
                                >
                                    <v-toolbar-title
                                        style="
                                            font-weight: bold;
                                            font-size: 2rem;
                                        "
                                        >{{$t('others.signin')}}</v-toolbar-title
                                    >
                                </v-toolbar>
                                <v-card-text>
                                    <form ref="form" @submit.prevent="login()">
                                        <v-text-field
                                            v-model="credentials.email"
                                            :rules="rules.emailRules"
                                            placeholder="Address mail"
                                            color="deep-orange darken-1"
                                            prepend-inner-icon="mdi-account"
                                            text
                                            solo
                                            rounded
                                            dense
                                            required
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="credentials.password"
                                            placeholder="Password"
                                            color="deep-orange darken-1"
                                            prepend-inner-icon="mdi-lock"
                                            :append-icon="
                                                showPWD
                                                    ? 'mdi-eye'
                                                    : 'mdi-eye-off'
                                            "
                                            :rules="rules.pwdRules"
                                            :type="
                                                showPWD ? 'text' : 'password'
                                            "
                                            @click:append="showPWD = !showPWD"
                                            password
                                            text
                                            solo
                                            rounded
                                            dense
                                            required
                                        ></v-text-field>
                                        <div class="text-center">
                                            <v-btn
                                                type="submit"
                                                class="btn-more text-center mt-3"
                                                large
                                                rounded
                                                :disabled="processing"
                                            >
                                                {{$t('others.signin')}}
                                            </v-btn>
                                        </div>
                                        <!-- <v-input
                                            :error-messages="errors"
                                            error
                                            disabled
                                            color="deep-orange darken-1"
                                        ></v-input> -->
                                    </form>
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-flex>
            </v-layout>
        </v-container>
    </v-main>
</template>

<script>
export default {
    name: "Signin",

    data() {
        return {
            snackbar_error: false,
            checkbox: false,
            processing: false,
            showPWD: false,
            rules: {
                emailRules: [
                    (v) => !!v || "Email is required",
                    (v) => /.+@.+\..+/.test(v) || "Email must be valid",
                ],
                pwdRules: [
                    (v) => !!v || "Password is required",
                    (v) => v.length >= 8 || "Min 8 characters",
                    (v) => /\d/.test(v) || "Password must contain a number",
                    (v) => /[a-z]|[A-Z]/.test(v) || "Password must contain a letter uppercase or lowercase",
                ],
            },
            credentials: {
                email: "",
                password: "",
            },
            errors: [],
        };
    },

    methods: {
        async login() {
            this.processing = true;

            await this.axios.get("http://localhost:8000/sanctum/csrf-cookie", {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                },
            });
            try {
                const { data } = await this.axios.post(
                    "/api/login",
                    this.credentials
                );
                // this.setAccessToken(data.token);
                // this.setTo(data.to);
                localStorage.setItem(
                    "auth",
                    JSON.stringify({ to: data.to, authenticated: true })
                );
                if (data.to === "admin")
                    this.$router.push({ name: data.to + "Dashboard" });
                else
                    this.$router.push({ name: data.to + "ENSA" });

            } catch (error) {
                this.errors.push(error.response.data.message);
                this.snackbar_error = true;
            } finally {
                this.processing = false;
            }
        },
    },
    mounted() {
        this.errors = [];
    },
};
</script>
