<template>
    <div>
        <my-upload
            field="img"
            @crop-success="cropSuccess"
            @crop-upload-success="cropUploadSuccess"
            @crop-upload-fail="cropUploadFail"
            :lang-ext="this.fr"
            v-model="show"
            :width="150"
            :height="150"
            :url="url"
            :params="params"
            :headers="headers"
            img-format="png"
        ></my-upload>
        <div class="pa-3">
            <!-- <div style="border: 2px solid red; border-radius: 50px; position: absolute; height: 100px; width: 100px;">
                <img :src="imgDataUrl" />
            </div> -->
            <v-avatar
                color="deep-orange darken-1"
                size="150"
            >
                <img :src="imgDataUrl" />
            </v-avatar>
        </div>
        <v-btn
            class="btn-more-mini text-center mt-2"
            @click="toggleShow"
            rounded
            >{{$t('admin.add_avatar')}}</v-btn
        >
    </div>
</template>
<script>
import { mapActions } from "vuex";
import myUpload from "vue-image-crop-upload/upload-2.vue";
export default {
    name: "AvatarUpload",
    data() {
        return {
            url: "http://localhost:8000/api/admin/avatar",
            show: false,
            fr: {
                hint: "Cliquez ou glissez le fichier ici.",
                loading: "Téléchargement…",
                noSupported: "Votre navigateur n'est pas supporté. Utilisez IE10 + ou un autre navigateur s'il vous plaît.",
                success: "Téléchargement réussi",
                fail: "Téléchargement echoué",
                preview: "Aperçu",
                btn: {
                    off: "Annuler",
                    close: "Fermer",
                    back: "Retour",
                    save: "Enregistrer",
                },
                error: {
                    onlyImg: "Image uniquement",
                    outOfSize: "L'image sélectionnée dépasse la taille maximum: ",
                    lowestPx: "L'image sélectionnée est trop petite. Dimensions attendues: ",
                },
            },
            params: {
                name: "avatar",
                noSquare: false,
                width: 150,
                height: 150,
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                smail: "*_~"
            },
            imgDataUrl: "",
        };
    },

    components: {
        "my-upload": myUpload,
    },
    methods: {
        ...mapActions({
            refreshUser: "usedByAll/refreshUser"
        }),
        toggleShow() {
            this.show = !this.show;
        },
        cropSuccess(imgDataUrl, field) {
            console.log("-------- crop success --------");
            this.imgDataUrl = imgDataUrl;
            console.log("field: " + field);
        },
        async cropUploadSuccess(jsonData, field) {
            console.log("-------- upload success --------");
            console.log(jsonData);
            console.log("field: " + field);
            await this.refreshUser();
        },
        cropUploadFail(status, field) {
            console.log("-------- upload fail --------");
            console.log(status);
            console.log("field: " + field);
        },
    },
};
</script>
