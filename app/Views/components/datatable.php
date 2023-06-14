<script>

let defaultActionButtons = function (data) {
    let url = window.location.href;
    let buttons = `
        <button class="btn btn-info btn-sm" onclick="${url}/${data.id}/show">Detail</button>
        <button class="btn btn-primary btn-sm" onclick="${url}/${data.id}/edit">Edit</button>
        <button class="btn btn-danger btn-sm" onclick="showDeleteModal(${data.id})">Delete</button>
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
            "autoWidth": true,
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