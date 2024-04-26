<script setup lang="ts">
// import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Sidebar from "../../../../resources/js/Components/Partials/Project/Sidebar.vue";
import Header from "../../../../resources/js/Components/Partials/Project/Header.vue";
import Timeline from "../../../../resources/js/Components/Partials/Project/Timeline.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const tasks = ref({
    data: [
        {
            id: 1,
            text: "Task #1",
            start_date: "2024-01-17",
            duration: 3,
            progress: 0.6,
        },
        {
            id: 2,
            text: "Task #2",
            start_date: "2024-01-20",
            duration: 3,
            progress: 0.4,
        },
    ],
    links: [{ id: 1, source: 1, target: 2, type: "0" }],
});
</script>

<template>
    <Head title="Timelline" />

    <div class="container">
        <div class="left">
            <Sidebar />
        </div>
        <div class="right">
            <Header />
            <div class="bottom">
                <h1>Timeline</h1>
                <!-- https://www.syncfusion.com/forums/187729/module-edit-is-not-available-in-treegrid-component?reply=z9vPrX -->
                <!-- There is a breaking issue with the component -->
                <Timeline />
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
.right .bottom {
    padding: 12px 8px;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 24px;
}
.right .bottom h1 {
    font-family: "Inter", sans-serif;
    font-weight: bold;
    font-size: 32px;
    text-align: left;
}
</style>
