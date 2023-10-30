<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="card">
    <div class="card-header bg-white">
        <div class="float-left">
            <div class="btn-group">
                <a href="<?=base_url('/admin/role')?>" class="btn btn-sm btn-block btn-primary"><i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <span class="card-title pl-2 text-primary"><?=translate('base.new')?> <?=translate('role.title')?></span>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
                    <form action="/admin/role" method="POST">
                        <?=csrf_field()?>
                       <?=$this->include('components/message.php')?>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name"><?=lang('role.name')?></label>
                            <input type="text" value="<?=old('name')?>" required name="name" id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="description"><?=lang('role.description')?></label>
                            <input type="text" value="<?=old('description')?>" required name="description" id="description" class="form-control <?=session('errors.description') ? 'is-invalid' : ''?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label for="permissions" class="form-label"><?=lang('user.permissions')?></label>

                                <select class="custom-select2 form-control select2-hidden-accessible" name="permissions[]" multiple="multiple" data-live-search="true" data-placeholder="<?=lang('user.permissions')?>" style="width: 100%;">
                                    <?php foreach ($permissions as $permission) {?>
                                        <option <?=in_array($permission['id'], old('permissions', [])) ? 'selected' : ''?> value="<?=$permission['id']?>"><?=$permission['name']?></option>
                                    <?php }?>
                                </select>
                                <?php if (session('error.permission')) {?>
                                    <h6 class="text-danger"><?=session('error.permission')?></h6>
                                <?php }?>

                        </div>
                        <div class="col-12 pt-2">
                            <button type="submit" id="create" class="btn btn-success"><?=lang('base.create')?></button>
                        </div>
                    </form>

                </div>
            </div>
<script>
    $('.select').select2();
</script>

<?=$this->endSection()?>