/**
 *
 * @param id
 */
function showDeleteModal(id) {
    const deleteForm =  $('#delete-frm');
    deleteForm.prop('action', window.location.href+'/'+id);
    $('#custimDeleteModal').modal('show');
}


/**
 *
 * @param route
 * @param modalId
 */
function showModal(route, modalId){
    $(`#${modalId}`).modal('show');
    $(`#${modalId}-content`).load(route)
}