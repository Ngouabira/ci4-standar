<?php

$columnNames = [];

$column1 = $data['columns'][0];
$column2 = $data['columns'][1];
$column3 = $data['columns'][2];

$columnNames[] = $column1;
$columnNames[] = $column2;
?>

<script>
    columnNames = <?php echo json_encode($columnNames); ?>;

    function escapeString(str) {
        return str.replace(/[`']/g, "\\$&");
    }

    actions = function(data) {
        return `
    <button type="button" onclick="selectItem2('<?=$data['field']?>',[${data['id']}, '${escapeString(data['<?=$column1?>'])}', '${escapeString(data['<?=$column2?>'])}', '<?=$column3?>' ], '<?=$data['modalId']?>')"
   class="btn btn-sm btn-outline-primary"><?=translate('base.App_select')?></button>

    `;
    };

    showModalTable({
        dataGrid: 'tableSelect<?=$data['field']?>',
        columnNames: columnNames,
        url: '<?=$data['route']?>',
        actionButtons: actions
    });
</script>