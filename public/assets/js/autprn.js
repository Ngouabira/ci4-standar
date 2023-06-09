
$("#ausegclf").change(function(){
    let tcodice = $("#tcodice").val();
    $.ajax({
        url: "/autprn_existe"+tcodice,
        method: 'GET',
        success: function (response) {
            if(response.status === true){
                $("#ausegclf").prop( "disabled", false );
            }
        }
    })
});

