<template>
    <ejs-kanban
        :dataSource="kanbanData"
        keyField="Status"
        :cardSettings="cardSettings"
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
import {
    KanbanComponent,
    ColumnsDirective,
    ColumnDirective,
} from "@syncfusion/ej2-vue-kanban";

export default {
    // name: 'Kanban',
    components: {
        "ejs-kanban": KanbanComponent,
        "e-columns": ColumnsDirective,
        "e-column": ColumnDirective,
    },
    setup() {
        const kanbanData = [
            {
                Id: 1,
                Status: "Open",
                Summary:
                    "Analyze the new requirements gathered from the customer.",
                Type: "Story",
                Priority: "Low",
                Tags: "Analyze,Customer",
                Estimate: 3.5,
                Assignee: "Nancy Davloio",
                RankId: 1,
            },
            {
                Id: 2,
                Status: "InProgress",
                Summary: "Improve application performance",
                Type: "Improvement",
                Priority: "Normal",
                Tags: "Improvement",
                Estimate: 6,
                Assignee: "Andrew Fuller",
                RankId: 1,
            },
            {
                Id: 3,
                Status: "Review",
                Summary:
                    "Arrange a web meeting with the customer to get new requirements.",
                Type: "Others",
                Priority: "Critical",
                Tags: "Meeting",
                Estimate: 5.5,
                Assignee: "Janet Leverling",
                RankId: 2,
            },
            {
                Id: 4,
                Status: "Close",
                Summary: "Fix the issues reported in the IE browser.",
                Type: "Bug",
                Priority: "Release Breaker",
                Tags: "IE",
                Estimate: 2.5,
                Assignee: "Janet Leverling",
                RankId: 2,
            },
            {
                Id: 5,
                Status: "Open",
                Summary: "Fix the issues reported by the customer.",
                Type: "Bug",
                Priority: "Low",
                Tags: "Customer",
                Estimate: "3.5",
                Assignee: "Steven walker",
                RankId: 1,
            },
            {
                Id: 6,
                Status: "InProgress",
                Summary:
                    "Arrange a web meeting with the customer to get the login page requirements.",
                Type: "Others",
                Priority: "Low",
                Tags: "Meeting",
                Estimate: 2,
                Assignee: "Michael Suyama",
                RankId: 1,
            },
            {
                Id: 7,
                Status: "Review",
                Summary: "Validate new requirements",
                Type: "Improvement",
                Priority: "Low",
                Tags: "Validation",
                Estimate: 1.5,
                Assignee: "Robert King",
                RankId: 1,
            },
            {
                Id: 8,
                Status: "Close",
                Summary: "Login page validation",
                Type: "Story",
                Priority: "Release Breaker",
                Tags: "Validation,Fix",
                Estimate: 2.5,
                Assignee: "Laura Callahan",
                RankId: 2,
            },
        ];
        const cardSettings = {
            contentField: "Summary",
            headerField: "Id",
        };

        return { kanbanData, cardSettings };
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
</style>
