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
tabsContent.on('submit',function(e){
    e.preventDefault();
    const values = tabsContent.serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    values.destins = JSON.parse(localStorage.getItem('destins'));

    $.ajax({
        url: "/clients",
        type:"POST",
        data:{
            "_token": "{{ csrf_token() }}",
            "data": values
        },
        success:function(response){
            $("#tabsContent")[0].reset();
            localStorage.removeItem('destins');
            Swal.fire({
                icon: 'success',
                position: 'top-end',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                window.location='/clients'
            });
        },
        error: function(response) {
            console.log(response)
        }
    });
});
