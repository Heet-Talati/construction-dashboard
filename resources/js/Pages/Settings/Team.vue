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
import Settings from "../Settings.vue";
import { ref } from "vue";
import axios from "axios";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();

interface Team {
    id: string;
    name: string;
}

const teams = ref<Team[]>([]);
axios.get(route("teams.get")).then((res) => {
    teams.value = res.data;
});

const selectedTeamId = ref<string>("");
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

const myTeams = ref<Team[]>([]);
axios.get(route("teams.get")).then((res) => {
    myTeams.value = res.data;
});
</script>

<template>
    <Settings>
        <div class="main">
            <h2 class="font-bold sm:p-4 text-2xl text-black-900 leading-tight">
                Teams
            </h2>
            <div class="bottom">
                <Label class="Label">Invite a member:</Label>
                <div class="invite">
                    <Input
                        v-model="memberEmail"
                        id="email"
                        type="email"
                        placeholder="Email of your Member"
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
                    <h1 v-for="team in myTeams">
                        {{ team.name }}
                    </h1>
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
</style>
