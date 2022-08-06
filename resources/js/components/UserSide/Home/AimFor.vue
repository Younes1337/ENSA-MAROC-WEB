<template>
    <section style="haight: auto; background-color: transparent !important;">
        <section class="section-1">
            <v-row class="we-aim-for">
                <v-col>
                    <div class="imgs">
                        <div class="img-front"></div>
                        <div class="img-back"></div>
                    </div>
                </v-col>
                <v-col class="text" text-center>
                    <h2 v-html="$t('aim_for.title_1')"></h2>
                    <h4 v-html="$t('aim_for.subtitle_1')"></h4>
                    <p v-html="$t('aim_for.content_1')"></p>
                </v-col>
            </v-row>
        </section>
        <section class="section-2">
            <v-row class="we-aim-for reverse">
                <v-col class="text" text-center>
                    <h2 v-html="$t('aim_for.title_2')"></h2>
                    <h4 v-html="$t('aim_for.subtitle_2')"></h4>
                    <p v-html="$t('aim_for.content_2')"></p>
                </v-col>
                <v-col>
                    <div class="imgs-reverse">
                        <div class="img-front-reverse"></div>
                        <div class="img-back-reverse"></div>
                    </div>
                </v-col>
            </v-row>
        </section>
        <section class="section-3">
            <v-row class="we-aim-for">
                <v-col>
                    <div class="imgs">
                        <div class="img-front"></div>
                        <div class="img-back"></div>
                    </div>
                </v-col>
                <v-col class="text" text-center>
                    <h2 v-html="$t('aim_for.title_3')"></h2>
                    <p v-html="$t('aim_for.content_3')"></p>
                </v-col>
            </v-row>
        </section>
    </section>
</template>

<script>
    export default {
        name: 'AimFor'
    }
</script>