$(document).ready(function () {
    ajaxCall(serverApi + "petugas", null, "GET", "loadPetugas");
});

function loadPetugas(data) {
    $('#jmlUPZ').text(data.length)
    $('#modal-petugas').modal('hide');
    var elementId = "tabel-list-petugas";
    $("#spinnerloadinglistpetugas").hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No</th><th class="col-2">Nama</th>' +
        '<th class="col-2">Masjid</th><th class="col-2">Jabatan</th><th class="col-2">Alamat</th><th class="col-2">Phone</th>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="text-center align-middle">' +
            '<button onclick="detailPetugas(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
            'data-toggle="modal" data-target="#modal-petugas" nowrap>' + data[i]["nama"] + ' (' + data[i]["id"] + ')</button>';
        // tr += '<td class="text-center align-middle">' +
        //     '<button onclick="detailPetugas(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
        //     'data-toggle="modal" data-target="#modal-petugas" nowrap>' + data[i]["nama"] + '</button>';
        if (role == 99 || role == 1) {
            tr += '<button onclick="deletePetugas(' + data[i]["id"] + ')" type="button"' +
                'class="btn-xs btn btn-danger w-100" nowrap>Hapus</button>';
        }
        tr += '</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["namaMasjid"] + "</td>";
        if (data[i]["role"] == 4) tr += '<td class="text-center align-middle text-sm" nowrap>Ketua / Imam</td>';
        else if (data[i]["role"] == 5) tr += '<td class="text-center align-middle text-sm" nowrap>Sekertaris</td>';
        else if (data[i]["role"] == 6) tr += '<td class="text-center align-middle text-sm" nowrap>Bendahara</td>';
        else if (data[i]["role"] == 7) tr += '<td class="text-center align-middle text-sm" nowrap>Pembina</td>';
        else tr += '<td class="text-center align-middle text-sm">-</td>';
        tr += '<td class="text-center align-middle text-sm" nowrap>' + data[i]["alamat"] + "</td>";
        tr += '<td class="text-center align-middle text-sm" nowrap>' + data[i]["phone"] + "</td>";

        tr += "</tr>";
        t += tr;
    }

    buildDataTable(t, elementId, "List petugas", [0, 1, 2, 3, 4, 5], [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ]);
}

function deletePetugas(id) {
    swalTunggu()
    ajaxCall(serverApi + "petugas/" + id, null, 'DELETE', "reLoadPetugas");
}

function newPetugas() {
    inputPreviewDokumenPetugas()
    $('#btn-upload-petugas').prop('disabled', true)
    $('#filena-petugas').val(null)
    $('#file-petugas').val(null)
    $('#upload-petugas').fadeIn()
    $('#btn-save-petugas').fadeIn()
    $('#btn-update-petugas').hide()
    $('#idNa').val("")
    $('#id_masjid').val("")
    $('#nama-petugas').val("")
    $('#email').val("")
    $('#password').val("")
    $('#role').val("")
    $('#alamat').val("")
    $('#phone').val("")
}

function detailPetugas(id) {
    inputPreviewDokumenPetugas()
    $('#filena-petugas').val(null)
    $('#file-petugas').val(null)
    $('#upload-petugas').hide()
    ajaxCall(serverApi + "petugasna/" + id, null, "GET", "loadDetailPetugas");
}

function loadDetailPetugas(data) {
    $('#btn-save-petugas').hide()
    $('#btn-update-petugas').fadeIn()
    $('#idNa-petugas').val(data.id)
    $('#id_masjid').val(data.id_masjid)
    $('#nama-petugas').val(data.nama)
    $('#email').val(data.email)
    $('#password').val("")
    $('#role').val(data.role)
    $('#alamat').val(data.alamat)
    $('#phone').val(data.phone)
}

function updateDataPetugas() {
    tambahDataPetugas("PUT")
}

function tambahDataPetugas(type = "POST") {
    swalTunggu()
    dataNa = {
        'id': $('#idNa-petugas').val(),
        'id_masjid': $('#id_masjid').val(),
        'nama': $('#nama-petugas').val(),
        'email': $('#email').val(),
        'password': $('#password').val(),
        'role': $('#role').val(),
        'alamat': $('#alamat').val(),
        'phone': $('#phone').val(),
    }

    if ($("#filena-petugas").val() == "") ajaxCall(serverApi + "petugas", JSON.stringify(dataNa), type, "reLoadPetugas");
    else {
        var files = document.getElementById('filena-petugas').files;
        var filename = files[0].name;
        var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
        if (extension == '.XLS' || extension == '.XLSX') {
            dataNa = excelFileToJSON(files[0], 'uploadPetugas');
        } else {
            alert("Please select a valid excel file."); swal.close();
        }
    }
}

function uploadPetugas(dataNa) {
    ajaxCall(serverApi + "uppetugas", JSON.stringify(dataNa), "POST", "reLoadPetugas");
}

function browseFilePetugas() {
    $('#filena-petugas').trigger("click")
    $('#btn-upload-petugas').prop('disabled', false)
};

function clearFilePetugas() {
    $('#filena-petugas').val(null)
    $('#file-petugas').val(null)
    inputPreviewDokumenPetugas()
    $('#btn-upload-petugas').prop('disabled', true)
};

function inputPreviewDokumenPetugas() {
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#file-petugas").val(fileName);
    });
}
