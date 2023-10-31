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
        <span class="card-title pl-2"><?=translate('base.edit')?> <?=translate('role.title')?></span>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <form action="/admin/role/<?=$role['id']?>" method="POST">
            <?=csrf_field()?>
            <input type="hidden" name="_method" value="PUT">
            <?=$this->include('components/message.php')?>
            <div class="col-12 pt-1">
                <label class="form-label" for="name"><?=lang('role.name')?></label>
                <input type="text" required name="name" id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>" value="<?=$role['name']?>">
            </div>
            <div class="col-12 pt-1">
                <label class="form-label" for="description"><?=lang('role.description')?></label>
                <input type="text" required name="description" id="description" class="form-control <?=session('errors.description') ? 'is-invalid' : ''?>" value="<?=$role['description']?>">
            </div>
            <div class="col-12 pt-1">
                <label for="permissions" class="form-label"><?=lang('role.permissions')?></label>

                    <select class="select custom-select2 form-control" name="permissions[]" multiple="multiple" data-live-search="true">
                        <?php foreach ($permissions as $value) {?>
                            <?php if (in_array($value['id'], $role['permissions'])) {?>
                                <option value="<?=$value['id']?>" selected><?=$value['name']?></option>
                            <?php } else {?>
                                <option value="<?=$value['id']?>"><?=$value['name']?></option>
                            <?php }?>
                        <?php }?>
                    </select>
                    <?php if (session('error.permission')) {?>
                        <h6 class="text-danger"><?=session('error.permission')?></h6>
                    <?php }?>

            </div>
            <div class="col-12 pt-2">
                <button type="submit" id="create" class="btn btn-success"><?=lang('base.update')?></button>
            </div>
        </form>

    </div>
</div>

<script>
    $('.select').select2();
</script>

<?=$this->endSection()?>