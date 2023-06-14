$(document).ready(function () {
    ajaxCall(serverApi + "masjid", null, "GET", "loadmasjid");
    ajaxCall(serverApi + "jenisprogram", null, "GET", "loadJenisProgram");

    thisYearMinOne = thisYear - 1
    thisYearMinTwo = thisYear - 2
    var o = '<option value="" disabled>-- Pilih Tahun --</option>' +
        '<option value="0">Semua Tahun</option>' +
        '<option value=' + thisYearMinTwo + '>' + thisYearMinTwo + '</option>' +
        '<option value=' + thisYearMinOne + '>' + thisYearMinOne + '</option>' +
        '<option selected value=' + thisYear + '>' + thisYear + '</option>';
    document.getElementById("tahun_laporan").innerHTML = o;
});

function loadmasjid(data) {
    var o = '<option value="" disabled>-- Pilih Masjid --</option>';
    o += '<option value="0" selected>Semua Masjid</option>';
    for (var i = 0; i < data.length; i++) {
        o +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
    }
    document.getElementById("id_masjid").innerHTML = o;

    if (role == 4 || role == 5 || role == 6) {
        $('#id_masjid').val(id_masjid)
        $('#id_masjid').prop('disabled', true)
    } else {
        $('#id_masjid').val("")
        $('#id_masjid').prop('disabled', false)
    }
}

function loadJenisProgram(data) {
    var o = '<option value="" disabled>-- Pilih Jenis Program --</option>';
    o += '<option value="0" selected>Semua Program</option>';
    for (var i = 0; i < data.length; i++) {
        o +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
    }
    document.getElementById("program").innerHTML = o;
}

function filterNa() {
    if ($('#tglAwal').val() != "" || $('#tglAkhir').val() != "") { $('#bulan').val(""); $('#tahun_laporan').val(""); }
    getLaporan()
}

function filterBulan() {
    if ($('#bulan').val() != "" && $('#tahun_laporan').val() != "") {
        $('#tglAwal').val("")
        $('#tglAkhir').val("")
    }

    getLaporan()

}

function getLaporan() {
    dataNa = {
        'tglAwal': $('#tglAwal').val(),
        'tglAkhir': $('#tglAkhir').val(),
        'bulan': $('#bulan').val(),
        'tahun': $('#tahun_laporan').val(),
        'program': $('#program').val(),
        'id_masjid': $('#id_masjid').val(),
    }

    if (dataNa.program != null && dataNa.id_masjid != null) {
        if (dataNa.tglAwal != "" && dataNa.tglAkhir != "") {
            ajaxCall(serverApi + "lapdonasi", JSON.stringify(dataNa), "POST", "loadLaporan");
            swalTunggu()
        }
        if (dataNa.bulan != "" && dataNa.tahun != "") {
            ajaxCall(serverApi + "lapdonasi", JSON.stringify(dataNa), "POST", "loadLaporan");
            swalTunggu()
        }
    }
}

function loadLaporan(data) {
    ketua = data.ketua
    pembina = data.pembina
    sekertaris = data.sekertaris
    bendahara = data.bendahara
    listketua = ""
    listsekertaris = ""
    listbendahara = ""
    listpembina = ""
    for (var i = 0; i < ketua.length; i++) {
        listketua += ketua[i] + ', '
        if (i > 2) i = ketua.length
    }

    for (var i = 0; i < pembina.length; i++) {
        listpembina += pembina[i] + ', '
        if (i > 2) i = pembina.length
    }

    for (var i = 0; i < sekertaris.length; i++) {
        listsekertaris += sekertaris[i] + ', '
        if (i > 2) i = sekertaris.length
    }

    for (var i = 0; i < bendahara.length; i++) {
        listbendahara += bendahara[i] + ', '
        if (i > 2) i = bendahara.length
    }

    $('#nama-masjid').text(": " + data.masjid.nama)
    $('#nama-jalan').text(": " + data.masjid.jalan)
    $('#pembina').text("1. " + listpembina.slice(0, -2))
    $('#ketua').text("2. " + listketua.slice(0, -2))
    $('#sekertaris').text("3. " + listsekertaris.slice(0, -2))
    if (listbendahara == "") $('#bendahara').text("")
    else $('#bendahara').text("4. " + listbendahara.slice(0, -2))
    $('#jmlOrang').text(": " + data.jmlOrang + " Orang")
    $('#jmlUang').text(": Rp " + numbFor(data.jmlUang))
    $('#jmlBeras').text(": " + numbFor(data.jmlBeras) + " Liter")

    // Table
    loadTablePenerimaan(data['donasi'])
    loadTablePenyaluran(data['mustahik'])

    // Fill Nama dan tanggal Print
    var objToday = new Date(),
        weekday = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'),
        dayOfWeek = weekday[objToday.getDay()],
        domEnder = function () {
            var a = objToday;
            if (/1/.test(parseInt((a + "").charAt(0))))
                return "th"; a = parseInt((a + "").charAt(1));
            return 1 == a ? "st" : 2 == a ? "nd" : 3 == a ? "rd" : "th"
        }(),
        dayOfMonth = today + (objToday.getDate() < 10) ? '0' + objToday.getDate() : objToday.getDate(),
        months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
        curMonth = months[objToday.getMonth()],
        curYear = objToday.getFullYear(),
        curHour = objToday.getHours() > 12 ? objToday.getHours() - 12 : (objToday.getHours() < 10 ? "0" + objToday.getHours() : objToday.getHours()),
        curMinute = objToday.getMinutes() < 10 ? "0" + objToday.getMinutes() : objToday.getMinutes(),
        curSeconds = objToday.getSeconds() < 10 ? "0" + objToday.getSeconds() : objToday.getSeconds(),
        curMeridiem = objToday.getHours() > 12 ? "PM" : "AM";
    var today = dayOfWeek + " " + dayOfMonth + " " + curMonth + " " + curYear;

    // document.getElementsByTagName('h1')[0].textContent = today;
    $('#tgl-print').text('Kota Parepare, ' + today)
    if (listbendahara == "") $('#nama-print').text('(' + pembina[0] + ')')
    else $('#nama-print').text('(' + ketua[0] + ')')

    swal.close()
}

