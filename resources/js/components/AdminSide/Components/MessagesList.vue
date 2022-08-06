<template>
    <section class="section-admin">
        <v-col class="pa-3 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">{{$t('admin.title_msgs')}}</p>
        </v-col>

        <v-col class="pa-3 mb-10">
            <v-data-table
                :headers="selectedHeaders"
                :items="messages"
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
                        <v-dialog
                            v-model="dialogDelete"
                            max-width="300px"
                            persistent
                        >
                            <v-card>
                                <v-card-title class="text-h5">
                                    {{$t('admin.text_remove.msg_text')}}
                                </v-card-title>
                                <v-card-text>
                                    {{$t('admin.text_remove.msg_subtext')}}
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
export default {
    name: "MessagesList",

    data() {
        const self = this;
        return {
            loader: null,
            loading: false,
            valid: true,
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: "First name",
                    align: "center",
                    sortable: true,
                    value: "sender_firstName",
                    width: "200",
                },
                {
                    text: "Last name",
                    align: "center",
                    sortable: true,
                    value: "sender_lastName",
                    width: "200",
                },
                {
                    text: "Message content",
                    align: "center",
                    sortable: false,
                    value: "message_content",
                    width: "400",
                },
                {
                    text: "Email",
                    value: "email",
                    align: "center",
                    sortable: true,
                    width: "250",
                },
                {
                    text: "Sender",
                    value: "sender",
                    align: "center",
                    sortable: false,
                    width: "200",
                },
                {
                    text: "Date/Time sent",
                    value: "date_time_sent",
                    align: "center",
                    sortable: true,
                    width: "200",
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
            messages: [],
            editedIndex: -1,
            editedItem: {}
        };
    },

    computed: {},

    mounted() {
        this.initialize();
        const toShow = ["sender_firstName", "sender_lastName", "date_time_sent","actions"];
        this.value = this.headers.filter((obj) => {
            return toShow.includes(obj.value);
        });
    },

    watch: {
        // editedItem: {
        //     handler(val) {
        //         console.log("====================================");
        //         console.log(val);
        //         console.log("====================================");
        //     },
        //     deep: true,
        // },
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
    },

    created() {
    },

    methods: {
        async initialize() {
            const { data } = await this.axios.get(`/api/admin/message`);
            this.messages = data
        },

        deleteItem(item) {
            this.editedIndex = this.messages.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.messages.splice(this.editedIndex, 1);
            this.axios
                .delete(`/api/admin/message/${this.editedItem.id}`)
                .then((res) => {
                    this.initialize();
                });
            this.closeDelete();
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
    },
};
</script>