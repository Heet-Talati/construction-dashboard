<template>
    <div class="col-lg-12 control-section">
        <div>
            <ejs-gantt
                ref="gantt"
                id="overviewSample"
                :resources="resources"
                :dataSource="data"
                :height="height"
                :width="width"
                :viewType="viewType"
                :highlightWeekends="true"
                :load="load"
                :dataBound="created"
                :allowSelection="true"
                :treeColumnIndex="1"
                :allowSorting="true"
                :gridLines="gridLines"
                :renderBaseline="true"
                :taskFields="taskFields"
                :resourceFields="resourceFields"
                :splitterSettings="splitterSettings"
                :selectionSettings="selectionSettings"
                :tooltipSettings="tooltipSettings"
                :filterSettings="filterSettings"
                :allowFiltering="true"
                :showColumnMenu="true"
                :toolbar="toolbar"
                :timelineSettings="timelineSettings"
                :eventMarkers="eventMarkers"
                :holidays="holidays"
                :labelSettings="labelSettings"
                :allowResizing="true"
                :taskbarHeight="taskbarHeight"
                :rowHeight="rowHeight"
                :projectStartDate="projectStartDate"
                :projectEndDate="projectEndDate"
            >
                <e-columns>
                    <e-column
                        field="TaskId"
                        textAlign="Left"
                        :visible="false"
                    ></e-column>
                    <e-column
                        field="TaskName"
                        headerText="Product Release"
                        width="180"
                    ></e-column>
                    <e-column
                        field="Assignee"
                        headerText="Assignee"
                        :template="'columnTemplate'"
                        :allowSorting="false"
                        width="135"
                    >
                    </e-column>
                    <e-column
                        field="Status"
                        minWidth="100"
                        width="120"
                        :template="'columnTemplate1'"
                    >
                    </e-column>
                    <e-column
                        field="Priority"
                        minWidth="80"
                        width="100"
                        :template="'columnTemplate2'"
                    >
                    </e-column>
                    <e-column
                        field="Work"
                        headerText="Planned Hours"
                        width="120"
                    ></e-column>
                    <e-column
                        field="TimeLog"
                        headerText="Work Log"
                        width="120"
                    ></e-column>
                </e-columns>

                <template v-slot:columnTemplate="{ data }">
                    <div
                        class="columnTemplate"
                        v-if="data.ganttProperties.resourceNames"
                    >
                        <img
                            :src="
                                'src/gantt/images/' +
                                data.ganttProperties.resourceNames +
                                '.png'
                            "
                            style="height: 25px; width: 25px"
                        />
                        <div
                            style="
                                display: inline-block;
                                width: 100%;
                                position: relative;
                                left: 5px;
                            "
                        >
                            {{ data.ganttProperties.resourceNames }}
                        </div>
                    </div>
                </template>

                <template v-slot:columnTemplate1="{ data }">
                    <div v-if="data.taskData.Status">
                        <div :style="Status(data.taskData.Status)">
                            <span
                                :style="StatusContent(data.taskData.Status)"
                                >{{ data.taskData.Status }}</span
                            >
                        </div>
                    </div>
                </template>

                <template v-slot:columnTemplate2="{ data }">
                    <div v-if="data.taskData.Priority">
                        <div :style="Priority(data.taskData.Priority)">
                            <span
                                :style="PriorityContent(data.taskData.Priority)"
                                >{{ data.taskData.Priority }}</span
                            >
                        </div>
                    </div>
                </template>
            </ejs-gantt>
        </div>
    </div>
</template>

<script>
import {
    GanttComponent,
    ColumnDirective,
    ColumnsDirective,
    Selection,
    Toolbar,
    DayMarkers,
    Edit,
    Filter,
    Reorder,
    Resize,
    ColumnMenu,
    VirtualScroll,
    Sort,
    RowDD,
    ContextMenu,
    ExcelExport,
    PdfExport,
    CriticalPath,
} from "@syncfusion/ej2-vue-gantt";
// import { editingResources, overviewData } from "./data-source";
import { DropDownList } from "@syncfusion/ej2-dropdowns";

