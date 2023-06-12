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

                    <form action="/admin/permission/<?=$permission['id']?>" method="POST">
                        <?=csrf_field()?>
                        <input type="hidden" name="_method" value="PUT">
                        <?=view_cell('App\Libraries\Message::render')?>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" required name="name" id="name" class="form-control <?=session('info.messages.name') ? 'is-invalid' : ''?>" value="<?=$permission['name']?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="description">Description</label>
                            <input type="text" required name="description" id="description" class="form-control <?=session('info.messages.description') ? 'is-invalid' : ''?>" value="<?=$permission['description']?>">
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