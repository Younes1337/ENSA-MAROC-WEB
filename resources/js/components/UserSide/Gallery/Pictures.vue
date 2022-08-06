<template>
    <section class="mt-12 pictures">
        <v-container>
            <v-row>
                <v-col
                    class="pa-4"
                    v-for="item in images"
                    :key="item.id"
                    cols="12"
                    sm="4"
                >
                    <v-lazy
                        v-model="isActive"
                        :options="{
                            threshold: 0.5,
                        }"
                        min-height="200"
                        transition="fade-transition"
                    >
                    <div class="spotlight" :data-src="item.path" data-animation="scale" data-title="false">
                        <v-card
                            class="picture"
                            @click="overlay = !overlay"
                            :style="{ backgroundImage: `url(${item.path})` }"
                        >
                            <v-card-title
                                class="title"
                                flat
                                align-center
                                justify-center
                                >{{ item.ensa.title }}</v-card-title
                            >
                            <div class="back"></div>
                        </v-card>
                    </div>
                    </v-lazy>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>
<script>
export default {
    data() {
        return {
            isActive: false,
            loading: false,
            images: []
        };
    },
    async mounted() {
        const { data } = await this.axios.get("/api/image");
        this.images = data.map((image) => ({ ...image, show: false }));
    },
};
</script>