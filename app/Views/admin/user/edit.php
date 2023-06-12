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

                    <form action="admin/user/<?=$user['id']?>" method="POST">
                        <?=csrf_field()?>
                        <input type="hidden" name="_method" value="PUT">
                        <?=view_cell('App\Libraries\Message::render')?>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name"><?=lang('user.name')?></label>
                            <input type="text" name="name" required id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>" value="<?=$user['name']?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name"><?=lang('user.email')?></label>
                            <input type="email" required name="email" id="email" class="form-control <?=session('errors.email') ? 'is-invalid' : ''?>" value="<?=$user['email']?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name"><?=lang('user.roles')?></label>
                            <select name="role" id="role" class="form-control"></select>
                        </div>
                        <div class="pt-2">
                            <button type="button" id="create" class="btn btn-primary"><?=lang('button.update')?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>