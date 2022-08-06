<template>
    <section class="faq-section mt-12">
        <v-row class="mt-5" justify="center">
            <v-expansion-panels inset>
                <v-expansion-panel v-for="faq in faqs" :key="faq.id">
                    <v-expansion-panel-header>{{
                        faq.question
                    }}</v-expansion-panel-header>
                    <v-expansion-panel-content>{{
                        faq.response
                    }}</v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-row>
    </section>
</template>

<script>
export default {
    data() {
        return {
            faqs: [],
        };
    },
    async mounted() {
        const { data } = await this.axios.get("/api/faq");
        console.log("====================================");
        console.log(data);
        console.log("====================================");
        this.faqs = data.map((faq) => ({ ...faq, show: false }));
    },
};
</script>
