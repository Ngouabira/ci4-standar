<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<script src="/assets/js/app.js"></script>
<?=$this->include('Components/modal.php')?>
<div class="card">
    <div class="card-header bg-white">
        <div class="float-left">
            <div class="btn-group">
                <a href="<?=base_url('/admin/user')?>" class="btn btn-sm btn-block btn-primary"><i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <span class="card-title pl-2"><?=translate('base.new')?> <?=translate('user.title')?></span>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="/admin/user" method="POST">
            <?=csrf_field()?>
            <?=$this->include('components/message.php')?>
            <div class="col-12 pt-1">
                <label class="form-label" for="name"><?=translate('user.name')?></label>
                <input type="text" name="name" value="<?=old('name')?>" id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>">
            </div>
            <div class="col-12 pt-1">
                <label class="form-label" for="email"><?=translate('user.email')?></label>
                <input type="email" name="email" value="<?=old('email')?>" id="email" class="form-control <?=session('errors.email') ? 'is-invalid' : ''?>">
            </div>
            <div class="col-12 pt-1">
                <label for="roles" class="col-form-label"><?=translate('user.roles')?></label>
                <select class="custom-select2 form-control select2-hidden-accessible" name="roles[]" multiple="multiple" data-placeholder="<?=translate('user.roles')?>" style="width: 100%;">
                    <?php foreach ($roles as $role) {?>
                        <option <?=in_array($role['id'], old('roles', [])) ? 'selected' : ''?> value="<?=$role['id']?>"><?=$role['name']?></option>
                    <?php }?>
                </select>
                <?php if (session('error.role')) {?>
                    <h6 class="text-danger"><?=session('error.role')?></h6>
                <?php }?>
            </div>
            <div class="col-12 pt-1">
                <label for="permissions" class="col-form-label"><?=translate('user.permissions')?></label>
                <select class="custom-select2 form-control select2-hidden-accessible" name="permissions[]" multiple="multiple" data-live-search="true" data-placeholder="<?=translate('user.permissions')?>" style="width: 100%;">
                    <?php foreach ($permissions as $permission) {?>
                        <option <?=in_array($permission['id'], old('permissions', [])) ? 'selected' : ''?> value="<?=$permission['id']?>"><?=$permission['name']?></option>
                    <?php }?>
                </select>
                <?php if (session('error.permission')) {?>
                    <h6 class="text-danger"><?=session('error.permission')?></h6>
                <?php }?>
            </div>

            <div class="col-12 pt-1">
                <label class="form-label" for="password"><?=translate('user.password')?></label>
                <input type="password" name="password" id="password" class="form-control <?=session('errors.password') ? 'is-invalid' : ''?>">
            </div>
            <div class="pt-2 col-12">
                <button type="submit" id="create" class="btn btn-success"><?=translate('base.create')?></button>
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