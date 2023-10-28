let link = window.location.href;
var currentURL = link.replace(/\/new(#|$)/, "");
let method = "add";
let itemkey = 0;
let globalModalId;
let globalkey;

$("#btn-modal").click(function () {
  method = "add";
  clearField(globalkey);
});

$("#btn-close").click(function () {
  method = "add";
  clearField(globalkey);
});

window.onbeforeunload = function (e) {
  localStorage.clear();
};

//Edit modal
function showEditmodal(id, item) {
  itemkey = id;
  const key = item.id;
  method = "edit";
  const modalId = `#${globalModalId}`;
  const modalAction = `#${key}-action`;
  $(modalId).modal("show");
  $(modalAction).empty();
  const data = JSON.parse(localStorage.getItem(key));
  data.forEach((val) => {
    if (val.position === itemkey) {
      $.each(val, (k, value) => {
        if ($(`#${k}`)[0]?.tagName.toLowerCase() === "select") {
          if (value.indexOf("|") !== -1) {
            result = value.split("|", 2);
            $(`#${k}`).val(result[0]);
            const option = document.createElement("option");
            option.value = result[0];
            option.selected = true;
            let part2 = result[1] ? "|" + result[1] : "";
            option.innerHTML = `${result[0]}${part2}`;
            let selectedIndex = $(`#${k}`)[0].selectedIndex;
            $(`#${k}`)[0].remove(selectedIndex);
            $(`#${k}`)[0].appendChild(option);
          }
        } else {
          $(`#${k}`).val(value);
        }
      });
    }
  });
}

//Clear field
function clearField(key) {
  const data = JSON.parse(localStorage.getItem(key));
  if (data) {
    data.forEach((val) => {
      $.each(val, (k, value) => {
        $(`#${k}`).val("");
      });
    });
  }
}

//Add row to the table
function tableAddRow(key, columnLenght) {
  let tableContentId = $(`#table-content-${key}`);
  tableContentId.empty();
  const data = JSON.parse(localStorage.getItem(key));
  data.forEach((val) => {
    let row = "";
    let countV = Object.keys(val).length - 1;
    let values = Object.values(val);

    for (let i = 0; i < columnLenght; i++) {
      if (i === 0) {
        row += "<tr><td>" + values[i] + "</td>";
      } else if (i === columnLenght - 1) {
        row +=
          "<td>" +
          values[i] +
          "</td><td class='d-flex justify-content-between'><a href='#' id='" +
          key +
          "' onclick='deleteData(" +
          values[countV] +
          ", this, " +
          columnLenght +
          ")' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a><a href='#'  id='" +
          key +
          "'  onclick='showEditmodal(" +
          values[countV] +
          ", this)'  class='btn btn-sm btn-primary'><i class='fas fa-pen'></i></a></td><tr>";
      } else {
        row += "<td>" + values[i] + "</td>";
      }
    }
    tableContentId.append(row);
  });
}

// Add data to the localstorage
function addData(key, formId) {
  let data = [];

  if (localStorage.getItem(key)) {
    data = JSON.parse(localStorage.getItem(key));
  }

  let values = $(formId)
    .serializeArray()
    .reduce(function (obj, item) {
      if ($(`#${item.name}`)[0]?.tagName.toLowerCase() === "select") {
        let selectedIndex = $(`#${item.name}`)[0].selectedIndex;
        let selectedOption = $(`#${item.name}`)[0].options[selectedIndex];
        if (selectedOption) {
          obj[item.name] = selectedOption.text;
        } else {
          obj[item.name] = item.value;
        }
      } else {
        obj[item.name] = item.value;
      }
      return obj;
    }, {});

  globalkey = key;
  globalModalId = "modal-" + key;
  values.position = data.length + 1;
  data.push(values);
  localStorage.setItem(key, JSON.stringify(data));
  $(formId)[0].reset();
}

//Update data to the localstorage
function updateData(key, formId) {
  const values = $(formId)
    .serializeArray()
    .reduce(function (obj, item) {
      if ($(`#${item.name}`)[0]?.tagName.toLowerCase() === "select") {
        let selectedIndex = $(`#${item.name}`)[0].selectedIndex;
        let selectedOption = $(`#${item.name}`)[0].options[selectedIndex];
        if (selectedOption) {
          obj[item.name] = selectedOption.text;
        } else {
          obj[item.name] = item.value;
        }
      } else {
        obj[item.name] = item.value;
      }
      return obj;
    }, {});

  const data = JSON.parse(localStorage.getItem(key));

  data.forEach((val, index) => {
    if (val.position === parseInt(itemkey)) {
      $.each(val, (k, v) => {
        val[k] = values[k];
        val.position = itemkey;
      });
    }
  });
  localStorage.setItem(key, JSON.stringify(data));

  $(`#${globalModalId}`).modal("hide");
}

// Add or update dayta
function saveData(key, formId, limit) {
  if (method == "add") {
    addData(key, formId);
  } else {
    updateData(key, formId);
  }
  clearField(key);
  tableAddRow(key, limit);
  console.log(method);
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
      donnes.push(val);
    }
  });
  localStorage.setItem(key, JSON.stringify(donnes));
  tableAddRow(key, limit);
}

function formatLocalStorageData(data) {
  let result = [];

  if (data != null) {
    data.forEach((val) => {
      let tab = {};
      $.each(val, (k, value) => {
        if ($(`#${k}`)[0]?.tagName.toLowerCase() === "select") {
          if (value.indexOf("|") !== -1) {
            array = value.split("|", 2);
            tab[k] = array[0];
          }
        } else {
          tab[k] = value;
        }
      });
      result.push(tab);
    });
  }

  return result;
}

// Form submit
let tabsContent = $("#tabsContent");

tabsContent.on("submit", function (e) {
  e.preventDefault();

  $("#form-btn").attr("disabled", true);
  const values = tabsContent.serializeArray().reduce(function (obj, item) {
    obj[item.name] = item.value;
    return obj;
  }, {});
  values[globalkey] = formatLocalStorageData(
    JSON.parse(localStorage.getItem(globalkey))
  );
  $.ajax({
    url: `${currentURL}`,
    method: "POST",
    data: values,
    success: function (response) {
      console.table(response);
      $("#tabsContent")[0].reset();
      localStorage.removeItem(globalkey);
      Swal.fire({
        icon: response.type,
        position: "top-end",
        title: response.message,
      }).then((result) => {
        window.location = `${currentURL}`;
      });
      $("#form-btn").attr("disabled", false);
    },
    error: function (xhr, status, error) {
      console.log(error);
      $("#form-btn").attr("disabled", false);
    },
  });
});