var theme;
var style;
var CurrentTheme;
var statusStyleColor;
var priorityStyle;
var priorityContentStyle;
var statusContentstyleColor;
var dropDownData = [
    { ID: "Default", Text: "Default" },
    { ID: "Grid", Text: "Grid" },
    { ID: "Chart", Text: "Chart" },
];
var editingResources = [
    { resourceId: 1, resourceName: "Martin Tamer" },
    { resourceId: 2, resourceName: "Rose Fuller" },
    { resourceId: 3, resourceName: "Margaret Buchanan" },
    { resourceId: 4, resourceName: "Fuller King" },
    { resourceId: 5, resourceName: "Davolio Fuller" },
    { resourceId: 6, resourceName: "Van Jack" },
    { resourceId: 7, resourceName: "Fuller Buchanan" },
    { resourceId: 8, resourceName: "Jack Davolio" },
    { resourceId: 9, resourceName: "Tamer Vinet" },
    { resourceId: 10, resourceName: "Vinet Fuller" },
    { resourceId: 11, resourceName: "Bergs Anton" },
    { resourceId: 12, resourceName: "Construction Supervisor" },
];
var overviewData = [
    {
        TaskId: "1",
        TaskName: "Q-1 Release",
        StartDate: new Date("2021/12/20"),
        EndDate: new Date("2022/04/04"),
        TimeLog: 2,
        Work: 2,
        Progress: 80,
        Status: "In Progress",
    },
    {
        TaskId: "2",
        TaskName: "Roadmap",
        ParentId: 1,
    },
    {
        TaskId: "3",
        TaskName: "Implementation",
        ParentId: 2,
    },
    {
        TaskId: "4",
        TaskName: "Grid",
        StartDate: new Date("2021/12/20"),
        EndDate: new Date("2022/02/20"),
        TimeLog: 44,
        Work: 45,
        Progress: 70,
        ParentId: 3,
    },
    {
        TaskId: "5",
        TaskName: "Batch Editing",
        StartDate: new Date("2021/12/24"),
        EndDate: new Date("2022/02/21"),
        Assignee: [1],
        TimeLog: 42,
        Work: 43,
        Progress: 100,
        Status: "Completed",
        ParentId: 4,
        Priority: "High",
        Component: "Grid",
    },
    {
        TaskId: "6",
        TaskName: "PDF Export",
        StartDate: new Date("2021/12/28"),
        EndDate: new Date("2022/02/25"),
        Assignee: [2],
        TimeLog: 42,
        Work: 45,
        Progress: 10,
        Status: "On Hold",
        ParentId: 4,
        Priority: "Normal",
        Component: "Grid",
    },
    {
        TaskId: "7",
        TaskName: "Tree Grid",
        StartDate: new Date("2022/01/02"),
        EndDate: new Date("2022/02/20"),
        TimeLog: 33,
        Work: 30,
        Progress: 80,
        ParentId: 3,
    },
    {
        TaskId: "8",
        TaskName: "Drag Multi-selection",
        StartDate: new Date("2022/01/02"),
        EndDate: new Date("2022/02/20"),
        Assignee: [4],
        TimeLog: 33,
        Work: 32,
        Progress: 100,
        Status: "Completed",
        ParentId: 7,
        Priority: "Critical",
        Component: "Tree Grid",
    },
    {
        TaskId: "9",
        TaskName: "Gantt Chart",
        StartDate: new Date("2022/02/20"),
        EndDate: new Date("2022/04/28"),
        TimeLog: 2,
        Work: 2,
        Progress: 100,
        ParentId: 3,
    },
    {
        TaskId: "10",
        TaskName: "Initial loading performance",
        StartDate: new Date("2022/02/24"),
        EndDate: new Date("2022/03/14"),
        Assignee: [1],
        TimeLog: 13,
        Work: 15,
        Progress: 35,
        Status: "In Progress",
        ParentId: 9,
        Priority: "Low",
        Component: "Gantt Chart",
    },
    {
        TaskId: "11",
        TaskName: "Drag Multi-selection",
        StartDate: new Date("2022/02/22"),
        EndDate: new Date("2022/03/14"),
        Assignee: [8],
        TimeLog: 13,
        Work: 14,
        Progress: 100,
        Predecessor: "8FS",
        Status: "Completed",
        ParentId: 9,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "12",
        TaskName: "ScrollToViewAsync Method",
        StartDate: new Date("2022/02/20"),
        EndDate: new Date("2022/03/10"),
        Assignee: [1],
        TimeLog: 13,
        Work: 10,
        Progress: 100,
        Status: "Completed",
        ParentId: 9,
        Priority: "High",
        Component: "Gantt Chart",
    },
    {
        TaskId: "13",
        TaskName: "ScrollToTimelineAsync Method",
        StartDate: new Date("2022/02/20"),
        EndDate: new Date("2022/03/10"),
        Assignee: [4],
        TimeLog: 13,
        Work: 10,
        Progress: 40,
        Status: "On Hold",
        ParentId: 9,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "14",
        TaskName: "ScrollToTaskbarAsync Method",
        StartDate: new Date("2022/03/10"),
        EndDate: new Date("2022/03/25"),
        Assignee: [1],
        TimeLog: 11,
        Work: 15,
        Progress: 100,
        Status: "Completed",
        ParentId: 9,
        Priority: "Critical",
        Component: "Gantt Chart",
    },
    {
        TaskId: "15",
        TaskName: "Web Accessibility",
        StartDate: new Date("2022/03/10"),
        EndDate: new Date("2022/03/25"),
        Assignee: [4],
        TimeLog: 11,
        Work: 12,
        Progress: 35,
        Status: "On Hold",
        ParentId: 9,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "16",
        TaskName: "Testing",
        Work: 8,
        ParentId: 3,
    },
    {
        TaskId: "17",
        TaskName: "Phase-1",
        StartDate: new Date("2022/03/20"),
        EndDate: new Date("2022/03/24"),
        Work: 2,
        Progress: 0,
        ParentId: 16,
    },
    {
        TaskId: "18",
        TaskName: "Phase-2",
        StartDate: new Date("2022/03/22"),
        EndDate: new Date("2022/03/26"),
        Work: 1,
        Progress: 0,
        Predecessor: "17FS",
        ParentId: 16,
    },
    {
        TaskId: "19",
        TaskName: "Testing Completion",
        StartDate: new Date("2022/03/27"),
        TimeLog: 0,
        ParentId: 3,
    },
    {
        TaskId: "20",
        TaskName: "Release Roll-out",
        StartDate: new Date("2022/04/04"),
        TimeLog: 0,
        ParentId: 2,
    },
    {
        TaskId: "21",
        TaskName: "Q-2 Release",
        StartDate: new Date("2022/04/05"),
        EndDate: new Date("2022/06/30"),
        TimeLog: 2,
        Work: 2,
        Progress: 90,
        Status: "Completed",
    },
    {
        TaskId: "22",
        TaskName: "Roadmap",
        ParentId: 21,
    },
    {
        TaskId: "23",
        TaskName: "Implementation",
        ParentId: 22,
    },
    {
        TaskId: "24",
        TaskName: "Grid",
        StartDate: new Date("2022/04/05"),
        EndDate: new Date("2022/05/30"),
        TimeLog: 2,
        Work: 2,
        Progress: 100,
        ParentId: 23,
    },
    {
        TaskId: "25",
        TaskName: "Web Accessibility",
        StartDate: new Date("2022/04/05"),
        EndDate: new Date("2022/04/30"),
        Assignee: [1],
        TimeLog: 19,
        Work: 15,
        Progress: 100,
        Status: "Completed",
        ParentId: 24,
        Priority: "High",
        Component: "Grid",
    },
    {
        TaskId: "26",
        TaskName: "Sticky Header",
        StartDate: new Date("2022/04/15"),
        EndDate: new Date("2022/05/10"),
        Assignee: [8],
        TimeLog: 19,
        Work: 20,
        Progress: 100,
        Status: "Completed",
        ParentId: 24,
        Priority: "Normal",
        Component: "Grid",
    },
    {
        TaskId: "27",
        TaskName: "Adapative UI Mode",
        StartDate: new Date("2022/04/20"),
        EndDate: new Date("2022/05/20"),
        Assignee: [2],
        TimeLog: 19,
        Work: 25,
        Progress: 100,
        Status: "Completed",
        ParentId: 24,
        Priority: "Normal",
        Component: "Grid",
    },
    {
        TaskId: "28",
        TaskName: "Tree Grid",
        StartDate: new Date("2022/04/25"),
        EndDate: new Date("2022/05/30"),
        TimeLog: 2,
        Work: 2,
        Progress: 50,
        ParentId: 23,
    },
    {
        TaskId: "29",
        TaskName: "CRUD Opreation for virtualization",
        StartDate: new Date("2022/04/25"),
        EndDate: new Date("2022/05/30"),
        Assignee: [4],
        TimeLog: 26,
        Work: 28,
        Progress: 72,
        Status: "In Progress",
        ParentId: 28,
        Priority: "Normal",
        Component: "Tree Grid",
    },
    {
        TaskId: "30",
        TaskName: "Frozen Column",
        StartDate: new Date("2022/04/28"),
        EndDate: new Date("2022/05/30"),
        Assignee: [1],
        TimeLog: 26,
        Work: 28,
        Progress: 100,
        Status: "Completed",
        ParentId: 28,
        Priority: "High",
        Component: "Tree Grid",
    },
    {
        TaskId: "31",
        TaskName: "Gantt Chart",
        StartDate: new Date("2022/05/05"),
        EndDate: new Date("2022/06/20"),
        TimeLog: 2,
        Work: 2,
        Progress: 50,
        ParentId: 23,
    },
    {
        TaskId: "32",
        TaskName: "Observable Collection",
        StartDate: new Date("2022/05/15"),
        EndDate: new Date("2022/06/10"),
        Assignee: [2],
        TimeLog: 19,
        Work: 15,
        Progress: 70,
        Status: "On Hold",
        ParentId: 31,
        Priority: "Critical",
        Component: "Gantt Chart",
    },
    {
        TaskId: "33",
        TaskName: "INotifyPropertyChanged",
        StartDate: new Date("2022/05/18"),
        EndDate: new Date("2022/05/30"),
        Assignee: [4],
        TimeLog: 19,
        Work: 18,
        Progress: 20,
        Status: "On Hold",
        ParentId: 31,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "34",
        TaskName: "INotifyPropertyChanged",
        StartDate: new Date("2022/05/25"),
        EndDate: new Date("2022/06/15"),
        Assignee: [8],
        TimeLog: 19,
        Work: 25,
        Progress: 50,
        Status: "In Progress",
        ParentId: 31,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "35",
        TaskName: "Customized Taskbar Editing",
        StartDate: new Date("2022/05/25"),
        EndDate: new Date("2022/06/30"),
        Assignee: [1],
        TimeLog: 15,
        Work: 20,
        Progress: 10,
        Status: "On Hold",
        ParentId: 31,
        Priority: "High",
        Component: "Gantt Chart",
    },
    {
        TaskId: "36",
        TaskName: "Column Virtualization ",
        StartDate: new Date("2022/05/05"),
        EndDate: new Date("2022/05/30"),
        Assignee: [2],
        TimeLog: 18,
        Work: 22,
        Progress: 100,
        Status: "Completed",
        ParentId: 31,
        Priority: "Critical",
        Component: "Gantt Chart",
    },
    {
        TaskId: "37",
        TaskName: "Touch Interaction ",
        StartDate: new Date("2022/05/27"),
        EndDate: new Date("2022/6/17"),
        Assignee: [8],
        TimeLog: 18,
        Work: 14,
        Progress: 100,
        Status: "Completed",
        ParentId: 31,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "38",
        TaskName: "Editing Tooltip Template",
        StartDate: new Date("2022/05/29"),
        EndDate: new Date("2022/06/19"),
        Assignee: [4],
        TimeLog: 18,
        Work: 20,
        Progress: 100,
        Status: "Completed",
        ParentId: 31,
        Priority: "Low",
        Component: "Gantt Chart",
    },
    {
        TaskId: "39",
        TaskName: "Predecessor Drag Vertical Auto Scroll",
        StartDate: new Date("2022/05/25"),
        EndDate: new Date("2022/06/15"),
        Assignee: [2],
        TimeLog: 18,
        Work: 15,
        Progress: 100,
        Status: "Completed",
        ParentId: 31,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "40",
        TaskName: "Taskbar Drag Horizontal Auto Scroll",
        StartDate: new Date("2022/05/27"),
        EndDate: new Date("2022/06/17"),
        Assignee: [1],
        TimeLog: 18,
        Work: 14,
        Progress: 100,
        Status: "Completed",
        ParentId: 31,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "41",
        TaskName: "Predecessor Types Configure",
        StartDate: new Date("2022/05/28"),
        EndDate: new Date("2022/06/18"),
        Assignee: [8],
        TimeLog: 18,
        Work: 15,
        Progress: 70,
        Status: "On Hold",
        ParentId: 31,
        Priority: "Low",
        Component: "Gantt Chart",
    },
    {
        TaskId: "42",
        TaskName:
            "Based on content height holiday, event markers, and weekend container rendering",
        StartDate: new Date("2022/05/28"),
        EndDate: new Date("2022/06/15"),
        Assignee: [4],
        TimeLog: 18,
        Work: 17,
        Progress: 60,
        Status: "In Progress",
        ParentId: 31,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "43",
        TaskName: "Feature Completion",
        StartDate: new Date("2022/06/15"),
        TimeLog: 0,
        ParentId: 23,
    },
    {
        TaskId: "44",
        TaskName: "Testing",
        Work: 8,
        ParentId: 23,
    },
    {
        TaskId: "45",
        TaskName: "Phase-1",
        StartDate: new Date("2022/06/15"),
        EndDate: new Date("2022/06/20"),
        Work: 3,
        Progress: 0,
        ParentId: 44,
    },
    {
        TaskId: "46",
        TaskName: "Phase-2",
        StartDate: new Date("2022/06/18"),
        EndDate: new Date("2022/06/23"),
        Work: 2,
        Predecessor: "45FS",
        Progress: 0,
        ParentId: 44,
    },
    {
        TaskId: "47",
        TaskName: "Testing Completion",
        StartDate: new Date("2022/06/24"),
        TimeLog: 0,
        ParentId: 24,
    },
    {
        TaskId: "48",
        TaskName: "Release Roll-out",
        StartDate: new Date("2022/06/30"),
        TimeLog: 0,
        ParentId: 22,
    },
    {
        TaskId: "49",
        TaskName: "Q-3 Release",
        StartDate: new Date("2022/07/01"),
        EndDate: new Date("2022/09/29"),
        TimeLog: 2,
        Work: 2,
        Progress: 100,
        StoryPoints: 100,
        Status: "In Progress",
    },
    {
        TaskId: "50",
        TaskName: "Roadmap",
        ParentId: 49,
    },
    {
        TaskId: "51",
        TaskName: "Implementation",
        ParentId: 50,
    },
    {
        TaskId: "52",
        TaskName: "Grid",
        StartDate: new Date("2022/07/01"),
        EndDate: new Date("2022/07/20"),
        TimeLog: 15,
        Work: 120,
        Progress: 100,
        ParentId: 51,
    },
    {
        TaskId: "53",
        TaskName: "Lazy-Loading Grouping with Virtualization",
        StartDate: new Date("2022/07/01"),
        EndDate: new Date("2022/07/15"),
        Assignee: [1],
        TimeLog: 11,
        Work: 12,
        Progress: 50,
        Status: "In Progress",
        ParentId: 52,
        Priority: "Normal",
        Component: "Grid",
    },
    {
        TaskId: "54",
        TaskName: "Filter Bar Keyboard Navigation",
        StartDate: new Date("2022/07/04"),
        EndDate: new Date("2022/07/18"),
        Assignee: [8],
        TimeLog: 11,
        Work: 15,
        Progress: 20,
        Status: "On Hold",
        ParentId: 52,
        Priority: "Low",
        Component: "Grid",
    },
    {
        TaskId: "55",
        TaskName: "Keyboard Navigation Enhanced",
        StartDate: new Date("2022/07/07"),
        EndDate: new Date("2022/07/20"),
        Assignee: [2],
        TimeLog: 11,
        Work: 12,
        Progress: 33,
        Status: "In Progress",
        ParentId: 52,
        Priority: "High",
        Component: "Grid",
    },
    {
        TaskId: "56",
        TaskName: "Tree Grid",
        StartDate: new Date("2022/07/01"),
        EndDate: new Date("2022/07/20"),
        TimeLog: 15,
        Work: 12,
        Progress: 100,
        ParentId: 51,
    },
    {
        TaskId: "57",
        TaskName: "Persistence State",
        StartDate: new Date("2022/07/15"),
        EndDate: new Date("2022/08/15"),
        Assignee: [2],
        TimeLog: 24,
        Work: 20,
        Progress: 20,
        Status: "In Progress",
        ParentId: 56,
        Priority: "Normal",
        Component: "Tree Grid",
    },
    {
        TaskId: "58",
        TaskName: "Add or Remove Frozen Columns",
        StartDate: new Date("2022/07/18"),
        EndDate: new Date("2022/08/15"),
        Assignee: [1],
        TimeLog: 24,
        Work: 20,
        Progress: 40,
        Status: "In Progress",
        ParentId: 56,
        Priority: "Critical",
        Component: "Tree Grid",
    },
    {
        TaskId: "59",
        TaskName: "Gantt Chart",
        StartDate: new Date("2022/07/01"),
        EndDate: new Date("2022/07/20"),
        TimeLog: 15,
        Work: 120,
        Progress: 100,
        ParentId: 51,
    },
    {
        TaskId: "60",
        TaskName: "Timeline Virtualization",
        StartDate: new Date("2022/07/18"),
        EndDate: new Date("2022/08/15"),
        Assignee: [8],
        TimeLog: 24,
        Work: 21,
        Progress: 80,
        Status: "In Progress",
        ParentId: 59,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "61",
        TaskName: "String and GUID Task Id type",
        StartDate: new Date("2022/07/25"),
        EndDate: new Date("2022/08/20"),
        Assignee: [4],
        TimeLog: 24,
        Work: 19,
        Progress: 10,
        Status: "In Progress",
        ParentId: 59,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "62",
        TaskName: "Rendering spinner for every Gantt action",
        StartDate: new Date("2022/07/27"),
        EndDate: new Date("2022/08/20"),
        Assignee: [2],
        TimeLog: 24,
        Work: 20,
        Progress: 35,
        Status: "In Progress",
        ParentId: 59,
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "63",
        TaskName: "External Key Events",
        StartDate: new Date("2022/07/27"),
        EndDate: new Date("2022/08/15"),
        Assignee: [8],
        TimeLog: 24,
        Work: 18,
        Progress: 100,
        Status: "Completed",
        ParentId: 59,
        Priority: "High",
        Component: "Gantt Chart",
    },
    {
        TaskId: "64",
        TaskName: "Dependency and CRUD operation in row virtualization",
        StartDate: new Date("2022/07/25"),
        EndDate: new Date("2022/08/15"),
        Assignee: [1],
        TimeLog: 24,
        Work: 17,
        Progress: 78,
        Status: "In Progress",
        ParentId: 59,
        Predecessor: "30FS+40Days",
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "65",
        TaskName: "AutoCalculateDateScheduling API",
        StartDate: new Date("2022/07/27"),
        EndDate: new Date("2022/08/20"),
        Assignee: [2],
        TimeLog: 24,
        Work: 19,
        Progress: 25,
        Status: "On Hold",
        ParentId: 59,
        Priority: "Low",
        Component: "Gantt Chart",
    },
    {
        TaskId: "66",
        TaskName: "Persistence State",
        StartDate: new Date("2022/08/15"),
        EndDate: new Date("2022/09/15"),
        Assignee: [4],
        TimeLog: 24,
        Work: 18,
        Progress: 70,
        Status: "In Progress",
        ParentId: 59,
        Predecessor: "58FS",
        Priority: "Normal",
        Component: "Gantt Chart",
    },
    {
        TaskId: "67",
        TaskName: "Feature Completion",
        StartDate: new Date("2022/09/15"),
        TimeLog: 0,
        ParentId: 51,
    },
    {
        TaskId: "68",
        TaskName: "Testing",
        Work: 8,
        ParentId: 51,
    },
    {
        TaskId: "69",
        TaskName: "Phase-1",
        StartDate: new Date("2022/09/15"),
        EndDate: new Date("2022/09/19"),
        Work: 3,
        Progress: 0,
        ParentId: 68,
    },
    {
        TaskId: "70",
        TaskName: "Phase-2",
        StartDate: new Date("2022/09/18"),
        EndDate: new Date("2022/09/23"),
        Work: 4,
        Predecessor: "69FS",
        Progress: 0,
        ParentId: 68,
    },
    {
        TaskId: "71",
        TaskName: "Testing Completion",
        StartDate: new Date("2022/09/24"),
        TimeLog: 0,
        ParentId: 51,
    },
    {
        TaskId: "72",
        TaskName: "Release Roll-out",
        StartDate: new Date("2022/09/29"),
        TimeLog: 0,
        ParentId: 50,
    },
];

