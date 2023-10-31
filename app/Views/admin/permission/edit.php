<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="card">
    <div class="card-header bg-white">
        <div class="float-left">
            <div class="btn-group">
                <a href="<?=base_url('/admin/permission')?>" class="btn btn-sm btn-block btn-primary"><i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <span class="card-title pl-2"><?=translate('base.new')?> <?=translate('permission.title')?></span>
    </div>
    <div class="card-body table-responsive">

        <form action="/admin/permission/<?=$permission['id']?>" method="POST">
            <?=csrf_field()?>
            <input type="hidden" name="_method" value="PUT">
            <?=$this->include('components/message.php')?>
            <div class="col-12 pt-1">
                <label class="form-label" for="name"><?=lang('permission.name')?></label>
                <input type="text" required name="name" id="name" class="form-control <?=session('info.messages.name') ? 'is-invalid' : ''?>" value="<?=$permission['name']?>">
            </div>
            <div class="col-12 pt-1">
                <label class="form-label" for="description"><?=lang('permission.description')?></label>
                <input type="text" required name="description" id="description" class="form-control <?=session('info.messages.description') ? 'is-invalid' : ''?>" value="<?=$permission['description']?>">
            </div>
            <div class="col-12 pt-2">
                <button type="submit" id="update" class="btn btn-success"><?=lang('base.update')?></button>
            </div>
        </form>

    </div>
</div>
<?=$this->endSection()?>