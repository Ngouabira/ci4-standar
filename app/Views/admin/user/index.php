<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>

<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="card-header">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="card-title text-primary">Users</h5>
                        <a href="/admin/user/create" class="btn btn-success"><i class='bx bx-plus'></i>&nbsp; Add new</a>
                    </div>
                </div>
                <div class="card-body table-responsive mt-3">
                <?=view_cell('App\Libraries\Message::render')?>
                    <table class="table  table-bordered mt-2" id="userTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                                <!-- <th>Role</th> -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.11.1/datatables.min.js"></script>
<script src="/assets/js/app.js"></script>
<script>
let columnNames = [
        { data: 'id'},
        { data: 'name'},
        { data: 'email'}
    ];

showTable('userTable', columnNames,'/admin/user');

</script>
<?=$this->endSection()?>