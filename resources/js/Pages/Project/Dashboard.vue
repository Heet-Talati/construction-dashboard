<script setup lang="ts">
// import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Sidebar from "../../../../resources/js/Components/Partials/Project/Sidebar.vue";
import Header from "../../../../resources/js/Components/Partials/Project/Header.vue";
import { Head } from "@inertiajs/vue3";
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
            </div>
            <div class="bottom">
                <h1>
                    Building dashboard, enough data has not been gathered yet...
                </h1>
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
.bottom > h1 {
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
</style>
