
/**
 *
 * @param {string} idName  le meme name que celui mi au niveau du components (x-custom-select)
 * @param {*} data
 * @param  columnList
 * @param {*} idModal  le meme method que celui mi au niveau du components (x-custom-select)
 */
function selectPersoModal(idName, data, columnList, idModal) {
    let res = JSON.parse(data);
    let selectp = $(`#${idName}`);
    selectp.html('');
    selectp.append(`<option value='${res[columnList[0]]}' selected='selected'> ${res[columnList[1]]}  ${res[columnList[2]] !== undefined ?' | '+res[columnList[2]]: ''}</option>`);
    $(`#${idName}_val`).val(res[columnList[0]]).trigger('change');
    $(`#${idModal}`).modal('hide');
}
function selectPersoModal2(data, idInput, idModal) {
    $(`#${idInput}`).val(parseInt(data)).trigger('change');
    $(`#${idModal}`).modal('hide');
}
function selectPersoModal3(id, descr, idInput, idModal,idDescInput) {
    $(`#${idInput}`).val(parseInt(id)).trigger('change');
    $(`#${idModal}`).modal('hide');
}
function selectPersoModalP(id, cfcodice, cfdescr1, idModal) {
    $(`#pnsotcon_val`).empty();
    $(`#pnsotcon_val`).append(`<option value='${id}' selected='selected'>${cfcodice} | ${cfdescr1}</option>`);
    $(`#${idModal}`).modal('hide');
}

function showModel(id) {
    const frmDelete = document.getElementById("delete-frm");
    frmDelete.action = id;
    const confirmationModal = document.getElementById("deleteConfirmationModel");
    confirmationModal.style.display = 'block';
    confirmationModal.classList.remove('fade');
    confirmationModal.classList.add('show');
}
function showEditModal(id, idModal) {
    const frmDelete = document.getElementById("edit-confirm-frm");
    frmDelete.href = id;
    const confirmationModal = document.getElementById('editConfirmationModel');
    confirmationModal.style.display = 'block';
    confirmationModal.classList.remove('fade');
    confirmationModal.classList.add('show');
}

function dismissModel() {
    const confirmationModal = document.getElementById("deleteConfirmationModel");
    confirmationModal.style.display = 'none';
    confirmationModal.classList.remove('show');
    confirmationModal.classList.add('fade');
}
function dismissEditModal() {
    const confirmationModal = document.getElementById("editConfirmationModel");
    confirmationModal.style.display = 'none';
    confirmationModal.classList.remove('show');
    confirmationModal.classList.add('fade');
}

/**
 *
 * @param idcompany
 * @param modalId
 */
function openModal(idcompany, modalId){
    $(`#${modalId}`).modal('show');
    $(`#${modalId}-content`).load(idcompany)
}

function getPrint(selector)
{
    let w = window.open();
    w.document.write($(selector).html());
    w.print();
    return false;
}

/**
 *
 * @param {string} key
 * @param {string} formId
 * @param {string} action
 * @param {number} limit
 */
function save(key, formId,action, limit = 5){
    if(action === 'add'){
        add(key,formId,limit);
    }else{
        update(key,formId,limit);
    }
}

/**
 *
 * @param {string} key
 * @param {string} formId
 * @param {number} limit
 */
function update(key,formId, limit){
    const values = $(formId).serializeArray().reduce(function(obj, item) {
        obj[item.name] = (item.name === 'id') ?parseInt(item.value):item.value;
        return obj;
    }, {});

    const  data = JSON.parse(localStorage.getItem(key));
    data.forEach((val, index)=>{
        if (val.id === values.id){
            $.each(val, (k,v)=>{
                val[k] = values[k];
            });
        }
    });
    localStorage.setItem(key, JSON.stringify(data));
    addRows(key,`#table-content-${key}`, limit)
    const modalId = `#add-${key}`;
    $(modalId).modal('hide');
}

