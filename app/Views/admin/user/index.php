<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<!-- SELECT2 EXAMPLE -->
<div class="card">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-10 mt-2">
                <h3 class="card-title"><?=translate('user.title')?></h3>
            </div>
            <div class="col-2">
                <a type="button" class="btn float-right btn-primary" href="user/new" title="<?=translate("user.App_new")?>"> <i class="fa fa-plus"></i> </a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?=$this->include('components/message.php')?>
        <div id="userTable"></div>
    </div>
    <?=$this->include('components/modal.php')?>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<script src="/assets/js/app.js"></script>
<?=$this->include('components/datatable.php')?>
<?=$this->endSection()?>


<?=$this->section('js')?>
<script>
    const columns = [{
            dataField: 'name',
            caption: `<?=translate('user.name')?>`,
            visible: true
        },
        {
            dataField: 'email',
            caption: `<?=translate('user.email')?>`,
            visible: true
        },

        //   { dataField: 'deleted_by', caption: `<?=translate('user.deleted_by')?>`, visible: false },
        //   { dataField: 'created_by', caption: `<?=translate('user.created_by')?>`, visible: false },
        //   { dataField: 'updated_by', caption: `<?=translate('user.updated_by')?>`, visible: false },
        //   { dataField: 'isdeleted', caption: `<?=translate('user.isdeleted')?>`, visible: false },
        //   { dataField: 'created_at', caption: `<?=translate('user.created_at')?>`, visible: false },
        //   { dataField: 'updated_at', caption: `<?=translate('user.updated_at')?>`, visible: false },
        //   { dataField: 'deleted_at', caption: `<?=translate('user.deleted_at')?>`, visible: false },
    ];
    showTable({
        dataGrid: 'userTable',
        columnNames: columns,
        url: '/admin/user'
    })
</script>
<?=$this->endSection()?>