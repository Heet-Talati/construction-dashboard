<template>
    <ejs-gantt
        :dataSource="data"
        :taskFields="taskFields"
        :treeColumnIndex="1"
        :height="450"
        :timelineSettings="viewMode"
    >
        <e-columns>
            <e-column
                field="TaskID"
                headerText="Task ID"
                width="100"
                textAlign="Right"
            ></e-column>
            <e-column
                field="TaskName"
                headerText="Task Name"
                width="200"
                textAlign="Left"
            ></e-column>
            <e-column
                field="StartDate"
                headerText="Start Date"
                width="120"
                format="dd.MM.yyyy"
                textAlign="Right"
            ></e-column>
            <e-column
                field="Duration"
                headerText="Duration"
                width="120"
                textAlign="Right"
            ></e-column>
        </e-columns>
    </ejs-gantt>
</template>

<script>
import {
    GanttComponent,
    ColumnsDirective,
    ColumnDirective,
    Selection,
} from "@syncfusion/ej2-vue-gantt";
export default {
    components: {
        "ejs-gantt": GanttComponent,
        "e-columns": ColumnsDirective,
        "e-column": ColumnDirective,
    },
    setup() {
        const newProjectData = [
            {
                TaskID: 1,
                TaskName: "Project Initiation",
                StartDate: new Date("04/02/2019"),
                EndDate: new Date("04/21/2019"),
                subtasks: [
                    {
                        TaskID: 2,
                        TaskName: "Identify Site location",
                        StartDate: new Date("04/02/2019"),
                        Duration: 0,
                        Progress: 50,
                    },
                    {
                        TaskID: 3,
                        TaskName: "Perform Soil test",
                        StartDate: new Date("04/02/2019"),
                        Duration: 4,
                        Progress: 50,
                    },
                    {
                        TaskID: 4,
                        TaskName: "Soil test approval",
                        StartDate: new Date("04/02/2019"),
                        Duration: 4,
                        Predecessor: "2FS",
                        Progress: 50,
                    },
                ],
            },
            {
                TaskID: 5,
                TaskName: "Project Estimation",
                StartDate: new Date("04/02/2019"),
                EndDate: new Date("04/21/2019"),
                subtasks: [
                    {
                        TaskID: 6,
                        TaskName: "Develop floor plan for estimation",
                        StartDate: new Date("04/04/2019"),
                        Duration: 3,
                        Progress: 50,
                    },
                    {
                        TaskID: 7,
                        TaskName: "List materials",
                        StartDate: new Date("04/04/2019"),
                        Duration: 3,
                        Progress: 50,
                    },
                    {
                        TaskID: 8,
                        TaskName: "Estimation approval",
                        StartDate: new Date("04/04/2019"),
                        Duration: 0,
                        Predecessor: "6SS",
                        Progress: 50,
                    },
                ],
            },
        ];

        return {
            data: newProjectData,
            taskFields: {
                id: "TaskID",
                name: "TaskName",
                startDate: "StartDate",
                endDate: "EndDate",
                duration: "Duration",
                progress: "Progress",
                child: "subtasks",
                dependency: "Predecessor",
            },
            viewMode: { timelineViewMode: "Week" },
            // gantt: [Selection],
        };
    },
};
</script>

<style>
@import "../../../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-buttons/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-calendars/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-dropdowns/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-navigations/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-popups/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-splitbuttons/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-layouts/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-grids/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-treegrid/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-vue-gantt/styles/material.css";
</style>
