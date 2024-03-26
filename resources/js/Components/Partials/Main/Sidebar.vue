<script setup lang="ts">
import {
    DashboardIcon,
    Pencil2Icon,
    ChatBubbleIcon,
    GearIcon,
    QuestionMarkCircledIcon,
} from "@radix-icons/vue";
import ProfilePic from "../ProfilePic.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="sidebar">
        <div class="top">
            <ProfilePic />
            <div class="pages">
                <Link :href="route('dashboard')">
                    <div class="tabs">
                        <DashboardIcon class="icon" />
                        <p>Dashboard</p>
                    </div>
                </Link>
                <Link :href="route('tasks')">
                    <div class="tabs">
                        <Pencil2Icon class="icon" />
                        <p>Tasks</p>
                    </div>
                </Link>
                <div class="tabs">
                    <ChatBubbleIcon class="icon" />
                    <p>Chat</p>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="pages">
                <div class="tabs">
                    <GearIcon class="icon" />
                    <p>Settings</p>
                </div>
                <div class="tabs">
                    <QuestionMarkCircledIcon class="icon" />
                    <p>Help</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.sidebar {
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    background-color: #f4f4f5;
    width: 72px;
    height: 100%;
}

.top,
.bottom {
    display: flex;
    flex-direction: column;
}
.pfp {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
}
.pfp > img {
    height: 40px;
    width: 40px;
}

.pages {
    padding: 8px;
    gap: 16px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.tabs {
    padding: 8px;
    width: 100%;
    border-radius: 4px;
    gap: 4px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}
.tabs:hover {
    background-color: #e4e4e7;
}
.tabs .icon {
    color: #71717a;
    height: 20px;
    width: 20px;
}
.tabs:hover .icon {
    color: #27272a;
}
.tabs > p {
    font-size: 8px;
    font-weight: 500;
    color: #a1a1aa;
}
.tabs:hover p {
    color: #71717a;
}
</style>
