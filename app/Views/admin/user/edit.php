<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="card-title text-primary"><?=lang('user.edit_user')?></h5>
                    </div>
                </div>
                <div class="card-body table-responsive">

                    <form action="/admin/user/<?=$user['id']?>" method="POST">
                        <?=csrf_field()?>
                        <input type="hidden" name="_method" value="PUT">
                       <?=$this->include('components/message.php')?>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name"><?=lang('user.name')?></label>
                            <input type="text" name="name" required id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>" value="<?=$user['name']?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name"><?=lang('user.email')?></label>
                            <input type="email" required name="email" id="email" class="form-control <?=session('errors.email') ? 'is-invalid' : ''?>" value="<?=$user['email']?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label for="roles" class="col-sm-2 col-form-label"><?=lang('user.roles')?></label>
                            <div class="col-sm-8">
                                <select class="selectpicker show-tick form-control select" name="roles[]" multiple="multiple" data-placeholder="<?=lang('user.roles')?>" style="width: 100%;">
                                <?php foreach ($roles as $value) {?>
                                    <?php if (array_key_exists($value['id'], $roles)) {?>
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
                        </div>
                        <div class="col-12 pt-1">
                            <label for="permissions" class="col-sm-2 col-form-label"><?=lang('user.permissions')?></label>
                            <div class="col-sm-8">
                                <select class="form-control select" name="permissions[]" multiple="multiple" data-live-search="true" data-placeholder="<?=lang('user.permissions')?>" style="width: 100%;">
                                <?php foreach ($permissions as $value) {?>
                                    <?php if (array_key_exists($value['id'], $permissions)) {?>
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
                        </div>
                        <div class="pt-2">
                            <button type="submit" id="create" class="btn btn-primary"><?=lang('button.update')?></button>
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

<?=$this->endSection()?>