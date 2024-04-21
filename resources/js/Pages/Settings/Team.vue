<script setup lang="ts">
import Label from "../../Components/ui/label/Label.vue";
import Button from "../../Components/ui/button/Button.vue";
import Input from "../../Components/ui/input/Input.vue";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "../../Components/ui/select";
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from "../../Components/ui/alert-dialog";
import { TrashIcon } from "@radix-icons/vue";
import Settings from "../Settings.vue";
import { getCurrentInstance, ref } from "vue";
import axios from "axios";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();

interface Team {
    id: number;
    name: string;
}

const teams = ref<Team[]>([]);
axios.get(route("teams.get")).then((res) => {
    teams.value = res.data;
});

const selectedTeamId = ref<number>();
const memberEmail = ref<string>("");
const handleSaveChanges = () => {
    const data = {
        email: memberEmail.value,
        team: selectedTeamId.value,
    };
    axios
        .post(route("member.add"), data)
        .then((response) => {
            console.log(response.data);
            // const redirectUrl = `${window.location.origin}/project/${response.data.id}/dashboard`;
            // window.location.href = redirectUrl;
        })
        .catch((error) => {
            console.error("Error saving changes:", error);
        });
};

const team_name = ref<string>("");
const newTeam = () => {
    axios
        .post(route("teams.new"), { name: team_name.value })
        .then((response) => {
            console.log(response.data);
            axios.get(route("teams.get")).then((res) => {
                teams.value = res.data;
            });
        })
        .catch((error) => {
            console.error("Error saving changes:", error);
        });
};

const removeTeam = (team_id: number) => {
    axios
        .post(route("member.remove"), { id: team_id })
        .then((response) => {
            console.log(response.data);
            axios.get(route("teams.get")).then((res) => {
                teams.value = res.data;
            });
        })
        .catch((error) => {
            console.error("Error saving changes:", error);
        });
};
</script>

<template>
    <Settings>
        <div class="main">
            <h2 class="font-bold sm:p-4 text-2xl text-black-900 leading-tight">
                Teams
            </h2>
            <div class="bottom">
                <Label class="Label">Make a new Team:</Label>
                <div class="new_team">
                    <Input
                        v-model="team_name"
                        type="email"
                        placeholder="Enter Your Team Name"
                        class="col-span-4"
                    />
                    <Button @click="newTeam"> Go </Button>
                </div>
                <br />
                <Label class="Label">Invite a member:</Label>
                <div class="invite">
                    <Input
                        v-model="memberEmail"
                        id="email"
                        type="email"
                        placeholder="Email Of Your Member"
                        class="col-span-4"
                    />
                    <Select>
                        <SelectTrigger class="col-span-4">
                            <SelectValue placeholder="Select Team" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectLabel>Project Teams</SelectLabel>
                                <SelectItem
                                    v-for="team in teams"
                                    :value="team.id.toString()"
                                    @click="selectedTeamId = team.id"
                                >
                                    {{ team.name }}
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <Button @click="handleSaveChanges"> Invite </Button>
                </div>
                <div class="my-teams my-5">
                    <Label class="Label">My current teams:</Label>
                    <br /><br />
                    <div
                        v-for="team in teams"
                        class="flex items-center justify-between bg-gray-200 rounded-md p-3 w-1/2 mb-3"
                    >
                        <h1 class="flex-grow font-semibold text-xl">
                            {{ team.name }}
                        </h1>
                        <AlertDialog>
                            <AlertDialogTrigger as-child>
                                <Button variant="destructive" size="icon"
                                    ><TrashIcon class="h-6 w-6"></TrashIcon
                                ></Button>
                            </AlertDialogTrigger>
                            <AlertDialogContent>
                                <AlertDialogHeader>
                                    <AlertDialogTitle
                                        class="text-center text-2xl mb-2"
                                    >
                                        Are you absolutely sure?
                                    </AlertDialogTitle>
                                    <AlertDialogDescription class="text-center">
                                        This action cannot be undone. This will
                                        remove you from the team. You will no
                                        longer be communicate with the team
                                        group.
                                    </AlertDialogDescription>
                                </AlertDialogHeader>
                                <AlertDialogFooter>
                                    <AlertDialogCancel>
                                        Cancel
                                    </AlertDialogCancel>
                                    <AlertDialogAction
                                        @click="removeTeam(team.id)"
                                    >
                                        Leave {{ team.name }}
                                    </AlertDialogAction>
                                </AlertDialogFooter>
                            </AlertDialogContent>
                        </AlertDialog>
                    </div>
                </div>
            </div>
        </div>
    </Settings>
</template>

<style scoped>
.bottom {
    margin: 16px;
}
.Label {
    font-size: 20px;
}
.invite > Input {
    width: 1000px;
}
.invite > Select {
    width: 100px;
}
.invite {
    margin-top: 12px;
    display: flex;
    max-width: 700px;
    gap: 24px;
}
.new_team {
    margin-top: 12px;
    display: flex;
    max-width: 400px;
    gap: 24px;
}
</style>
