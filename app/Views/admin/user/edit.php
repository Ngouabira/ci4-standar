<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="card">
<div class="card-header bg-white">
        <div class="float-left">
            <div class="btn-group">
                <a href="<?=base_url('/admin/user')?>" class="btn btn-sm btn-block btn-primary"><i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <span class="card-title pl-2 text-primary"><?=translate('base.edit')?> <?=translate('user.title')?></span>
    </div>
    <div class="card-body table-responsive">

        <form action="/admin/user/<?=$user['id']?>" method="POST">
            <?=csrf_field()?>
            <input type="hidden" name="_method" value="PUT">
            <?=$this->include('components/message.php')?>
            <div class="col-12 pt-1">
                <label class="form-label" for="name"><?=translate('user.name')?></label>
                <input type="text" name="name" required id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>" value="<?=$user['name']?>">
            </div>
            <div class="col-12 pt-1">
                <label class="form-label" for="name"><?=translate('user.email')?></label>
                <input type="email" required name="email" id="email" class="form-control <?=session('errors.email') ? 'is-invalid' : ''?>" value="<?=$user['email']?>">
            </div>
            <div class="col-12 pt-1">
                <label for="roles" class="form-label"><?=translate('user.roles')?></label>

                <select class="custom-select2 form-control select2-hidden-accessible" name="roles[]" multiple="multiple" data-live-search="true" data-placeholder="<?=translate('user.roles')?>" style="width: 100%;">
                    <?php foreach ($roles as $value) {?>
                        <?php if (in_array($value['id'], $user['roles'])) {?>
                            <option value="<?=$value['id']?>" selected><?=$value['name']?></option>
                        <?php } else {?>
                            <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php }?>
                    <?php }?>
                </select>
                <?php if (session('error.role')) {?>
                    <h6 class="text-danger"><?=session('error.role')?></h6>
                <?php }?>

            </div>
            <div class="col-12 pt-1">
                <label for="permissions" class="form-label"><?=translate('user.permissions')?></label>

                <select class="custom-select2 form-control select2-hidden-accessible" name="permissions[]" multiple="multiple" data-live-search="true" data-placeholder="<?=translate('user.permissions')?>" style="width: 100%;">
                    <?php foreach ($permissions as $value) {?>
                        <?php if (in_array($value['id'], $user['permissions'])) {?>
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
                <button type="submit" id="create" class="btn btn-success"><?=translate('base.update')?></button>
            </div>
        </form>

    </div>
</div>

<script>
    $('.select').select2();
</script>

<?=$this->endSection()?>