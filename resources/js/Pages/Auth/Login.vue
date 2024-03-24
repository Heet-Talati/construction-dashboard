<script setup lang="ts">
import Login from "../../Components/forms/Login.vue";
import Label from "../../Components/ui/label/Label.vue";
import { Link } from "@inertiajs/vue3";

// defineProps<{
//     canResetPassword?: boolean;
//     status?: string;
// }>();

// const form = useForm({
//     email: "",
//     password: "",
//     remember: false,
// });

// const submit = () => {
//     form.post(route("login"), {
//         onFinish: () => {
//             form.reset("password");
//         },
//     });
// };
</script>

<template>
    <div class="container">
        <div class="left">
            <div class="content">
                <Label>Log in to</Label>
                <div class="logo">
                    <img src="../../../../public/assets/LogoD.png" alt="Logo" />
                </div>
                <Login />
                <div class="links">
                    <Link :href="route('password.request')">
                        Forgot your password?
                    </Link>
                    <p class="mini-text">
                        Don't have an account?
                        <span class="link"
                            ><Link :href="route('register')">
                                Register
                            </Link></span
                        >
                    </p>
                </div>
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
    width: 60%;
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
    gap: 16px;
    width: 480px;
    min-width: 400px;
    padding: 64px 40px;
    border: 1px solid #d4d4d8;
    border-radius: 8px;
}
.content Label {
    font-family: "Inter", sans-serif;
    font-size: 16px;
    font-weight: 500;
}
.content > div.logo {
    margin: 0;
}

.links {
    font-family: "Inter", sans-serif;
    margin-top: 16px;
    font-size: 12px;
    font-weight: 500;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.links .mini-text {
    color: #71717a;
}
.mini-text .link {
    color: black;
}

.right {
    height: 100%;
    width: 40%;
    background-color: #18181b;

    display: flex;
    justify-content: right;
}
.logo {
    width: 150px;
    margin: 30px 50px;
}
</style>
