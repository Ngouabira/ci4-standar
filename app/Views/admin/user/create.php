<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="card-title text-primary">New user</h5>
                    </div>
                </div>
                <div class="card-body table-responsive">

                    <form action="/admin/user" method="POST">
                        <?=csrf_field()?>
                        <?=view_cell('App\Libraries\Message::render')?>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" name="name" value="<?=old('name')?>" id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" value="<?=old('email')?>" id="email" class="form-control <?=session('errors.email') ? 'is-invalid' : ''?>">
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="role">Roles</label>
                            <select name="role" id="role" class="form-control"></select>
                        </div>
                        <div class="col-12 pt-1">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control <?=session('errors.password') ? 'is-invalid' : ''?>">
                        </div>
                        <div class="pt-2">
                            <button type="submit" id="create" class="btn btn-primary">Create</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>