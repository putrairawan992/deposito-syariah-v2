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
            <div class="mb-5 md:mb-0 text-lg font-sans font-semibold"> Daftar Splash Screen </div>
            <div class="flex justify-center mb-2" id="loading-tb-splah">
                <div class="p-2 px-4 rounded-lg shadow-md border bg-blue-500 flex flex-row items-center text-white">
                    <span class="loading loading-ring loading-md mr-2 font-semibold font-sans"></span>
                    Load Data...
                </div>
            </div>
            <table id="tb-splah" class="display" style="width:100%">
            </table>
        </div>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="modalSplash" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-white text-gray-800" style="max-width: 25rem; max-height: 100%">
            <label for="modalSplash" class="absolute top-3 right-4 text-xl cursor-pointer"><i
                    class="far fa-times-circle"></i></label>
            <div class="mt-5 relative z-0 h-11 w-full min-w-[200px]">
                <input name="splash" id="splash"
                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                    type="file" accept="image/png, image/gif, image/jpeg" placeholder=" " />
                <label
                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                    Upload Splash Screen
                </label>
            </div>

            <img class="cursor-pointer object-cover h-96 rounded-md w-full my-4"
                src="https://static.bmdstatic.com/st/home/76e4c0-MB.jpg" alt="">

            <div class="mb-3 relative h-10 w-full min-w-[200px]">
                <select readonly id="urutan"
                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                    <option value="">-- Tidak Ditentukan --</option>
                    <option value="1">1</option>
                    <option value="2" selected>2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
                <label
                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                    Urutan Tampilan
                </label>
            </div>

            <div class="mb-3 relative h-10 w-full min-w-[200px]">
                <select readonly id="status"
                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                    <option value="0">Tidak Aktif</option>
                    <option value="1">Aktif</option>
                </select>
                <label
                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                    Status Splash Screen
                </label>
            </div>

            <div class="mb-3 relative h-10 w-full min-w-[200px]">
                <textarea readonly id="deskripsi" name="deskripsi"
                    class="h-14 peer w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                    placeholder=" "></textarea>
                <label
                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                    Deskripsi
                </label>
            </div>

            <div class="modal-action -mb-2">
                <button data-ripple-light="true" onclick="simpanSplash()" type="button"
                    class="border text-sm hover:shadow-lg
                    hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                    lg:px-5 block p-1 leading-normal text-inherit antialiased text-blue-gray-400">
                    Edit</button>
                <button data-ripple-light="true" onclick="simpanSplash()" type="button"
                    class="bg-gradient-to-tr from-green-600 to-green-400 text-sm hover:shadow-lg
                    hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                    lg:px-5 block p-1 leading-normal text-inherit antialiased text-white">
                    Simpan</button>
                <label for="modalSplash" data-ripple-light="true" type="button"
                    class="border text-sm hover:shadow-lg cursor-pointer
                    hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                    lg:px-5 block p-1 leading-normal text-inherit antialiased text-blue-gray-400">
                    Close</label>
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
            $("#loading-tb-splah").fadeIn()
            // ajaxCall(serverApi + 'allnasabah', null, "GET", "showAllPromo")
        }

        function showAllPromo(dataNa) {
            restyleButton()
            var elementId = "tb-splah";
            $("#loading-tb-splah").hide();
            document.getElementById(elementId).innerHTML =
                '<thead><tr><th>Gambar</th><th>Deskripsi</th><th>Urutan</th><th>Status</th><th>Pembuat</th></tr></thead>'
            var t = "<tbody>";
            let k = 0;
            for (let i = 0; i < 12; i++) {
                k++;
                var tr = '<tr class="align-center">';
                tr +=
                    '<td class="text-left align-middle" nowrap><label for="modalSplash"><img class="cursor-pointer object-cover h-16 w-36 rounded-md"' +
                    'src="https://static.bmdstatic.com/st/home/76e4c0-MB.jpg" alt=""></label></td>';
                tr +=
                    '<td class="text-left align-middle text-sm"><p>Ada Promo Bank dan Partner, Ayo Bergabung sebelum Kehabisan promonya</p></td>';
                tr += '<td class="text-center align-middle text-sm font-sans" nowrap>' + k + '</td>';
                tr +=
                    '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-green-500 shadow-md shadow-green-500/20 transition-all">' +
                    'Aktif' + "</button></td>";
                tr += '<td class="text-left align-middle text-sm font-sans" nowrap>Admin</td>';
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
