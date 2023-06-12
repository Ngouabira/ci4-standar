let defaultActionButtons = function (id) {
    var buttons = `
        <button class="btn btn-info btn-sm" onclick="showDetail(${id})">Detail</button>
        <button class="btn btn-primary btn-sm" onclick="editUser(${id})">Edit</button>
        <button class="btn btn-danger btn-sm" onclick="deleteUser(${id})">Delete</button>
    `;
    return buttons;
};

function showTable(tableId, columnNames, url, actionButtons=defaultActionButtons, pageLength=10) {

    $(`#${tableId}`).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url,
            type: 'POST',
            dataType: 'json',
            data: function (d) {
                var pageInfo = this.page.info();
                d.length = pageInfo.length;
                d.start = pageInfo.start;
                d.draw = this.ajax.params().draw;
                d.search = $(`#${tableId}_filter input`).val();
            },
            dataSrc: function (json) {
                json.recordsFiltered = json.recordsTotal;
                return json.data;
            }
        },
        columns: [
            ...columnNames,
            {
                data: null,
                render: function (data, type, row) {
                    return actionButtons(row.id);
                }
            }
        ],
        searching: true,
        lengthChange: true,
        lengthMenu: [10, 25, 50, 100],
        pageLength: pageLength
    });

}