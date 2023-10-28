function showCustomModal(data){
    $(`#${data.modalId}`).modal('show');
    $(`#blocSelect${data.field}`).load('/modal?data='+encodeURIComponent(JSON.stringify(data)))
}
/**
 *
 * @param id
 * @param url
 */
function showDeleteModal(id, url =window.location.href) {
    const deleteForm =  $('#delete-frm');
    deleteForm.prop('action', url+'/'+id);
    $('#idValue').val(id);
    $('#custimDeleteModal').modal('show');
}


/**
 *
 * @param modalId
 */
function showModal(modalId){
    $(`#${modalId}`).modal('show');
}

function selectItem(idName, data, modalId) {
    let selectp = $(`#${idName}`);
    selectp.html('');
    selectp.append(`<option value='${data[0]}' selected='selected'> ${data[1]}  ${data[2] !== undefined ?' | '+data[2]: ''}</option>`);
    $(`#${idName}_val`).val(data[0]).trigger('change');
    $(`#${modalId}`).modal('hide');
}

function selectItem2(idName, data, modalId) {

    if (data[3]) {
        $(`#${data[3]}`).val(parseInt(data[0])).trigger('change');
    } else {
        let selectp = $(`#${idName}`);
        selectp.html('');
        selectp.append(`<option value='${data[0]}' selected='selected'> ${data[1]}  ${data[2] !== undefined ?' | '+data[2]: ''}</option>`);
    }

    $(`#${idName}_val`).val(data[0]).trigger('change');
    $(`#${modalId}`).modal('hide'); 
    
}


function selectItem3(idName, data, modalId) {
let selectp = $(`#${idName}`);
selectp.html('');
selectp.append(`<option value='${data[0]}' selected='selected'> ${data[0]}  ${data[1] !== undefined ?' | '+data[1]: ''}</option>`);
$(`#${idName}_val`).val(data[0]).trigger('change');
$(`#${modalId}`).modal('hide'); 
    
}


function setFieldSelectedOption(elementId, codice, description) {
    let selectedIndex = $(`#${elementId}`)[0].selectedIndex;
    $(`#${elementId}`)[0].remove(selectedIndex);
    const option = document.createElement("option");
    option.value = codice;
    option.selected = true;
    option.innerHTML = codice != null && codice != "" ? `${codice} | ${description}` : "";
    $(`#${elementId}`)[0].appendChild(option);
    $(`#${elementId}_val`).val(codice);
  }

  function clearFieldSelectedOption(elementId){

    let selectedIndex = $(`#${elementId}`)[0]?.selectedIndex;
        $(`#${elementId}`)[0].remove(selectedIndex);
        $(`#${elementId}_val`).val("");
  }


  function formatDecimalWithPrecision(value, decimalPrecision) {
    if (isNaN(value) || value == "" || value == 0) {
      return 0;
    }
  
    const formattedValue = parseFloat(value).toFixed(decimalPrecision);
  
    return formattedValue;
  }