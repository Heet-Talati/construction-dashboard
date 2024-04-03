<template>
    <Button variant="secondary" @click.native="newCard"> Add New Card</Button>
    <ejs-kanban
        :dataSource="kanbanData"
        keyField="Status"
        :cardSettings="cardSettings"
        ref="kanbanObj"
    >
        <e-columns>
            <e-column headerText="📋 To Do" keyField="Open"></e-column>
            <e-column
                headerText="⏳ In Progress"
                keyField="InProgress"
            ></e-column>
            <e-column headerText="📖 In Review" keyField="Review"></e-column>
            <e-column headerText="✅ Done" keyField="Close"></e-column>
        </e-columns>
    </ejs-kanban>
</template>

<script>
import { ref } from "vue";
import {
    KanbanComponent,
    ColumnsDirective,
    ColumnDirective,
} from "@syncfusion/ej2-vue-kanban";
import { DataManager, ODataAdaptor } from "@syncfusion/ej2-data";
import Button from "../../../Components/ui/button/Button.vue";

export default {
    // name: 'Kanban',
    components: {
        "ejs-kanban": KanbanComponent,
        "e-columns": ColumnsDirective,
        "e-column": ColumnDirective,
        Button: Button,
    },
    setup() {
        // const kanbanData = ref([
        //     {
        //         Id: 1,
        //         Status: "Open",
        //         Summary:
        //             "Analyze the new requirements gathered from the customer.",
        //     },
        //     {
        //         Id: 2,
        //         Status: "InProgress",
        //         Summary: "Improve application performance",
        //     },
        //     {
        //         Id: 3,
        //         Status: "Open",
        //         Summary:
        //             "Arrange a web meeting with the customer to get new requirements.",
        //     },
        // ]);

        let SERVICE_URI = "http://127.0.0.1:8000/api/tasks";
        const kanbanData = new DataManager({
            url: SERVICE_URI,
            adaptor: new ODataAdaptor(),
            crossDomain: true,
        });
        const cardSettings = {
            contentField: "Summary",
            headerField: "Id",
        };

        const newCard = function () {
            const cardIds = kanbanData.value.map((obj) => parseInt(obj.Id, 10));
            const cardCount = Math.max(...cardIds) + 1;
            const cardDetails = {
                Id: cardCount,
                Status: "Open",
                Summary: "This is a new card",
            };
            const updatedData = [...kanbanData.value, cardDetails];
            kanbanData.value = updatedData;
        };
        return { kanbanData, cardSettings, newCard };
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
