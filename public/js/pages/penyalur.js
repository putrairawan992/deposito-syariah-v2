$(document).ready(function () {
    ajaxCall(serverApi + "penyalur", null, "GET", "loadPenyalur");
    ajaxCall(serverApi + "masjid", null, "GET", "loadMasjidPenyalur");
    ajaxCall(serverApi + "mustahik", null, "GET", "loadMustahik");
    ajaxCall(serverApi + "jenismustahik", null, "GET", "loadJenismustahik");
    ajaxCall(serverApi + "jenisprogram", null, "GET", "loadJenisProgram");
    ajaxCall(serverApi + "userprofile", null, "GET", "pengaturanRekapPenyalur");
});

function pengaturanRekapPenyalur(data) {
    thisYearMinOne = thisYear - 1
    thisYearMinTwo = thisYear - 2
    var o = '<option value="" disabled>-- Pilih Tahun --</option>' +
        '<option value="0">-- Semua Tahun --</option>' +
        '<option value=' + thisYearMinTwo + '>' + thisYearMinTwo + '</option>' +
        '<option value=' + thisYearMinOne + '>' + thisYearMinOne + '</option>' +
        '<option selected value=' + thisYear + '>' + thisYear + '</option>';
    document.getElementById("tahun_rekap").innerHTML = o;
    roleNa = data.userProfile.role
    if (roleNa == 4 || roleNa == 5 || roleNa == 6 || roleNa == 7) {
        $('#id_masjid_rekap').val(data.userProfile.id_masjid);
        $('#id_masjid_rekap').prop('disabled', true);
    }

    rekapPenyalur()
}

function rekapPenyalur() {
    id_masjid = $('#id_masjid_rekap').val()
    program = $('#program_rekap').val()
    dataNa = {
        id_masjid: id_masjid,
        program: program,
        tahun: $('#tahun_rekap').val(),
        bulan: $('#bulan_rekap').val()
    }
    if ($('#tahun_rekap').val() == 0) $('#bulan_rekap').val(0)
    if (id_masjid != null && program != null) {
        ajaxCall(serverApi + "rekappenyalur", JSON.stringify(dataNa), "POST", "loadRekapPenyalur");
    }
}

function loadRekapPenyalur(data) {
    var rekap = data.rekap;
    var elementId = "tabel-list-penyalur-rekap";
    $('#spinnerloadinglistpenyalurrekap').hide();
    headNa =
        '<thead><th class="col-1">No.</th><th class="col-2 text-center">Program</th><th class="col-1" nowrap>Uang (Rp)</th>' +
        '<th class="col-1" nowrap>Jml Orang</th><th class="col-1" nowrap>Beras (Liter)</th><th class="col-1" nowrap>Jml Orang</th>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < rekap.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + rekap[i]["program"] + "</td>";
        if (rekap[i]["amount"] == 0) tr += '<td class="align-middle text-sm text-center" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm text-right" nowrap>' + numbFor(rekap[i]["amount"]) + "</td>";
        if (rekap[i]["jmlOrangAmount"] == 0) tr += '<td class="align-middle text-sm text-center" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm text-right" nowrap>' + numbFor(rekap[i]["jmlOrangAmount"]) + "</td>";
        if (rekap[i]["beras"] == 0) tr += '<td class="align-middle text-sm text-center" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm text-right" nowrap>' + numbFor(rekap[i]["beras"]) + "</td>";
        if (rekap[i]["jmlOrangBeras"] == 0) tr += '<td class="align-middle text-sm text-center" nowrap>-</td>';
        else tr += '<td class="align-middle text-sm text-right" nowrap>' + numbFor(rekap[i]["jmlOrangBeras"]) + "</td>";

        tr += "</tr>";
        t += tr;
    }
    var tr = '<tr class="align-center">';
    tr += '<td class="text-center align-middle"></td>';
    tr += '<td class="align-middle  text-bold text-center" nowrap>Total</td>';
    if (data.kalkulasi.amount == 0) tr += '<td class="align-middle text-bold text-center" nowrap>-</td>';
    else tr += '<td class="align-middle text-bold text-right" nowrap>Rp ' + numbFor(data.kalkulasi.amount) + "</td>";
    if (data.kalkulasi.jml_orang_amount == 0) tr += '<td class="align-middle text-bold text-center" nowrap>-</td>';
    else tr += '<td class="align-middle text-bold text-right" nowrap>' + numbFor(data.kalkulasi.jmlOrangAmount) + " Orang</td>";
    if (data.kalkulasi.beras == 0) tr += '<td class="align-middle text-bold text-center" nowrap>-</td>';
    else tr += '<td class="align-middle text-bold text-right" nowrap>' + numbFor(data.kalkulasi.beras) + " Liter</td>";
    if (data.kalkulasi.jml_orang_beras == 0) tr += '<td class="align-middle text-bold text-center" nowrap>-</td>';
    else tr += '<td class="align-middle text-bold text-right" nowrap>' + numbFor(data.kalkulasi.jmlOrangBeras) + " Orang</td>";
    tr += "</tr>";
    t += tr;

    document.getElementById(elementId).innerHTML += t
}

