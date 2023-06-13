<div class="modal fade" id="<?=$data['modalId']?>">
    <div class="modal-dialog <?=$data['size']?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=$data['title']?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="<?=$data['modalId']?>-content">
                <table class="table table-striped table-hover mt-2" id="tableSelect<?=$data['field']?>">
                    <thead>
                        <tr>
                            <?php foreach ($data['columns'] as $column): ?>
                                <th scope="col"><?=lang($data['model'] . '.' . $column)?></th>
                            <?php endforeach;?>
                            <th scope="col"><?=lang('common.action')?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php

$columnNames = [];

foreach ($data['columns'] as $column) {
    $columnNames[] = ['data' => $column];
}

$column1 = $data['columns'][0];
$column2 = $data['columns'][1];
?>

<script>
    columnNames = <?php echo json_encode($columnNames); ?>;

    targets = [0, 2];

    actions = function(data) {
        let buttons = `
    <button type="button" onclick="selectItem('<?=$data['field']?>',[${data['id']}, '${data['<?=$column1?>']}', '${data['<?=$column2?>']}' ], '<?=$data['modalId']?>')"
   class="btn btn-sm btn-outline-primary"><?=lang('common.select')?></button>

    `;
        return buttons;
    };

    showTable('tableSelect<?=$data['field']?>', columnNames, '<?=$data['route']?>', actions, targets);
</script>