function updateD(key,formId, limit){
    const values = $(formId).serializeArray().reduce(function(obj, item) {
        obj[item.name] = (item.name === 'position') ?parseInt(item.value):item.value;
        return obj;
    }, {});
    let donnees = {
        pnsotcon: values.pnsotcon,
        descode: values.descode,
        pncodfor: values.pncodfor ?? '',
        pncodcli: values.pncodcli ?? '',
        pncodiva: values.pncodiva,
        pnimponi: values.pnimponi,
        pnimpdar: values.pnimpdar??'',
        pnimpave: values.pnimpave ?? '',
        pndessup: values.pndessup,
        pnconpar: values.pnconpar,
        pncencos: values.pncencos,
        pnimpval: values.pnimpval,
        pnimpovl: values.pnimpovl,
        id: values.position,

    };
    let donneesV = {
        pnsotcon: values.pnsotconV,
        pncodfor: values.pncodforV ?? '',
        pncodcli: values.pncodcliV ?? '',
        pncodiva: values.pncodiva ?? '',
        pnimponi: values.pnimponi ?? '',
        pnimpdar: values.pnimpdar??'',
        pnimpave: values.pnimpave ?? '',
        pndessup: values.pndessup?? '',
        pnconpar: values.pnconpar ?? '',
        pncencos: values.pncencos ?? '',
        pnimpval: values.pnimpval ?? '',
        pnimpovl: values.pnimpovl ?? '',
        id: values.position,

    };
    const  data = JSON.parse(localStorage.getItem(key));
    const  datav = JSON.parse(localStorage.getItem(`${key}-v`));
    let newTab = [];
    let newTabV = [];
    data.forEach((v) => {
        if(v.position !== values.position)
        {
            newTab.push(v);
        }else{
            console.log('V : ', v)
            v.pnimpdar = values.pnimpdar ?? '';
            v.pnimpave = values.pnimpave ?? '';
            newTab.push(v);
        }
    });
    datav.forEach((v) => {
        if(v.position !== values.position)
        {
            newTabV.push(v);
        }else{
            v.pnimpdar = values.pnimpdar ?? '';
            v.pnimpave = values.pnimpave ?? '';
            newTabV.push(v);
        }
    });
    console.log('new tab : ', newTab)
    console.log('new tab v : ', newTabV)

    localStorage.setItem(key, JSON.stringify(newTab));
    localStorage.setItem(`${key}-v`, JSON.stringify(newTabV));
    localStorage.setItem(`${key}-t`, JSON.stringify(newTabV));
    addRows(key,'#table-content-destins', limit)
    const modalId = `#edit-${key}`;
    $(modalId).modal('hide');
}

/**
 *
 * @param {string} key
 * @param {string} formId
 * @param {number} limit
 */
