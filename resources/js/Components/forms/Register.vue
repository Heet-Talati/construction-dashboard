<script setup lang="ts">
// import { h } from 'vue';
// import { useForm } from 'vee-validate';
// import { toTypedSchema } from '../..vee-validate/zod';
// import * as z from 'zod';

import { Button } from "../../Components/ui/button";
import { FormControl, FormField, FormItem } from "../../Components/ui/form";
import { Input } from "../../Components/ui/input";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "../InputError.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => {
            form.reset("password", "password_confirmation");
        },
    });
};

// const formSchema = toTypedSchema(
//   z.object({
//     fullName: z.string().min(2).max(50),
//   })
// );

// const { handleSubmit } = useForm({
//   validationSchema: formSchema,
// });
</script>

<template>
    <form class="" @submit.prevent="submit">
        <FormField v-slot="{ componentField }" name="name">
            <FormItem>
                <InputError class="mt-2" :message="form.errors.name" />
                <FormControl>
                    <Input
                        id="name"
                        type="text"
                        placeholder="Full Name"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                        v-bind="componentField"
                    />
                </FormControl>
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="email">
            <FormItem>
                <InputError class="mt-2" :message="form.errors.email" />
                <FormControl>
                    <Input
                        id="email"
                        type="email"
                        placeholder="Email"
                        v-model="form.email"
                        required
                        autocomplete="username"
                        v-bind="componentField"
                    />
                </FormControl>
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="password">
            <FormItem>
                <InputError class="mt-2" :message="form.errors.password" />
                <FormControl>
                    <Input
                        id="password"
                        type="password"
                        placeholder="Password"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        v-bind="componentField"
                    />
                </FormControl>
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="confirm-password">
            <FormItem>
                <FormControl>
                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                    <Input
                        id="password_confirmation"
                        type="password"
                        placeholder="Confirm Password"
                        v-model="form.password_confirmation"
                        autocomplete="new-password"
                        required
                        v-bind="componentField"
                    />
                </FormControl>
            </FormItem>
        </FormField>
        <Button
            type="submit"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            >Register
        </Button>
    </form>
</template>

<style scoped>
form {
    width: 100%;
    display: flex;
    gap: 16px;
    flex-direction: column;
    align-items: stretch;
    justify-content: center;
}
</style>
