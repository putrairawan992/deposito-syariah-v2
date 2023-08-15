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
            <div class="mb-3 text-lg font-sans font-semibold"> Daftar Nasabah </div>
            <div class="flex justify-center mb-2" id="loading-tb-nasabah">
                <div class="p-2 px-4 rounded-lg shadow-md border bg-blue-500 flex flex-row items-center text-white">
                    <span class="loading loading-ring loading-md mr-2"></span>
                    Load Data...
                </div>
            </div>
            <table id="tb-nasabah" class="display" style="width:100%">
            </table>
        </div>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="modalProfil" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-white text-gray-800">
            <label for="modalProfil" class="absolute top-3 right-4 text-xl cursor-pointer" onclick="clearImg()"><i
                    class="far fa-times-circle"></i></label>
            <div class="flex flex-col sm:flex-row">

                <div class="w-full sm:w-1/3 mx-0 sm:mx-5">
                    <div class="font-semibold">Identitas</div>
                    <div class="flex flex-col mb-4">
                        <div class="h-1 w-1 rounded-full bg-black"></div>
                        <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="nama"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Nama Lengkap Sesuai KTP
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="email"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            type="email" placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Email
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="phone"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            No Telepon
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="alamat"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Alamat Sekarang
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="id_privy"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            PrivyID
                        </label>
                    </div>

                    <div class="font-semibold" style="margin-top:20px">Foto Nasabah</div>
                    <div class="flex flex-col mb-4">
                        <div class="h-1 w-1 rounded-full bg-black"></div>
                        <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <label id="btnimage_ktp" tabindex="0" for="modalImage" onclick="showimage_ktp()"
                            class="flex-row flex items-center middle none center rounded-md cursor-pointer
                                py-2 px-3 font-sans font-bold text-blue-gray-400 border shadow-md shadow-green-500/20 transition-all hover:shadow-lg
                                hover:shadow-green-500/40 active:opacity-[0.85] pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            data-ripple-light="true">
                            <i class="fas fa-id-card text-sm mr-2"></i>
                            <div class="text-sm" id="ketFotoKtp">Foto KTP</div>
                        </label>
                        <input hidden id="image_ktp" />
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <label id="btnimage_selfie" tabindex="0" for="modalImage" onclick="showimage_selfie()"
                            class="flex-row flex items-center middle none center rounded-md cursor-pointer
                                py-2 px-3 font-sans font-bold text-blue-gray-400 border shadow-md shadow-green-500/20 transition-all hover:shadow-lg
                                hover:shadow-green-500/40 active:opacity-[0.85] pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            data-ripple-light="true">
                            <i class="fas fa-portrait text-sm mr-2"></i>
                            <div class="text-sm" id="ketFotoSelfie">Foto Selfie</div>
                        </label>
                        <input hidden id="image_selfie" />
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <label id="btnimage_ktp_ahli_waris" tabindex="0" for="modalImage"
                            onclick="showimage_ktp_ahli_waris()"
                            class="flex-row flex items-center middle none center rounded-md cursor-pointer
                                py-2 px-3 font-sans font-bold text-blue-gray-400 border shadow-md shadow-green-500/20 transition-all hover:shadow-lg
                                hover:shadow-green-500/40 active:opacity-[0.85] pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            data-ripple-light="true">
                            <i class="fas fa-id-card text-sm mr-2"></i>
                            <div class="text-sm" id="ketFotoKtpAhliWaris">Foto KTP Ahli Waris</div>
                        </label>
                        <input hidden id="image_ktp_ahli_waris" />
                    </div>

                </div>

                <div class="w-full sm:w-1/3 mx-0 sm:mx-5">
                    <div class="font-semibold">Detail</div>
                    <div class="flex flex-col mb-4">
                        <div class="h-1 w-1 rounded-full bg-black"></div>
                        <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="ktp"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            No KTP
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="tmpt_lahir"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Tempat Lahir
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="tgl_lahir"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            type="date" placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Tanggal Lahir
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="ibu_kandung"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Nama Ibu Kandung
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <select id="status_pernikahan" disabled
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                            <option value="0">Belum Menikah</option>
                            <option value="1">Menikah</option>
                            <option value="2">Duda / Janda</option>
                        </select>
                        <label class="absolute left-3 text-xs text-blue-gray-400 bg-white px-2 font-sans rounded-md"
                            style="top: -8px">
                            Status Pernikahan
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="jenis_pekerjaan"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Profesi / Pekerjaan
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="nama_perusahaan"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Nama Perusahaan
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="alamat_kerja"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Alamat Perusahaan
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <select id="penghasilan" disabled
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                            <option value="1">dibawah Rp 5 juta</option>
                            <option value="2">Rp 5 - 10 juta</option>
                            <option value="3">Rp 10 - 20 juta</option>
                            <option value="4">Rp 20 - 50 juta</option>
                            <option value="5">diatas Rp 50 juta</option>
                        </select>
                        <label class="absolute left-3 text-xs text-blue-gray-400 bg-white px-2 font-sans rounded-md"
                            style="top: -8px">
                            Penghasilan
                        </label>
                    </div>
                </div>

                <div class="w-full sm:w-1/3 mx-0 sm:mx-5">
                    <div class="font-semibold">Ahli Waris</div>
                    <div class="flex flex-col mb-4">
                        <div class="h-1 w-1 rounded-full bg-black"></div>
                        <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="nama_ahli_waris"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Nama Lengkap Ahli Waris
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="ktp_ahli_waris"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            No KTP Ahli Waris
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="phone_ahli_waris"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            No Telepon Ahli Waris
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="hub_ahli_waris"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Hubungan dengan Ahli Waris
                        </label>
                    </div>

                    <div class="font-semibold mt-5">Rekening Nasabah</div>
                    <div class="flex flex-col mb-4">
                        <div class="h-1 w-1 rounded-full bg-black"></div>
                        <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
                    </div>

                    <div class="dropdown">
                        <label tabindex="0"
                            class="flex-row flex items-center middle none center rounded-md cursor-pointer
                                py-2 px-3 font-sans font-bold text-blue-gray-400 border shadow-md shadow-green-500/20 transition-all hover:shadow-lg
                                hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            data-ripple-light="true">
                            <i class="fas fa-wallet text-sm mr-2"></i>
                            <div class="text-sm">Daftar Bank</div>
                        </label>
                        <ul tabindex="0" id="listBank"
                            class="bg-white dropdown-content z-[1] menu p-1 text-sm shadow rounded-md w-64 text-gray-700">
                            <li><a>Belum Ada</a></li>
                        </ul>
                    </div>

                    <div class="font-semibold mt-6">Di Isi Validator</div>
                    <div class="flex flex-col mb-4">
                        <div class="h-1 w-1 rounded-full bg-black"></div>
                        <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
                    </div>
                    <input hidden id="id" />
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <select id="validasi" onchange="ketValidasi()"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                            <option value="0">Belum Periksa</option>
                            <option value="1">Belum Valid</option>
                            <option value="2">Sudah Valid</option>
                            <option value="3">Non Aktifkan Nasabah</option>
                        </select>
                        <label id="valAdmin"
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Validasi Admin
                        </label>
                        <label class="absolute left-3 text-xs text-blue-gray-400 bg-white px-2 font-sans rounded-md"
                            style="top: -8px" id="valNonAdmin">
                            Validasi Admin
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input id="ket_validasi"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label id="ketAdmin"
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Keterangan Validasi
                        </label>
                        <label class="absolute left-3 text-xs text-blue-gray-400 bg-white px-2 font-sans rounded-md"
                            style="top: -8px" id="ketNonAdmin">
                            Keterangan Validasi
                        </label>
                    </div>
                </div>

            </div>
            <div class="modal-action mt-0">
                <button data-ripple-light="true" onclick="simpanValidasi()" id="simpanValidasi"
                    class="bg-gradient-to-tr from-green-600 to-green-400 text-sm mr-2 hover:shadow-lg
                    hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                    lg:px-5 block p-1 leading-normal text-inherit antialiased text-white">
                    Simpan</button>
            </div>
        </div>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="modalImage" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-white text-gray-800" style="max-width: 45rem">
            <label for="modalImage" class="absolute top-3 right-4 text-xl cursor-pointer"><i
                    class="far fa-times-circle"></i></label>
            <div class="flex justify-center items-center">
                <img src="" alt="fotoNasabah" class="object-cover" style="height: 550px" id="showFoto">
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
        var valValidasi = null
        reloadData()
        ajaxCall(serverApi + 'kota', null, "GET", "showKota")

        function showKota(data) {}

        function restyleButton() {
            setTimeout(function() {
                $('.dt-button').css('border-radius', '10px').css('margin-right', '-5px').css('height', '33px').css(
                    'font-size', '12px').css('background-color', '#4CAF50').css('color', 'white')
            }, 700)
        }

        function reloadData() {
            $("#loading-tb-nasabah").fadeIn()
            ajaxCall(serverApi + 'allnasabah', null, "GET", "showAllNasabah")
        }

        function showAllNasabah(dataNa) {
            restyleButton()
            var elementId = "tb-nasabah";
            $("#loading-tb-nasabah").hide();
            document.getElementById(elementId).innerHTML =
                '<thead><tr><th>#</th><th>KTP</th><th>Nama</th><th>Status</th><th>Validasi</th></tr> </thead>'
            var t = "<tbody>";
            dataNa.forEach(data => {
                var tr = '<tr class="align-center">';
                var idUserna = data['iduser']
                tr +=
                    '<td class="text-center align-middle" nowrap><label id="btnNasabah" for="modalProfil" data-ripple-light="true"' +
                    'class="cursor-pointer rounded-md bg-gradient-to-tr from-green-600 to-green-400 py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40">' +
                    data["iduser"] + "</label></td>";
                tr += '<td class="text-left align-middle" nowrap>' + data["ktp"] + "</td>";
                tr += '<td class="text-left align-middle" nowrap><div class="val_iduser" hidden>' + idUserna +
                    '</div><div>' + data["nama"] + "</div></td > ";
                if (data["status"] == "0") {
                    tr +=
                        '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-red-800 shadow-md shadow-green-500/20 transition-all">' +
                        'Tidak Aktif' + "</button></td>";
                } else {
                    tr +=
                        '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-green-800 shadow-md shadow-green-500/20 transition-all">' +
                        'Aktif' + "</button></td>";
                }
                if (data["validasi"] == "0") {
                    tr +=
                        '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-red-800 shadow-md shadow-green-500/20 transition-all">' +
                        'Belum diperiksa' + "</button>";
                } else if (data["validasi"] == "1") {
                    tr +=
                        '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-red-800 shadow-md shadow-green-500/20 transition-all">' +
                        'Data Tidak Valid' + "</button>";
                } else {
                    tr +=
                        '<td class="text-left align-middle" nowrap><button class="pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-green-800 shadow-md shadow-green-500/20 transition-all">' +
                        'Data Valid' + "</button>";
                }

                tr += "</td></tr>";
                t += tr;
            })
            t += "</tbody>";
            buildTableNoExport(t, elementId)
        }

        $(document).on("click", "#btnNasabah", function() {
            $('#simpanValidasi').hide()
            var row = $(this).closest("tr")
            var id = row.find(".val_iduser").text()
            ajaxCall(serverApi + 'nasabah/' + id, null, "GET", "getNasabah")
        })

        function getNasabah(data) {
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

        function ketValidasi() {
            if (role == "99" || role == "1") {
                if (valValidasi != $('#validasi').val()) {
                    $('#simpanValidasi').fadeIn()
                    $('#validasi').val() == "2" ? $('#ket_validasi').val('Data Sudah Valid') : $('#ket_validasi').val('')
                } else {
                    $('#simpanValidasi').hide()
                }
            }
        }

        function simpanValidasi() {
            dataNa = {
                'id': $('#id').val(),
                'validasi': $('#validasi').val(),
                'ket_validasi': $('#ket_validasi').val()
            }

            ajaxCall(serverApi + 'validasinasabah', JSON.stringify(dataNa), "PUT", "afterSimpanValidasi")
        }

        function afterSimpanValidasi(data) {
            swalBerhasil('Berhasil', 'Data ' + data)
            $('#closeDetailNasabah').click()
            reloadData()
        }

        function showimage_ktp() {
            var link = $('#image_ktp').val()
            $("#showFoto").attr("src", '../' + link);
        }

        function showimage_selfie() {
            var link = $('#image_selfie').val()
            $("#showFoto").attr("src", '../' + link);
        }

        function showimage_ktp_ahli_waris() {
            var link = $('#image_ktp_ahli_waris').val()
            $("#showFoto").attr("src", '../' + link);
        }

        function clearImg() {
            dataNa = {
                'img': $('#image_ktp').val(),
            }
            if ($('#image_ktp').val() != "") {
                ajaxCall(serverApi + 'clearImg', dataNa, "GET", 'clearImg')
            }

            dataNa = {
                'img': $('#image_selfie').val(),
            }
            if ($('#image_selfie').val() != "") {
                ajaxCall(serverApi + 'clearImg', dataNa, "GET", 'clearImg')
            }

            dataNa = {
                'img': $('#image_ktp_ahli_waris').val(),
            }
            if ($('#image_ktp_ahli_waris').val() != "") {
                ajaxCall(serverApi + 'clearImg', dataNa, "GET", 'clearImg')

            }
        }
    </script>
@endsection