function add(key,formId, limit){

    let donnees=[];
    let donneesv=[];
    let donneest=[];
    if(localStorage.getItem(key)){
        donnees = JSON.parse(localStorage.getItem(key))
        donneesv = JSON.parse(localStorage.getItem(`${key}-v`))
        donneest = JSON.parse(localStorage.getItem(`${key}-t`))
    }
    const values = $(formId).serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    let data = values;
    let datav = values;
    if(formId === '#dprinots-form'){
        data = {
            pnsotcon: values.pnsotcon,
            descode: values.descode,
            pncodfor: values.pncodfor ?? '',
            pncodcli: values.pncodcli ?? '',
            pncodiva: values.pncodiva,
            pnimponi: values.pnimponi,
            pnimpdar: values.pnimpdar??'',
            pnimpave: values.pnimpave ?? '',
            pndessup: values.pndessup,
            pnconpar: values.pnconpar,
            pncencos: values.pncencos,
            pnimpval: values.pnimpval,
            pnimpovl: values.pnimpovl

        };
        datat = {
            pnsotcon: values.pnsotcon,
            descode: values.descode,
            pncodfor: values.pncodfor ?? '',
            pncodcli: values.pncodcli ?? '',
            pncodiva: values.pncodiva,
            pnimponi: values.pnimponi,
            pnimpdar: values.pnimpdar??'',
            pnimpave: values.pnimpave ?? '',
            pndessup: values.pndessup,
            pnconpar: values.pnconpar,
            pncencos: values.pncencos,
            pnimpval: values.pnimpval,
            pnimpovl: values.pnimpovl,
            pnsotconv: values.pnsotconV,
            pncodforv: values.pncodforV ?? '',
            pncodcliv: values.pncodcliV ?? '',

        };
        datav = {
            pnsotcon: values.pnsotconV,
            pncodfor: values.pncodforV ?? '',
            pncodcli: values.pncodcliV ?? '',
            pncodiva: values.pncodiva ?? '',
            pnimponi: values.pnimponi ?? '',
            pnimpdar: values.pnimpdar??'',
            pnimpave: values.pnimpave ?? '',
            pndessup: values.pndessup?? '',
            pnconpar: values.pnconpar ?? '',
            pncencos: values.pncencos ?? '',
            pnimpval: values.pnimpval ?? '',
            pnimpovl: values.pnimpovl ?? ''

        };

        if(data.pntiprec === 'C' && data.pncodcli === ''){
            $('#pncodcli').addClass('text-danger');
            return;
        }
        if(data.pntiprec === 'F' && data.pncodfor === ''){
            $('#pncodfor').addClass('text-danger');
            return;
        }
        if(data.pnimpdar === '' && data.pnimpave ===''){
            $('#pnimpave').addClass('border border-danger');
            $('#pnimpdar').addClass('border border-danger');
            return;
        }else{
            $('#pnimpave').removeClass('border border-danger');
            $('#pnimpdar').removeClass('border border-danger');
        }
        const totalDare = localStorage.getItem('total_dare') ?? 0;
        if(data.pnimpdar !== ''){
            localStorage.setItem('total_dare', parseInt(totalDare,10)+ parseInt(data.pnimpdar, 10));
        }
        const totalAvere = localStorage.getItem('total_avere') ?? 0;
        if( data.pnimpave !==''){
            localStorage.setItem('total_avere', parseInt(totalAvere,10)+ parseInt(data.pnimpave, 10));
        }

    }

    data.position = donnees.length + 1;
    datav.position = donnees.length + 1;
    datat.position = donnees.length + 1;
    donnees.push(data)
    donneesv.push(datav)
    donneest.push(datat)
    localStorage.setItem(key, JSON.stringify(donnees));
    localStorage.setItem(`${key}-v`, JSON.stringify(donneesv));
    localStorage.setItem(`${key}-t`, JSON.stringify(donneest));
    let indexD = localStorage.getItem('indice_sotcons');
    localStorage.setItem('indice_sotcons', parseInt(indexD, 10)+1);
    if(formId === '#dprinots-form'){
        addRows(key,formId, limit)
    }else{
        addRows2(key,formId, limit)
    }
    $(formId)[0].reset();
    $(`#pnsotcon_val`).empty();
    $("#pncodcli option:selected").text('');
    $("#pncodfor option:selected").text('');
    $('#pncodcli_val').val('');
    $('#pncodfor_val').val('');

    const scontos = JSON.parse(localStorage.getItem('scontos')) ?? null;
    let indice = localStorage.getItem('indice_sotcons') ?? 0;
    if (scontos !== null && scontos[indice] !== undefined) {
        localStorage.setItem('indice_sotcons', indice);
        $(`#pnsotcon_val`).append(`<option value='${scontos[indice].tcaupa.id}' selected='selected'>${scontos[indice].tcaupa.cfcodice} | ${scontos[indice].tcaupa.cfdescr1}</option>`);
        if (scontos[indice].tda === 'A') {
            $("#pnimpave").addClass('propose');
            $("#pnimpdar").removeClass('propose');
        } else {
            $("#pnimpdar").addClass('propose');
            $("#pnimpave").removeClass('propose');
        }
    }
    checkFornitorOrClient($("#pnsotcon_val").val());
    setDescriptionSupplementaire();
    setCentroDiCosto();
    // $(`#add-${key}`).modal('hide');
}
/**
 *
 * @param {string} key
 * @param {string} tableBodyId
 * @param columnLenght
 */
