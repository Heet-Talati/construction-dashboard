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
            <Header />
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
    justify-content: right;
}
</style>
