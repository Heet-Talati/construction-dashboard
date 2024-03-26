<script setup lang="ts">
// import { h } from 'vue';
// import { useForm } from 'vee-validate';
// import { toTypedSchema } from '@vee-validate/zod';
// import * as z from 'zod';

import { Button } from "@/Components/ui/button";
import { FormControl, FormField, FormItem } from "@/Components/ui/form";
import { Input } from "@/Components/ui/input";
import InputError from "@/Components/InputError.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
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
    <Head title="Forgot Password" />

    <!-- <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div> -->

    <form class="" @submit="submit">
        <FormField v-slot="{ componentField }" name="email">
            <FormItem>
                <InputError class="mt-2" :message="form.errors.email" />
                <FormControl>
                    <Input
                        v-bind="componentField"
                        id="email"
                        type="email"
                        placeholder="Email"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
                </FormControl>
            </FormItem>
        </FormField>

        <Button
            type="submit"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            >Send Password Reset Link
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
