<div class="modal fade" id="custimDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="modal-content" id="delete-frm" method="POST" action="">
            <?=csrf_field()?>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?=translate('base.App_delete')?></h4>
                <button type="button" style="background: none; border: none; font-size: 2.3em; color:red;" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" id="idValue" >
                <div class="form-group col-md-12">
                    <h3> <?=translate('base.App_delete_message')?></h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?=translate('base.App_cancel')?></button>
                <button class="btn btn-success" type="submit" ><?=translate('base.App_yes')?></button>
            </div>
        </form>
    </div>
</div>