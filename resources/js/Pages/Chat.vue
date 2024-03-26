<script setup lang="ts">
// import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Sidebar from "../../../resources/js/Components/Partials/Main/Sidebar.vue";
import Header from "../../../resources/js/Components/Partials/Main/Header.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Chat" />

    <div class="container">
        <div class="left">
            <Sidebar />
        </div>
        <div class="right">
            <Header />
            <div class="bottom">
                <h1>Chats</h1>
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
    gap: 24px;
}
.right .bottom h1 {
    font-family: "Inter", sans-serif;
    font-weight: bold;
    font-size: 32px;
    text-align: left;
}
</style>
