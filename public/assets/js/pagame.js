//Create pagame js

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
/* window.onload = function (){
    const tpagselect = document.getElementById("tpagsco");
    const tpaginput = document.getElementById("tpagspg");

    tpaginput.addEventListener("keyup", (e) => {
        const value = e.currentTarget.value;
        if(value === ""){
            tpagselect.disabled = true;
        } else {
            tpagselect.disabled = false
        }
    });
}*/


