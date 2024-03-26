<script setup lang="ts">
import { PlusCircledIcon } from "@radix-icons/vue";
import Button from "../../ui/button/Button.vue";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "../../ui/select";
</script>

<template>
    <div class="header">
        <Select>
            <SelectTrigger class="w-[220px]">
                <SelectValue placeholder="Select a project" />
            </SelectTrigger>
            <SelectContent>
                <SelectGroup>
                    <SelectLabel>Project</SelectLabel>
                    <SelectItem value="shivalik-shilp">
                        Shivalik Shilp
                    </SelectItem>
                    <SelectItem value="ratnakar">
                        Ratnakar Nine Square</SelectItem
                    >
                </SelectGroup>
            </SelectContent>
        </Select>
        <Button><PlusCircledIcon /> Add Project</Button>
    </div>
</template>

<style scoped>
.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px;
    height: 72px;
    width: 100%;
    border-bottom: 2px solid #f4f4f5;
}

Button {
    padding: 8px 12px;
    gap: 4px;
}
</style>
