<template>
    <section class="section-admin">
        <v-col class="pa-3 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">{{$t('admin.title_users')}}</p>
        </v-col>

        <v-col class="pa-3 mb-10">
            <v-data-table
                :headers="selectedHeaders"
                :items="users"
                sort-by="title"
                color="deep-orange darken-1"
                class="elevation-1"
            >
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
                            <template
                                v-slot:activator="{ on, attrs }"
                                fill-height
                                fluid
                            >
                                <v-btn
                                    class="btn-more text-center mt-md-2 pa-4"
                                    v-bind="attrs"
                                    v-on="on"
                                    rounded
                                    ><v-icon left> mdi-plus-thick </v-icon>
                                    {{$t('admin.btn_add.user')}}
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
                                                {{$t('admin.validate')}}
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
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-file-input
                                                        truncate-length="50"
                                                        v-model="editedItem.avatar"
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        placeholder="avatar"
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
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-text-field
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        v-model="
                                                            editedItem.first_name
                                                        "
                                                        placeholder="First name"
                                                        :rules="rules.firstNameRules"
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
                                                    <v-text-field
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        v-model="
                                                            editedItem.last_name
                                                        "
                                                        placeholder="Last name"
                                                        :rules="rules.lastNameRules"
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
                                                    <v-select
                                                        class="input-select"
                                                        v-model="
                                                            editedItem.role
                                                        "
                                                        :items="[
                                                            'Admin',
                                                            'Moderator',
                                                        ]"
                                                        placeholder="Role"
                                                        color="deep-orange darken-1"
                                                        :rules="rules.roleRules"
                                                        text
                                                        solo
                                                        rounded
                                                        clearable
                                                        dense
                                                        required
                                                    ></v-select>
                                                </v-col>

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="6"
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-select
                                                        class="input-select"
                                                        v-model="editedItem.e_n_s_a_id"
                                                        :items="ensas"
                                                        placeholder="ENSA"
                                                        color="deep-orange darken-1"
                                                        item-text="title"
                                                        item-value="id"
                                                        :disabled="editedItem.role == 'Admin'"
                                                        :rules="rules.ensaRules"
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        clearable
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
                                                    <v-text-field
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        v-model="
                                                            editedItem.email
                                                        "
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

                                                <v-col
                                                    cols="12"
                                                    xs="12"
                                                    sm="12"
                                                    md="4"
                                                    lg="4"
                                                    xl="4"
                                                >
                                                    <v-text-field
                                                        class="input-text"
                                                        color="deep-orange darken-1"
                                                        v-model="
                                                            editedItem.phone_number
                                                        "
                                                        placeholder="Phone number"
                                                        :rules="rules.phoneRules"
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
                                                    <v-text-field
                                                        class="input-text"
                                                        v-model="
                                                            editedItem.password
                                                        "
                                                        placeholder="Password"
                                                        color="deep-orange darken-1"
                                                        :append-icon="
                                                            showPWD
                                                                ? 'mdi-eye'
                                                                : 'mdi-eye-off'
                                                        "
                                                        :rules="rules.pwdRules"
                                                        :type="
                                                            showPWD
                                                                ? 'text'
                                                                : 'password'
                                                        "
                                                        @click:append="
                                                            showPWD = !showPWD
                                                        "
                                                        password
                                                        text
                                                        solo
                                                        rounded
                                                        dense
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
                                                    <v-text-field
                                                        class="input-text"
                                                        v-model="
                                                            editedItem.password_confirmation
                                                        "
                                                        placeholder="Password confirmation"
                                                        color="deep-orange darken-1"
                                                        :append-icon="
                                                            showPWDC
                                                                ? 'mdi-eye'
                                                                : 'mdi-eye-off'
                                                        "
                                                        :rules="rules.pwdcRules"
                                                        :type="
                                                            showPWDC
                                                                ? 'text'
                                                                : 'password'
                                                        "
                                                        @click:append="
                                                            showPWDC = !showPWDC
                                                        "
                                                        password
                                                        text
                                                        solo
                                                        rounded
                                                        dense
                                                        required
                                                    ></v-text-field>
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
                                    {{$t('admin.text_remove.user_text')}}
                                </v-card-title>
                                <v-card-text>
                                    {{$t('admin.text_remove.user_subtext')}}
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="deep-orange darken-1"
                                        text
                                        @click="closeDelete"
                                        >{{$t('admin.cancel')}}</v-btn
                                    >
                                    <v-btn
                                        color="deep-orange darken-1"
                                        text
                                        @click="deleteItemConfirm"
                                        >{{$t('admin.remove')}}</v-btn
                                    >
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>
                <template v-slot:[`item.actions`]="{ item }">
                    <v-btn
                        class="ma-1"
                        color="deep-purple darken-3"
                        fab
                        x-small
                        @click="editItem(item)"
                    >
                        <v-icon color="white">mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn
                        class="ma-1"
                        color="deep-purple darken-3"
                        fab
                        x-small
                        @click="deleteItem(item)"
                    >
                        <v-icon color="white">mdi-delete</v-icon>
                    </v-btn>
                </template>
                <template v-slot:no-data>
                    <v-btn
                        class="btn-more-mini text-center"
                        :loading="loading"
                        :disabled="loading"
                        @click="
                            initialize;
                            loader = 'loading';
                        "
                        rounded
                        >{{$t('admin.reset')}}</v-btn
                    >
                </template>
                <template v-slot:[`item.published`]="{ item }">
                    <v-simple-checkbox
                        v-model="item.published"
                    ></v-simple-checkbox>
                </template>
            </v-data-table>
        </v-col>
    </section>
</template>

