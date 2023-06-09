let method='add';
let itemkey = 0;
let thekey;

//Link table et form
function addCatric(key,formId, limit){
    let donnees=[];
    if(localStorage.getItem(key)){
        donnees = JSON.parse(localStorage.getItem(key))
    }
    const values = $(formId).serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    thekey = key;
    // console.log(values);
    values.position = donnees.length + 1;
    donnees.push(values)
    localStorage.setItem(key, JSON.stringify(donnees));
    addRowsolder(key, limit)
    //addRowsolder(key,formId, limit)
    $(formId)[0].reset();
}

function addRowsolder(key, columnLenght){
    // function addRowsolder(key, tableBodyId, columnLenght){
    let tableContentId = $('#table-content-catric');
    tableContentId.empty();
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val)=>{
        let row = '';
        let countV = Object.keys(val).length - 1;
        let values = Object.values(val);
        for (let i=0; i<columnLenght; i++){
            if(i === 0){
                row += '<tr><td>'+values[i] +'</td>';
            }else if(i === columnLenght - 1){
                row += '<td>'+values[i]+"</td><td class='d-flex justify-content-between'><a href='#' id='"+key+"' onclick='deleteItem("+values[countV]+", this, "+columnLenght+")' class='btn btn-sm btn-danger'><i class='bx bx-trash'></i></a><a href='#'  id='"+key+"'  onclick='showEditmodalOld("+values[countV]+", this)'  class='btn btn-sm btn-primary'><i class='bx bx-edit'></i></a></td><tr>";
            }else{
                row += '<td>'+values[i]+'</td>';
            }

        }
        tableContentId.append(row);
    });
}


//Delete modal
/**
 *
 * @param id
 * @param item
 * @param  limit
 */
//function deleteItem(id, item, limit, idPage=null){
function deleteItem(id, item, limit){
    const key = item.id;
    let donnes = [];
    const tableBodyId = `#table-content-${key}`;
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val, index)=>{
        if (val.position !== id){
            donnes.push(val)
        }
    });
    localStorage.setItem(key, JSON.stringify(donnes));
    addRowsolder(key, limit);
    /*if(idPage !== null){
        addRowsolder(key,tableBodyId, parseInt(limit));
    }else{
        addRowsolder(key,tableBodyId, parseInt(limit));
    }*/
}

//Update modal


function showEditmodalOld(id, item ) {
    //const btnEdit = `<button type="button" onclick="updateCatric('catrics', '#catricForm',${id}, ${limit})" class="btn btn-primary">Editer</button>`;
    itemkey=id;
    const key = item.id;
    method= 'edit';
    // const modalId = `#add-${key}`;
    const modalId = `#staticBackdrop`;
    const modalAction = `#${key}-action`;
    $(modalId).modal('show');
    $(modalAction).empty();
    // $(modalAction).append(btnEdit);
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val)=>{
        if (val.position === id){
            $.each(val, (k,value) =>{
                $(`#${k}`).val(value);
            });
        }
    });
}


function updateCatric (key, formId, limit)
{
    const values = $(formId).serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    const  data = JSON.parse(localStorage.getItem(key));
    data.forEach((val, index)=>{
        if (val.position === parseInt(itemkey,2)){
            $.each(val, (k,v)=>{
                val[k] = values[k];
                val.position = itemkey;
            });
        }
    });
    localStorage.setItem(key, JSON.stringify(data));
    addRowsolder(key, limit)
    // const modalId = `#add-${key}`;
    const modalId = `#staticBackdrop`;
    $(modalId).modal('hide');
}

//Test put post
function saveData(key, formId, limit) {
    if (method === 'add') {
        addCatric(key, formId, limit);
    } else {
        updateCatric(key, formId , limit);
    }
    clearField(key);
}
$('#btn-modal').click(function () {
    method='add';
})

$('#btn-close').click(function () {
    clearField(key);
})

function clearField(key){
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val) => {
        $.each(val, (k, value) => {
            $(`#${k}`).val("");
        });
    });
}

//Ajax post:
let tabsContent = $('#tabsContent');

tabsContent.on('submit', function(e) {
    e.preventDefault();
    const values = tabsContent.serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    values.catrics = JSON.parse(localStorage.getItem('catrics'));

    $.ajax({
        /*  url: '{{route('catrics.store')}}',
          method: 'post',*/
        url: "/catrics",
        type: "POST",
      /*  data: {
            "_token": "{{ csrf_token() }}",
            "data": values
        },*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "data": values

        },
        success: function(response) {
            console.log(response);
            $("#tabsContent")[0].reset();
            localStorage.removeItem('catrics');
            Swal.fire({
                icon: 'success',
                position: 'top-end',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                window.location = '/catrics'
            });
        },
        error: function(response) {
            console.log(response)
        }
    });
});
