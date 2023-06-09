//Update  pagame js

const tpagselect = document.getElementById("tpagsco");
$(document).ready(function() {
    if($('#tpagspg').val() > 0){
        tpagselect.disabled = false;
    }
})
function setValue(el) {
    console.log(el.value);
    $('#charger').val(el.value);
}

function setSconto(el) {
    console.log(el.value);
    if(el.value > 0){
        tpagselect.disabled = false;
    }else{
        tpagselect.disabled = true;
    }
}
/*const tpagselect = document.getElementById("tpagsco");
const tpaginput = document.getElementById("tpagspg");

tpaginput.addEventListener("keyup", (e) => {
    const value = e.currentTarget.value;
    if(value === ""){
        tpagselect.disabled = true;
    } else {
        tpagselect.disabled = false
    }
});*/
