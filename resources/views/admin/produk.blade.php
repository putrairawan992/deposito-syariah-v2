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
            <div class="md:flex md:items-center md:justify-between mb-2 md:mb-4">
                <div class="mb-3 md:mb-0 text-lg font-sans font-semibold"> Daftar Produk </div>
                <div id="mitraInfo" hidden
                    class="mt-2 md:mt-0 w-full flex items-center bg-gray-200 rounded-md shadow-sm shadow-gray-600"
                    style="max-width: 700px">
                    <i class="fas fa-exclamation-circle text-xl ml-4 mr-2"></i>
                    <p class="text-sm p-2">
                        Admin Mitra dapat menambahkan, mengganti, dan menghapus produk dari masing-masing Mitra.
                    </p>
                </div>
            </div>
            <div class="flex justify-end mb-3">
                <label for="modalProduk" data-ripple-light="true" id="addProduk" onclick="addProduk()" hidden
                    class="bg-gradient-to-tr from-green-600 to-green-400 text-sm hover:shadow-lg
                    hover:shadow-green-500/40 whitespace-nowrap rounded-lg sm:px3 px-2 cursor-pointer
                    block p-2 leading-normal text-inherit antialiased text-white">
                    <i class="fas fa-plus-circle text-sm mr-2"></i>Daftarkan Produk</label>
            </div>
            <div class="flex justify-center mb-2" id="loading-tb-produk">
                <div class="p-2 px-4 rounded-lg shadow-md border bg-blue-500 flex flex-row items-center text-white">
                    <span class="loading loading-ring loading-md mr-2 font-semibold font-sans"></span>
                    Load Data...
                </div>
            </div>
            <table id="tb-produk" class="display" style="width:100%">
            </table>
        </div>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="modalProduk" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-white text-gray-800" style="max-width: 20rem">
            <div class="font-sans font-semibold -mt-2 mb-2 text-lg" id="titleModalProduk">Detail Produk</div>
            <label for="modalProduk" class="absolute top-3 right-4 text-xl cursor-pointer" id="closeModalProduk"><i
                    class="far fa-times-circle"></i></label>
            <div class="text-white text-xs font-sans mt-5">
                <form id="form-produk">
                    <input type="text" hidden id="no_produk" name="no_produk">
                    <div class="mb-3 relative h-10 w-full min-w-[200px]" id="namaBank">
                        <input readonly id="bankName"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Nama Bank
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="minimal" name="minimal"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Minimal Deposito
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="target" name="target"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Target Dana Terkumpul
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="nisbah" name="nisbah"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Nisbah
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="bagi_hasil" name="bagi_hasil"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Bagi Hasil Setara / Tahun
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <select id="tenor" name="tenor"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                            <option value="0">-- Pilih Tenor --</option>
                            <option value="6">6 Bulan</option>
                            <option value="12">12 Bulan</option>
                            <option value="18">18 Bulan</option>
                            <option value="24">24 Bulan</option>
                            <option value="30">30 Bulan</option>
                            <option value="36">36 Bulan</option>
                        </select>
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Tenor
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="start_date" name="start_date" onfocus="this.showPicker()" type="date"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Tanggal Mulai
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="end_date" name="end_date" onfocus="this.showPicker()" type="date"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Tanggal Berakhir
                        </label>
                    </div>

                </form>
            </div>
            <div class="modal-action">
                <button data-ripple-light="true" onclick="simpanProduk()" type="button" hidden id="btnSimpanProduk"
                    class="bg-gradient-to-tr from-green-600 to-green-400 text-sm hover:shadow-lg
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                            lg:px-5 block p-1 leading-normal text-inherit antialiased text-white">
                    Simpan</button>
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

        function reloadData() {
            $("#loading-tb-produk").fadeIn()
            ajaxCall(serverApi + 'produk', null, "GET", "showAllProduk")
        }

        function showAllProduk(dataNa) {
            restyleButton()
            var elementId = "tb-produk";
            $("#loading-tb-produk").hide();
            document.getElementById(elementId).innerHTML =
                '<thead><tr><th>Kode</th><th>Mitra</th><th>Min Deposito</th><th>Bagi Hasil</th><th>Nisbah</th><th>Tenor</th><th>Status</th><th>Expire</th></tr> </thead>'
            var t = "<tbody>";
            dataNa.forEach(e => {
                var tr = '<tr class="align-center">';
                tr +=
                    '<td id="btnProduk" class="text-center align-middle" nowrap><label for="modalProduk" data-ripple-light="true"' +
                    'class="cursor-pointer rounded-md bg-gradient-to-tr from-green-600 to-green-400 py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40">' +
                    e.no_produk + "</label></td>";
                tr += '<td class="text-left align-middle" nowrap>' + e.nama +
                    '<div hidden class="val_idproduk">' + e.no_produk + ' </div></td>';
                tr += '<td class="text-left align-middle" nowrap>Rp ' + numbFor(e.minimal) + '</td>';
                tr += '<td class="text-left align-middle" nowrap>' + e.bagi_hasil + ' % / Tahun</td>';
                tr += '<td class="text-left align-middle" nowrap>' + e.nisbah + '</td>';
                tr += '<td class="text-left align-middle" nowrap>' + e.tenor + ' Bulan</td>';
                if (e.status == "1") {
                    tr +=
                        '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-green-800 shadow-md shadow-green-500/20 transition-all">' +
                        'Aktif' + "</button></td>";
                } else {
                    tr +=
                        '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-red-800 shadow-md shadow-green-500/20 transition-all">' +
                        'Tidak Aktif' + "</button></td>";
                }
                tr += '<td class="text-left align-middle" nowrap>' + e.expire + '</td>';
                tr += "</td></tr>";
                t += tr;
            });

            t += "</tbody>";
            buildTableNoExport(t, elementId)
        }

        $(document).on("click", "#btnProduk", function() {
            var row = $(this).closest("tr")
            var id = row.find(".val_idproduk").text()
            ajaxCall(serverApi + 'produk/' + id, null, "GET", "getProduk")
        })

        function getProduk(data) {
            $('#titleModalProduk').text('Detail ' + data.no_produk)
            $('#minimal').prop('readonly', true)
            $('#target').prop('readonly', true)
            $('#nisbah').prop('readonly', true)
            $('#bagi_hasil').prop('readonly', true)
            $('#tenor').prop('readonly', true)
            $('#start_date').prop('readonly', true)
            $('#end_date').prop('readonly', true)

            if (role == 2) {
                $('#minimal').prop('readonly', false)
                $('#target').prop('readonly', false)
                $('#nisbah').prop('readonly', false)
                $('#bagi_hasil').prop('readonly', false)
                $('#tenor').prop('readonly', false)
                $('#start_date').prop('readonly', false)
                $('#end_date').prop('readonly', false)
            }

            $('#namaBank').show()
            $('#bankName').val(data.nama)
            $('#no_produk').val(data.no_produk)
            $('#minimal').val(data.minimal)
            $('#target').val(data.target)
            $('#nisbah').val(data.nisbah)
            $('#bagi_hasil').val(data.bagi_hasil)
            $('#tenor').val(data.tenor)
            $('#start_date').val(data.start_date)
            $('#end_date').val(data.end_date)

        }

        function addProduk() {
            $('#namaBank').hide()
            $('#titleModalProduk').text('Tambah Produk')
            $('#minimal').prop('readonly', false)
            $('#target').prop('readonly', false)
            $('#nisbah').prop('readonly', false)
            $('#bagi_hasil').prop('readonly', false)
            $('#tenor').prop('readonly', false)
            $('#start_date').prop('readonly', false)
            $('#end_date').prop('readonly', false)

            $('#bankName').val('')
            $('#no_produk').val('')
            $('#minimal').val('')
            $('#target').val('')
            $('#nisbah').val('')
            $('#bagi_hasil').val('')
            $('#tenor').val('0')
            $('#start_date').val('')
            $('#end_date').val('')
        }

        function simpanProduk() {
            swalTunggu()
            dataNa = new FormData(document.getElementById("form-produk"))
            url = serverApi + 'produk'
            $.ajax({
                url: url,
                type: "POST",
                data: dataNa,
                crossDomain: true,
                data: dataNa,
                dataType: "json",
                contentType: "multipart/form-data",
                processData: false,
                contentType: false,
                beforeSend: function(xhr, settings) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                headers: {
                    Accept: "application/json",
                },
                success: function(data) {
                    afterSimpanProduk(data)
                },
                error: function(xhr, XMLHttpRequest, textStatus, errorThrown) {
                    swal({
                        icon: "error",
                        title: "Gagal",
                        text: xhr.responseText,
                        button: false,
                    });
                },
            });
        }

        function afterSimpanProduk(data) {
            swalBerhasil('Berhasil', data)
            $('#closeModalProduk').click()
            reloadData()
        }
    </script>
@endsection
