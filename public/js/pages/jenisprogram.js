$(document).ready(function () {
    ajaxCall(serverApi + "jenisprogram", null, "GET", "loadJenisProgram");
});

function loadJenisProgram(data) {
    $('#modal-pengaturan').modal('hide');
    var elementId = "tabel-list-program";
    $("#spinnerloadinglistprogram").hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No</th><th class="col-3">Nama</th>' +
        '<th class="col-7">Deskripsi</th></thead>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="text-center align-middle">' +
            '<button onclick="detailJenisProgram(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
            'data-toggle="modal" data-target="#modal-pengaturan" nowrap>' + data[i]["nama"] + '</button></td>';
        if (data[i]["deskripsi"] == null || data[i]["deskripsi"] == 'null' || data[i]["deskripsi"] == '-') tr += '<td class="align-middle text-center" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + data[i]["deskripsi"] + "</td>";
        tr += "</tr>";
        t += tr;
    }

    buildDataTable(t, elementId, "List jenisprogram", [0, 1, 2], [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ]);
}

function newProgram() {
    $('#btn-jeniszis').hide()
    $('#btn-jenistransaksi').hide()
    $('#btn-jenisprogram').fadeIn()
    $('#btn-jenismustahik').hide()

    $('#update-jenisprogram').hide()
    $('#simpan-jenisprogram').fadeIn()

    $('#title-pengaturan').text('Program Penyaluran')
    $('#label-nama-pengaturan').text('Nama Program')
    $('#nama-pengaturan').text('Nama Jenis Program Penyaluran')
    $('#label-deskripsi-pengaturan').text('Deskripsi Program')
    $('#deskripsi-pengaturan').text('Deskripsi Lengkap Jenis Program')

    $('#idNa').val("")
    $('#nama').val("")
    $('#deskripsi').val("")
}

function detailJenisProgram(id) {
    $('#btn-jeniszis').hide()
    $('#btn-jenistransaksi').hide()
    $('#btn-jenisprogram').fadeIn()
    $('#btn-jenismustahik').hide()

    $('#update-jenisprogram').fadeIn()
    $('#simpan-jenisprogram').hide()

    $('#title-pengaturan').text('Program Penyaluran')
    $('#label-nama-pengaturan').text('Nama Program')
    $('#nama-pengaturan').text('Nama Jenis Program Penyaluran')
    $('#label-deskripsi-pengaturan').text('Deskripsi Program')
    $('#deskripsi-pengaturan').text('Deskripsi Lengkap Jenis Program')

    $('#idNa').val("")
    $('#nama').val("")
    $('#deskripsi').val("")
    ajaxCall(serverApi + "jenisprogram/" + id, null, "GET", "loadDetailJenisProgram");
}

function loadDetailJenisProgram(data) {
    $('#idNa').val(data.id)
    $('#nama').val(data.nama)
    $('#deskripsi').val(data.deskripsi)
}

function updateDataJenisProgram() {
    tambahDataJenisProgram("PUT")
}

function tambahDataJenisProgram(type = "POST") {
    swalTunggu()
    dataNa = {
        'id': $('#idNa').val(),
        'nama': $('#nama').val(),
        'deskripsi': $('#deskripsi').val(),
    }

    ajaxCall(serverApi + "jenisprogram", JSON.stringify(dataNa), type, "reLoadJenisProgram");
}
