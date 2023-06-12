<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css" />

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js" referrerpolicy="no-referrer"></script>

<script>

let defaultActionButtons = function (id) {
    var buttons = `
        <button class="btn btn-info btn-sm" onclick="showDetail(${id})">Detail</button>
        <button class="btn btn-primary btn-sm" onclick="editUser(${id})">Edit</button>
        <button class="btn btn-danger btn-sm" onclick="deleteUser(${id})">Delete</button>
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
                        return  actionButtons(data.id);
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