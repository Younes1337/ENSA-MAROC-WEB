<template>
    <section>
        <v-row class="px-4">
            <h3 class="mb-4 text-left" style="color: var(--purple-color)">
                Chapters
            </h3>
            <v-expansion-panels inset>
                <!-- Courses list -->
                <v-expansion-panel>
                    <v-expansion-panel-header> <strong>Courses</strong> </v-expansion-panel-header>
                    <v-expansion-panel-content class="text-left">
                        <div v-for="element in elements" :key="element.id">
                            <h4 class="mt-2"> {{ element.title_element }}:</h4>
                            <ul class="pl-8 mt-1">
                                <li v-for="doc in element.documents" :key="doc.id">
                                    <a v-if="doc.doc_type === 'courses'" :href="doc.doc_link" target="_blank">
                                        {{doc.doc_title}}
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div v-if="coursesModules.length">
                            <h4 class="mt-2">Module courses :</h4>
                            <ul class="pl-8 mt-1">
                                <li v-for="course in coursesModules" :key="course.id">
                                    <a  :href="course.doc_link" target="_blank">
                                        {{course.doc_title}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </v-expansion-panel-content>
                </v-expansion-panel>
                <!-- Practical work / Directed work list -->
                <v-expansion-panel>
                    <v-expansion-panel-header> <strong>Practical work / Directed work</strong> </v-expansion-panel-header>
                    <v-expansion-panel-content class="text-left">
                        <ul class="pl-8">
                            <li v-for="practicalWork in practicalWorks" :key="practicalWork.id">
                                <a v :href="practicalWork.doc_link" target="_blank">
                                    {{practicalWork.doc_title}}
                                </a>
                            </li>
                        </ul>
                    </v-expansion-panel-content>
                </v-expansion-panel>
                <!-- Exams list -->
                <v-expansion-panel>
                    <v-expansion-panel-header> <strong>Exams</strong> </v-expansion-panel-header>
                    <v-expansion-panel-content class="text-left">
                        <ul class="pl-8">
                            <li v-for="exam in exams" :key="exam.id">
                                <a :href="exam.doc_link" target="_blank">
                                    {{exam.doc_title}}
                                </a>
                            </li>
                        </ul>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-row>
    </section>
</template>
<script>
export default {
    data() {
        return {
            coursesModules: [],
            exams: [],
            practicalWorks: [],
        };
    },

    props: ['elements', 'documents'],

    mounted () {
        const examsElements = this.elements.documents.filter(doc => doc.doc_type === "exams");
        const examsModules = this.documents.filter(doc => doc.doc_type === "exams");
        this.exams = [...examsElements, ...examsModules];
        

        const practicalWorksElements = this.elements.documents.filter(
            doc => doc.doc_type === "practical_directed_work"
        );
        const practicalWorksModules = this.documents.filter(
            doc => doc.doc_type === "practical_directed_work"
        );
        this.practicalWorks = [...practicalWorksElements, ...practicalWorksModules];

        this.coursesModules = this.documents.filter(doc => doc.doc_type === "courses");
        
    },

};
</script>
