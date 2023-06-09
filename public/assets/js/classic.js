let method = 'add';
let itemkey = 0;
let theModalId;
let thekey;

function addData(key, formId, limit) {
    let donnees = [];
    if (localStorage.getItem(key)) {
        donnees = JSON.parse(localStorage.getItem(key))
    }
    let values = $(formId).serializeArray().reduce(function (obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});

    thekey = key;
    theModalId = "modal-"+key;
    values.position = donnees.length + 1;
    donnees.push(values)
    localStorage.setItem(key, JSON.stringify(donnees));
    $(formId)[0].reset();
}

//
function addRowsolder(key, columnLenght) {
    let tableContentId = $(`#table-content-${key}`);
    tableContentId.empty();
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val) => {
        let row = '';
        let countV = Object.keys(val).length - 1;
        let values = Object.values(val);

        for (let i = 0; i < columnLenght; i++) {
            if (i === 0) {
                row += '<tr><td>' + values[i] + '</td>';
            } else if (i === columnLenght - 1) {
                row += '<td>' + values[i] +
                    "</td><td class='d-flex justify-content-between'><a href='#' id='" + key +
                    "' onclick='deleteData(" + values[countV] + ", this, " + columnLenght +
                    ")' class='btn btn-sm btn-danger'><i class='bx bx-trash'></i></a><a href='#'  id='" +
                    key + "'  onclick='showEditmodal(" + values[countV] +
                    ", this)'  class='btn btn-sm btn-primary'><i class='bx bx-edit'></i></a></td><tr>";
            } else {
                row += '<td>' + values[i] + '</td>';
            }

        }
        tableContentId.append(row);
    });
}



/**
 *
 * @param id
 * @param item
 * @param  limit
 */
function deleteData(id, item, limit) {
    const key = item.id;
    let donnes = [];
    const tableBodyId = `#table-content-${key}`;
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val, index) => {
        if (val.position !== id) {
            donnes.push(val)
        }
    });
    localStorage.setItem(key, JSON.stringify(donnes));
    addRowsolder(key, limit)

}


//Update modal
function showEditmodal(id, item, limit) {
    itemkey = id;
    const key = item.id;
    method = 'edit';
    const modalId = `#${theModalId}`;
    const modalAction = `#${key}-action`;
    $(modalId).modal('show');
    $(modalAction).empty();
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val) => {
        if (val.position === itemkey) {
            $.each(val, (k, value) => {
                $(`#${k}`).val(value);
            });
        }
    });
}

function updateData(key, formId, limit) {
    const values = $(formId).serializeArray().reduce(function (obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val, index) => {
        if (val.position === parseInt(itemkey)) {
            $.each(val, (k, v) => {
                val[k] = values[k];
                val.position = itemkey
            });
        }
    });
    localStorage.setItem(key, JSON.stringify(data));

    $(`#${theModalId}`).modal('hide');
}

function saveData(key, formId, limit) {

    if (method == 'add') {

        addData(key, formId, limit);
    } else {
        updateData(key, formId, limit);
    }
    clearField(key);
    addRowsolder(key, limit);
}

$('#btn-modal').click(function () {

    method = 'add';
})

$('#btn-close').click(function () {

    clearField(thekey);
})

window.onbeforeunload = function (e) {
    localStorage.clear();
};

function clearField(key){

    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val) => {
            $.each(val, (k, value) => {
                $(`#${k}`).val("");
            });
    });

}

let tabsContent = $('#tabsContent');

tabsContent.on('submit', function(e) {
    e.preventDefault();
    const values = tabsContent.serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    values[thekey] = JSON.parse(localStorage.getItem(thekey));

    $.ajax({
        url: `/${thekey}`,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "data": values

        },
        success: function(response) {
            $("#tabsContent")[0].reset();
            localStorage.removeItem(thekey);
            Swal.fire({
                icon: 'success',
                position: 'top-end',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                window.location = `/${thekey}`
            });
        },
        error: function(response) {
            console.log(response)
        }
    });
});
