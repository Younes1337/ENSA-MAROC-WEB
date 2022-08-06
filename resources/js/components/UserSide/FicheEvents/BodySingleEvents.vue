<template>
    <section class="ficheCEN-section">
        <v-app>
            <v-container fluid>
                <v-row>
                    <v-col
                        class="px-4"
                        cols="12"
                        xs="12"
                        sm="12"
                        md="12"
                        lg="12"
                        xl="12"
                    >
                        <v-card class="ficheCEN-card">
                            <v-card-title class="card-title"
                                >Details</v-card-title
                            >
                            <v-card-text>
                                <div class="card-content">
                                    <p>
                                        {{ description }}
                                    </p>
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-app>
    </section>
</template>
<script>
export default {
    data() {
        return {};
    },
    props: ['description']
};
</script>
