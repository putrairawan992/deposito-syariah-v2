$(document).ready(function () {
    ajaxCall(serverApi + "donasi", null, "GET", "loadDonasi");
    ajaxCall(serverApi + "masjid", null, "GET", "loadMasjidDonasi");
    ajaxCall(serverApi + "petugas", null, "GET", "loadpetugas");
    ajaxCall(serverApi + "donatur", null, "GET", "loaddonatur");
    ajaxCall(serverApi + "jeniszis", null, "GET", "loadjeniszis");
    ajaxCall(serverApi + "jenistransaksi", null, "GET", "loadjenistransaksi");
});

function detailKwitansi(id) {
    ajaxCall(serverApi + "donasi/" + id, null, "GET", "loadDetailKwitansi");
}

function loadDetailKwitansi(data) {
    var tanggalNa = konversiTanggal(data.tanggal)
    var total = data.amount
    if (data.amount == 0 && data.beras > 0) total = data.beras
    $('#nomor').text(': ' + data.id + '/BAZNASPR/' + tanggalNa.split(' ')[4] + '/' + tanggalNa.split(' ')[3])
    $('#periode').text(': ' + tanggalNa.split(' ')[2] + ' ' + tanggalNa.split(' ')[3])
    $('#NPWZ').text(': ' + data.npwz)
    $('#NPWP').text(': ' + data.npwp)
    $('#dari').text(': ' + data.namaDonatur)
    $('#alamat').text(': ' + data.alamat)
    $('#telepon').text(': ' + data.phone + ' / ' + data.emailDonatur)
    $('#objek').text(data.jenisZis)
    $('#uraian').text(data.keterangan)
    $('#via').text(data.jenisTransaksi)
    $('#jumlah').text(numbFor(data.amount))
    $('#total').text('Rp ' + numbFor(data.amount))
    $('#terbilang').html('Terbilang :<br>' + inWords(total) + ' Rupiah')
    if (data.amount == 0 && data.beras > 0) {
        $('#jumlah').text(numbFor(data.beras))
        $('#total').text(numbFor(data.beras) + ' Liter')
        $('#terbilang').html('Terbilang :<br>' + inWords(total) + ' Liter beras')
    } else if (data.amount > 0 && data.beras > 0) {
        $('#jumlah').html(numbFor(data.amount) + ' dan<br>' + numbFor(data.beras) + ' liter')
        $('#total').html('Rp ' + numbFor(data.amount) + ' dan<br>' + numbFor(data.beras) + ' liter')
        $('#terbilang').html('Terbilang :<br>' + inWords(data.amount) + ' Rupiah dan ' + inWords(data.beras) + ' Liter Beras')
    }
    $('#tgl-petugas').text('Pare pare, ' + dateFormatOne(data.tanggal))
    $('#petugas').text('Petugas : ' + data.namaMuzaki)
    $('#tgl-donatur').text('Pare pare, ' + dateFormatOne(data.tanggal))
    $('#atsnamadonatur').text('Penyetor : ' + data.namaDonatur)
    $('#namaDonatur').text('Semoga Allah SWT memberikan pahala kepada "' +
        data.namaDonatur +
        '" atas harta yang telah dikeluarkan dan menjadi berkah dan suci atas hartayang lainnya.')
}

function pengaturanRekapDonasi(data) {
    thisYearMinOne = thisYear - 1
    thisYearMinTwo = thisYear - 2
    var o = '<option value="" disabled>-- Pilih Tahun --</option>' +
        '<option value="0">-- Semua Tahun --</option>' +
        '<option value=' + thisYearMinTwo + '>' + thisYearMinTwo + '</option>' +
        '<option value=' + thisYearMinOne + '>' + thisYearMinOne + '</option>' +
        '<option selected value=' + thisYear + '>' + thisYear + '</option>';
    document.getElementById("tahun_rekap").innerHTML = o;

    if (role == 4 || role == 5 || role == 6 || role == 7) {
        $('#id_masjid_rekap').val(data.userProfile.id_masjid);
        $('#id_masjid_rekap').prop('disabled', true);
        $('#id_masjid').val(data.userProfile.id_masjid);
        $('#id_masjid').prop('disabled', true);
        $('#id_muzakki').val(data.userProfile.id);
        $('#id_muzakki').prop('disabled', true);
    }

    rekapDonasi()
}

function rekapDonasi() {
    id_masjid = $('#id_masjid_rekap').val()
    jenis_zis = $('#jenis_zis_rekap').val()
    dataNa = {
        id_masjid: id_masjid,
        jenis_zis: jenis_zis,
        tahun: $('#tahun_rekap').val(),
        bulan: $('#bulan_rekap').val()
    }
    if ($('#tahun_rekap').val() == 0) $('#bulan_rekap').val(0)
    if (id_masjid != null && jenis_zis != null) {
        ajaxCall(serverApi + "rekapdonasi", JSON.stringify(dataNa), "POST", "loadRekapDonasi");
    }
}

