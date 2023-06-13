<?=$this->include('Views/load/select2')?>
<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="card-title text-primary"><?=lang('role.edit_role')?></h5>
                    </div>
                </div>
                <div class="card-body table-responsive">

                    <form action="/admin/role/<?=$role['id']?>" method="POST">
                        <?=csrf_field()?>
                        <input type="hidden" name="_method" value="PUT">
                        <?=view_cell('App\Libraries\Message::render')?>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name"><?=lang('role.name')?></label>
                            <input type="text" required name="name" id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>" value="<?=$role['name']?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="description"><?=lang('role.description')?></label>
                            <input type="text" required name="description" id="description" class="form-control <?=session('errors.description') ? 'is-invalid' : ''?>" value="<?=$role['description']?>">
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
    $('.select').select2();
</script>

<?=$this->endSection()?>