<template>
    <section class="terms-section mt-12">
        <v-container>
            <v-row class="text-left pa-6">
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <p>{{$t('titles_terms_page.other_1')}} {{new Date().getDate()}}.{{new Date().getMonth()+1}}.{{new Date().getFullYear()}}</p>
                    <p v-html="$t('titles_terms_page.other_2')"></p>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">
                            {{$t('titles_terms_page.title_part_1')}}
                        </h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_1')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_2')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_2')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_3')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_3')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_4')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_4')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_5')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_5')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">
                            {{$t('titles_terms_page.title_part_6')}}
                        </h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_6')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_7')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_7')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_8')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_8')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_9')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_9')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">
                            {{$t('titles_terms_page.title_part_10')}}
                        </h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_10')"></div>
                </v-col>

                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_11')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_11')"></div>
                </v-col>

                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_12')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_12')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_13')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_13')"></div>
                </v-col>
                <v-col
                    class="paragraph"
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    xl="12"
                >
                    <div id="terms-title" class="d-inline-flex mb-3">
                        <div class="vertical-div"></div>
                        <h2 class="ma-0 ml-2">{{$t('titles_terms_page.title_part_14')}}</h2>
                    </div>
                    <div v-html="$t('parag_terms_page.parag_part_14')"></div>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>

<script>
export default {
    data() {
        return {};
    },
};
</script>
