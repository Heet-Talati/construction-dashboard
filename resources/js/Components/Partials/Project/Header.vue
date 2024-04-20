<script setup lang="ts">
import { PlusCircledIcon } from "@radix-icons/vue";
import Button from "../../ui/button/Button.vue";
import Input from "../../../Components/ui/input/Input.vue";
import Label from "../../../Components/ui/label/Label.vue";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "../../ui/select";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "../../../Components/ui/dialog";
import axios from "axios";
import { ref } from "vue";
import { onMounted } from "vue";

interface Project {
    id: string;
    name: string;
}

const projects = ref<Project[]>([]);
const fetchProjects = () => {
    axios
        .get(route("projects.get"))
        .then((res) => {
            projects.value = res.data;
        })
        .catch((error) => {
            console.error("Error fetching projects:", error);
        });
};
onMounted(fetchProjects);

const currentProject = function () {
    const projectId = window.location.pathname.replace(/\D/g, "");

    return projectId.toString();
};

const currentPage = function () {
    const pathName = window.location.pathname.split("/");
    return pathName[pathName.length - 1];
};
</script>

<template>
    <div class="header">
        <Select :default-value="currentProject()">
            <SelectTrigger class="w-[220px]">
                <SelectValue placeholder="Select a project" />
            </SelectTrigger>
            <SelectContent>
                <SelectGroup>
                    <SelectLabel>Project</SelectLabel>
                    <SelectItem
                        v-for="project in projects"
                        :value="project.id.toString()"
                    >
                        <a :href="`/project/${project.id}/${currentPage()}`">
                            {{ project.name }}
                        </a>
                    </SelectItem>
                </SelectGroup>
            </SelectContent>
        </Select>
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

.dialog-title {
    font-family: "Inter";
    font-size: 24px;
    font-weight: bold;
}
.dialog-desc {
    font-family: "Inter";
    font-size: 12px;
    font-weight: 400;
    color: #71717a;
}
</style>