function loadPenyalur(data) {
    $('#modal-penyalur').modal('hide');
    var elementId = "tabel-list-penyalur";
    $("#spinnerloadinglistpenyalur").hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No</th><th class="col-3">Nama</th>' +
        '<th class="col-3">Masjid</th><th class="col-2">Program</th></th><th class="col-2">Jenis</th><th class="col-2">Uang</th><th class="col-2 text-xs" nowrap>Jml Orang</th>' +
        '<th class="col-2">Beras</th><th class="col-2 text-xs" nowrap>Jml Orang</th></thead>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="text-center align-middle">' +
            '<button onclick="detailPenyalur(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
            'data-toggle="modal" data-target="#modal-penyalur" nowrap>' + data[i]["namaMustahik"] + '</button>';
        if (role == 99 || role == 1) {
            tr += '<button onclick="deletePenyalur(' + data[i]["id"] + ')" type="button"' +
                'class="btn-xs btn btn-danger w-100" nowrap>Hapus</button>';
        }
        tr += '</td>';
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["namaMasjid"] + "</td>";
        if (data[i]["program"] != null) tr += '<td class="text-center align-middle text-sm" nowrap>' + data[i]["namaProgram"] + "</td>";
        else tr += '<td class="text-center align-middle text-sm" nowrap>-</td>';
        tr += '<td class="text-center align-middle text-sm" nowrap>' + data[i]["jenisMustahik"] + "</td>";
        if (data[i]["amount"] > 0) {
            tr += '<td class="text-right align-middle text-sm" nowrap>Rp ' + numbFor(data[i]["amount"]) + "</td>";
            tr += '<td class="text-center align-middle text-sm" nowrap>' + numbFor(data[i]["jml_orang_amount"]) + " Orang</td>";
        } else {
            tr += '<td class="text-center align-middle text-sm" nowrap>-</td>';
            tr += '<td class="text-center align-middle text-sm" nowrap>-</td>';
        } if (data[i]["beras"] > 0) {
            tr += '<td class="text-right align-middle text-sm" nowrap>' + numbFor(data[i]["beras"]) + " Liter</td>";
            tr += '<td class="text-center align-middle text-sm" nowrap>' + numbFor(data[i]["jml_orang_beras"]) + " Orang</td>";
        } else {
            tr += '<td class="text-center align-middle text-sm" nowrap>-</td>';
            tr += '<td class="text-center align-middle text-sm" nowrap>-</td>';
        } tr += "</tr>";
        t += tr;
    }

    buildDataTable(t, elementId, "List penyalur", [0, 1, 2, 3, 4, 5], [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ]);

    if (role == 7) $('#buat-baru').hide()
}

function deletePenyalur(id) {
    swalTunggu()
    ajaxCall(serverApi + "penyalur/" + id, null, 'DELETE', "reLoadPenyalur");
}

function newPenyalur() {
    // inputPreviewDokumenPenyalur()
    $('#btn-upload-penyalur').prop('disabled', true)
    $('#filena-penyalur').val(null)
    $('#file-penyalur').val(null)
    $('#upload-penyalur').fadeIn()
    $('#btn-save-penyalur').fadeIn()
    $('#btn-update-penyalur').hide()
    $('#idNa').val("")
    $('#program').val(0)
    $('#id_masjid').val(0)
    $('#id_mustahik').val(0)
    $('#id_jenis_mustahik').val(0)
    $('#tanggal').val(null)
    $('#amount').val(0)
    $('#jml_orang_amount').val(0)
    $('#beras').val(0)
    $('#jml_orang_beras').val(0)
    if (role == 4 || role == 5 || role == 6) {
        $('#id_masjid').val(id_masjid);
        $('#id_masjid').prop('disabled', true);
    }
    else {
        $('#id_masjid').prop('disabled', false);
    }
}

