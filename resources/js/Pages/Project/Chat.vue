<script setup lang="ts">
// import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Sidebar from "../../../../resources/js/Components/Partials/Project/Sidebar.vue";
import Header from "../../../../resources/js/Components/Partials/Project/Header.vue";
import Input from "../../../../resources/js/Components/ui/input/Input.vue";
import Button from "../../../../resources/js/Components/ui/button/Button.vue";
import { Head } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import { EarthIcon, User } from "lucide-vue-next";
import axios from "axios";

const chatlane = document.querySelector("#chat-container");

const getUrl = function () {
    const url = window.location.pathname;
    const digits = url
        .split("")
        .filter((char) => "0" <= char && char <= "9")
        .join("");
    return parseInt(digits, 10);
};
const project_id: number = getUrl();

const message = ref<string>("");
const getMessages = ref<any[]>([]);
// let getMessages: any[] = [];
let convo = [];
getMessages.value.forEach((message) => {
    convo.push({
        message: message.message,
        username: message.username,
        current: message.current,
    });
});
const pushMessage = () => {
    // axios
    //     .post(route("message.submit"), {
    //         msg: message.value,
    //         project_id: project_id,
    //     })
    //     .then((res) => console.log(res));
    // message.value = "";
    mount();
    chatlane?.scroll(chatlane.scrollTop, 999999);
};
const mount = () => {
    axios
        .post(route("message.get"), { project_id: project_id })
        .then((res) => (getMessages.value = res.data));
};

onMounted(() => {
    mount();
    chatlane?.scroll(chatlane.scrollTop, 9999);
    console.log("scrolled");
    window.Echo.channel("project-chat").listen("MessageEvent", (data: any) => {
        console.log("Recieved data", data);
    });
});
</script>

<template>
    <Head title="Tasks" />

    <div class="container">
        <div class="left">
            <Sidebar />
        </div>
        <div class="right">
            <Header />
            <div class="bottom">
                <h1>GroupChat</h1>
                <div class="chat">
                    <!-- <div class="groups">
                        <h1 v-for="x in 20">GroupName</h1>
                    </div> -->
                    <div class="chat-main">
                        <div class="chat-main-top" id="chat-container">
                            <div
                                class="flex"
                                :class="{ flex_end: message.current == 1 }"
                                v-for="message in getMessages"
                            >
                                <div
                                    class="message"
                                    :class="{
                                        chat_bubble: message.current == 1,
                                    }"
                                >
                                    <span class="username">{{
                                        message.username
                                    }}</span>
                                    <span class="textchat">{{
                                        message.message
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat-main-bottom">
                            <form
                                @submit.prevent="pushMessage"
                                class="chat-bar"
                            >
                                <Input
                                    placeholder="enter message"
                                    v-model="message"
                                ></Input>
                                <Button>Send</Button>
                            </form>
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

.chat {
    display: flex;
    border: 1px solid black;
    max-width: 920px;
    width: 100%;
    max-height: 75vh;
    /* max-height: 650px; */
    height: 100%;
}
.groups {
    border-right: 1px solid black;
    width: 270px;
    height: 100%;
    overflow-y: scroll;
}
.chat-main {
    display: flex;
    flex-direction: column;
    /* width: calc(920px - 220px); */
    width: 100%;
}
.chat-main-top {
    height: 100%;
    overflow-y: auto;
    overflow-wrap: break-word;
}
.chat-main-bottom {
    height: 70px;
    width: 100%;
    border-top: 1px solid black;
}
.chat-bar {
    width: 80%;
    display: flex;
    gap: 24px;
    margin: 15px auto;
}
.message {
    padding: 4px 12px;
    margin: 4px 12px;
    border-radius: 12px;
    display: inline-flex;
    /* gap: 2px; */
    flex-direction: column;
    background-color: rgb(60, 151, 255);
    color: white;
    max-width: 50%;
    width: auto;
}
.flex {
    display: flex;
}
.flex_end {
    justify-content: flex-end;
}
.chat_bubble {
    background-color: rgb(42, 189, 19);
}
.username {
    font-size: 14px;
    font-weight: 700;
}
.textchat {
    font-size: 20px;
    font-weight: 500;
}
</style>
