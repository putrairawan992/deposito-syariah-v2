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
            <div class="mb-5 md:mb-0 text-lg font-sans font-semibold"> Daftar Semua Portofolio </div>
            <div class="flex justify-center mb-2" id="loading-tb-transaksi">
                <div class="p-2 px-4 rounded-lg shadow-md border bg-blue-500 flex flex-row items-center text-white">
                    <span class="loading loading-ring loading-md mr-2 font-semibold font-sans"></span>
                    Load Data...
                </div>
            </div>
            <table id="tb-transaksi" class="display" style="width:100%">
            </table>
        </div>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="modalTransaksi" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-white text-gray-800" style="max-width: 30rem">
            <div class="font-sans font-semibold -mt-2 mb-2 text-lg" id="titleModalTransaksi">Detail Portofolio T23232107
            </div>
            <label for="modalTransaksi" class="absolute top-3 right-4 text-xl cursor-pointer"><i
                    class="far fa-times-circle"></i></label>
            <div class="font-semibold text-base">BPR Kencana</div>
            <div class="flex flex-col mb-2">
                <div class="h-1 w-1 rounded-full bg-black"></div>
                <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
            </div>
            <div class="flex justify-between">
                <div>
                    <div>Pilihan Tenor</div>
                    <div>3 Bulan</div>
                </div>
                <div>
                    <div>Bagi Hasil Setara</div>
                    <div>5% / Tahun</div>
                </div>
            </div>
            <div class="flex flex-col my-2">
                <div class="h-1 w-1 rounded-full bg-black"></div>
                <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
            </div>
            <div class="flex justify-between">
                <div>Pengajuan Deposito</div>
                <div>Rp 10.000.000</div>
            </div>
            <div class="flex justify-between">
                <div>Estimasi Bagi Hasil Setara / Tahun</div>
                <div>Rp 125.000</div>
            </div>
            <div class="flex justify-between">
                <div>Estimasi Total Pengembalian</div>
                <div>Rp 10.125.000</div>
            </div>
            <div class="flex flex-col my-2">
                <div class="h-1 w-1 rounded-full bg-black"></div>
                <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
            </div>
            <div class="flex justify-between">
                <div>Nama Bank</div>
                <div>Bank BNI</div>
            </div>
            <div class="flex justify-between">
                <div>No Rekening</div>
                <div>1232992982</div>
            </div>
            <div class="flex justify-between">
                <div>Nama Pemilik Rekening</div>
                <div>Ahmad</div>
            </div>
            <div class="flex flex-col my-2">
                <div class="h-1 w-1 rounded-full bg-black"></div>
                <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
            </div>
            <div class="my-2">Lacak Proses</div>
            <div class="flex items-center mb-2">
                <i class="fas fa-check-circle text-xl mr-2" style="color: green"></i>
                <div>Pengajuan Deposito</div>
            </div>
            <div class="flex items-center mb-2">
                <i class="fas fa-check-circle text-xl mr-2" style="color: green"></i>
                <div>Dokumen Telah di Tanda Tangani</div>
            </div>
            <div class="flex items-center mb-2">
                <i class="fas fa-check-circle text-xl mr-2" style="color: green"></i>
                <div>Pengajuan Disetujui BPR</div>
            </div>
            <div class="flex items-center mb-2">
                <i class="fas fa-check-circle text-xl mr-2" style="color: green"></i>
                <div>Pembayaran Berhasil</div>
            </div>
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
        showAllPromo()

        function reloadData() {
            $("#loading-tb-transaksi").fadeIn()
            // ajaxCall(serverApi + 'allnasabah', null, "GET", "showAllPromo")
        }

        function showAllPromo(dataNa) {
            restyleButton()
            var elementId = "tb-transaksi";
            $("#loading-tb-transaksi").hide();
            document.getElementById(elementId).innerHTML =
                '<thead><tr><th>Kode</th><th>Mitra</th><th>Nasabah</th><th>Bagi Hasil</th><th>Nisbah</th><th>Tenor</th><th>Status</th><th>Closing</th></tr></thead>'
            var t = "<tbody>";
            for (let i = 0; i < 12; i++) {
                var tr = '<tr class="align-center">';
                tr +=
                    '<td class="text-center align-middle" nowrap><label id="btnMitra" for="modalTransaksi" data-ripple-light="true"' +
                    'class="cursor-pointer rounded-md bg-gradient-to-tr from-green-600 to-green-400 py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40">' +
                    "T23232107</label></td>";
                tr += '<td class="text-left align-middle" nowrap>PT BPR B</td>';
                tr += '<td class="text-left align-middle" nowrap>Ahmad Bahri</td>';
                tr += '<td class="text-left align-middle" nowrap>5% / Tahun</td>';
                tr += '<td class="text-left align-middle" nowrap>40:60</td>';
                tr += '<td class="text-left align-middle" nowrap>6 Bulan</td>';
                tr +=
                    '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-green-500 shadow-md shadow-green-500/20 transition-all">' +
                    'Aktif' + "</button></td>";
                tr += '<td class="text-left align-middle text-sm font-sans" nowrap>1 Desember 2023</td>';
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
