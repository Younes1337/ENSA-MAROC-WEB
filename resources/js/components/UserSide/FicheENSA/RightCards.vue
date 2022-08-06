<template>
    <div>
        <v-card class=" ficheENSA-card-right mb-8">
            <v-card-title class="card-title" v-html="$t('fiche_ensa.docs')"></v-card-title>
            <v-card-text>
                <div class="card-content">
                    <p v-html="$t('fiche_ensa.docs_subtitle')"></p>
                    <v-btn class="btn-more-mini text-center" to="/courses" rounded> {{$t('fiche_ensa.explore_docs')}} </v-btn>
                </div>
            </v-card-text>
        </v-card>
        <v-card class=" ficheENSA-card-right mb-8">
            <v-card-title class="card-title" v-html="$t('fiche_ensa.intro')"></v-card-title>
            <v-card-text>
                <div class="card-content" v-html="ENSAInfo.intro">
                    {{ ENSAInfo.intro }}
                </div>
            </v-card-text>
        </v-card>
        <v-card class=" ficheENSA-card-right mb-8">
            <v-card-title class="card-title" v-html="$t('fiche_ensa.initial_edu')"></v-card-title>
            <v-card-text>
                <div class="card-content" v-html="ENSAInfo.initial_education">
                    {{ ENSAInfo.initial_education }}
                </div>
            </v-card-text>
        </v-card>
        <v-card class=" ficheENSA-card-right mb-8">
            <v-card-title class="card-title" v-html="$t('fiche_ensa.initial_edu')"></v-card-title>
            <v-card-text>
                <div class="card-content" v-html="ENSAInfo.continuing_education">
                    {{ ENSAInfo.continuing_education }}
                </div>
            </v-card-text>
        </v-card>
        <v-card class=" ficheENSA-card-right mb-8">
            <v-card-title class="card-title" v-html="$t('fiche_ensa.cooperation')"></v-card-title>
            <v-card-text>
                <div class="card-content" v-html="ENSAInfo.cooperation">
                    {{ ENSAInfo.cooperation }}
                </div>
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
    export default {
        data: () => ({}),
        props: ["ENSAInfo"]
    }
</script>