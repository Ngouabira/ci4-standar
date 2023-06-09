$(document).ready(function () {
    $("#cfprivat").attr('disabled','disabled');
    $("#tabparti2" ).attr( "disabled", true );
});
function getValue(sel){
    if(sel.value === 'S'){
        $("#cfprivat").prop( "disabled", false );
        $("#tabparti2").prop( "disabled", false );
    }else{
        $("#cfprivat").attr('disabled','disabled');
        $("#tabparti2" ).prop( "disabled", true );
    }
}
function openMaps() {
    const v1 = $('#cfindiri').val();
    const v2 = $('#cflocali').val();
    if(v1 !== '' && v2 !==''){
        let url = 'https://www.google.com/maps/place/'+v1+'/'+v2;
        window.open(url)
    }
}

$("#cfcodfis").change(function(){
    let cfstaiso = $("#cfstaiso option:selected").text();
    let key = cfstaiso.substring(0,3);
    const value = $('#cfcodfis').val();
    if(key.trim() == 'IT'){
        $('#cfpariva').attr('type', 'number');
        $('#cfpariva').attr('min', '11111111111');
        $('#cfpariva').attr('max', '999999999999');
        $('#cfpariva').attr('maxlenght', '11');
        if(value.length == 11 ||value.length == 16 ){

            return true;
        }else{
            $('#cfcodfis').val('');
        }
        console.log(cfstaiso, cfstaiso.substring(0,3));
    }

});
$("#cfmastro").change(function(){
    const id = $('#cfmastro').val();
    let url = '{{ route("clients.cfmastro", ":id") }}';
    url = url.replace(':id', id)
    $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {
            if(response.status === null){
                $('#cfmastro').val('');
            }
        }
    })
});
let tabsContent =  $('#tabsContent');

selectElement.addEventListener('change', (event) => {
    const value = event.target.value;
    if(value === 'S'){
        cfprivat.removeAttribute('disabled');
        parti2.removeAttribute('disabled');
    }else{
        cfprivat.disabled =true;
        parti2.disabled =true;
    }
});
