<template>
    <Button variant="secondary" @click.native="newCard">Add New Card</Button>
    <ejs-kanban
        :key="componentKey"
        :dataSource="kanbanData"
        keyField="Status"
        :cardSettings="cardSettings"
        ref="kanbanObj"
        :addCard="newCard"
        enable-persistence="true"
    >
        <e-columns>
            <e-column headerText="📋 To Do" keyField="Open"></e-column>
            <e-column
                headerText="⏳ In Progress"
                keyField="InProgress"
            ></e-column>
            <e-column headerText="📖 In Review" keyField="Review"></e-column>
            <e-column headerText="✅ Done" keyField="Done"></e-column>
        </e-columns>
    </ejs-kanban>
</template>

<script>
import {
    KanbanComponent,
    ColumnsDirective,
    ColumnDirective,
} from "@syncfusion/ej2-vue-kanban";
import {
    DataManager,
    WebApiAdaptor,
    UrlAdaptor,
    ODataAdaptor,
} from "@syncfusion/ej2-data";
import Button from "../../../Components/ui/button/Button.vue";
import { ref } from "vue";

export default {
    components: {
        "ejs-kanban": KanbanComponent,
        "e-columns": ColumnsDirective,
        "e-column": ColumnDirective,
        Button: Button,
    },
    setup() {
        const getUrl = function () {
            const url = window.location.pathname;
            const digits = url
                .split("")
                .filter((char) => "0" <= char && char <= "9")
                .join("");
            return parseInt(digits, 10);
        };
        const id = getUrl();
        const componentKey = ref(0);

        const SERVICE_URI = "http://127.0.0.1:8000/api";
        const kanbanData = new DataManager({
            url: `${SERVICE_URI}/project/tasks/${id}`,
            headers: "*",
            // insertUrl: "/project/tasks/insert",
            adaptor: new WebApiAdaptor(),
            // adaptor: new UrlAdaptor(),
            // adaptor: new ODataAdaptor(),
            crossDomain: false,
        });
        console.log(getUrl());
        const cardSettings = {
            contentField: "Summary",
            headerField: "id",
        };

        const newCard = function () {
            const cardDetails = {
                Status: "Open",
                Summary: "This is a new card",
                task_id: 10000 * Math.random(),
                project_id: id,
            };
            axios
                .post(route("project.task.create"), cardDetails)
                .then((res) => {
                    componentKey.value += 1;
                })
                .catch((error) => {
                    console.error("Error creating new card:", error);
                });
        };

        // axiosInstance.interceptors.request.use(async (request) => {
        //     request.headers["X-XSRF-TOKEN"] = Cookies.get("XSRF-TOKEN");
        //     if (
        //         (request.method == "post" ||
        //             request.method == "put" ||
        //             request.method == "delete") &&
        //         !Cookies.get("XSRF-TOKEN")
        //     ) {
        //         await axiosInstance.get("/sanctum/csrf-cookie").then(() => {
        //             request.headers["X-XSRF-TOKEN"] = Cookies.get("XSRF-TOKEN");
        //         });
        //     }
        //     return request;
        // });

        return {
            kanbanData,
            cardSettings,
            newCard,
            componentKey,
            id,
        };
    },
};
</script>

<style scoped>
@import "../../../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-buttons/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-layouts/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-dropdowns/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-navigations/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-popups/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-vue-kanban/styles/material.css";

Button {
    margin-left: 8px;
}
</style>
