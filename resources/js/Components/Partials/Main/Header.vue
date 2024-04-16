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
                                    <SelectItem value="Team-1">
                                        Team A
                                    </SelectItem>
                                    <SelectItem value="Team-2">
                                        Team B
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                    </div>
                </div>
                <DialogFooter>
                    <Button type="submit"> Save changes & Deploy </Button>
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
