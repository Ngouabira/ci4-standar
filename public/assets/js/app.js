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
 * @param modalId
 */
function showModal(modalId){
    $(`#${modalId}`).modal('show');
}

/**
 *
 * @param route
 * @param modalId
 */
function showModal2(route, modalId){
    $(`#${modalId}`).modal('show');
    $(`#${modalId}-content`).load(route)
}

function selectItem(idName, data, modalId) {
    let selectp = $(`#${idName}`);
    selectp.html('');
    selectp.append(`<option value='${data[0]}' selected='selected'> ${data[1]}  ${data[2] !== undefined ?' | '+data[2]: ''}</option>`);
    $(`#${idName}_val`).val(data[0]).trigger('change');
    $(`#${modalId}`).modal('hide');
}