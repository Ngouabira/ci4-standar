<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="float-left">
            <div class="btn-group">
                <a href="<?= base_url('/admin/permission') ?>" class="btn btn-sm btn-block btn-primary"><i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <span class="card-title pl-2 text-primary"><?= translate('base.new') ?> <?= translate('permission.title') ?></span>
    </div>
    <div class="card-body table-responsive">

        <form action="/admin/permission" method="POST">
            <?= csrf_field() ?>
            <?= $this->include('components/message.php') ?>
            <div class="col-12 pt-1">
                <label class="form-label" for="name"><?= lang('permission.name') ?></label>
                <input type="text" value="<?= old('name') ?>" required name="name" id="name" class="form-control <?= session('info.messages.name') ? 'is-invalid' : '' ?>">
            </div>
            <div class="col-12 pt-1">
                <label class="form-label" for="description"><?= lang('permission.description') ?></label>
                <input type="text" value="<?= old('description') ?>" required name="description" id="description" class="form-control <?= session('info.messages.description') ? 'is-invalid' : '' ?>">
            </div>
            <div class="col-12 pt-2">
                <button type="submit" id="create" class="btn btn-success"><?= lang('base.create') ?></button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>