function loadRekapDonasi(data) {
    var rekap = data.rekap;
    var elementId = "tabel-list-donasi-rekap";
    $('#spinnerloadinglistdonasirekap').hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No.</th><th class="col-2" nowrap>Jenis ZIS</th><th class="col-1" nowrap>Jml Orang</th>' +
        '<th class="col-1" nowrap>Uang (Rp)</th><th class="col-1" nowrap>Beras (Liter)</th>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < rekap.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + rekap[i]["namaJenisZis"] + "</td>";
        tr += '<td class="align-middle text-sm text-right" nowrap>' + numbFor(rekap[i]["jmlOrang"]) + "</td>";
        if (rekap[i]["amount"] == 0) tr += '<td class="align-middle text-sm text-center" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm text-right" nowrap>' + numbFor(rekap[i]["amount"]) + "</td>";
        if (rekap[i]["beras"] == 0) tr += '<td class="align-middle text-sm text-center" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm text-right" nowrap>' + numbFor(rekap[i]["beras"]) + "</td>";

        tr += "</tr>";
        t += tr;
    }
    var tr = '<tr class="align-center">';
    tr += '<td class="text-center align-middle"></td>';
    tr += '<td class="align-middle  text-center text-bold" nowrap>Total</td>';
    tr += '<td class="align-middle text-bold text-right" nowrap>' + numbFor(data.kalkulasi.jmlOrang) + " Orang</td>";
    if (data.kalkulasi.amount == 0) tr += '<td class="align-middle text-bold text-center" nowrap>-</td>';
    else tr += '<td class="align-middle text-bold text-right" nowrap>Rp ' + numbFor(data.kalkulasi.amount) + "</td>";
    if (data.kalkulasi.beras == 0) tr += '<td class="align-middle text-bold text-center" nowrap>-</td>';
    else tr += '<td class="align-middle text-bold text-right" nowrap>' + numbFor(data.kalkulasi.beras) + " Liter</td>";
    tr += "</tr>";
    t += tr;
    document.getElementById(elementId).innerHTML += t
}

function loadDonasi(data) {
    $('#modal-donasi').modal('hide');
    var elementId = "tabel-list-donasi";
    $("#spinnerloadinglistdonasi").hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No</th><th class="col-2">Muzakki</th><th class="col-2">Masjid</th>' +
        '<th class="col-2">Jenis</th><th class="col-2" nowrap>Jenis Transaksi</th><th class="col-2">Petugas</th><th class="col-2">Donasi</th><th class="col-1">Tanggal</th><th class="col-2">Kwitansi</th>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="text-center align-middle">' +
            '<button onclick="detailDonasi(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100 mb-1 mr-1"' +
            'data-toggle="modal" data-target="#modal-donasi" nowrap>' + data[i]["namaDonatur"] + '</button>'
        if (role == 99 || role == 1) {
            tr += '<button onclick="deleteDonasi(' + data[i]["id"] + ')" type="button"' +
                'class="btn-xs btn btn-danger w-100" nowrap>Hapus</button>';
        }
        tr += '</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["namaMasjid"] + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["jenisZis"] + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["jenisTransaksi"] + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["namaMuzaki"] + "</td>";
        if (data[i]["beras"] > 0 && data[i]["amount"] > 0) tr += '<td class="text-center align-middle text-sm" nowrap>Rp ' + numbFor(data[i]["amount"]) + " dan<br>" + numbFor(data[i]["beras"]) + ' Liter</td>';
        else if (data[i]["beras"] > 0) tr += '<td class="text-center align-middle text-sm" nowrap>' + numbFor(data[i]["beras"]) + ' Liter</td>';
        else if (data[i]["amount"] > 0) tr += '<td class="text-center align-middle text-sm" nowrap>Rp ' + numbFor(data[i]["amount"]) + '</td>';
        else tr += '<td class="text-center align-middle text-sm">-</td>';
        tr += '<td class="text-center align-middle text-sm" nowrap>' + data[i]["tanggal"] + "</td>";
        tr += '<td class="text-center align-middle text-sm" nowrap>' +
            '<button onclick="detailKwitansi(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100 mb-1 mr-1"' +
            'data-toggle="modal" data-target="#modal-kwitansi" nowrap>Kwitansi</button></td>';

        tr += "</tr>";
        t += tr;
    }

    buildDataTable(t, elementId, "List donasi", [0, 1, 2, 3, 4, 5], [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ]);

    if (role == 7) $('#buat-baru').hide()
}

