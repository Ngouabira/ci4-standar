$("#tlogdoc").change(function(e) {
    for (file of e.target.files) {
        $("#logo").attr('src', URL.createObjectURL(file))
    }
})