function detailPenyalur(id) {
    // inputPreviewDokumenPenyalur()
    $('#filena-penyalur').val(null)
    $('#file-penyalur').val(null)
    $('#upload-penyalur').hide()
    if (role == 4 || role == 5 || role == 6) {
        $('#id_masjid').val(id_masjid);
        $('#id_masjid').prop('disabled', true);
    }
    else {
        $('#id_masjid').prop('disabled', false);
    }
    ajaxCall(serverApi + "penyalur/" + id, null, "GET", "loadDetailPenyalur");
}

function loadDetailPenyalur(data) {
    $('#btn-save-penyalur').hide()
    $('#btn-update-penyalur').fadeIn()
    $('#idNa').val(data.id)
    $('#program').val(data.program)
    $('#id_masjid').val(data.id_masjid)
    $('#id_mustahik').val(data.id_mustahik)
    $('#id_jenis_mustahik').val(data.id_jenis_mustahik)
    $('#tanggal').val(data.tanggal)
    $('#amount').val(data.amount)
    $('#beras').val(data.beras)
    $('#jml_orang_amount').val(data.jml_orang_amount)
    $('#jml_orang_beras').val(data.jml_orang_beras)
}

function updateDataPenyalur() {
    tambahDataPenyalur("PUT")
}

function tambahDataPenyalur(type = "POST") {
    swalTunggu()
    dataNa = {
        'id': $('#idNa').val(),
        'id_masjid': $('#id_masjid').val(),
        'id_mustahik': $('#id_mustahik').val(),
        'id_jenis_mustahik': $('#id_jenis_mustahik').val(),
        'tanggal': $('#tanggal').val(),
        'program': $('#program').val(),
        'amount': $('#amount').val(),
        'jml_orang_amount': $('#jml_orang_amount').val(),
        'beras': $('#beras').val(),
        'jml_orang_beras': $('#jml_orang_beras').val(),
    }

    ajaxCall(serverApi + "penyalur", JSON.stringify(dataNa), type, "reLoadPenyalur");
    // if ($("#filena-penyalur").val() == "") ajaxCall(serverApi + "penyalur", JSON.stringify(dataNa), type, "reLoadPenyalur");
    // else {
    //     var files = document.getElementById('filena-penyalur').files;
    //     var filename = files[0].name;
    //     var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
    //     if (extension == '.XLS' || extension == '.XLSX') {
    //         dataNa = excelFileToJSON(files[0], 'uploadPenyalur');
    //     } else {
    //         alert("Please select a valid excel file."); swal.close();
    //     }
    // }
}

function loadMasjidPenyalur(data) {
    var o = '<option value="0" selected disabled>-- Pilih Masjid --</option>';
    var or = '<option value="0" disabled>-- Pilih Masjid --</option>';
    or += '<option value="All" selected>Semua Masjid</option>';
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
}

function loadMustahik(data) {
    var o = '<option value="0" selected disabled>-- Pilih Mustahik --</option>';
    for (var i = 0; i < data.length; i++) {
        o +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
    }
    document.getElementById("id_mustahik").innerHTML = o;
}

function loadJenismustahik(data) {
    var o = '<option value="0" selected disabled>-- Pilih Jenis Mustahik --</option>';
    for (var i = 0; i < data.length; i++) {
        o +=
            "<option value=" +
            data[i].id +
            ">" +
            data[i].nama +
            "</option>";
    }
    document.getElementById("id_jenis_mustahik").innerHTML = o;
}

function loadJenisProgram(data) {
    var o = '<option value="0" selected disabled>-- Pilih Jenis Program --</option>';
    var or = '<option value="" disabled>-- Pilih Jenis Program --</option>';
    or += '<option value="0" selected>Semua Program</option>';
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
    document.getElementById("program").innerHTML = o;
    document.getElementById("program_rekap").innerHTML = or;
}

// function uploadPenyalur(dataNa) {
//     for (var i = 0; i < dataNa.length; i++) {
//         dataNa[i].id_masjid = $('#id_masjidna').val()
//         dataNa[i].role = 10
//     }
//     ajaxCall(serverApi + "uppenyalur", JSON.stringify(dataNa), "POST", "reLoadPenyalur");
// }

// function browseFilePenyalur() {
//     $('#filena-penyalur').trigger("click")
//     $('#btn-upload-penyalur').prop('disabled', false)
// };

// function clearFilePenyalur() {
//     $('#filena-penyalur').val(null)
//     $('#file-penyalur').val(null)
//     inputPreviewDokumenPenyalur()
//     $('#btn-upload-penyalur').prop('disabled', true)
// };

// function inputPreviewDokumenPenyalur() {
//     $('input[type="file"]').change(function (e) {
//         var fileName = e.target.files[0].name;
//         $("#file-penyalur").val(fileName);
//     });
// }
