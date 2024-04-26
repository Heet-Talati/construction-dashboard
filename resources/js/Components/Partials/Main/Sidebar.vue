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
                    <div
                        :class="{
                            tabsactive: $page.url === '/dashboard',
                            tabs: true,
                        }"
                    >
                        <DashboardIcon
                            :class="{
                                iconactive: $page.url === '/dashboard',
                                icon: true,
                            }"
                        />
                        <p
                            :class="{
                                pactive: $page.url === '/dashboard',
                                tabsp: true,
                            }"
                        >
                            Dashboard
                        </p>
                    </div>
                </Link>
                <Link :href="route('tasks')">
                    <div
                        :class="{
                            tabsactive: $page.url === '/tasks',
                            tabs: true,
                        }"
                    >
                        <Pencil2Icon
                            :class="{
                                iconactive: $page.url === '/tasks',
                                icon: true,
                            }"
                        />
                        <p
                            :class="{
                                pactive: $page.url === '/tasks',
                                tabsp: true,
                            }"
                        >
                            Tasks
                        </p>
                    </div>
                </Link>
                <!-- <Link :href="route('chat')">
                    <div
                        :class="{
                            tabsactive: $page.url === '/chat',
                            tabs: true,
                        }"
                    >
                        <ChatBubbleIcon
                            :class="{
                                iconactive: $page.url === '/chat',
                                icon: true,
                            }"
                        />
                        <p
                            :class="{
                                pactive: $page.url === '/chat',
                                tabsp: true,
                            }"
                        >
                            Chat
                        </p>
                    </div>
                </Link> -->
            </div>
        </div>
        <div class="bottom">
            <div class="pages">
                <Link :href="route('settings')">
                    <div
                        :class="{
                            tabsactive: $page.url === '/settings',
                            tabs: true,
                        }"
                    >
                        <GearIcon
                            :class="{
                                iconactive: $page.url === '/settings',
                                icon: true,
                            }"
                        />
                        <p
                            :class="{
                                pactive: $page.url === '/settings',
                                tabsp: true,
                            }"
                        >
                            Settings
                        </p>
                    </div>
                </Link>
                <!-- <Link :href="route('help')">
                    <div
                        :class="{
                            tabsactive: $page.url === '/help',
                            tabs: true,
                        }"
                    >
                        <QuestionMarkCircledIcon
                            :class="{
                                iconactive: $page.url === '/help',
                                icon: true,
                            }"
                        />
                        <p
                            :class="{
                                pactive: $page.url === '/help',
                                tabsp: true,
                            }"
                        >
                            Help
                        </p>
                    </div>
                </Link> -->
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
.pages a {
    display: inline-block;
    width: 100%;
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
.tabsactive {
    background-color: #e4e4e7;
}
.icon {
    color: #71717a;
    height: 20px;
    width: 20px;
}
.tabs:hover .icon {
    color: #27272a;
}
.iconactive {
    color: #27272a;
}
.tabsp {
    color: #a1a1aa;
    font-size: 8px;
    font-weight: 500;
}
.tabs:hover .tabsp {
    color: #71717a;
}
.pactive {
    color: #71717a;
}
</style>
