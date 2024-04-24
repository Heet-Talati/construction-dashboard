<script setup lang="ts">
// import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Sidebar from "../../../resources/js/Components/Partials/Main/Sidebar.vue";
import Header from "../../../resources/js/Components/Partials/Main/Header.vue";
import { Head } from "@inertiajs/vue3";
import axios from "axios";
// axios
//     .post(route("test", [1]))
//     .then((res) => {
//         console.log(res.data);
//     })
//     .catch((error) => {
//         console.error("Error saving changes:", error);
//     });
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
                <h1>
                    Building dashboard, enough data has not been gathered yet...
                </h1>
            </div>
            <div class="bottom"></div>
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
</style>
