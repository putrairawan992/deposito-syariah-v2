$(document).ready(function () {
    ajaxCall(serverApi + "jenismustahik", null, "GET", "loadJenisMustahik");
});

function loadJenisMustahik(data) {
    $('#modal-pengaturan').modal('hide');
    var elementId = "tabel-list-jenismustahik";
    $("#spinnerloadinglistjenismustahik").hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No</th><th class="col-2">Nama</th>' +
        '<th class="col-7">Deskripsi</th></thead>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="text-center align-middle">' +
            '<button onclick="detailJenismustahik(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
            'data-toggle="modal" data-target="#modal-pengaturan" nowrap>' + data[i]["nama"] + '</button></td>';
        if (data[i]["deskripsi"] == null || data[i]["deskripsi"] == 'null' || data[i]["deskripsi"] == '-') tr += '<td class="align-middle text-center" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + data[i]["deskripsi"] + "</td>";
        tr += "</tr>";
        t += tr;
    }

    buildDataTable(t, elementId, "List jenismustahik", [0, 1, 2], [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ]);
}

function newJenismustahik() {
    $('#btn-jeniszis').hide()
    $('#btn-jenistransaksi').hide()
    $('#btn-jenisprogram').hide()
    $('#btn-jenismustahik').fadeIn()

    $('#update-jenismustahik').hide()
    $('#simpan-jenismustahik').fadeIn()

    $('#title-pengaturan').text('Jenis Mustahik')
    $('#label-nama-pengaturan').text('Jenis Mustahik')
    $('#nama-pengaturan').text('Nama Jenis Mustahik')
    $('#label-deskripsi-pengaturan').text('Deskripsi Mustahik')
    $('#deskripsi-pengaturan').text('Deskripsi Lengkap Jenis Mustahik')

    $('#idNa').val("")
    $('#nama').val("")
    $('#deskripsi').val("")
}

function detailJenismustahik(id) {
    $('#btn-jeniszis').hide()
    $('#btn-jenistransaksi').hide()
    $('#btn-jenisprogram').hide()
    $('#btn-jenismustahik').fadeIn()

    $('#update-jenismustahik').fadeIn()
    $('#simpan-jenismustahik').hide()

    $('#title-pengaturan').text('Jenis Mustahik')
    $('#label-nama-pengaturan').text('Jenis Mustahik')
    $('#nama-pengaturan').text('Nama Jenis Mustahik')
    $('#label-deskripsi-pengaturan').text('Deskripsi Mustahik')
    $('#deskripsi-pengaturan').text('Deskripsi Lengkap Jenis Mustahik')

    $('#idNa').val("")
    $('#nama').val("")
    $('#deskripsi').val("")
    ajaxCall(serverApi + "jenismustahik/" + id, null, "GET", "loadDetailJenisMustahik");
}

function loadDetailJenisMustahik(data) {
    $('#idNa').val(data.id)
    $('#nama').val(data.nama)
    $('#deskripsi').val(data.deskripsi)
}

function updateDataJenismustahik() {
    tambahDataJenismustahik("PUT")
}

function tambahDataJenismustahik(type = "POST") {
    swalTunggu()
    dataNa = {
        'id': $('#idNa').val(),
        'nama': $('#nama').val(),
        'deskripsi': $('#deskripsi').val(),
    }

    ajaxCall(serverApi + "jenismustahik", JSON.stringify(dataNa), type, "reLoadJenisMustahik");
}
