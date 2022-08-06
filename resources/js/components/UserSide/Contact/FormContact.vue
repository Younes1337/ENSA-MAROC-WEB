<template>
    <section class="contact-section mt-12">
        <v-container fluid>
            <v-snackbar
                v-model="snackbar_success"
                bottom
                right
                :timeout="2000"
                color="success"
            >
                <v-icon dark> mdi-checkbox-marked-circle </v-icon>
                <span v-html="$t('snackbar.contact.success')"></span>
                <template v-slot:action="{ attrs }">
                    <v-btn
                        color="white"
                        text
                        v-bind="attrs"
                        @click="snackbar = false"
                    >
                        {{$t('snackbar.close')}}
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
                <span v-html="$t('snackbar.contact.success')"></span>
                <template v-slot:action="{ attrs }">
                    <v-btn
                        color="white"
                        text
                        v-bind="attrs"
                        @click="snackbar = false"
                    >
                        {{$t('snackbar.close')}}
                    </v-btn>
                </template>
            </v-snackbar>
            <v-row>
                <v-col
                    class="mb-6 px-16"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div
                        class="text-center px-16"
                        v-html="$t('others.contact_subtext')"
                    ></div>
                </v-col>
                <v-col
                    class="d-flex justify-center flex-column px-12"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <v-form ref="form" v-model="valid" lazy-validation>
                        <v-row>
                            <v-col
                                cols="12"
                                xs="12"
                                sm="12"
                                md="6"
                                lg="6"
                                xl="6"
                            >
                                <v-text-field
                                    v-model="firstName"
                                    class="input-text"
                                    :rules="rules.firstNameRule"
                                    placeholder="First name"
                                    color="deep-orange darken-1"
                                    text
                                    solo
                                    rounded
                                    dense
                                    clearable
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                class="form-input"
                                cols="12"
                                xs="12"
                                sm="12"
                                md="6"
                                lg="6"
                                xl="6"
                            >
                                <v-text-field
                                    v-model="lastName"
                                    class="input-text"
                                    :rules="rules.lastNameRule"
                                    placeholder="Last name"
                                    color="deep-orange darken-1"
                                    text
                                    solo
                                    rounded
                                    dense
                                    clearable
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col
                                class="form-input"
                                cols="12"
                                xs="12"
                                sm="12"
                                md="6"
                                lg="6"
                                xl="6"
                            >
                                <v-text-field
                                    v-model="email"
                                    class="input-text"
                                    :rules="rules.emailRule"
                                    placeholder="Email"
                                    color="deep-orange darken-1"
                                    text
                                    solo
                                    rounded
                                    dense
                                    clearable
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                class="form-input"
                                cols="12"
                                xs="12"
                                sm="12"
                                md="6"
                                lg="6"
                                xl="6"
                            >
                                <v-select
                                    class="input-text"
                                    v-model="select_item"
                                    :items="items"
                                    :rules="[
                                        (v) =>
                                            !!v || 'Specify sender is required',
                                    ]"
                                    placeholder="Sender"
                                    color="deep-orange darken-1"
                                    text
                                    solo
                                    rounded
                                    dense
                                    clearable
                                    required
                                ></v-select>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col
                                class="form-input-textarea"
                                cols="12"
                                xs="12"
                                sm="12"
                                md="12"
                                lg="12"
                                xl="12"
                            >
                                <v-textarea
                                    class="input-text"
                                    v-model="message"
                                    :rules="rules.messageRule"
                                    placeholder="Message"
                                    :counter="255"
                                    color="deep-orange darken-1"
                                    rows="3"
                                    row-height="15"
                                    text
                                    solo
                                    rounded
                                    dense
                                    clearable
                                    required
                                ></v-textarea>
                            </v-col>
                        </v-row>

                        <v-btn
                            :disabled="!valid"
                            class="btn-more text-center mt-8"
                            @click="validate"
                            large
                            rounded
                        >
                            {{$t('others.send')}}
                        </v-btn>
                    </v-form>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>
<script>
export default {
    data: () => ({
        valid: true,
        firstName: "",
        lastName: "",
        email: "",
        message: "",
        select_item: null,
        snackbar_success: false,
        snackbar_error: false,
        items: [
            "ENSA student",
            "External student",
            "ENSA Professor",
            "External Professor",
            "Other",
        ],
        rules: {
            firstNameRule: [
                (v) => !!v || "First name is required",
                (v) =>
                    (v && v.length >= 3) ||
                    "First name can't be less than 3 characters",
            ],
            lastNameRule: [
                (v) => !!v || "Last name is required",
                (v) =>
                    (v && v.length >= 3) ||
                    "Last name can't be less than 3 characters",
            ],
            emailRule: [
                (v) => !!v || "E-mail is required",
                (v) => /.+@.+\..+/.test(v) || "Email must be valid",
            ],
            messageRule: [
                (v) => !!v || "Message content is required",
                (v) =>
                    (v && v.length <= 250) ||
                    "Message content must be less than 250 characters",
            ],
        },
    }),

    methods: {
        async validate() {
            if (this.$refs.form.validate()) {
                const message = {
                    content: this.message,
                    sender_firstName: this.firstName,
                    sender_lastName: this.lastName,
                    email: this.email,
                    sender_type: this.select_item,
                    date_time_sent: new Date()
                        .toISOString()
                        .slice(0, 19)
                        .replace("T", " "),
                };
                try {
                    await this.axios.get("/sanctum/csrf-cookie");
                    const { data } = await this.axios.post(
                        "/api/message",
                        message
                    );
                    if (data.message.includes("received")) {
                        this.snackbar_success = true;
                        this.$refs.form.reset();
                    } else {
                        this.snackbar_error = true;
                    }
                } catch (error) {
                    alert(error.data);
                }
            }
        },
    },
};
</script>
