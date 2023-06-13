<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="card-title text-primary"><?=lang('role.new_role')?></h5>
                    </div>
                </div>
                <div class="card-body table-responsive">

                    <form action="/admin/role" method="POST">
                        <?=csrf_field()?>
                        <?=view_cell('App\Libraries\Message::render')?>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name"><?=lang('role.name')?></label>
                            <input type="text" value="<?=old('name')?>" required name="name" id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="description"><?=lang('role.description')?></label>
                            <input type="text" value="<?=old('description')?>" required name="description" id="description" class="form-control <?=session('errors.description') ? 'is-invalid' : ''?>">
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
                        <div class="pt-2">
                            <button type="submit" id="create" class="btn btn-primary"><?=lang('button.create')?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
    $('.select').select2();
</script>

<?=$this->endSection()?>