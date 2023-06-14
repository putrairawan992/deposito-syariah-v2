$(document).ready(function () {
    ajaxCall(serverApi + "mustahik", null, "GET", "loadMustahik");
    ajaxCall(serverApi + "masjid", null, "GET", "loadMasjidMustahik");
});

function loadMustahik(data) {
    $('#modal-mustahik').modal('hide');
    var elementId = "tabel-list-mustahik";
    $("#spinnerloadinglistmustahik").hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No</th><th class="col-2">Nama</th>' +
        '<th class="col-2">Masjid</th><th class="col-2">Alamat</th><th class="col-2">Phone</th></thead>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        // tr += '<td class="text-center align-middle">' +
        //     '<button onclick="detailMustahik(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
        //     'data-toggle="modal" data-target="#modal-mustahik" nowrap>' + data[i]["nama"] + ' (' + data[i]["id"] + ')</button></td>';
        tr += '<td class="text-center align-middle">' +
            '<button onclick="detailMustahik(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
            'data-toggle="modal" data-target="#modal-mustahik" nowrap>' + data[i]["nama"] + '</button>';
        if (role == 99 || role == 1) {
            tr += '<button onclick="deleteMustahik(' + data[i]["id"] + ')" type="button"' +
                'class="btn-xs btn btn-danger w-100" nowrap>Hapus</button>';
        }
        tr += '</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["namaMasjid"] + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["alamat"] + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["phone"] + "</td>";
        tr += "</tr>";
        t += tr;
    }

    buildDataTable(t, elementId, "List mustahik", [0, 1, 2, 3, 4, 5], [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ]);

    if (role == 7) $('#buat-baru-mustahik').hide()
}

function deleteMustahik(id) {
    swalTunggu()
    ajaxCall(serverApi + "mustahik/" + id, null, 'DELETE', "reLoadMustahik");
}

function newMustahik() {
    inputPreviewDokumenMustahik()
    $('#btn-upload-mustahik').prop('disabled', true)
    $('#filena-mustahik').val(null)
    $('#file-mustahik').val(null)
    $('#upload-mustahik').fadeIn()
    $('#btn-save-mustahik').fadeIn()
    $('#btn-update-mustahik').hide()
    $('#idNa').val("")
    $('#id_masjid').val(0)
    $('#nama').val("")
    $('#alamat').val("")
    $('#phone').val("")
    if (role == 4 || role == 5 || role == 6) {
        $('#id_masjid').val(id_masjid); $('#id_masjidna').val(id_masjid);
        $('#id_masjid').prop('disabled', true);
        $('#id_masjidna').prop('disabled', true);
    }
    else {
        $('#id_masjid').prop('disabled', false);
        $('#id_masjidna').prop('disabled', false);
    }
}

function loadMasjidMustahik(data) {
    var o = '<option value="0" selected disabled>-- Pilih Masjid --</option>';
    for (var i = 0; i < data.length; i++) {
        o +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
    }
    document.getElementById("id_masjid").innerHTML = o;
    document.getElementById("id_masjidna").innerHTML = o;
}

function detailMustahik(id) {
    inputPreviewDokumenMustahik()
    $('#filena-mustahik').val(null)
    $('#file-mustahik').val(null)
    $('#upload-mustahik').hide()
    ajaxCall(serverApi + "mustahik/" + id, null, "GET", "loadDetailMustahik");
}

function loadDetailMustahik(data) {
    $('#btn-save-mustahik').hide()
    $('#btn-update-mustahik').fadeIn()
    $('#idNa').val(data.id)
    $('#id_masjid').val(data.id_masjid)
    $('#nama').val(data.nama)
    $('#alamat').val(data.alamat)
    $('#phone').val(data.phone)
}

function updateDataMustahik() {
    tambahDataMustahik("PUT")
}

function tambahDataMustahik(type = "POST") {
    swalTunggu()
    dataNa = {
        'id': $('#idNa').val(),
        'id_masjid': $('#id_masjid').val(),
        'nama': $('#nama').val(),
        'alamat': $('#alamat').val(),
        'phone': $('#phone').val(),
    }

    if ($("#filena-mustahik").val() == "") ajaxCall(serverApi + "mustahik", JSON.stringify(dataNa), type, "reLoadMustahik");
    else {
        var files = document.getElementById('filena-mustahik').files;
        var filename = files[0].name;
        var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
        if (extension == '.XLS' || extension == '.XLSX') {
            dataNa = excelFileToJSON(files[0], 'uploadMustahik');
        } else {
            alert("Please select a valid excel file."); swal.close();
        }
    }
}

function uploadMustahik(dataNa) {
    for (var i = 0; i < dataNa.length; i++) {
        dataNa[i].id_masjid = $('#id_masjidna').val()
        dataNa[i].role = 10
    }
    ajaxCall(serverApi + "upmustahik", JSON.stringify(dataNa), "POST", "reLoadMustahik");
}

function browseFileMustahik() {
    $('#filena-mustahik').trigger("click")
    $('#btn-upload-mustahik').prop('disabled', false)
};

function clearFileMustahik() {
    $('#filena-mustahik').val(null)
    $('#file-mustahik').val(null)
    inputPreviewDokumenMustahik()
    $('#btn-upload-mustahik').prop('disabled', true)
};

function inputPreviewDokumenMustahik() {
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#file-mustahik").val(fileName);
    });
}