function deleteDonasi(id) {
    swalTunggu()
    ajaxCall(serverApi + "donasi/" + id, null, 'DELETE', "reloadDonasi");
}

function newDonasi() {
    $('#btn-update-donasi').hide()
    $('#btn-save-donasi').fadeIn()
    $('#idNa').val(null)
    $('#id_donatur').val(0)
    $('#jenis_zis').val(0)
    $('#amount').val(0)
    $('#beras').val(0)
    $('#tanggal').val(null)
    $('#keterangan').val("")
    $('#id_donatur').prop('disabled', false)

    if (role == 4 || role == 5 || role == 6 || role == 7) { }
    else {
        $('#id_masjid').val(0)
        $('#id_masjid').prop('disabled', false)
    }
}

function gantiPetugas() {
    // $('#id_masjid').val()
    ajaxCall(serverApi + "petugas/" + $('#id_masjid').val(), null, "GET", "loadpetugas");
}

function updateDonasi() { tambahData("PUT") }

function tambahData(type = "POST") {
    dataNa = {
        'id': $('#idNa').val(),
        'id_donatur': $('#id_donatur').val(),
        'id_masjid': $('#id_masjid').val(),
        'id_muzakki': $('#id_muzakki').val(),
        'jenis_zis': $('#jenis_zis').val(),
        'jenis_transaksi': $('#jenis_transaksi').val(),
        'amount': $('#amount').val(),
        'beras': $('#beras').val(),
        'keterangan': $('#keterangan').val(),
        'tanggal': $('#tanggal').val(),
    }

    ajaxCall(serverApi + "donasi", JSON.stringify(dataNa), type, "reloadDonasi");
}

function loadMasjidDonasi(data) {
    var o = '<option value="0" selected disabled>-- Pilih Masjid --</option>';
    var or = '<option value="" disabled>-- Pilih Masjid --</option>';
    or += '<option value="All" selected>-- Semua Masjid --</option>';
    for (var i = 0; i < data.length; i++) {
        o +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
        or +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
    }
    document.getElementById("id_masjid").innerHTML = o;
    document.getElementById("id_masjid_rekap").innerHTML = or;

    ajaxCall(serverApi + "userprofile", null, "GET", "pengaturanRekapDonasi");
}

function loadpetugas(data) {
    var o = '<option value="0" selected disabled>-- Pilih Petugas --</option>';
    for (var i = 0; i < data.length; i++) {
        o +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
    }
    document.getElementById("id_muzakki").innerHTML = o;
}

function loaddonatur(data) {
    var o = '<option value="0" selected disabled>-- Pilih Muzakki --</option>';
    for (var i = 0; i < data.length; i++) {
        o +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
    }
    document.getElementById("id_donatur").innerHTML = o;
}

function loadjeniszis(data) {
    var o = '<option value="0" selected disabled>-- Pilih Jenis ZIS --</option>';
    var or = '<option value="" disabled>-- Pilih Jenis ZIS --</option>';
    or += '<option value="All" selected>-- Semua Jenis ZIS --</option>';
    for (var i = 0; i < data.length; i++) {
        o +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
        or +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
    }
    document.getElementById("jenis_zis").innerHTML = o;
    document.getElementById("jenis_zis_rekap").innerHTML = or;
}

function loadjenistransaksi(data) {
    var o = '<option value="0" selected disabled>-- Pilih Jenis Transaksi --</option>';
    for (var i = 0; i < data.length; i++) {
        o +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
    }
    document.getElementById("jenis_transaksi").innerHTML = o;
}

function detailDonasi(id) {
    // inputPreviewDokumenPetugas()
    $('#filena-donasi').val(null)
    $('#file-donasi').val(null)
    $('#upload-donasi').hide()
    ajaxCall(serverApi + "donasi/" + id, null, "GET", "loadDetailPetugas");
}

function loadDetailPetugas(data) {
    $('#btn-update-donasi').fadeIn()
    $('#btn-save-donasi').hide()
    $('#idNa').val(data.id)
    $('#id_donatur').val(data.id_donatur)
    $('#id_donatur').prop('disabled', true)
    $('#id_masjid').val(data.id_masjid)
    $('#id_masjid').prop('disabled', true)
    $('#id_muzakki').val(data.id_muzakki)
    $('#jenis_zis').val(data.jenis_zis)
    $('#jenis_transaksi').val(data.jenis_transaksi)
    $('#tanggal').val(data.tanggal)
    $('#amount').val(data.amount)
    $('#beras').val(data.beras)
    $('#keterangan').val(data.keterangan)
}

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
    location.reload();
}