function loadTablePenerimaan(data) {
    var elementId = "tabel-penerimaan";
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No.</th><th class="col-2">Jenis ZIS</th><th class="col-1">Jml Orang</th>' +
        '<th class="col-1">Uang (Rp)</th><th class="col-1">Beras (Liter)</th>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    let jmlOrang = 0;
    let amount = 0;
    let beras = 0;
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["jenisZis"] + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + numbFor(data[i]["jmlOrang"]) + "</td>";
        if (data[i]["amount"] == 0) tr += '<td class="align-middle text-sm" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + numbFor(data[i]["amount"]) + "</td>";
        if (data[i]["beras"] == 0) tr += '<td class="align-middle text-sm" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + numbFor(data[i]["beras"]) + "</td>";

        tr += "</tr>";
        t += tr;

        jmlOrang += data[i]['jmlOrang'];
        amount += data[i]['amount'];
        beras += data[i]['beras'];
    }

    if (data.length > 0) {
        if (jmlOrang == 0) jmlOrang = '-'
        else jmlOrang = numbFor(jmlOrang) + ' Orang'
        if (amount == 0) amount = '-'
        else amount = 'Rp ' + numbFor(amount)
        if (beras == 0) beras = '-'
        else beras = numbFor(beras) + ' Liter'
        var tr = '<tr class="align-center text-bold">';
        tr += '<td class="text-center align-middle" colspan="2">Total</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + jmlOrang + '</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + amount + '</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + beras + '</td>';

        tr += "</tr>";
        t += tr;
    }
    document.getElementById(elementId).innerHTML += t
}

function loadTablePenyaluran(data) {
    var elementId = "table-penyaluran";
    headNa =
        '<thead><th class="col-1">No.</th><th class="col-2">Mustahik</th><th class="col-1">Uang (Rp)</th>' +
        '<th class="col-1">Jml Orang</th><th class="col-1">Beras (Liter)</th><th class="col-1">Jml Orang</th>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    let amount = 0;
    let jml_orang_amount = 0;
    let beras = 0;
    let jml_orang_beras = 0;
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["jenisMustahik"] + "</td>";
        if (data[i]["amount"] == 0) tr += '<td class="align-middle text-sm" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + numbFor(data[i]["amount"]) + "</td>";
        if (data[i]["jml_orang_amount"] == 0) tr += '<td class="align-middle text-sm" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + numbFor(data[i]["jml_orang_amount"]) + "</td>";
        if (data[i]["beras"] == 0) tr += '<td class="align-middle text-sm" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + numbFor(data[i]["beras"]) + "</td>";
        if (data[i]["jml_orang_beras"] == 0) tr += '<td class="align-middle text-sm" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm" nowrap>' + numbFor(data[i]["jml_orang_beras"]) + "</td>";

        tr += "</tr>";
        t += tr;

        amount += data[i]['amount']
        jml_orang_amount += data[i]['jml_orang_amount']
        beras += data[i]['beras']
        jml_orang_beras += data[i]['jml_orang_beras']
    }
    if (data.length > 0) {
        if (amount == 0) amount = '-'
        else amount = 'Rp ' + numbFor(amount)
        if (jml_orang_amount == 0) jml_orang_amount = '-'
        else jml_orang_amount = numbFor(jml_orang_amount) + ' Orang'
        if (beras == 0) beras = '-'
        else beras = numbFor(beras) + ' Liter'
        if (jml_orang_beras == 0) jml_orang_beras = '-'
        else jml_orang_beras = numbFor(jml_orang_beras) + ' Orang'

        var tr = '<tr class="align-center text-bold">';
        tr += '<td class="text-center align-middle" colspan="2">Total</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + amount + '</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + jml_orang_amount + '</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + beras + '</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + jml_orang_beras + '</td>';

        tr += "</tr>";
        t += tr;
    }
    document.getElementById(elementId).innerHTML += t
}

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
