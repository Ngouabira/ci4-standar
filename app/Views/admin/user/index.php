<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>

<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="card-title text-primary"><?=lang('user.users')?></h5>
                        <a href="/admin/user/create" class="btn btn-success"><i class='bx bx-plus'></i>&nbsp; <?=lang('common.add_new')?></a>
                    </div>
                </div>
                <div class="card-body table-responsive mt-3">
                <?=view_cell('App\Libraries\Message::render')?>
                    <table class="table table-striped table-hover mt-2" id="userTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?=lang('user.name')?></th>
                                <th><?=lang('user.email')?></th>
                                <th><?=lang('common.action')?></th>
                                <!-- <th>Role</th> -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?=view_cell('App\Libraries\ConfirmMessage::render')?>
<?=view_cell('App\Libraries\Datatable::render')?>

<script src="/assets/js/app.js"></script>
<script>
let columnNames = [
        { data: 'id'},
        { data: 'name'},
        { data: 'email'}
    ];

let targets = [0, 3];

let actions = function (id) {
    let buttons = `
        <a class="btn btn-info btn-sm" href="/admin/user/${id}/show"><?=lang('button.detail')?></a>
        <a class="btn btn-primary btn-sm" href="/admin/user/${id}/edit"><?=lang('button.edit')?></a>
        <button class="btn btn-danger btn-sm" onclick="showDeleteModal(${id})"><?=lang('button.delete')?></button>
    `;
    return buttons;
};

let tab = showTable('userTable', columnNames,'/admin/user',actions, targets,1);

</script>

<?=$this->endSection()?>