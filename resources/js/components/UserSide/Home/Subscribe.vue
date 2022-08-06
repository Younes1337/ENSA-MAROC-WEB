<template>
    <section class="subscribe">
        <v-row>
            <v-row
                class="d-flex align-center justify-center back-images"
                col="12"
            >
                <v-col class="img-left" md="5">
                    <img src="/img/envelopes.svg" alt="Subscribe" />
                </v-col>

                <v-col class="img-center" md="2">
                    <img src="/img/envelope.svg" alt="Subscribe" />

                    <p v-html="$t('others.subscribe')"></p>
                </v-col>

                <v-col class="img-right" md="5">
                    <img src="/img/envelopes.svg" alt="Subscribe" />
                </v-col>
            </v-row>
        </v-row>

        <v-row class="d-flex align-center justify-center" col="12">
            <v-col class="mini-text" col="12">
                <p v-html="$t('others.subscribe_subtitle')"></p>
            </v-col>
        </v-row>

        <v-snackbar
            v-model="snackbar_success"
            bottom
            right
            :timeout="2000"
            color="success"
        >
            <v-icon dark> mdi-checkbox-marked-circle </v-icon>

            <span v-html="$t('snackbar.subscription.success')"></span>

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
        <v-snackbar
            v-model="snackbar_error"
            bottom
            right
            :timeout="2000"
            color="error"
        >
            <v-icon dark> mdi-alert </v-icon>
            <span v-html="$t('snackbar.subscription.error')"></span>
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
        <v-form ref="form" v-model="valid" lazy-validation>
            <v-row
                class="d-flex align-center justify-center"
                col="12"
                ref="form"
            >
                <v-col class="form-input" md="7" xs="12" sm="12">
                    <v-text-field
                        v-model="email"
                        type="email"
                        :rules="rules.emailRules"
                        placeholder="Your email"
                        solo
                        required
                    ></v-text-field>
                </v-col>
                <v-col class="form-input" md="5" xs="12" sm="12">
                    <v-btn
                        class="btn-more text-center"
                        :disabled="!valid"
                        @click="validate"
                        large
                        rounded
                    >
                        {{ $t("others.submit") }}
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
    </section>
</template>
<script>
export default {
    data: () => ({
        email: "",
        snackbar_success: false,
        snackbar_error: false,
        valid: true,
        rules: {
            emailRules: [
                (v) => !!v || "Email is required",
                (v) => /.+@.+\..+/.test(v) || "Email must be valid",
            ],
        },
    }),

    methods: {
        async validate() {
            // if (this.valid = false) {
            //   this.snackbar_success = false;
            //   this.snackbar_error = true;
            // } else if (this.valid = true) {
            //   this.$refs.form.validate();
            //   this.snackbar_success = true;
            //   this.snackbar_error = false;
            //   this.$refs.form.reset();
            // }
            this.$refs.form.validate();
            const result = await this.axios.post("/api/newsletter", {
                email: this.email,
            });
            if (result.data[0] == "success") {
                this.snackbar_success = true;
                this.$refs.form.reset();
            } else {
                this.snackbar_error = true;
            }
        },
    },
};
</script>
