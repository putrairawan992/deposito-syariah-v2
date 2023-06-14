$(document).ready(function () {
    ajaxCall(serverApi + "jenistransaksi", null, "GET", "loadjenistransaksi");
});

function loadjenistransaksi(data) {
    $('#modal-pengaturan').modal('hide');
    var elementId = "tabel-list-payment";
    $("#spinnerloadinglistpayment").hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No</th><th class="col-2">Nama</th>' +
        '<th class="col-7">Deskripsi</th></thead>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="text-center align-middle">' +
            '<button onclick="detailJenistransaksi(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
            'data-toggle="modal" data-target="#modal-pengaturan" nowrap>' + data[i]["nama"] + '</button></td>';
        if (data[i]["deskripsi"] == null || data[i]["deskripsi"] == 'null' || data[i]["deskripsi"] == '-') tr += '<td class="align-middle text-center" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + data[i]["deskripsi"] + "</td>";
        tr += "</tr>";
        t += tr;
    }

    buildDataTable(t, elementId, "List jenistransaksi", [0, 1, 2], [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ]);
}

function newPayment() {
    $('#btn-jeniszis').hide()
    $('#btn-jenistransaksi').fadeIn()
    $('#btn-jenisprogram').hide()
    $('#btn-jenismustahik').hide()

    $('#update-jenistransaksi').hide()
    $('#simpan-jenistransaksi').fadeIn()

    $('#title-pengaturan').text('Jenis Transaksi')
    $('#label-nama-pengaturan').text('Nama Transaksi')
    $('#nama-pengaturan').text('Nama Jenis Transaksi')
    $('#label-deskripsi-pengaturan').text('Deskripsi Transaksi')
    $('#deskripsi-pengaturan').text('Deskripsi Lengkap Jenis Transaksi')

    $('#idNa').val("")
    $('#nama').val("")
    $('#deskripsi').val("")
}

function detailJenistransaksi(id) {
    $('#btn-jeniszis').hide()
    $('#btn-jenistransaksi').fadeIn()
    $('#btn-jenisprogram').hide()
    $('#btn-jenismustahik').hide()

    $('#update-jenistransaksi').fadeIn()
    $('#simpan-jenistransaksi').hide()

    $('#title-pengaturan').text('Jenis Transaksi')
    $('#label-nama-pengaturan').text('Nama Transaksi')
    $('#nama-pengaturan').text('Nama Jenis Transaksi')
    $('#label-deskripsi-pengaturan').text('Deskripsi Transaksi')
    $('#deskripsi-pengaturan').text('Deskripsi Lengkap Jenis Transaksi')

    $('#idNa').val("")
    $('#nama').val("")
    $('#deskripsi').val("")
    ajaxCall(serverApi + "jenistransaksi/" + id, null, "GET", "loadDetailJenistransaksi");
}

function loadDetailJenistransaksi(data) {
    $('#idNa').val(data.id)
    $('#nama').val(data.nama)
    $('#deskripsi').val(data.deskripsi)
}

function updateDataJenistransaksi() {
    tambahDataJenistransaksi("PUT")
}

function tambahDataJenistransaksi(type = "POST") {
    swalTunggu()
    dataNa = {
        'id': $('#idNa').val(),
        'nama': $('#nama').val(),
        'deskripsi': $('#deskripsi').val(),
    }

    ajaxCall(serverApi + "jenistransaksi", JSON.stringify(dataNa), type, "reLoadJenistransaksi");
}
