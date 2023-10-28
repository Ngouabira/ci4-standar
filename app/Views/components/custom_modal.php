<div class="modal fade" id="<?=$data['modalId']?>">
    <div class="modal-dialog <?=$data['size']?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=$data['title']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="<?=$data['modalId']?>-content">
                <div  id="tableSelect<?=$data['field']?>">

                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php

$columnNames = [];

foreach ($data['columns'] as $column) {
    $columnNames[] = ['dataField' => $column, 'caption' => lang('base.' . $data['model'] . '_' . $column, [], session()->get('lang'))];
}

$column1 = $data['columns'][0];
$column2 = $data['columns'][1];
?>

<script>
    columnNames = <?php echo json_encode($columnNames); ?>;

    actions = function(data) {
        return `
    <button type="button" onclick="selectItem('<?=$data['field']?>',[${data['id']}, '${data['<?=$column1?>']}', '${data['<?=$column2?>']}' ], '<?=$data['modalId']?>')"
   class="btn btn-sm btn-outline-primary"><?=translate('base.App_select')?></button>

    `;
    };

    showModalTable({dataGrid:'tableSelect<?=$data['field']?>', columnNames:columnNames, url:'<?=$data['route']?>',actionButtons:actions});
</script>