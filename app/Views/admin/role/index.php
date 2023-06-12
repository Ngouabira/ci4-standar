<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="card-title text-primary">Roles</h5>
                        <a href="/admin/role/create" class="btn btn-success"><i class='bx bx-plus'></i>&nbsp; Add new</a>
                    </div>
                </div>
                <div class="card-body table-responsive mt-3">
                <?=view_cell('App\Libraries\Message::render')?>
                    <table class="table  table-bordered mt-2" id="attivaTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>