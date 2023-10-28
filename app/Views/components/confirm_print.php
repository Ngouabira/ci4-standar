<div class="modal fade" id="confirmPrintModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?=lang('base.App_print', [], session()->get('lang'))?></h4>
                <button type="button" style="background: none; border: none; font-size: 2.3em; color:red;" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <h3> <?=lang('base.App_confirm_print_message', [], session()->get('lang'))?></h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?=lang('base.App_cancel', [], session()->get('lang'))?></button>
                <button class="btn btn-success" type="button" id="btnConfirm" data-dismiss="modal"><?=lang('base.App_yes', [], session()->get('lang'))?></button>
            </div>
        </div>
    </div>
</div>

<script>
   $('#btnConfirm').click(function(event) {
        event.preventDefault(); // Prevent the default button click behavior
        $('#confirmPrintModal').modal('hide');
        var form = $('#data-form');
        form.submit(); // Submit the form
    });
</script>