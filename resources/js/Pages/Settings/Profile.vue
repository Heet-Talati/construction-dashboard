<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from ".././Profile/Partials/DeleteUserForm.vue";
import UpdatePasswordForm from ".././Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from ".././Profile/Partials/UpdateProfileInformationForm.vue";
import Settings from "../Settings.vue";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>

<template>
    <Settings>
        <div class="main">
            <h2 class="font-bold sm:p-4 text-2xl text-black-900 leading-tight">
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
    </Settings>
</template>
