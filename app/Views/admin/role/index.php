<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- SELECT2 EXAMPLE -->
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-10 mt-2">
                <h3 class="card-title"><?= translate('role.title') ?></h3>
            </div>
            <div class="col-2">
                <a type="button" class="btn float-right btn-primary" href="role/new" title="<?= translate("role.App_new") ?>"> <i class="fa fa-plus"></i> </a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?= $this->include('components/message.php') ?>
        <div id="roleTable"></div>
    </div>
    <?= $this->include('components/modal.php') ?>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<script src="/assets/js/app.js"></script>
<?= $this->include('components/datatable.php') ?>
<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script>
    const columns = [{
            dataField: 'name',
            caption: `<?= translate('role.name') ?>`,
            visible: true
        },
        {
            dataField: 'description',
            caption: `<?= translate('role.description') ?>`,
            visible: true
        },

        //   { dataField: 'deleted_by', caption: `<?= translate('role.deleted_by') ?>`, visible: false },
        //   { dataField: 'created_by', caption: `<?= translate('role.created_by') ?>`, visible: false },
        //   { dataField: 'updated_by', caption: `<?= translate('role.updated_by') ?>`, visible: false },
        //   { dataField: 'isdeleted', caption: `<?= translate('role.isdeleted') ?>`, visible: false },
        //   { dataField: 'created_at', caption: `<?= translate('role.created_at') ?>`, visible: false },
        //   { dataField: 'updated_at', caption: `<?= translate('role.updated_at') ?>`, visible: false },
        //   { dataField: 'deleted_at', caption: `<?= translate('role.deleted_at') ?>`, visible: false },
    ];
    showTable({
        dataGrid: 'roleTable',
        columnNames: columns,
        url: '/admin/role'
    })
</script>
<?= $this->endSection() ?>