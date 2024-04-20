<script setup lang="ts">
import { PlusCircledIcon } from "@radix-icons/vue";
import Button from "../../ui/button/Button.vue";
import Input from "@/Components/ui/input/Input.vue";
import Label from "@/Components/ui/label/Label.vue";
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
} from "@/Components/ui/dialog";
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

interface Team {
    id: string;
    name: string;
}

const teams = ref<Team[]>([]);
axios.get(route("teams.get")).then((res) => {
    teams.value = res.data;
});

const selectedProjectId = ref<string>("");
const projectName = ref<string>("");
const handleSaveChanges = () => {
    const data = {
        name: projectName.value,
        project_id: selectedProjectId.value,
    };
    axios
        .post(route("projects.make"), data)
        .then((response) => {
            console.log(response.data);
            const redirectUrl = `${window.location.origin}/project/${response.data.id}/dashboard`;
            window.location.href = redirectUrl;
        })
        .catch((error) => {
            console.error("Error saving changes:", error);
        });
};

// const selectedItem = ref<string>("");
// const handleSelectChange = (id: string) => {
//     console.log(id);
//     axios.get(route("chat"));
// };
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
                    <SelectItem
                        v-for="project in projects"
                        :value="project.name"
                    >
                        <a :href="`/project/${project.id}/dashboard`">
                            {{ project.name }}
                        </a>
                    </SelectItem>
                </SelectGroup>
            </SelectContent>
        </Select>
        <Dialog>
            <DialogTrigger as-child>
                <Button><PlusCircledIcon /> Add Project</Button>
            </DialogTrigger>
            <DialogContent class="sm:max-w-[300px]">
                <DialogHeader>
                    <DialogTitle class="dialog-title"
                        >Create Project</DialogTitle
                    >
                    <DialogDescription class="dialog-desc">
                        Deploy your new project in one click.
                    </DialogDescription>
                </DialogHeader>
                <div class="grid gap-4 py-4">
                    <div class="grid grid-cols-4 items-center gap-2">
                        <Label for="name"> Name </Label>
                        <Input
                            v-model="projectName"
                            id="name"
                            placeholder="Name of your Project"
                            class="col-span-4"
                        />
                    </div>
                    <div class="grid grid-cols-4 items-center gap-2">
                        <Label for="username"> Team </Label>
                        <Select>
                            <SelectTrigger class="col-span-4">
                                <SelectValue placeholder="Select" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Project Teams</SelectLabel>
                                    <SelectItem
                                        v-for="team in teams"
                                        :value="team.id"
                                        @click="selectedProjectId = team.id"
                                    >
                                        {{ team.name }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                    </div>
                </div>
                <DialogFooter>
                    <Button @click="handleSaveChanges">
                        Save changes & Deploy
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
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
