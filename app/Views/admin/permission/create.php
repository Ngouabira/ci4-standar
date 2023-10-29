<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="card-title text-primary"><?=lang('permission.new_permission')?></h5>
                    </div>
                </div>
                <div class="card-body table-responsive">

                    <form action="/admin/permission" method="POST">
                    <?=csrf_field()?>
                   <?=$this->include('components/message.php')?>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name"><?=lang('permission.name')?></label>
                            <input type="text"  value="<?=old('name')?>" required name="name" id="name" class="form-control <?=session('info.messages.name') ? 'is-invalid' : ''?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="description"><?=lang('permission.description')?></label>
                            <input type="text"  value="<?=old('description')?>" required name="description" id="description" class="form-control <?=session('info.messages.description') ? 'is-invalid' : ''?>">
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
<?=$this->endSection()?>