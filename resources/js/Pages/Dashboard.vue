<script setup lang="ts">
// import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Sidebar from "../../../resources/js/Components/Partials/Main/Sidebar.vue";
import Header from "../../../resources/js/Components/Partials/Main/Header.vue";
import { Head } from "@inertiajs/vue3";
import axios from "axios";
import { ref } from "vue";

const statusCount = ref({});
const totalCount = ref(null);
axios
    .get(route("dashboard.statusCount"))
    .then((res) => {
        statusCount.value = res.data;
        totalCount.value =
            res.data.Open +
            res.data.InProgress +
            res.data.Review +
            res.data.Done;
    })
    .catch((error) => {
        console.error("Error saving changes:", error);
    });

const teamsCount = ref({});
axios
    .get(route("dashboard.teams"))
    .then((res) => {
        teamsCount.value = res.data;
    })
    .catch((error) => {
        console.error("Error saving changes:", error);
    });

const projects = ref({});
axios
    .get(route("projects.get"))
    .then((res) => {
        projects.value = res.data;
    })
    .catch((error) => {
        console.error("Error saving changes:", error);
    });
</script>

<!-- <template>
    <AuthenticatedLayout>
        <Sidebar />
    </AuthenticatedLayout>
</template> -->

<template>
    <Head title="Dashboard" />

    <div class="container">
        <div class="left">
            <Sidebar />
        </div>
        <div class="right">
            <div class="top">
                <Header />
                <!-- <h1>
                    Building dashboard, enough data has not been gathered yet...
                </h1> -->
            </div>
            <div class="bottom">
                <div class="tasks">
                    <h2>Task Progress</h2>
                    <div class="task_state">
                        <h3>📋 Open</h3>
                        <div class="progress">
                            <h3>
                                Total - {{ statusCount.Open }}/{{ totalCount }}
                            </h3>
                        </div>
                    </div>
                    <div class="task_state">
                        <h3>⏳ In Progress</h3>
                        <div class="progress">
                            <h3>
                                Total - {{ statusCount.InProgress }}/{{
                                    totalCount
                                }}
                            </h3>
                        </div>
                    </div>
                    <div class="task_state">
                        <h3>📖 Review</h3>
                        <div class="progress">
                            <h3>
                                Total - {{ statusCount.Review }}/{{
                                    totalCount
                                }}
                            </h3>
                        </div>
                    </div>
                    <div class="task_state">
                        <h3>✅ Done</h3>
                        <div class="progress">
                            <h3>
                                Total - {{ statusCount.Done }}/{{ totalCount }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="projects">
                    <h2>Your Current Projects</h2>
                    <div class="projects-list">
                        <div v-for="project in projects" class="team_state">
                            <h3>{{ project.name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="teams">
                    <h2>Current Teams</h2>
                    <div v-for="team in teamsCount" class="team_state">
                        <h3>{{ team.name }} - {{ team.count }}</h3>
                        <!-- <div class="progress"><h3>Members - 0</h3></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    display: flex;
    flex-direction: row;
    height: 100vh;
    max-width: 100%;
    /* max-width: 1280px; */

    padding: 0;
}

.left {
    height: 100%;
}

.right {
    height: 100%;
    width: 100%;
    background-color: #ffffff;

    display: flex;
    flex-direction: column;
    justify-content: right;
}
.top > h1 {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 40%;
    color: #515156;
    user-select: none;
    transform: translate(-50%, -50%);
    font-weight: bold;
    font-size: xx-large;
}
.bottom {
    display: flex;
    height: 100%;
    width: 100%;
    padding: 16px;
    /* gap: 24px; */
    justify-content: space-between;
}
.tasks {
    background-color: #acacac;
    height: 90%;
    width: 300px;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    padding: 16px;
}
.tasks > h2,
.projects > h2,
.teams > h2 {
    font-size: 32px;
    font-weight: 700;
    width: 100%;
    text-align: center;
    /* margin-bottom: 8px; */
}
.task_state > h3 {
    font-size: 20px;
    font-weight: 500;
}
.task_state {
    display: flex;
    flex-direction: column;
    height: 100px;
    border-radius: 8px;
    padding: 8px 12px;
    width: 100%;
    background-color: #ffffff;
}
.task_state .progress {
    height: 100%;
    display: flex;
    align-items: center;
}
.task_state .progress > h3 {
    font-size: 24px;
    font-weight: 600;
    color: #505050;
}

.teams {
    background-color: #acacac;
    height: 90%;
    width: 300px;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    /* justify-content: space-between; */
    padding: 16px;
}
.team_state > h3 {
    font-size: 20px;
    font-weight: 700;
}
.team_state {
    display: flex;
    justify-content: center;
    flex-direction: column;
    height: 50px;
    border-radius: 8px;
    padding: 8px 12px;
    width: 100%;
    background-color: #ffffff;
    color: #2f2f2f;
    margin-top: 12px;
}
/* .team_state .progress {
    height: 100%;
    display: flex;
    align-items: center;
}
.team_state .progress > h3 {
    font-size: 24px;
    font-weight: 600;
    color: #505050;
} */

.projects {
    background-color: #acacac;
    height: 90%;
    width: 700px;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    padding: 16px;
}
.projects-list {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    gap: 12px;
}
.projects-list > div {
    width: 45%;
}
</style>
