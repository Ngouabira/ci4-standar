function setValue(el) {
    $('#charger').val(el.value);
}
const tpagselect = document.getElementById("tpagsco");
function setSconto(el) {
    console.log(el.value);
    if(el.value > 0){
        tpagselect.disabled = false;
    }else{
        tpagselect.disabled = true;
    }
}
