<script>

let defaultActionButtons = function (data) {
    var buttons = `
        <button class="btn btn-info btn-sm" onclick="showDetail(${data.id})">Detail</button>
        <button class="btn btn-primary btn-sm" onclick="editUser(${data.id})">Edit</button>
        <button class="btn btn-danger btn-sm" onclick="deleteUser(${data.id})">Delete</button>
    `;
    return buttons;
};


function showTable(tableId, columnNames, url, actionButtons=defaultActionButtons, targets, pageLength=10) {

       return $(`#${tableId}`).DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "pageLength": pageLength,
            "responsive": true,
            "autoWidth": false,
            "info": true,
            "lengthChange": true,
             order: [[1, 'asc']],
            "language": {
                "url":"//cdn.datatables.net/plug-ins/1.13.4/i18n/<?=(session()->get('lang') == 'it') ? 'it-IT' : ((session()->get('lang') == 'fr') ? 'fr-FR' : 'en-GB')?>.json"
            },
            ajax: {
                url: url,
                method: 'GET',
            },

            columns: [
                ...columnNames,
                {
                    "data": function (data) {
                        return  actionButtons(data);
                    }
                }
            ],
            columnDefs: [{
                orderable: false,
                targets: targets
            }]
        })
}
</script>