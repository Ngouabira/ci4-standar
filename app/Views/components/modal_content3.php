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

    function escapeString(str) {
        return str.replace(/[`']/g, "\\$&");
    }

    actions = function(data) {
        return `
    <button type="button" onclick="selectItem3('<?=$data['field']?>',['${escapeString(data['<?=$column1?>'])}', '${escapeString(data['<?=$column2?>'])}' ], '<?=$data['modalId']?>')"
   class="btn btn-sm btn-outline-primary"><?=translate('base.App_select')?></button>

    `;
    };

    showModalTable({dataGrid:'tableSelect<?=$data['field']?>', columnNames:columnNames, url:'<?=$data['route']?>',actionButtons:actions});
</script>