function addRows2(key, tableBodyId, columnLenght){
    let tableContentId = $('#table-content-destins');
    tableContentId.empty();
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val)=>{
        let row = '';
        let countV = Object.keys(val).length - 1;
        let values = Object.values(val);
        for (let i=0; i<columnLenght; i++){
            if(i === 0){
                row += '<tr><td>'+values[i]+'</td>';
            }
            else if(i === columnLenght){
                row += '<td>'+values[i+1]+"</td><td class='d-flex justify-content-between'><a href='#' id='"+key+"' onclick='deleteItem("+values[countV]+", this, "+columnLenght+")' class='btn btn-sm btn-danger'><i class='bx bx-trash'></i></a></td><tr>"; //<a href='#'  id='"+key+"'  onclick='showEditmodal("+values[countV]+", this)'  class='btn btn-sm btn-primary'><i class='bx bx-edit'></i></a>
            }
            else{
                row += '<td>'+values[i]+'</td>';
            }

        }
        tableContentId.append(row);
    });
    if(key === 'dprinots'){
        calculateStatMaster(key);
    }
}

/**
 *
 * @param {string} key
 * @param {string} tableBodyId
 * @param columnLenght
 */
function addRows(key, tableBodyId, columnLenght){
    let tableContentId = $('#table-content-destins');
    tableContentId.empty();
    const data = JSON.parse(localStorage.getItem(`${key}-v`));
    data.forEach((val)=>{
        let row = '';
        let values = Object.values(val);
        for (let i=0; i<columnLenght; i++){
            if(i === 0){
                row += '<tr><td>'+values[i]+'</td>';
            }
            else if( i === columnLenght-1){
                row +='<td>'+values[i]+"</td></td><td class='d-flex justify-content-between'><a href='#' id='"+key+"'onclick='deleteItem2("+values[i+1]+", "+columnLenght+")' class='btn btn-sm btn-danger'><i class='bx bx-trash'></i></a><a href='#' id='"+key+"' onclick='showEditmodal2("+values[i+1]+")' class='btn btn-sm btn-primary'><i class='bx bx-edit'></i></a></td><tr>";
            }
            else{
                row += '<td>'+values[i]+'</td>';
            }

        }
        tableContentId.append(row);
    });
    if(key === 'dprinots'){
        calculateStatMaster(key);
    }
}
async function getCodice(id){

    const reponse = await $.ajax({
        url: "/masters-infos/"+id,
        type:"GET",
        success:function(response){
            return JSON.parse(response).message;
        }
    })
    return reponse.message;
}
/**
 *
 * @param {string} key
 */
function calculateStatMaster(key) {
    let total_dare = document.getElementById('total_dare');
    let total_avere = document.getElementById('total_avere');
    let total_imponibile = document.getElementById('total_imponibile');
    let total_differenza_dare_avere = document.getElementById('total_differenza_dare_avere');
    let pnimpave = 0;
    let pnimpdar = 0;
    let pnimponi = 0;
    let  pdare = 0;
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val)=>{
        pnimpdar+= (val.pnimpdar !== "")?parseInt(val.pnimpdar, 10):0;
        pnimpave+= (val.pnimpave !== "")?parseInt(val.pnimpave, 10):0;
        pnimponi+= (val.pnimponi !== "")?parseInt(val.pnimponi, 10):0;
    });

    pdare = pnimpdar - pnimpave;
    total_dare.value = pnimpdar;
    total_avere.value = pnimpave;
    total_imponibile.value = pnimponi;
    total_differenza_dare_avere.value = pdare;

}

function showEditmodal2(id) {
    $('#edit-dprinots').modal('show');
    $('#edit-dprinots-content').load(`/dprinots-modif/${id}`);
}

function showEditmodalOld(id, item, limit) {
    const btnEdit = `<button type="button" onclick="updateClientFornitDestin('destins', '#destins-form',${id}, ${limit})" class="btn btn-primary">Editer</button>`;
    const key = item.id;
    const modalId = `#add-${key}`;
    const modalAction = `#${key}-action`;
    $(modalId).modal('show');
    $(modalAction).empty();
    $(modalAction).append(btnEdit);
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val)=>{
        if (val.position === id){
            $.each(val, (k,value) =>{
                $(`#${k}`).val(value);
            });
        }
    });
}
function updateClientFornitDestin (key, formId, idValue, limit)
{
    const values = $(formId).serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});

    const  data = JSON.parse(localStorage.getItem(key));
    data.forEach((val, index)=>{
        if (val.position === parseInt(idValue,10)){
            $.each(val, (k,v)=>{
                val[k] = values[k];
            });
        }
    });
    localStorage.setItem(key, JSON.stringify(data));
    addRowsolder(key,`#table-content-${key}`, limit)
    const modalId = `#add-${key}`;
    $(modalId).modal('hide');

}

