<template>
    <section class="section-admin">
        <v-col class="pa-3 mt-5 d-inline-flex">
            <div class="vertical-div"></div>
            <p class="page-admin-title ma-0 ml-2">{{$t('admin.title_dashboard')}}</p>
        </v-col>

        <v-row class="pa-3">
            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                <v-card
                    class="rounded-lg"
                    style="box-shadow: 0 0 16px -6px grey"
                >
                    <highcharts :options="chartOptionsUsers"></highcharts>
                </v-card>
            </v-col>
            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                <v-card
                    class="rounded-lg"
                    style="box-shadow: 0 0 16px -6px grey"
                >
                    <highcharts :options="chartOptionsCourses"></highcharts>
                </v-card>
            </v-col>
        </v-row>
    </section>
</template>

<script>
export default {
    data() {
        return {
            chartOptionsUsers: {
                chart: {
                    type: "spline",
                    backgroundColor: "transparent",
                    height: 'inherit',
                    style: {
                        fontFamily: "Poppins",
                    },
                },
                title: {
                    text: "Website visitors",
                },
                series: [
                    {
                        data: [10, 0, 8, 2, 6, 4, 5, 5, 8, 30],
                        name: "Visitors number per month",
                        marker: {
                            enabled: true,
                            radius: 2,
                            symbol: "circle",
                            states: {
                                hover: {
                                    enabled: true,
                                    radius: 4,
                                },
                            },
                        },
                    },
                ],
                xAxis: {
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                },
                yAxis: {
                    title: {
                        text: "visitors",
                    },
                },
                rules: [],
                legend: {
                    enabled: true,
                },
                credits: {
                    enabled: true,
                },
                plotOptions: {
                    series: {
                        marker: {
                            enabled: true,
                        },
                        lineWidth: 2,
                        states: {
                            hover: {
                                lineWidth: 4,
                            },
                        },
                    },
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: "#ffffff",
                    borderColor: "#e74a23",
                    borderRadius: "4px",
                    borderWidth: "1px",
                    shadow: true,
                },
            },
            chartOptionsCourses: {
                chart: {
                    type: "spline",
                    backgroundColor: "transparent",
                    style: {
                        fontFamily: "Poppins",
                    },
                },
                colors: ["#e74a23", "#a32041", "#b0b0b0", "#7e20a3", "0d0d0d"],
                title: {
                    text: "Must visited courses",
                },
                series: [
                    {
                        data: [10, 0, 8, 2, 6, 4, 5, 5, 8, 25, 6, 17],
                        name: "Math",
                        marker: {
                            enabled: true,
                            radius: 2,
                            symbol: "circle",
                            states: {
                                hover: {
                                    enabled: true,
                                    radius: 4,
                                },
                            },
                        },
                    },
                    {
                        data: [3, 26, 8, 22, 10, 14, 11, 23, 3, 25, 6, 1],
                        name: "Information Technology",
                        marker: {
                            enabled: true,
                            radius: 2,
                            symbol: "circle",
                            states: {
                                hover: {
                                    enabled: true,
                                    radius: 4,
                                },
                            },
                        },
                    },
                    {
                        data: [24, 2, 14, 22, 10, 14, 16, 23, 7, 2, 6, 20],
                        name: "English",
                        marker: {
                            enabled: true,
                            radius: 2,
                            symbol: "circle",
                            states: {
                                hover: {
                                    enabled: true,
                                    radius: 4,
                                },
                            },
                        },
                    },
                ],
                xAxis: {
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                },
                yAxis: {
                    title: {
                        text: "views",
                    },
                },
                rules: [],
                tooltip: {
                    enabled: true,
                    backgroundColor: "#ffffff",
                    borderColor: "#e74a23",
                    borderRadius: "4px",
                    borderWidth: "1px",
                    shadow: true,
                },
            },
        };
    },
    mounted () {
    },
};
</script>
<style>
.vue-highcharts {
    width: 100%;
}
.highcharts-credits {
    display: none;
}
</style>
