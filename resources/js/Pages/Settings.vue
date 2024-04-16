<script setup lang="ts">
import Sidebar from "../../../resources/js/Components/Partials/Main/Sidebar.vue";
import Header from "../../../resources/js/Components/Partials/Main/Header.vue";
import Label from "../Components/ui/label/Label.vue";
import { Link, Head } from "@inertiajs/vue3";
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
                    <div class="settings-items">
                        <button>
                            <Link href="/settings/profile">Profile</Link>
                            <!-- <Link :href="route('profile.edit')">Profile</Link> -->
                        </button>
                        <!-- <button>
                            <Link :href="route('profile.edit')">Roles</Link>
                        </button>
                        <button>
                            <Link :href="route('profile.edit')">
                                Permissions
                            </Link>
                        </button>
                        <button>
                            <Link :href="route('profile.edit')">Teams</Link>
                        </button> -->
                        <Link :href="route('logout')" method="post" as="button"
                            >Log Out</Link
                        >
                    </div>
                </div>
                <slot />
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
.settings-items {
    display: flex;
    align-items: flex-start;
    flex-direction: column;
    font-family: Inter;
    font-weight: 600;
    gap: 12px;
    padding: 24px 0;
}
.settings-items button,
.settings-items Link {
    cursor: pointer;
    width: auto;
    padding: 4px 8px;
    background-color: #d4d4d8;
    border-radius: 4px;
}
</style>
