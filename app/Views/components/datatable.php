<script>
    let defaultActionButton = function(data) {
        let url = window.location.href;
        return `
        <a class="btn btn-info btn-sm" href="${url}/${data.id}/show"><?=lang("base.App_show", [], session()->get('lang'))?></a>
        <a class="btn btn-primary btn-sm" href="${url}/${data.id}/edit"><?=lang("base.App_edit", [], session()->get('lang'))?></a>
        <button class="btn btn-danger btn-sm" onclick="showDeleteModal(${data.id})"><?=lang("base.App_delete", [], session()->get('lang'))?></button>
    `;
    };

    let defaultActionButtons = function(data) {
        let url = window.location.href;
        return `
        <a class="btn btn-info btn-sm" href="${url}/${data.id}/show"><i class='fas fa-eye'></i></a>
        <button class="btn btn-danger btn-sm" onclick="showDeleteModal(${data.id})"><i class='fas fa-trash'></i></button>
    `;
    };

    /**
     * Show a table with the given parameters
     * @param dataGrid  {string}
     * @param columnNames {array}
     * @param url {string}
     * @param actionButtons {function}
     * @param pageLength {number}
     */
    async function showTable({
        dataGrid,
        columnNames,
        url,
        actionButtons = defaultActionButtons,
        table,
        key = 'tcodice',
        pageLength = 10,
        allowAdding = false,
        allowUpdating = false,
        allowDeleting = false
    }) {

        let state = await getState(table);

        Globalize.locale('<?=session()->get('lang')?>');
        $(`#${dataGrid}`).dxDataGrid({
            dataSource: {
                store: {
                    type: "odata",
                    url: url
                },
                paginate: true,
                pageSize: pageLength // Set the number of items to retrieve per page
            },
            keyExpr: key,
            columns: [
                ...columnNames,
                {
                    caption: "<?=lang('base.App_action', [], session()->get('lang'))?>",
                    width: "auto",
                    allowGrouping: false,
                    allowHiding: false,
                    allowReordering: false,
                    cellTemplate: function(container, options) {
                        let data = options.data;
                        let buttons = actionButtons(data);
                        $(container).append(buttons);
                    }
                }
            ],

            stateStoring: {
                enabled: true,
                type: "custom",
                customLoad: function() {
                    return state;
                },

            },
            allowColumnResizing: true,
            columnAutoWidth: true,
            rowAlternationEnabled: true,
            showBorders: true,
            filterRow: {
                visible: true
            },
            remoteOperations: false,
            searchPanel: {
                visible: true,
                highlightSearchText: false,
                searchMode: "contains",
                width: "350px"
            },
            groupPanel: {
                visible: true
            },
            columnChooser: {
                enabled: true,
            },
            toolbar: {
                items: [{
                        widget: "dxButton",
                        options: {
                            icon: "save",
                            // text: "Save State",
                            onClick: function(e) {

                                const gridInstance = $(`#${dataGrid}`).dxDataGrid("instance");
                                const state = gridInstance.state();
                                delete state.pageIndex;
                                delete state.searchText;
                                saveGridState(state, table);
                            }
                        }
                    },
                    {
                        widget: "dxButton",
                        options: {
                            icon: "columnchooser",
                            onClick: function() {
                                const gridInstance = $(`#${dataGrid}`).dxDataGrid("instance");
                                gridInstance.showColumnChooser();
                            }
                        }
                    },
                    "groupPanel",
                    "searchPanel"
                ]
            },
            pager: {
                showPageSizeSelector: true,
                allowedPageSizes: [10, 25, 50, 100],
            },
            allowColumnReordering: true,
            summary: {
                totalItems: [{
                    column: key,
                    summaryType: "count",
                    displayFormat: "<?=translate('base.App_total')?>: {0}"
                }]
            },
            showColumnTotals: true,
            sortByGroupSummaryInfo: [{
                summaryItem: 'count',
            }],
            editing: {
                mode: "form",
                allowAdding: allowAdding,
                allowUpdating: allowUpdating,
                allowDeleting: allowDeleting,
            },

            onSaving: function(e) {
                if (e.changes[0]) {
                    const change = e.changes[0];
                    const newUrl = url.split("/")[1];
                    let modifiedData = e.changes[0].data;
                    if (change) {
                        e.cancel = true;
                        if (e.changes[0].type === "insert") {
                            saveItem(modifiedData, url, "POST")
                        } else if (e.changes[0].type === "update") {
                            const id = change.key.id;
                            saveItem(modifiedData, `/${newUrl}/${id}`, "PUT")

                        } else if (e.changes[0].type === "remove") {
                            const id = change.key.id;
                            deleteItem(`/${newUrl}/${id}`)
                        }

                    }
                }
            },

            sorting: {
                mode: "single"
            },
            onOptionChanged: function(e) {

                let match = e.fullName.match(/columns\[(\d+)\]\.sortOrder/);

                if (match) {
                    let columnIndex = parseInt(match[1]);
                    let sortedColumn = e.component.columnOption(columnIndex, "dataField");
                    let sortOrder = e.value;
                    saveSession({[`${table}sortedColumn`]: sortedColumn, [`${table}sortDirection`]: sortOrder});
                }
            }

        });
    }

    function showTableWithAddAndEdit({
        dataGrid,
        columnNames,
        url,
        targets = [0],
        pageLength = 10
    }) {
        Globalize.locale('<?=session()->get('lang')?>');
        let dataSource = $(`#${dataGrid}`).dxDataGrid({
            dataSource: {
                store: {
                    type: "odata",
                    url: url
                },
                paginate: true,
                pageSize: pageLength // Set the number of items to retrieve per page
            },
            keyExpr: "id",
            columns: [
                ...columnNames,
                {
                    type: 'buttons',
                    width: '150px',
                    buttons: ['edit', 'delete']
                }
            ],
            allowColumnResizing: true,
            columnAutoWidth: true,
            rowAlternationEnabled: true,
            showBorders: true,
            filterRow: {
                visible: true
            },
            remoteOperations: false,
            searchPanel: {
                visible: true,
                highlightSearchText: false,
                searchMode: "contains",
                width: "350px"
            },
            groupPanel: {
                visible: true
            },
            columnChooser: {
                enabled: true
            },
            pager: {
                showPageSizeSelector: true,
                allowedPageSizes: [10, 25, 50, 100],
            },
            allowColumnReordering: true,
            summary: {
                totalItems: [{
                    column: "id",
                    summaryType: "count",
                    displayFormat: "<?=translate('base.App_total')?>: {0}"
                }]
            },
            sortByGroupSummaryInfo: [{
                summaryItem: 'count',
            }],
            editing: {
                mode: "form", // Enable row-based editing
                allowAdding: true, // Enable adding new rows
                allowUpdating: true, // Enable editing existing rows
                allowDeleting: true, // Enable deleting rows
            },

            onSaving: function(e) {
                if (e.changes[0]) {
                    const change = e.changes[0];
                    const newUrl = url.split("/")[1];
                    let modifiedData = e.changes[0].data;
                    if (change) {
                        e.cancel = true;
                        if (e.changes[0].type === "insert") {
                            saveItem(modifiedData, url, "POST")
                        } else if (e.changes[0].type === "update") {
                            const id = change.key.id;
                            saveItem(modifiedData, `/${newUrl}/${id}`, "PUT")

                        } else if (e.changes[0].type === "remove") {
                            const id = change.key.id;
                            deleteItem(`/${newUrl}/${id}`)
                        }

                    }
                }
            }

        });
    }

    function showModalTable({
        dataGrid,
        columnNames,
        url,
        actionButtons = defaultActionButtons,
        pageLength = 10
    }) {
        Globalize.locale('<?=session()->get('lang')?>');
        let dataSource = $(`#${dataGrid}`).dxDataGrid({
            dataSource: {
                store: {
                    type: "odata",
                    url: url
                },
                paginate: true,
                pageSize: pageLength
            },
            keyExpr: "id",
            columns: [
                ...columnNames,
                {
                    caption: "<?=lang('base.App_action', [], session()->get('lang'))?>",
                    width: "auto",
                    allowGrouping: false,
                    allowHiding: false,
                    allowReordering: false,
                    cellTemplate: function(container, options) {
                        let data = options.data;
                        let buttons = actionButtons(data);
                        $(container).append(buttons);
                    }
                }
            ],
            allowColumnResizing: true,
            columnAutoWidth: true,
            rowAlternationEnabled: true,
            showBorders: true,
            filterRow: {
                visible: true
            },
            remoteOperations: false,
            searchPanel: {
                visible: true,
                highlightSearchText: false,
                searchMode: "contains",
                width: "350px"
            },
            groupPanel: {
                visible: true
            },
            columnChooser: {
                enabled: true
            },
            pager: {
                showPageSizeSelector: true,
                allowedPageSizes: [10, 25, 50, 100],
            },
            allowColumnReordering: true,
            summary: {
                totalItems: [{
                    column: "id",
                    summaryType: "count",
                    displayFormat: "<?=translate('base.App_total')?>: {0}"
                }]
            },
            sortByGroupSummaryInfo: [{
                summaryItem: 'count',
            }],
            sorting: {
                mode: "single"
            },

        });
    }

    function getSortedColumn(dataGridOptions) {
        const sortedColumn = dataGridOptions.columns.find((column) => column.sortIndex !== undefined);
        const sortOrder = sortedColumn ? sortedColumn.sortOrder : 'asc';
        return {
            sortedColumn: sortedColumn?.name || 'id',
            sortOrder: sortOrder
        };
    }



    async function getState(table) {

        let state = null;

        await $.ajax({
            url: "/devexpress/" + table + '/getState',
            method: "GET",
            success: function(response) {
                state = response;
                let sort = state ? getSortedColumn(state):[];
                saveSession({[`${table}sortedColumn`]: sort?.sortedColumn ?? 'id', [`${table}sortDirection`]: sort.sortOrder ?? 'asc'});
            },
            error: function(error) {
                console.error("Error saving state:", error);
            }
        });
        return state;
    }

    function saveSession(data) {

        return $.ajax({
            url: '/save-sort-session',
            method: 'POST',
            data: data,
            success: function(response) {
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });

    }


    function saveGridState(state, table) {

        $.ajax({
            url: "/devexpress",
            method: "POST",
            data: {
                state: JSON.stringify(state),
                table: table
            },
            success: function(response) {
                Swal.fire({
                    icon: response.type,
                    position: 'top-end',
                    title: response.message,
                }).then((result) => {
                    location.reload();
                });
            },
            error: function(error) {
                console.error("Error saving state:", error);
            }
        });
    }


    function saveItem(data, url, method) {

        return $.ajax({
            url: url,
            method: method,
            data: data,
            success: function(response) {
                Swal.fire({
                    icon: response.type,
                    position: 'top-end',
                    title: response.message,
                }).then((result) => {
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });

    }


    function deleteItem(url) {

        return $.ajax({
            url: url,
            method: 'DELETE',
            success: function(response) {
                Swal.fire({
                    icon: response.type,
                    position: 'top-end',
                    title: response.message,
                }).then((result) => {
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });

    }
</script>