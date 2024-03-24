<script lang="ts" setup>
import { Button } from "../../Components/ui/button";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head>404</Head>

    <div class="container">
        <div class="left">
            <div class="content">
                <h1>404</h1>
                <p>Sorry, the page you are looking for could not be found</p>
                <Button><a href="/">Simon Go Back</a></Button>
            </div>
        </div>
        <div class="right">
            <div class="logo">
                <img src="../../../../public/assets/LogoL.png" alt="Logo" />
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
    width: 65%;
    background-color: #fff;

    display: flex;
    justify-content: center;
    align-items: center;
}
.content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 25px;
    max-width: 440px;
}
.content h1 {
    font-family: "Inter", sans-serif;
    font-size: 124px;
    font-weight: 400;
}
.content p {
    font-family: "Kalam", cursive;
    text-align: center;
    font-weight: 400;
    font-size: 32px;
}
.content Button {
    font-weight: 500;
    font-size: 1.125rem;
    padding: 24px 20px;
}

.right {
    height: 100%;
    width: 35%;
    background-color: #18181b;

    display: flex;
    justify-content: right;
}
.logo {
    width: 200px;
    margin: 30px 50px;
}
</style>
