function showDeleteModal(id) {
    const deleteForm =  $('#delete-frm');
    deleteForm.prop('action', window.location.href+'/'+id);
    $('#custimDeleteModal').modal('show');
}