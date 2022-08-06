<template>
    <section class="section-auto events-section mt-6">
        <v-container fluid grid-list-md>
            <v-layout row>
                <v-flex
                    v-for="event in events"
                    :key="event.id"
                    xs12
                    sm12
                    md12
                    lg12
                    xl12
                >
                    <v-card class="ma-2 mb-6 pa-3" :to="'/singleEvent/' + event.id">
                        <v-row>
                            <v-col cols="12" md="4">
                                <v-img
                                    :src="event.image"
                                    class="white--text align-start rounded-lg"
                                    height="300px"
                                ></v-img>
                            </v-col>
                            <v-col cols="12" md="8">
                                <v-row>
                                    <v-col cols="12" md="12">
                                        <v-chip-group column>
                                            <v-chip
                                                small
                                                label
                                                v-for="tag in event.tags"
                                                :key="tag.id"
                                                >{{ tag }}</v-chip
                                            >
                                        </v-chip-group>
                                        <v-card-text
                                            class="title-card pb-0 px-0"
                                        >
                                            {{ event.title }}
                                        </v-card-text>

                                        <v-card-text class="text-card px-0">
                                            {{ event.description }}
                                        </v-card-text>
                                    </v-col>
                                    <v-col cols="12" md="12">
                                        <v-card-actions
                                            class="d-flex justify-space-between pa-0"
                                        >
                                            <p
                                                class="align-self-baseline ensa-location ma-0"
                                            >
                                                {{
                                                    event.ensa +
                                                    " - " +
                                                    event.duration
                                                }}
                                            </p>
                                            <p
                                                class="align-self-baseline ensa-location ma-0"
                                            >
                                                {{ event.start_at }}
                                            </p>
                                        </v-card-actions>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </section>
</template>
<script>
export default {
    data() {
        return {
            events: [],
        };
    },
    methods: {
        timeDistance(date1, date2) {
            let distance = Math.abs(date1 - date2);
            const years = Math.floor(distance / 31104000000);
            distance -= years * 31104000000;
            const months = Math.floor(distance / 2592000000);
            distance -= months * 2592000000;
            const days = Math.floor(distance / 86400000);
            distance -= days * 86400000;
            const hours = Math.floor(distance / 3600000);
            distance -= hours * 3600000;
            const minutes = Math.floor(distance / 60000);
            distance -= minutes * 60000;
            const seconds = Math.floor(distance / 1000);
            // ${years}:${months}:${days} days:
            let interval = "";
            if (minutes != "00")
                interval = `${hours} hour ${("0" + minutes).slice(-2)} min`;
            if (hours == "00") interval = `${("0" + minutes).slice(-2)} min`;
            return interval;
        },
    },
    async mounted() {
        const { data } = await this.axios.get("/api/events");
        data.map((event) => {
            this.events.push({
                ...event,
                duration: this.timeDistance(
                    new Date(event.end_at),
                    new Date(event.start_at)
                ),
                tags: event.tags.split(","),
                show: false,
            });
        });
    },
};
</script>
