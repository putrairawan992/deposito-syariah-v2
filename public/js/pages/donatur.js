$(document).ready(function () {
    ajaxCall(serverApi + "donatur", null, "GET", "loadDonatur");
});

function loadDonatur(data) {
    $('#modal-donatur').modal('hide');
    var elementId = "tabel-list-donatur";
    $("#spinnerloadinglistdonatur").hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No</th><th class="col-2">Nama</th>' +
        '<th class="col-2">Email</th><th class="col-2">Alamat</th><th class="col-2">Phone</th>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="text-center align-middle">' +
            '<button onclick="detailDonatur(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
            'data-toggle="modal" data-target="#modal-donatur" nowrap>' + data[i]["nama"] + '</button>';
        if (role == 99 || role == 1) {
            tr += '<button onclick="deleteDonatur(' + data[i]["id"] + ')" type="button"' +
                'class="btn-xs btn btn-danger w-100" nowrap>Hapus</button>';
        }
        tr += '</td>';
        if (data[i]["email"] == "" || data[i]["email"] == null) tr += '<td class="align-middle text-sm" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + data[i]["email"] + "</td>";
        if (data[i]["alamat"] == "" || data[i]["alamat"] == null) tr += '<td class="align-middle text-sm" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + data[i]["alamat"] + "</td>";
        if (data[i]["phone"] == "" || data[i]["phone"] == null) tr += '<td class="align-middle text-sm" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + data[i]["phone"] + "</td>";
        // tr += '<td class="align-middle text-sm" nowrap>' + data[i]["alamat"] + "</td>";
        // tr += '<td class="text-center align-middle text-sm" nowrap>' + data[i]["phone"] + "</td>";

        tr += "</tr>";
        t += tr;
    }

    buildDataTable(t, elementId, "List donatur", [0, 1, 2, 3, 4, 5], [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ]);

    if (role == 7) $('#buat-baru').hide()
}

function deleteDonatur(id) {
    swalTunggu()
    ajaxCall(serverApi + "donatur/" + id, null, 'DELETE', "reLoadDonatur");
}

function newDonatur() {
    inputPreviewDokumenDonatur()
    $('#btn-upload-donatur').prop('disabled', true)
    $('#filena-donatur').val(null)
    $('#file-donatur').val(null)
    $('#upload-donatur').fadeIn()
    $('#btn-save-donatur').fadeIn()
    $('#btn-update-donatur').hide()
    $('#nama').val("")
    $('#email').val("")
    $('#alamat').val("")
    $('#phone').val("")
}

function detailDonatur(id) {
    inputPreviewDokumenDonatur()
    $('#filena-donatur').val(null)
    $('#file-donatur').val(null)
    $('#upload-donatur').hide()
    ajaxCall(serverApi + "donatur/" + id, null, "GET", "loadDetailDonatur");
}

function loadDetailDonatur(data) {
    $('#btn-save-donatur').hide()
    $('#btn-update-donatur').fadeIn()
    $('#idNa').val(data.id)
    $('#nama').val(data.nama)
    $('#email').val(data.email)
    $('#alamat').val(data.alamat)
    $('#phone').val(data.phone)
}

function updateDataDonatur() {
    tambahDataDonatur("PUT")
}

function tambahDataDonatur(type = "POST") {
    swalTunggu()
    dataNa = {
        'id': $('#idNa').val(),
        'nama': $('#nama').val(),
        'email': $('#email').val(),
        'password': $('#password').val(),
        'alamat': $('#alamat').val(),
        'phone': $('#phone').val(),
    }

    if ($("#filena-donatur").val() == "") ajaxCall(serverApi + "donatur", JSON.stringify(dataNa), type, "reLoadDonatur");
    else {
        var files = document.getElementById('filena-donatur').files;
        var filename = files[0].name;
        var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
        if (extension == '.XLS' || extension == '.XLSX') {
            dataNa = excelFileToJSON(files[0], 'uploadDonatur');
        } else {
            alert("Please select a valid excel file."); swal.close();
        }
    }
}

function uploadDonatur(dataNa) {
    ajaxCall(serverApi + "updonatur", JSON.stringify(dataNa), "POST", "reLoadDonatur");
}

function browseFileDonatur() {
    $('#filena-donatur').trigger("click")
    $('#btn-upload-donatur').prop('disabled', false)
};

function clearFileDonatur() {
    $('#filena-donatur').val(null)
    $('#file-donatur').val(null)
    inputPreviewDokumenDonatur()
    $('#btn-upload-donatur').prop('disabled', true)
};

function inputPreviewDokumenDonatur() {
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#file-donatur").val(fileName);
    });
}
