<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="card-title text-primary">Edit permission</h5>
                    </div>
                </div>
                <div class="card-body table-responsive">

                    <form action="/admin/role/<?=$role['id']?>" method="POST">
                    <?=csrf_field()?>
                        <input type="hidden" name="_method" value="PUT">
                        <?php if (session()->has('errors')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php foreach (session('errors') as $error): ?>
                                    <li class="ml-40"><?=$error?></li>
                                <?php endforeach?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif?>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" required name="name" id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>" value="<?=$role['name']?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="description">Description</label>
                            <input type="text" required name="description" id="description" class="form-control <?=session('errors.description') ? 'is-invalid' : ''?>" value="<?=$role['description']?>">
                        </div>
                        <div class="pt-2">
                            <button type="submit" id="create" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>