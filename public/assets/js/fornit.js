$(document).ready(function() {
    $("#cfprivat").attr('disabled', 'disabled');
    $("#btnpart2").attr("disabled", true);
});

function getValue(sel) {
    if (sel.value === 'S') {
        $("#cfprivat").prop("disabled", false);
        $("#btnpart2").prop("disabled", false);
    } else {
        $("#cfprivat").attr('disabled', 'disabled');
        $("#btnpart2").prop("disabled", true);
    }
}

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
function openMaps() {
    const v1 = $('#cfindiri').val();
    const v2 = $('#cflocali').val();
    if(v1 !== '' && v2 !==''){
        let url = 'https://www.google.com/maps/place/'+v1+'/'+v2;
        window.open(url)
    }
}
let tabsContent = $('#tabsContent');

tabsContent.on('submit', function(e) {
    e.preventDefault();
    const values = tabsContent.serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    values.destins = JSON.parse(localStorage.getItem('destins'));

    $.ajax({
        url: "/fornits",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "data": values

        },
        success: function(response) {
            $("#tabsContent")[0].reset();
            localStorage.removeItem('destins');
            Swal.fire({
                icon: 'success',
                position: 'top-end',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                window.location = '/fornits'
            });
        },
        error: function(response) {
            console.log(response)
        }
    });
});
