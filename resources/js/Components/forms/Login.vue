<script setup lang="ts">
// import { h } from 'vue';
// import { useForm } from 'vee-validate';
// import { toTypedSchema } from '@vee-validate/zod';
// import * as z from 'zod';

import { Button } from "../../Components/ui/button";
import {
    FormControl,
    FormField,
    FormItem,
    FormMessage,
} from "../../Components/ui/form";
import { Input } from "../../Components/ui/input";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "../InputError.vue";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => {
            form.reset("password");
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
    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form class="" @submit.prevent="submit">
        <FormField v-slot="{ componentField }" name="email">
            <FormItem>
                <!-- <FormMessage /> -->
                <InputError :message="form.errors.email" />
                <FormControl>
                    <Input
                        type="email"
                        placeholder="Email"
                        id="email"
                        v-model="form.email"
                        required
                        autofocus
                        v-bind="componentField"
                    />
                </FormControl>
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="password">
            <FormItem>
                <!-- <FormMessage /> -->
                <InputError :message="form.errors.password" />
                <FormControl>
                    <Input
                        id="password"
                        type="password"
                        placeholder="Password"
                        v-model="form.password"
                        autocomplete="current-password"
                        v-bind="componentField"
                    />
                </FormControl>
            </FormItem>
        </FormField>
        <Button
            type="submit"
            :disabled="form.processing"
            :class="{ 'opacity-25': form.processing }"
            >Log in
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
