<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="card-title text-primary"><?=lang('user.new_user')?></h5>
                    </div>
                </div>
                <div class="card-body table-responsive">

                    <form action="/admin/user" method="POST">
                        <?=csrf_field()?>
                        <?=view_cell('App\Libraries\Message::render')?>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name"><?=lang('user.name')?></label>
                            <input type="text" name="name" value="<?=old('name')?>" id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="email"><?=lang('user.email')?></label>
                            <input type="email" name="email" value="<?=old('email')?>" id="email" class="form-control <?=session('errors.email') ? 'is-invalid' : ''?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label for="roles" class="col-sm-2 col-form-label"><?=lang('user.roles')?></label>
                            <div class="col-sm-8">
                                <select class="selectpicker show-tick form-control select" name="roles[]" multiple="multiple" data-placeholder="<?=lang('user.roles')?>" style="width: 100%;">
                                    <?php foreach ($roles as $role) {?>
                                        <option <?=in_array($role['id'], old('roles', [])) ? 'selected' : ''?> value="<?=$role['id']?>"><?=$role['name']?></option>
                                    <?php }?>
                                </select>
                                <?php if (session('error.role')) {?>
                                    <h6 class="text-danger"><?=session('error.role')?></h6>
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-12 pt-1">
                            <label for="permissions" class="col-sm-2 col-form-label"><?=lang('user.permissions')?></label>
                            <div class="col-sm-8">
                                <select class="form-control select" name="permissions[]" multiple="multiple" data-live-search="true" data-placeholder="<?=lang('user.permissions')?>" style="width: 100%;">
                                    <?php foreach ($permissions as $permission) {?>
                                        <option <?=in_array($permission['id'], old('permissions', [])) ? 'selected' : ''?> value="<?=$permission['id']?>"><?=$permission['name']?></option>
                                    <?php }?>
                                </select>
                                <?php if (session('error.permission')) {?>
                                    <h6 class="text-danger"><?=session('error.permission')?></h6>
                                <?php }?>
                            </div>
                        </div>

                        <div class="col-12 pt-1">
                            <label class="form-label" for="password"><?=lang('user.password')?></label>
                            <input type="password" name="password" id="password" class="form-control <?=session('errors.password') ? 'is-invalid' : ''?>">
                        </div>
                        <div class="pt-2">
                            <button type="submit" id="create" class="btn btn-primary"><?=lang('button.create')?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.select').select2();
</script>
<?=view_cell('App\Libraries\Datatable::render')?>


<?=view_cell('App\Libraries\CustomSelect::render', ['label' => 'Roles', 'name' => 'roles', 'options' => [], 'modalId' => 'rolesModal'])?>
<?=view_cell('App\Libraries\CustomSelect::render', ['label' => 'Permissions', 'name' => 'permissions', 'options' => [], 'modalId' => 'permissionsModal'])?>


<?=view_cell(
    'App\Libraries\CustomModal::render',
    [
        'size' => 'modal-lg', 'title' => 'Roles', 'modalId' => 'rolesModal',
        'model' => 'role', 'field' => 'roles', 'columns' => ['name', 'description'],
        'route' => '/select-role',
    ]
)?>

<?=view_cell(
    'App\Libraries\CustomModal::render',
    [
        'size' => 'modal-lg', 'title' => 'Permissions', 'modalId' => 'permissionsModal',
        'model' => 'permission', 'field' => 'permissions', 'columns' => ['name', 'description'],
        'route' => '/select-permission',
    ]
)?>
<?=$this->endSection()?>