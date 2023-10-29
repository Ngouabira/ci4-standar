<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<script src="/assets/js/app.js"></script>
<?=$this->include('Components/modal.php')?>
<div class="card">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-10 mt-2">
                <h5 class="card-title text-primary"><?=lang('user.new_user')?></h5>
            </div>
            <div class="col-2">
                <button type="submit" class="btn float-right btn-primary" href="user/new" title="<?=translate("user.App_new")?>"> <i class="icon-copy fi-save"></i> </button>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="/admin/user" method="POST">
            <?=csrf_field()?>
            <?=$this->include('components/message.php')?>
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
                    <select class="custom-select2 form-control select2-hidden-accessible" name="roles[]" multiple="multiple" data-placeholder="<?=lang('user.roles')?>" style="width: 100%;">
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
                    <select class="custom-select2 form-control select2-hidden-accessible" name="permissions[]" multiple="multiple" data-live-search="true" data-placeholder="<?=lang('user.permissions')?>" style="width: 100%;">
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
        </form>
    </div>
    <!-- /.card-body -->
</div>

<script>
    $('.select').select2();
</script>

<?=$this->include('/Components/datatable')?>

<?=view_cell(
    'App\Libraries\CustomModal3::render',
    [
        'modalId' => 'roleModal', 'size' => 'modal-xl', 'field' => 'role',
        'title' => translate('role.title'),
    ]
)?>

<?=view_cell(
    'App\Libraries\CustomModal3::render',
    [
        'modalId' => 'permissionModal', 'size' => 'modal-xl', 'field' => 'permission',
        'title' => translate('permission.title'),
    ]
)?>

<?=$this->endSection()?>