@extends ('layout.admin')

@section('content')
    <script src="/js/layout.js"></script>

    <link rel="stylesheet" href="/plugins/datatable/DataTables-1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="/plugins/datatable/Buttons-2.4.1/css/buttons.dataTables.min.css" />

    <script src="/plugins/datatable/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatable/Buttons-2.4.1/js/dataTables.buttons.min.js"></script>

    <script src="/plugins/datatable/Buttons-2.4.1/js/buttons.html5.min.js"></script>
    <script src="/plugins/datatable/Buttons-2.4.1/js/buttons.print.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <div class="content text-black ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4 ">
        <div class="p-4 mb-4 rounded-md bg-white">
            <div class="mb-5 md:mb-0 text-lg font-sans font-semibold"> Daftar Semua Aktivitas </div>
            <div class="flex justify-center mb-2" id="loading-tb-aktivitas">
                <div class="p-2 px-4 rounded-lg shadow-md border bg-blue-500 flex flex-row items-center text-white">
                    <span class="loading loading-ring loading-md mr-2 font-semibold font-sans"></span>
                    Load Data...
                </div>
            </div>
            <table id="tb-aktivitas" class="display" style="width:100%">
            </table>
        </div>
    </div>

    <style>
        .dataTables_info {
            font-size: 12px;
            display: none;
        }

        .dataTables_filter {
            font-size: 14px;
        }

        .modal-box {
            width: 100%;
        }

        @media (min-width: 480px) {
            .modal-box {
                max-width: 55rem;
                max-height: 95%;
            }
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            height: 30px;
            font-size: 12px;
            border-radius: 10px;
        }
    </style>

    <script>
        reloadData()
        showAllAktivitas()

        function reloadData() {
            $("#loading-tb-aktivitas").fadeIn()
            // ajaxCall(serverApi + 'allnasabah', null, "GET", "showAllAktivitas")
        }

        function showAllAktivitas(dataNa) {
            restyleButton()
            var elementId = "tb-aktivitas";
            $("#loading-tb-aktivitas").hide();
            document.getElementById(elementId).innerHTML =
                '<thead><tr><th>#</th><th>Aktivitas</th><th>Waktu</th></tr></thead>'
            var t = "<tbody>";
            let k = 0;
            for (let i = 0; i < 12; i++) {
                k++;
                var tr = '<tr class="align-center">';
                tr += '<td class="text-center align-middle" nowrap>' + k + '</td>';
                tr +=
                    '<td class="text-left align-middle text-sm font-sans" nowrap>Nasabah N2390293 selesai mengisi Profil</td>';
                tr += '<td class="text-center align-middle text-sm font-sans" nowrap>1 September 2023, 20:00</td>';
                tr += "</td></tr>";
                t += tr;
            }

            // dataNa.forEach(data => {
            //     var tr = '<tr class="align-center">';
            //     var idUserna = data['iduser']
            //     tr +=
            //         '<td class="text-center align-middle" nowrap><label id="btnPromo" for="modalProfil" data-ripple-light="true"' +
            //         'class="cursor-pointer rounded-md bg-gradient-to-tr from-green-600 to-green-400 py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40">' +
            //         data["iduser"] + "</label></td>";
            //     tr += '<td class="text-left align-middle" nowrap>' + data["ktp"] + "</td>";
            //     tr += '<td class="text-left align-middle" nowrap><div class="val_iduser" hidden>' + idUserna +
            //         '</div><div>' + data["nama"] + "</div></td > ";
            //     if (data["status"] == "0") {
            //         tr +=
            //             '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-red-800 shadow-md shadow-green-500/20 transition-all">' +
            //             'Tidak Aktif' + "</button></td>";
            //     } else {
            //         tr +=
            //             '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-green-800 shadow-md shadow-green-500/20 transition-all">' +
            //             'Aktif' + "</button></td>";
            //     }
            //     if (data["validasi"] == "0") {
            //         tr +=
            //             '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-red-800 shadow-md shadow-green-500/20 transition-all">' +
            //             'Belum diperiksa' + "</button>";
            //     } else if (data["validasi"] == "1") {
            //         tr +=
            //             '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-red-800 shadow-md shadow-green-500/20 transition-all">' +
            //             'Data Tidak Valid' + "</button>";
            //     } else {
            //         tr +=
            //             '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-green-800 shadow-md shadow-green-500/20 transition-all">' +
            //             'Data Valid' + "</button>";
            //     }

            //     tr += "</td></tr>";
            //     t += tr;
            // })

            t += "</tbody>";
            buildTableNoExport(t, elementId)
        }

        $(document).on("click", "#btnPromo", function() {
            $('#simpanValidasi').hide()
            var row = $(this).closest("tr")
            var id = row.find(".val_iduser").text()
            ajaxCall(serverApi + 'nasabah/' + id, null, "GET", "getNasabah")
        })

        function getPromo(data) {
            if (role == "99" || role == "1") {
                $('#valAdmin').show()
                $('#valNonAdmin').hide()
                $('#ketAdmin').show()
                $('#ketNonAdmin').hide()
                $('#validasi').prop('disabled', false)
                $('#ket_validasi').prop('disabled', false)
            } else {
                $('#valAdmin').hide()
                $('#valNonAdmin').show()
                $('#ketAdmin').hide()
                $('#ketNonAdmin').show()
                $('#validasi').prop('disabled', true)
                $('#ket_validasi').prop('disabled', true)
            }

            $('#nama').val(data.nama)
            $('#email').val(data.email)
            $('#phone').val(data.phone)
            $('#alamat').val(data.alamat)
            $('#id_privy').val(data.id_privy)
            $('#ktp').val(data.ktp)
            $('#tmpt_lahir').val(data.tmpt_lahir)
            $('#tgl_lahir').val(data.tgl_lahir)
            $('#ibu_kandung').val(data.ibu_kandung)
            $('#status_pernikahan').val(data.status_pernikahan)
            $('#jenis_pekerjaan').val(data.jenis_pekerjaan)
            $('#nama_perusahaan').val(data.nama_perusahaan)
            $('#alamat_kerja').val(data.alamat_kerja)
            $('#penghasilan').val(data.penghasilan)
            $('#nama_ahli_waris').val(data.nama_ahli_waris)
            $('#ktp_ahli_waris').val(data.ktp_ahli_waris)
            $('#phone_ahli_waris').val(data.phone_ahli_waris)
            $('#hub_ahli_waris').val(data.hub_ahli_waris)
            $('#namaBank').val(data.namaBank)
            $('#norek').val(data.norek)
            $('#atas_nama').val(data.atas_nama)
            $('#id').val(data.id_user)
            $('#validasi').val(data.validasi)
            $('#ket_validasi').val(data.ket_validasi)
            valValidasi = data.validasi

            var bankNa = ''
            data.listbank.forEach(e => {
                bankNa += '<li><a>' + e.norek + ' ' + e.bank + '<br>' + e.atas_nama + '</a></li>'
            });
            if (bankNa == '') {
                $('#listBank').html('<li><a>Belum Ada</a></li>')
            } else {
                $('#listBank').html(bankNa)
            }

            $('#image_ktp').val(data.image_ktp)
            $('#image_selfie').val(data.image_selfie)
            $('#image_ktp_ahli_waris').val(data.image_ktp_ahli_waris)

            $('#ketFotoKtp').text('Foto KTP')
            $('#ketFotoSelfie').text('Foto Selfie')
            $('#ketFotoKtpAhliWaris').text('Foto KTP Ahli Waris')

            if ($('#image_ktp').val() == "") {
                $('#ketFotoKtp').text('KTP Belum Ada')
            } else {
                $('#btnimage_ktp').removeClass('pointer-events-none')
            }
            if ($('#image_selfie').val() == "") {
                $('#ketFotoSelfie').text('Selfie Belum Ada')
            } else {
                $('#btnimage_selfie').removeClass('pointer-events-none')
            }
            if ($('#image_ktp_ahli_waris').val() == "") {
                $('#ketFotoKtpAhliWaris').text('KTP Ahli Waris Belum Ada')
            } else {
                $('#btnimage_ktp_ahli_waris').removeClass('pointer-events-none')
            }
        }
    </script>
@endsection