export default {
    components: {
        "ejs-gantt": GanttComponent,
        "e-column": ColumnDirective,
        "e-columns": ColumnsDirective,
    },
    data: function () {
        return {
            data: overviewData,
            resources: editingResources,
            height: "490px",
            width: "100%",
            viewType: "ProjectView",
            taskFields: {
                id: "TaskId",
                name: "TaskName",
                startDate: "StartDate",
                endDate: "EndDate",
                duration: "TimeLog",
                progress: "Progress",
                dependency: "Predecessor",
                parentID: "ParentId",
                resourceInfo: "Assignee",
            },
            resourceFields: {
                id: "resourceId",
                name: "resourceName",
            },
            toolbar: [
                "ExpandAll",
                "CollapseAll",
                {
                    type: "Input",
                    align: "Right",
                    template: '<div><input type="text" id="ganttView"/></div>',
                },
            ],
            splitterSettings: {
                position: "50%",
            },
            selectionSettings: {
                mode: "Row",
                type: "Single",
                enableToggle: true,
            },
            tooltipSettings: {
                showTooltip: true,
            },
            filterSettings: {
                type: "Menu",
            },
            gridLines: "Vertical",
            timelineSettings: {
                showTooltip: true,
                topTier: {
                    unit: "Month",
                    format: "MMM yyyy",
                },
                bottomTier: {
                    unit: "Day",
                    count: 4,
                    format: "dd",
                },
            },
            eventMarkers: [
                {
                    day: "04/04/2022",
                    cssClass: "e-custom-event-marker",
                    label: "Q-1 Release",
                },
                {
                    day: "06/30/2022",
                    cssClass: "e-custom-event-marker",
                    label: "Q-2 Release",
                },
                {
                    day: "09/29/2022",
                    cssClass: "e-custom-event-marker",
                    label: "Q-3 Release",
                },
            ],
            holidays: [
                {
                    from: "01/01/2022",
                    to: "01/01/2022",
                    label: "New Year holiday",
                    cssClass: "e-custom-holiday",
                },
                {
                    from: "12/25/2021",
                    to: "12/26/2021",
                    label: "Christmas holidays",
                    cssClass: "e-custom-holiday",
                },
            ],
            labelSettings: {
                rightLabel: "Assignee",
                taskLabel: "${Progress}%",
            },
            taskbarHeight: 24,
            rowHeight: 36,
            projectStartDate: new Date("12/17/2021"),
            projectEndDate: new Date("10/26/2022"),
        };
    },
    provide: {
        gantt: [
            Selection,
            Toolbar,
            DayMarkers,
            Edit,
            Filter,
            Reorder,
            Resize,
            ColumnMenu,
            VirtualScroll,
            Sort,
            RowDD,
            ContextMenu,
            ExcelExport,
            PdfExport,
            CriticalPath,
        ],
    },
    methods: {
        created: function (args) {
            if (
                document
                    .querySelector(".e-toolbar-right")
                    .querySelector(".e-dropdownlist") == null
            ) {
                var ddList = new DropDownList({
                    dataSource: dropDownData,
                    placeholder: "View",
                    width: "90px",
                    fields: { value: "ID", text: "Text" },
                    change: function (args) {
                        var ganttChart =
                            document.getElementById("overviewSample")
                                .ej2_instances[0];
                        if (args.value == "Grid") {
                            ganttChart.setSplitterPosition("100%", "position");
                        } else if (args.value == "Chart") {
                            ganttChart.setSplitterPosition("0%", "position");
                        } else {
                            ganttChart.setSplitterPosition("50%", "position");
                        }
                    },
                });
                var element = document.getElementById("ganttView");
                ddList.appendTo(element);
            }
        },
        load: function (args) {
            var themeCollection = [
                "bootstrap5",
                "bootstrap",
                "bootstrap4",
                "fluent",
                "fabric",
                "fusionnew",
                "material3",
                "material",
                "highcontrast",
                "tailwind",
            ];
            var cls = document.body.className.split(" ");
            theme =
                cls.indexOf("bootstrap5") > 0
                    ? "bootstrap5"
                    : cls.indexOf("bootstrap") > 0
                    ? "bootstrap"
                    : cls.indexOf("tailwind") > 0
                    ? "tailwind"
                    : cls.indexOf("fluent") > 0
                    ? "fluent"
                    : cls.indexOf("fabric") > 0
                    ? "fabric"
                    : cls.indexOf("material3") > 0
                    ? "material3"
                    : cls.indexOf("bootstrap4") > 0
                    ? "bootstrap4"
                    : cls.indexOf("material") > 0
                    ? "material"
                    : cls.indexOf("fusionnew") > 0
                    ? "fusionnew"
                    : cls.indexOf("highcontrast") > 0
                    ? "highcontrast"
                    : "";
            var check = themeCollection.indexOf(theme);
            if (check >= 0) {
                CurrentTheme = true;
            } else {
                CurrentTheme = false;
            }
        },
        Status: function (status) {
            switch (status) {
                case "In Progress":
                    statusStyleColor = CurrentTheme ? "#DFECFF" : "#2D3E57";
                    style =
                        "display: flex; padding: 1px 12px; gap: 10px; width: 96px; height: 24px; border-radius: 24px; background:" +
                        statusStyleColor;
                    break;
                case "Open":
                    style =
                        "background-color: red; color: white; border-radius: 15px; padding:6px";
                    break;
                case "On Hold":
                    statusStyleColor = CurrentTheme ? "#E4E4E7" : "#3C3B43";
                    style =
                        "display: flex; border-radius: 24px; padding: 1px 12px; gap: 10px; width: 78px; height: 24px; background:" +
                        statusStyleColor;
                    break;
                case "Completed":
                    statusStyleColor = CurrentTheme ? "#DFFFE2" : "#16501C";
                    style =
                        "display: flex; padding: 1px 12px; gap: 10px; width: 98px; height: 24px; border-radius: 24px;background:" +
                        statusStyleColor;
                    break;
                case "High":
                    statusStyleColor = CurrentTheme ? "#FFEBE9" : "#48211D";
                    style =
                        "display: flex; padding: 1px 12px; gap: 10px; width: 55px; height: 24px; border-radius: 24px; background:" +
                        statusStyleColor;
                    break;
            }
            return style;
        },
        StatusContent: function (status) {
            switch (status) {
                case "In Progress":
                    statusContentstyleColor = CurrentTheme
                        ? "#006AA6"
                        : "#34B6FF";
                    style =
                        "width: 72px; height: 22px; font-style: normal; font-weight: 500; font-size: 14px; line-height: 20px; text-align: center; color: " +
                        statusContentstyleColor;
                    break;
                case "Open":
                    style =
                        "background-color: red; color: white; border-radius: 15px; padding:6px";
                    break;
                case "On Hold":
                    statusContentstyleColor = CurrentTheme
                        ? "#766B7C"
                        : "#CDCBD7";
                    style =
                        "width: 54px; height: 22px; font-style: normal; font-weight: 500; font-size: 14px; line-height: 20px; text-align: center; color: " +
                        statusContentstyleColor;
                    break;
                case "Completed":
                    statusContentstyleColor = CurrentTheme
                        ? "#00A653"
                        : "#92FFC8";
                    style =
                        "width: 74px; height: 22px; font-style: normal; font-weight: 500; font-size: 14px; line-height: 20px; text-align: center; color: " +
                        statusContentstyleColor;
                    break;
                case "High":
                    statusContentstyleColor = CurrentTheme
                        ? "#FF3740"
                        : "#FFB5B8";
                    style =
                        "width: 31px; height: 22px; font-style: normal; font-weight: 500; font-size: 14px; line-height: 20px; text-align: center; color: " +
                        statusContentstyleColor;
                    break;
            }
            return style;
        },
        Priority: function (priority) {
            switch (priority) {
                case "Low":
                    priorityStyle = CurrentTheme ? "#FFF6D1" : "#473F1E";
                    style =
                        "display: flex; padding: 1px 12px; gap: 10px; width: 52px; height: 24px; border-radius: 24px; background: " +
                        priorityStyle;
                    break;
                case "Normal":
                    priorityStyle = CurrentTheme ? "#F5DFFF" : "#4D2F5A";
                    style =
                        "display: flex; padding: 1px 12px; gap: 10px; width: 73px; height: 24px; border-radius: 24px; background: " +
                        priorityStyle;
                    break;
                case "Critical":
                    priorityStyle = CurrentTheme ? "#FFEBE9" : "#48211D";
                    style =
                        "display: flex; padding: 1px 12px; gap: 10px; width: 72px; height: 24px; border-radius: 24px; background: " +
                        priorityStyle;
                    break;
                case "High":
                    priorityStyle = CurrentTheme ? "#FFEBE9" : "#48211D";
                    style =
                        "display: flex; padding: 1px 12px; gap: 10px; width: 55px; height: 24px; border-radius: 24px; background: " +
                        priorityStyle;
                    break;
            }
            return style;
        },
        PriorityContent: function (priority) {
            switch (priority) {
                case "Low":
                    priorityContentStyle = CurrentTheme ? "#70722B" : "#FDFF88";
                    style =
                        "width: 28px; height: 22px; font-style: normal; font-weight: 500; font-size: 14px; line-height: 20px; text-align: center; color: " +
                        priorityContentStyle;
                    break;
                case "Normal":
                    priorityContentStyle = CurrentTheme ? "#7100A6" : "#E3A9FF";
                    style =
                        "width: 49px; height: 22px; font-style: normal; font-weight: 500; font-size: 14px; line-height: 20px; text-align: center; color: " +
                        priorityContentStyle;
                    break;
                case "Critical":
                    priorityContentStyle = CurrentTheme ? "#FF3740" : "#FFB5B8";
                    style =
                        "width: 48px; height: 22px; font-style: normal; font-weight: 500; font-size: 14px; line-height: 20px; text-align: center; color: " +
                        priorityContentStyle;
                    break;
                case "High":
                    priorityContentStyle = CurrentTheme ? "#FF3740" : "#FFB5B8";
                    style =
                        "width: 31px; height: 22px; font-style: normal; font-weight: 500; font-size: 14px; line-height: 20px; text-align: center; color: " +
                        priorityContentStyle;
                    break;
            }
            return style;
        },
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

#overviewSample .e-gantt-child-taskbar,
#overviewSample .e-gantt-parent-taskbar {
    border-radius: 10px !important;
}
</style>
