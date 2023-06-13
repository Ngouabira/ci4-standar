<div class="card">
    <div class="card-body table-responsive mt-3">
        <table class="table  table-bordered mt-2" id="roleTableSelect<?=$filed?>">
            <thead>
            <tr>
                <th scope="col"><?=lang('role.id')?></th>
                <th scope="col"><?=lang('role.name')?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<script>
let columnNames = [
        { data: 'id'},
        { data: 'name'},
        { data: 'description'}
    ];

let targets = [0, 3];

let actions = function (id) {
    let buttons = `
    <a href="#" onclick="selectItem('<?=$field?>', ${role}, ['id', 'name'], 'select<?=$field?>')"
   class="btn btn-sm btn-outline-primary"><?=lang('role.select')?></a>

    `;
    return buttons;
};

let tab = showTable('roleTableSelect<?=$filed?>', columnNames,'/select/role',actions, targets);

</script>

<?=$this->endSection()?>