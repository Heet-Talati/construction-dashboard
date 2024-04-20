<template>
    <div>
        <div class="control-section file-overview">
            <div class="sample-container">
                <ejs-filemanager
                    id="overview_file"
                    :ajaxSettings="ajaxSettings"
                    :view="view"
                    :toolbarSettings="toolbarSettings"
                    :contextMenuSettings="contextMenuSettings"
                >
                </ejs-filemanager>
            </div>
        </div>
    </div>
</template>
<style>
.file-overview .sample-container {
    margin: 10px 10px 10px 10px;
}
</style>
<script>
import {
    FileManagerComponent,
    NavigationPane,
    Toolbar,
    DetailsView,
} from "@syncfusion/ej2-vue-filemanager";

/**
 * File Manager full functionalities sample
 */

let hostUrl = "https://ej2-aspcore-service.azurewebsites.net/";
export default {
    components: {
        "ejs-filemanager": FileManagerComponent,
    },
    data: function () {
        return {
            ajaxSettings: {
                url: hostUrl + "api/FileManager/FileOperations",
                getImageUrl: hostUrl + "api/FileManager/GetImage",
                uploadUrl: hostUrl + "api/FileManager/Upload",
                downloadUrl: hostUrl + "api/FileManager/Download",
            },
            toolbarSettings: {
                items: [
                    "NewFolder",
                    "SortBy",
                    "Cut",
                    "Copy",
                    "Paste",
                    "Delete",
                    "Refresh",
                    "Download",
                    "Rename",
                    "Selection",
                    "View",
                    "Details",
                ],
            },
            contextMenuSettings: {
                layout: [
                    "SortBy",
                    "View",
                    "Refresh",
                    "|",
                    "Paste",
                    "|",
                    "NewFolder",
                    "|",
                    "Details",
                    "|",
                    "SelectAll",
                ],
                visible: true,
            },
            view: "Details",
            detailsViewSettings: {
                columns: [
                    {
                        field: "name",
                        headerText: "Name",
                        customAttributes: { class: "e-fe-grid-name" },
                    },
                    {
                        field: "_fm_modified",
                        headerText: "DateModified",
                        format: "MM/dd/yyyy hh:mm a",
                    },
                    {
                        field: "size",
                        headerText: "Size",
                        template: '<span class="e-fe-size">${size}</span>',
                        format: "n2",
                    },
                ],
            },
        };
    },
    provide: {
        filemanager: [NavigationPane, DetailsView, Toolbar],
    },
};
</script>

<style>
@import "../../../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-icons/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-popups/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-buttons/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-splitbuttons/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-navigations/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-layouts/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-grids/styles/material.css";
@import "../../../../../node_modules/@syncfusion/ej2-vue-filemanager/styles/material.css";
</style>

<!-- Data from FileOperations get api  -->
<!-- {"cwd":{"path":null,"action":null,"newName":null,"names":null,"name":"Files","size":0,"previousName":null,"dateModified":"2024-04-20T18:29:18.4785856+00:00","dateCreated":"2024-04-20T18:29:29.797503+00:00","hasChild":true,"isFile":false,"type":"","id":null,"filterPath":"","filterId":null,"parentId":null,"targetPath":null,"renameFiles":null,"uploadFiles":null,"caseSensitive":false,"searchString":null,"showHiddenItems":false,"showFileExtension":false,"data":null,"targetData":null,"permission":null},"files":[{"path":null,"action":null,"newName":null,"names":null,"name":"Downloads","size":0,"previousName":null,"dateModified":"2024-04-20T18:29:18.4317243+00:00","dateCreated":"2024-04-20T18:29:29.8131227+00:00","hasChild":true,"isFile":false,"type":"","id":null,"filterPath":"\\","filterId":null,"parentId":null,"targetPath":null,"renameFiles":null,"uploadFiles":null,"caseSensitive":false,"searchString":null,"showHiddenItems":false,"showFileExtension":false,"data":null,"targetData":null,"permission":null}],"error":null,"details":null} -->
