<div class="modal fade" id="<?= $data['modalId'] ?>">
    <div class="modal-dialog <?= $data['size'] ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $data['title'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="<?= $data['modalId'] ?>-content">
                <div id="tableSelect<?= $data['field'] ?>">

                </div>
                <div id="blocSelect<?= $data['field'] ?>">

                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>