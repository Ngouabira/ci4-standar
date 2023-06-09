$(".save-data").click(function(event) {
    event.preventDefault();
    let tcodice = $("#tcodice").val();
    //console.log(tcodice);
    $.ajax({
        url: "/centros_existe/"+tcodice
        , type: "GET"
        , success: function(response) {
            if(response.status === true){
                //alert(tcodice);
                alert('{{ __("message.exist") }}'+' '+tcodice);
            }
        }
    });
});
