<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="card">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-10 mt-2">
                <h3 class="card-title"><?=translate('permission.title')?></h3>
            </div>
            <div class="col-2">
                <a type="button" class="btn float-right btn-primary" href="permission/new" title="<?=translate("permission.App_new")?>"> <i class="fa fa-plus"></i> </a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?=$this->include('components/message.php')?>
        <div id="permissionTable"></div>
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
            caption: `<?=translate('permission.name')?>`,
            visible: true
        },
        {
            dataField: 'description',
            caption: `<?=translate('permission.description')?>`,
            visible: true
        },

        //   { dataField: 'deleted_by', caption: `<?=translate('permission.deleted_by')?>`, visible: false },
        //   { dataField: 'created_by', caption: `<?=translate('permission.created_by')?>`, visible: false },
        //   { dataField: 'updated_by', caption: `<?=translate('permission.updated_by')?>`, visible: false },
        //   { dataField: 'isdeleted', caption: `<?=translate('permission.isdeleted')?>`, visible: false },
        //   { dataField: 'created_at', caption: `<?=translate('permission.created_at')?>`, visible: false },
        //   { dataField: 'updated_at', caption: `<?=translate('permission.updated_at')?>`, visible: false },
        //   { dataField: 'deleted_at', caption: `<?=translate('permission.deleted_at')?>`, visible: false },
    ];
    showTable({
        dataGrid: 'permissionTable',
        columnNames: columns,
        url: '/admin/permission'
    })
</script>
<?=$this->endSection()?>