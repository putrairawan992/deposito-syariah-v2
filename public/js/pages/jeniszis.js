$(document).ready(function () {
    ajaxCall(serverApi + "jeniszis", null, "GET", "loadJeniszis");
});

function loadJeniszis(data) {
    $('#modal-pengaturan').modal('hide');
    var elementId = "tabel-list-jeniszis";
    $("#spinnerloadinglistjeniszis").hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No</th><th class="col-4">Nama</th>' +
        '<th class="col-7">Deskripsi</th></thead>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="text-center align-middle">' +
            '<button onclick="detailJeniszis(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
            'data-toggle="modal" data-target="#modal-pengaturan" nowrap>' + data[i]["nama"] + '</button></td>';
        if (data[i]["deskripsi"] == null || data[i]["deskripsi"] == 'null' || data[i]["deskripsi"] == '-') tr += '<td class="align-middle text-center" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + data[i]["deskripsi"] + "</td>";
        tr += "</tr>";
        t += tr;
    }

    buildDataTable(t, elementId, "List jeniszis", [0, 1, 2], [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ]);
}

function newJeniszis() {
    $('#btn-jeniszis').fadeIn()
    $('#btn-jenistransaksi').hide()
    $('#btn-jenisprogram').hide()
    $('#btn-jenismustahik').hide()

    $('#update-jeniszis').hide()
    $('#simpan-jeniszis').fadeIn()

    $('#title-pengaturan').text('Zakat Infaq Shadaqoh')
    $('#label-nama-pengaturan').text('Jenis ZIS')
    $('#nama-pengaturan').text('Nama Jenis ZIS')
    $('#label-deskripsi-pengaturan').text('Deskripsi ZIS')
    $('#deskripsi-pengaturan').text('Deskripsi Lengkap Jenis ZIS')

    $('#idNa').val("")
    $('#nama').val("")
    $('#deskripsi').val("")
}

function detailJeniszis(id) {
    $('#btn-jeniszis').fadeIn()
    $('#btn-jenistransaksi').hide()
    $('#btn-jenisprogram').hide()
    $('#btn-jenismustahik').hide()

    $('#update-jeniszis').fadeIn()
    $('#simpan-jeniszis').hide()

    $('#title-pengaturan').text('Zakat Infaq Shadaqoh')
    $('#label-nama-pengaturan').text('Jenis ZIS')
    $('#nama-pengaturan').text('Nama Jenis ZIS')
    $('#label-deskripsi-pengaturan').text('Deskripsi ZIS')
    $('#deskripsi-pengaturan').text('Deskripsi Lengkap Jenis ZIS')

    $('#idNa').val("")
    $('#nama').val("")
    $('#deskripsi').val("")
    ajaxCall(serverApi + "jeniszis/" + id, null, "GET", "loadDetailJeniszis");
}

function loadDetailJeniszis(data) {
    $('#idNa').val(data.id)
    $('#nama').val(data.nama)
    $('#deskripsi').val(data.deskripsi)
}

function updateDataJeniszis() {
    tambahDataJeniszis("PUT")
}

function tambahDataJeniszis(type = "POST") {
    swalTunggu()
    dataNa = {
        'id': $('#idNa').val(),
        'nama': $('#nama').val(),
        'deskripsi': $('#deskripsi').val(),
    }

    ajaxCall(serverApi + "jeniszis", JSON.stringify(dataNa), type, "reLoadJeniszis");
}