function showEditmodal(id, item) {
    const btnEdit = '<input type="hidden" name="id" id="id"/><button type="button" onclick="save(\'destins\', \'#destins-form\',\'update\')" class="btn btn-primary">Editer</button>';
    const key = item.id;
    const modalId = `#add-${key}`;
    const modalAction = `#${key}-action`;
    $(modalId).modal('show');
    $(modalAction).empty();
    $(modalAction).append(btnEdit);
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val)=>{
        if (val.position === id){
            $.each(val, (k,value) =>{
                $(`#${k}`).val(value);
            });
        }
    });
}

/**
 *
 * @param id
 * @param item
 * @param  limit
 */
function deleteItem(id, item, limit, idPage=null){
    const key = item.id;
    let donnes = [];
    const tableBodyId = `#table-content-${key}`;
    const data = JSON.parse(localStorage.getItem(key));
    data.forEach((val, index)=>{
        if (val.position !== id){
            donnes.push(val)
        }else{
            if(val.pnimpdar !==''){
                const totalDare = parseInt(localStorage.getItem('total_dare'),10);
                localStorage.setItem('total_dare', totalDare - parseInt(val.pnimpdar));
            }
            if(val.pnimpave !==''){
                const totalAvere = parseInt(localStorage.getItem('total_avere'),10);
                localStorage.setItem('total_avere', totalAvere - parseInt(val.pnimpave));
            }
        }
    });
    localStorage.setItem(key, JSON.stringify(donnes));
    if(idPage !== null){
        addRows(key,tableBodyId, parseInt(limit))
    }else{
        addRows2(key,tableBodyId, parseInt(limit))
    }
}

function deleteItem2(id, limit, idPage=null){
    const key = 'dprinots';
    let donnes = [];
    let donnesv = [];
    const tableBodyId = `#table-content-destins`;
    const data = JSON.parse(localStorage.getItem('dprinots'));
    const datav = JSON.parse(localStorage.getItem('dprinots-v'));
    data.forEach((val, index)=>{
        if (val.position !== id){
            donnes.push(val)
        }else{
            if(val.pnimpdar !==''){
                const totalDare = parseInt(localStorage.getItem('total_dare'),10);
                localStorage.setItem('total_dare', totalDare - parseInt(val.pnimpdar));
            }
            if(val.pnimpave !==''){
                const totalAvere = parseInt(localStorage.getItem('total_avere'),10);
                localStorage.setItem('total_avere', totalAvere - parseInt(val.pnimpave));
            }
        }
    });
    datav.forEach((val, index)=>{
        if (val.position !== id){
            donnesv.push(val)
        }
    });
    localStorage.setItem(key, JSON.stringify(donnes));
    localStorage.setItem('dprinots-v', JSON.stringify(donnesv));
    if(idPage !== null){
        addRows2(key,tableBodyId, parseInt(limit))
    }else{
        addRows(key,tableBodyId, parseInt(limit))
    }
}

/**
 *
 * @param {string} idTable
 * @param {string} search
 * @param {string} lengthMenu
 * @param {string} emptyTable
 * @param {string} first
 * @param {string} previous
 * @param {string} next
 * @param {string} last
 */
function showJdatatable(idTable, search, lengthMenu,emptyTable,first, previous, next, last,order=1){
    const tables = $(idTable).DataTable({
        "aLengthMenu": [[5,10,25,50,100,-1], [5,10,25,50,100,"All"]],
        info: false,
        order: [[order, 'desc']],
        autoWidth: false,
        language: {
            search:         search,
            lengthMenu:    lengthMenu,
            emptyTable:     emptyTable,
            paginate: {
                first:      first,
                previous:   previous,
                next:       next,
                last:       last
            },
        },
        buttons: [
            { extend: 'excel',className: 'exportExcel', exportOptions: { modifier: { page: 'all'} } },
            {  extend: 'print', className: 'printFile' },
            { extend: 'pdf',className: 'pdfFile', exportOptions: { modifier: { page: 'all' } } },
        ]
    });
    // tables.buttons().container().appendTo(`${idTable}_wrapper .col-md-6:eq(0)`);
}

