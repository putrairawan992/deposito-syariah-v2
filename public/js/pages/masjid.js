$(document).ready(function () {
    ajaxCall(serverApi + "masjid", null, "GET", "loadMasjid");
});

function loadMasjid(data) {
    $('#jmlMasjid').text(data.length)
    $('#modal-masjid').modal('hide');
    var elementId = "tabel-list-masjid";
    $("#spinnerloadinglistmasjid").hide();
    headNa =
        '<thead><tr class="text-center align-middle align-items-center"><th class="col-1">No</th><th class="col-3">Nama Masjid</th>' +
        '<th class="col-2">Kegiatan</th><th class="col-2">Jalan / Desa</th><th class="col-2">Kelurahan</th><th class="col-2">Kecamatan</th></tr></thead>';
    document.getElementById(elementId).innerHTML = headNa
    var t = "";
    loadPilihMasjid(data)
    for (var i = 0; i < data.length; i++) {
        var tr = '<tr class="align-center">';
        tr += '<td class="text-center align-middle">' + (i + 1) + "</td>";
        tr += '<td class="text-center align-middle">' +
            '<button onclick="detailMasjid(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
            'data-toggle="modal" data-target="#modal-masjid" nowrap>' + data[i]["nama"] + '</button>';
        // tr += '<td class="text-center align-middle">' +
        //     '<button onclick="detailMasjid(' + data[i]["id"] + ')" type="button" class="btn-sm btn btn-info w-100"' +
        //     'data-toggle="modal" data-target="#modal-masjid" nowrap>' + data[i]["nama"] + ' (' + data[i]["id"] + ')</button>';
        if (role == 99 || role == 1) {
            tr += '<button onclick="deleteMasjid(' + data[i]["id"] + ')" type="button"' +
                'class="btn-xs btn btn-danger w-100" nowrap>Hapus</button>';
        }
        tr += '</td>';
        tr += '<td class="text-center align-middle text-sm" nowrap>' + data[i]["donasi"] + ' / ' + data[i]["penyalur"] + "</td>";
        tr += '<td class="align-middle text-sm" nowrap>' + data[i]["jalan"] + "</td>";
        tr += '<td class="text-center align-middle text-sm" nowrap>' + data[i]["kelurahan"] + "</td>";
        tr += '<td class="text-center align-middle text-sm" nowrap>' + data[i]["kecamatan"] + "</td>";

        tr += "</tr>";
        t += tr;
    }

    buildDataTable(t, elementId, "List Masjid", [0, 1, 2, 3, 4, 5], [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ]);
}

function deleteMasjid(id) {
    swalTunggu()
    ajaxCall(serverApi + "masjid/" + id, null, 'DELETE', "reLoadMasjid");
}

function loadPilihMasjid(data) {
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
}

function newMasjid() {
    inputPreviewDokumen()
    $('#btn-upload-masjid').prop('disabled', true)
    $('#filena-masjid').val(null)
    $('#file-masjid').val(null)
    $('#upload-masjid').fadeIn()
    $('#btn-save-masjid').fadeIn()
    $('#btn-update-masjid').hide()
    $('#idNa').val("")
    $('#nama').val("")
    $('#jalan').val("")
    $('#kelurahan').val("")
    $('#kecamatan').val("")
    $('#tahun_berdiri').val("")
    $('#tipiologi').val("")
    $('#luas_tanah').val("")
    $('#luas_bangunan').val("")
    $('#status_tanah').val("")
    $('#sertifikat').val("")
    $('#jml_imam').val("")
    $('#jml_khatib').val("")
    $('#jml_pengurus').val("")
    $('#jml_jamaah').val("")
    $('#kondisi_bangunan').val("")
    $('#keg_remaja_masjid').val("")
    $('#keg_majelis_taklim').val("")
    $('#keg_tpa').val("")
}

function detailMasjid(id) {
    inputPreviewDokumen()
    $('#filena-masjid').val(null)
    $('#file-masjid').val(null)
    $('#upload-masjid').hide()
    ajaxCall(serverApi + "masjid/" + id, null, "GET", "loadDetailMasjid");
}

function loadDetailMasjid(data) {
    $('#btn-save-masjid').hide()
    $('#btn-update-masjid').fadeIn()
    $('#idNa').val(data.id)
    $('#nama').val(data.nama)
    $('#jalan').val(data.jalan)
    $('#kelurahan').val(data.kelurahan)
    $('#kecamatan').val(data.kecamatan)
    $('#tahun_berdiri').val(data.tahun_berdiri)
    $('#tipiologi').val(data.tipiologi)
    $('#luas_tanah').val(data.luas_tanah)
    $('#luas_bangunan').val(data.luas_bangunan)
    $('#status_tanah').val(data.status_tanah)
    $('#sertifikat').val(data.sertifikat)
    $('#jml_imam').val(data.jml_imam)
    $('#jml_khatib').val(data.jml_khatib)
    $('#jml_pengurus').val(data.jml_pengurus)
    $('#kondisi_bangunan').val(data.kondisi_bangunan)
    $('#keg_remaja_masjid').val(data.keg_remaja_masjid)
    $('#keg_majelis_taklim').val(data.keg_majelis_taklim)
    $('#keg_tpa').val(data.keg_tpa)
    $('#jml_jamaah').val(data.jml_jamaah)
}

function updateData() {
    tambahData("PUT")
}

function tambahData(type = "POST") {
    swalTunggu()
    dataNa = {
        'id': $('#idNa').val(),
        'nama': $('#nama').val(),
        'jalan': $('#jalan').val(),
        'kelurahan': $('#kelurahan').val(),
        'kecamatan': $('#kecamatan').val(),
        'tahun_berdiri': $('#tahun_berdiri').val(),
        'tipiologi': $('#tipiologi').val(),
        'luas_tanah': $('#luas_tanah').val(),
        'luas_bangunan': $('#luas_bangunan').val(),
        'status_tanah': $('#status_tanah').val(),
        'sertifikat': $('#sertifikat').val(),
        'jml_imam': $('#jml_imam').val(),
        'jml_khatib': $('#jml_khatib').val(),
        'jml_pengurus': $('#jml_pengurus').val(),
        'jml_jamaah': $('#jml_jamaah').val(),
        'kondisi_bangunan': $('#kondisi_bangunan').val(),
        'keg_remaja_masjid': $('#keg_remaja_masjid').val(),
        'keg_majelis_taklim': $('#keg_majelis_taklim').val(),
        'keg_tpa': $('#keg_tpa').val()
    }

    if ($("#filena-masjid").val() == "") ajaxCall(serverApi + "masjid", JSON.stringify(dataNa), type, "reLoadMasjid");
    else {
        var files = document.getElementById('filena-masjid').files;
        var filename = files[0].name;
        var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
        if (extension == '.XLS' || extension == '.XLSX') {
            dataNa = excelFileToJSON(files[0], 'uploadMasjid');
        } else {
            alert("Please select a valid excel file."); swal.close();
        }
    }
}

function uploadMasjid(dataNa) {
    ajaxCall(serverApi + "upmasjid", JSON.stringify(dataNa), "POST", "reLoadMasjid");
}

function browseFile() {
    $('#filena-masjid').trigger("click")
    $('#btn-upload-masjid').prop('disabled', false)
};

function clearFile() {
    $('#filena-masjid').val(null)
    $('#file-masjid').val(null)
    inputPreviewDokumen()
    $('#btn-upload-masjid').prop('disabled', true)
};

function inputPreviewDokumen() {
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#file-masjid").val(fileName);
    });
}
