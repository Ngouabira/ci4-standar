<div class="modal fade" id="custimDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="modal-content" id="delete-frm" method="POST" action="">
            <?=csrf_field()?>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?=lang('message.delete')?></h4>
                <button type="button" style="background: none; border: none; font-size: 2.3em; color:red;" class="close" data-bs-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_method" value="DELETE">
                <div class="form-group col-md-12">
                    <h3> <?=lang('message.delete_message')?></h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?=lang('button.cancel')?></button>
                <button class="btn btn-success" type="submit" style="font-size: 1.3em;"><?=lang('button.yes')?></button>
            </div>
        </form>
    </div>
</div>