<script>
import { mdiAccount } from "@mdi/js";

export default {
    name: "UserList",

    data() {
        return {
            ensas: [],
            loader: null,
            loading: false,
            valid: true,
            dialog: false,
            dialogDelete: false,
            showPWD: false,
            showPWDC: false,
            headers: [
                {
                    text: "Avatar",
                    align: "center",
                    sortable: false,
                    value: "avatar",
                    width: "100",
                },
                {
                    text: "First name",
                    align: "center",
                    sortable: false,
                    value: "first_name",
                    width: "100",
                },
                {
                    text: "Last name",
                    value: "last_name",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Role",
                    value: "role",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Email",
                    value: "email",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Password",
                    value: "password",
                    align: "center",
                    sortable: false,
                },
                {
                    text: "Phone number",
                    value: "phone_number",
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
            users: [],
            editedIndex: -1,
            editedItem: {
                first_name: "",
                last_name: "",
                email: "",
                password: "",
                password_confirmation: "",
                phone_number: "",
                role: "",
                avatar: null,
                e_n_s_a_id: null
            },
            defaultItem: {
                first_name: "",
                last_name: "",
                email: "",
                password: "",
                password_confirmation: "",
                phone_number: "",
                role: "",
                avatar: null,
                e_n_s_a_id: null
            },

            rules: {
                avatarRules: [
                    (v) => !!v || "Avatar is required",
                    (v) => (v && v.size > 0) || 'Avatar is required',
                ],
                firstNameRules: [
                    (v) => !!v || "First name is required",
                    (v) =>
                        (v && v.length >= 3) ||
                        "First name can't be less than 3 characters",
                ],
                lastNameRules: [
                    (v) => !!v || "Last name is required",
                    (v) =>
                        (v && v.length >= 3) ||
                        "Last name can't be less than 3 characters",
                ],
                emailRules: [
                    (v) => !!v || "Email is required",
                    (v) => /.+@.+\..+/.test(v) || "Email must be valid",
                ],
                phoneRules: [
                    (v) => !!v || "Phone number is required",
                    (v) => v.length >= 10 || "Min 10 characters",
                    (v) => /\d/.test(v) || "Phone must contain numbers",
                    (v) => /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(v) || "Phone number must be valid",
                ],
                pwdRules: [
                    (v) => (!!v && this.editedIndex === -1) || "Password is required",
                    (v) => (v.length >= 8 && this.editedIndex === -1) || "Min 8 characters",
                    (v) => (/\d/.test(v) && this.editedIndex === -1) || "Password must contain a number",
                    (v) => (/[a-z]|[A-Z]/.test(v) && this.editedIndex === -1) || "Password must contain a letter uppercase or lowercase",
                ],
                ensaRules: [
                    (v) => !!v || 'Please choose an ENSA, is required',
                ],
                roleRules: [
                    (v) => !!v || 'Please choose a role, is required',
                ],
                pwdcRules: [
                    (v) => (!!v && this.editedIndex === -1) || "Password confirmation is required",
                    (v) => (v.length >= 8 && this.editedIndex === -1) || "Min 8 characters",
                    (v) => (/\d/.test(v) && this.editedIndex === -1) || "Password must contain a number",
                    (v) => (/[a-z]|[A-Z]/.test(v) && this.editedIndex === -1) || "Password must contain a letter uppercase or lowercase",
                    (v) => ((v === this.editedItem.password) && this.editedIndex === -1) || "Password and password confirmation mismatch",
                ],
            },
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "admin.form_title_add.user" : "admin.form_title_edit.user";
        },
    },

    async mounted() {
        const { data } = await this.axios.get(`/api/ensa`);
        this.ensas = data.map(ensa => ({title: ensa.title, id: ensa.id}))

        const toShow = ["firstName", "lastName", "role", "email", "actions"];
        this.value = this.headers.filter((obj) => {
            return toShow.includes(obj.value);
        });
    },

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

        editedItem: {
            handler(val) {
                console.log("====================================");
                console.log(val);
                console.log("====================================");
            },
            deep: true,
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        async initialize() {
            const { data } = await this.axios.get(`/api/admin/user`);
            this.users = data
        },

        editItem(item) {
            this.editedIndex = this.users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.users.splice(this.editedIndex, 1);
            this.axios.delete(`/api/admin/user/${this.editedItem.id}`).then((res) => {
                console.log(res.data);
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

        async save() {
            const valid = this.$refs.form.validate();

            let formData = new FormData();
            this.$delete(this.editedItem, 'email_verified_at');
            this.$delete(this.editedItem, 'created_at');
            this.$delete(this.editedItem, 'updated_at');

            this.editedItem.role = this.editedItem.role.toLowerCase();

            Object.entries(this.editedItem).forEach(([key, value]) => {
                formData.append(key, value);
            });

            if (valid) {
                if (this.editedIndex > -1) {
                    Object.assign(
                        this.users[this.editedIndex],
                        this.editedItem
                    );
                    console.log(this.editedItem);
                    this.axios
                        .patch(
                            `/api/admin/user/${this.editedItem.id}`,
                            this.editedItem
                        )
                        .then(async res => {
                            console.log(res.data);

                            var dataForm = new FormData();
                            dataForm.append("img", this.editedItem.avatar);
                            dataForm.append("id", this.editedItem.id);

                            var { data } = await this.axios.get('/api/admin/avatar', formData);
                            // this.close();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    try {
                        const { data } = await this.axios.post(
                            `/api/admin/register`,
                            formData,
                            {
                                "Content-Type": "multipart/form-data",
                            }
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
<style>
.input-select.table-select {
    max-width: 50%;
}
</style>
