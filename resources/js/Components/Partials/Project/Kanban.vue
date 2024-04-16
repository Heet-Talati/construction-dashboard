<template>
    <Button variant="secondary" @click.native="newCard"> Add New Card</Button>
    <ejs-kanban
        :dataSource="kanbanData"
        keyField="Status"
        :cardSettings="cardSettings"
        ref="kanbanObj"
        :actionComplete="onActionComplete"
        :addCard="newCard"
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
    UrlAdaptor,
    ODataAdaptor,
    ODataV4Adaptor,
} from "@syncfusion/ej2-data";
import Button from "../../../Components/ui/button/Button.vue";

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

        const SERVICE_URI = "http://127.0.0.1:8000/api";
        const kanbanData = new DataManager({
            url: `${SERVICE_URI}/project/tasks/${id}`,
            // insertUrl: `${SERVICE_URI}/tasks`,
            // updateUrl: `${SERVICE_URI}/tasks`,
            // removeUrl: `${SERVICE_URI}/tasks`,
            // adaptor: new UrlAdaptor(),
            adaptor: new ODataAdaptor(),
            crossDomain: true,
        });
        console.log(getUrl());
        const cardSettings = {
            contentField: "Summary",
            headerField: "Id",
        };

        const newCard = function () {
            const cardDetails = {
                Status: "Open",
                Summary: "This is a new card",
            };
            axios
                .post(route("tasks.create"), cardDetails)
                .then((res) => {
                    location.reload();
                    console.log(res);
                })
                .catch((error) => {
                    console.error("Error creating new card:", error);
                });
        };

        const onActionComplete = (args) => {
            if (args.requestType === "cardChanged") {
                const changedRecords = args.changedRecords;
                if (changedRecords.length > 0) {
                    const id = changedRecords[0].Id;
                    const updatedStatus = changedRecords[0].Status;
                    axios
                        .put(`/api/tasks/${id}`, { Status: updatedStatus })
                        .then((response) => {
                            console.log(response);
                            console.log("Task status updated successfully");
                        })
                        .catch((error) => {
                            console.error("Error updating task status:", error);
                        });
                }
            }
        };

        return { kanbanData, cardSettings, newCard, onActionComplete, id };
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
