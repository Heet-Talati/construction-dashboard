<script setup lang="ts">
import Sidebar from "../../../resources/js/Components/Partials/Main/Sidebar.vue";
import Header from "../../../resources/js/Components/Partials/Main/Header.vue";
import Label from "../Components/ui/label/Label.vue";
import { Head } from "@inertiajs/vue3";

// Temp
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Profile/Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Profile/Partials/UpdateProfileInformationForm.vue";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>

<template>
    <Head title="Settings" />

    <div class="container">
        <div class="left">
            <Sidebar />
        </div>
        <div class="right">
            <Header />
            <div class="bottom">
                <div class="settings-sidebar">
                    <Label>Settings</Label>
                </div>
                <div class="main">
                    <h2
                        class="font-bold sm:p-4 text-2xl text-black-900 leading-tight"
                    >
                        Profile
                    </h2>

                    <div>
                        <div class="p-2 sm:p-4 bg-white shadow sm:rounded-lg">
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                                class="max-w-xl"
                            />
                        </div>

                        <div class="p-2 sm:p-4 bg-white shadow sm:rounded-lg">
                            <UpdatePasswordForm class="max-w-xl" />
                        </div>

                        <div class="p-2 sm:p-4 bg-white shadow sm:rounded-lg">
                            <DeleteUserForm class="max-w-xl" />
                        </div>
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
    position: fixed;
}

.right {
    height: 100%;
    width: 100%;
    margin-left: 72px;
    background-color: #ffffff;

    display: flex;
    flex-direction: column;
    justify-content: right;
}
.bottom {
    display: flex;
    flex-direction: row;
    height: 100%;
    width: 100%;
}
.settings-sidebar {
    display: flex;
    flex-direction: column;
    background-color: #e4e4e7;
    width: 175px;
    height: 50%;
    border-radius: 0 4px 4px 0;
    padding: 24px 16px;
}
Label {
    font-size: 24px;
    font-family: "Inter";
    font-weight: 600;
}
.main {
    display: flex;
    flex-direction: column;
}
</style>
