<script lang="ts" setup>
import Dropdown from "../../Components/Dropdown.vue";
import DropdownLink from "../../Components/DropdownLink.vue";
</script>

<template>
    <Dropdown align="left">
        <template #trigger>
            <button type="button" class="pfp">
                <img src="../../../../public/assets/pfp.png" />
            </button>
        </template>

        <template #content>
            <DropdownLink :href="route('dashboard')"> Home </DropdownLink>
            <DropdownLink href="/settings/profile"> Profile </DropdownLink>
            <!-- <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink> -->
            <DropdownLink :href="route('logout')" method="post" as="button">
                Log Out
            </DropdownLink>
        </template>
    </Dropdown>
</template>

<style scoped>
.pfp {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
}
.pfp > img {
    height: 40px;
    width: 40px;
}
</style>