/**
 *
 * @param {Object} el
 */
function abacoiban(){
    const bastaiso = document.getElementById("bastaiso").value;
    const bacifcon = document.getElementById("bacifcon").value;
    const bacodcin = document.getElementById("bacodcin").value;
    const bacodabi = document.getElementById("bacodabi").value;
    const bacodcab = document.getElementById("bacodcab").value;
    const bacodcco = document.getElementById("bacodcco").value;
    const input = document.getElementById("bacoiban");
    input.value = bastaiso.substring(0,2) + bacifcon + bacodcin + bacodabi + bacodcab + bacodcco;
    let chaine = '';
    if (input.value.length > 0) {
        let data1 = input.value.match(/.{1,4}/g);
        for(const color of data1){
            chaine+= color+' ';
        }
    }
    input.value = chaine;
}


const input = document.getElementById("bacoiban");
function bbaswift() {
    if (input.value.length > 0) {
        if (input.value.length % 4 === 0) {
            input.value += '    ';
        }
    }
}

function abaswift()
{
    const bacifcon = document.getElementById("bacifcon");
    const bacodcin = document.getElementById("bacodcin");
    const bacodabi = document.getElementById("bacodabi");
    const bacodcab = document.getElementById("bacodcab");
    const bacodcco = document.getElementById("bacodcco");
    const input = document.getElementById("bacoiban").value;
    let test = input.replace(/\s/g,'');
    let test1 = test.replace(/\s/g,'');
    let test2 = test1.replace(/\s/g,'');
    let test3 = test2.replace(/\s/g,'');
    if (input.length > 0 ){
        bacifcon.value = test3.substring(3,5);
        bacodcin.value = test3.substring(5,6);
        bacodabi.value = test3.substring(6,13);
        bacodcab.value = test3.substring(13,20);
        bacodcco.value = test3.substring(20,32);
    }
}


function acfcodice(e){
    const gruppo = document.getElementById("gruppo");
    const conto = document.getElementById("conto");
    const sottoconto = document.getElementById("sottoconto");
    if(e.value.length===7){
        gruppo.value = e.value.substring(0,2);
        conto.value = e.value.substring(2,4);
        sottoconto.value = e.value.substring(4,7);
    }
}

/**
 *
 * @param {Object} limitField
 * @param {number}  limitNum
 */
function limitText(limitField, limitNum)
{
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    }
}

function tcodice(e)
{
    const primo = document.getElementById("primo");
    const secondo = document.getElementById("secondo");
    const terzo = document.getElementById("terzo");
    if(e.value.length === 6){
        primo.value = e.value.substring(0,2);
        secondo.value = e.value.substring(2,4);
        terzo.value = e.value.substring(4,6);
    }
}



function addClientFornitDestin(key,formId, limit){
    let donnees=[];
    if(localStorage.getItem(key)){
        donnees = JSON.parse(localStorage.getItem(key))
    }
    const values = $(formId).serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    values.position = donnees.length + 1;
    donnees.push(values)
    localStorage.setItem(key, JSON.stringify(donnees));
    addRowsolder(key,formId, limit)
    $(formId)[0].reset();
}

function addRowsolder(key, tableBodyId, columnLenght){
    let tableContentId = $('#table-content-destins');
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
                row += '<td>'+values[i]+"</td><td class='d-flex justify-content-between'><a href='#' id='"+key+"' onclick='deleteItem("+values[countV]+", this, "+columnLenght+")' class='btn btn-sm btn-danger'><i class='bx bx-trash'></i></a><a href='#'  id='"+key+"'  onclick='showEditmodalOld("+values[countV]+", this, "+columnLenght+")'  class='btn btn-sm btn-primary'><i class='bx bx-edit'></i></a></td><tr>";
            }else{
                row += '<td>'+values[i]+'</td>';
            }

        }
        tableContentId.append(row);
    });
    if(key === 'dprinots'){
        calculateStatMaster(key);
    }
}
