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
                <div class="mb-3 md:mb-0 text-lg font-sans font-semibold"> Akses User </div>
                <div class="mt-2 md:mt-0 w-full flex items-center bg-gray-200 rounded-md shadow-sm shadow-gray-600"
                    style="max-width: 1000px">
                    <i class="fas fa-exclamation-circle text-xl ml-4 mr-2"></i>
                    <p class="text-sm p-2">
                        Admin dapat memberikan akses user untuk masing-masing role seperti Admin CS, dan Admin Admin BPR.
                        Serta melihat status semua user Admin.
                    </p>
                </div>
            </div>
            <div class="flex justify-end mb-3">
                <label for="modalAdmin" data-ripple-light="true" id="addAdmin" onclick="newAdmin()"
                    class="bg-gradient-to-tr from-green-600 to-green-400 text-sm hover:shadow-lg
                    hover:shadow-green-500/40 whitespace-nowrap rounded-lg sm:px3 px-2 cursor-pointer
                    block p-2 leading-normal text-inherit antialiased text-white">
                    <i class="fas fa-plus-circle text-sm mr-2"></i>Daftarkan Admin</label>
            </div>
            <div class="flex justify-center mb-2" id="loading-tb-akses">
                <div class="p-2 px-4 rounded-lg shadow-md bg-blue-500 flex flex-row items-center text-white">
                    <span class="loading loading-ring loading-md mr-2 font-semibold font-sans"></span>
                    Load Data...
                </div>
            </div>
            <table id="tb-akses" class="display" style="width:100%">
            </table>
        </div>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="modalAdmin" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-white text-gray-800">
            <div class="font-sans font-semibold -mt-2 mb-2 text-lg" id="titleModalAdmin">Pendaftaran Admin</div>
            <label for="modalAdmin" class="absolute top-3 right-4 text-xl cursor-pointer" id="closeModalMitra"><i
                    class="far fa-times-circle"></i></label>
            <form id="form-admin">
                <input type="text" hidden id="iduser" name="iduser" />
                <div class="w-full">
                    <div class="font-semibold">Identitas User</div>
                    <div class="flex flex-col mb-4">
                        <div class="h-1 w-1 rounded-full bg-black"></div>
                        <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="username" name="username"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Username
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="email" name="email"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Email
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input readonly id="phone" name="phone"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Phone
                        </label>
                    </div>

                    <div class="font-semibold">Hak Akses</div>
                    <div class="flex flex-col mb-4">
                        <div class="h-1 w-1 rounded-full bg-black"></div>
                        <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
                    </div>
                    <div id="mitraNa">
                        <div class="mb-3 relative h-10 w-full min-w-[200px]">
                            <select readonly id="idmitra" name="idmitra"
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                <option value="0">Load Data Mitra</option>
                            </select>
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Mitra Bank
                            </label>
                            <label
                                class="hidden absolute left-3 text-xs text-blue-gray-400 bg-white px-2 font-sans rounded-md"
                                style="top: -8px">
                                Mitra Bank
                            </label>
                        </div>
                    </div>
                    <div id="roleNa">
                        <div class="mb-3 relative h-10 w-full min-w-[200px]">
                            <select readonly id="role" name="role" onchange="pilihMitra()"
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                <option value="0">-- Hak Akses --</option>
                                <option value="1">Admin</option>
                                <option value="2">Admin Mitra BPR</option>
                                <option value="3">Admin CS</option>
                            </select>
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Hak Akses
                            </label>
                            <label
                                class="hidden absolute left-3 text-xs text-blue-gray-400 bg-white px-2 font-sans rounded-md"
                                style="top: -8px">
                                Hak Akses
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <select readonly id="status" name="status"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Status User
                        </label>
                        <label class="hidden absolute left-3 text-xs text-blue-gray-400 bg-white px-2 font-sans rounded-md"
                            style="top: -8px">
                            Status User
                        </label>
                    </div>
                    <div class="mb-3 relative h-10 w-full min-w-[200px]">
                        <input disabled id="user_created"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label class="absolute left-3 text-xs text-blue-gray-400 bg-white px-2 font-sans rounded-md"
                            style="top: -9px">
                            User Created
                        </label>
                    </div>
                    <div id="passwordNa" class="hidden">
                        <div class="mb-3 relative h-10 w-full min-w-[200px]">
                            <input readonly id="password" name="password"
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                type="password" placeholder=" " />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Insert Password
                            </label>
                        </div>
                        <div class="mb-3 relative h-10 w-full min-w-[200px]">
                            <input readonly id="confirmpassword"
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                type="password" placeholder=" " />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Konfirmasi Password
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end mt-7">
                        <button data-ripple-light="true" onclick="editAdmin()" type="button" id="btnEdit"
                            class="text-sm hover:shadow-lg text-blue-gray-500 border hidden
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                            lg:px-5 p-1 leading-normal text-inherit antialiased">
                            Edit</button>
                        <button data-ripple-light="true" onclick="simpanAdmin()" type="button" id="btnSimpan"
                            class="bg-gradient-to-tr from-green-600 to-green-400 text-sm hover:shadow-lg
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 hidden
                            lg:px-5 p-1 leading-normal text-inherit antialiased text-white">
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .modal-box {
            width: 100%;
        }

        @media (min-width: 480px) {
            .modal-box {
                max-width: 25rem;
                max-height: 95%;
            }
        }

        .dataTables_info {
            font-size: 12px;
            display: none;
        }

        .dataTables_filter {
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            height: 30px;
            font-size: 12px;
            border-radius: 10px;
        }
    </style>

    <script>
        $('#roleNa').hide()
        var valValidasi = null
        ajaxCall(serverApi + 'mitra', null, "GET", "showAllMitra")
        reloadData()

        function reloadData() {
            ajaxCall(serverApi + 'alladmin', null, "GET", "showAllAdmin")
        }

        function showAllMitra(dataNa) {
            var o = '<option>-- Pilih Mitra --</option>'
            dataNa.forEach(e => {
                o += '<option value=' + e.idmitra + '>' + e.nama + '</option>'
            });

            $('#idmitra').html(o)
        }

        function showAllAdmin(dataNa) {
            restyleButton()
            var elementId = "tb-akses";
            $("#loading-tb-akses").hide();
            document.getElementById(elementId).innerHTML =
                '<thead><tr><th>#</th><th>Username</th><th>Email</th><th>Phone</th><th>Role</th><th>Status</th></tr></thead>'
            var t = "<tbody>";
            dataNa.forEach(data => {
                var tr = '<tr class="align-center">';
                var idUser = data['iduser']
                tr +=
                    '<td class="text-center align-middle" nowrap><label id="btnAdmin" for="modalAdmin" data-ripple-light="true"' +
                    'class="cursor-pointer rounded-md bg-gradient-to-tr from-green-600 to-green-400 py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40">' +
                    data["iduser"] + "</label></td>";
                tr += '<td class="text-left align-middle" nowrap>' + data["username"] + "</td>";
                tr += '<td class="text-left align-middle" nowrap><div class="val_iduser" hidden>' + idUser +
                    '</div><div>' + data["email"] + "</div></td > ";
                tr += '<td class="text-left align-middle" nowrap>' + data["phone"] + "</td>";

                tr +=
                    '<td class="text-left align-middle" nowrap><button class="border pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-green-800 shadow-sm shadow-green-500/20 transition-all">'
                switch (data["role"]) {
                    case "99":
                        tr += 'Super Admin'
                        break;
                    case "1":
                        tr += 'Admin Utama'
                        break;
                    case "2":
                        tr += 'Admin Mitra BPR'
                        break;
                    case "3":
                        tr += 'Admin CS'
                        break;
                    case "4":
                        tr += 'Owner'
                        break;
                    default:
                        break;
                }
                tr += "</button></td>";

                if (data["status"] == 1) {
                    tr +=
                        '<td class="text-left align-middle" nowrap><button class="border pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-green-800 shadow-sm shadow-green-500/20 transition-all">' +
                        'Aktif' + "</button></td>";
                } else {
                    tr +=
                        '<td class="text-left align-middle" nowrap><button class="border pointer-events-none rounded-md py-2 px-4 font-sans text-xs font-bold text-red-800 shadow-sm shadow-green-500/20 transition-all">' +
                        'Tidak Aktif' + "</button></td>";
                }

                tr += "</td></tr>";
                t += tr;
            })
            t += "</tbody>";
            buildTableNoExport(t, elementId)
        }

        $(document).on("click", "#btnAdmin", function() {
            var row = $(this).closest("tr")
            var id = row.find(".val_iduser").text()
            ajaxCall(serverApi + 'admin/' + id, null, "GET", "getAdmin")
        })

        function getAdmin(data) {
            $('#titleModalAdmin').text('Detail Admin')
            role == "99" || role == "1" ? $('#btnEdit').fadeIn() : $('#btnEdit').hide()
            $('#passwordNa').hide()
            $('#btnSimpan').hide()
            $('#roleNa').hide()
            $('#mitraNa').hide()
            $('#iduser').prop('readonly', true)
            $('#username').prop('readonly', true)
            $('#email').prop('readonly', true)
            $('#phone').prop('readonly', true)
            $('#status').prop('readonly', true)
            $('#user_created').prop('readonly', true)
            $('#password').prop('readonly', true)
            $('#confirmpassword').prop('readonly', true)

            $('#idmitra').val(data.idmitra)
            $('#iduser').val(data.iduser)
            $('#username').val(data.username)
            $('#email').val(data.email)
            $('#phone').val(data.phone)
            $('#status').val(data.status)
            $('#role').val(data.role)
            $('#user_created').val(data.user_created)
            $('#password').val('')
            $('#confirmpassword').val('')

            if (data.role != "99") $('#roleNa').fadeIn()
            data.role == "2" ? $('#mitraNa').fadeIn() : $('#mitraNa').hide()
        }

        function pilihMitra() {
            $('#role').val() == 2 ? $('#mitraNa').fadeIn() : $('#mitraNa').hide()
        }

        function newAdmin() {
            $('#titleModalAdmin').text('Pendaftaran Admin')
            $('#btnEdit').hide()
            role == "99" || role == "1" ? $('#btnSimpan').fadeIn() : $('#btnSimpan').hide()
            $('#passwordNa').fadeIn()
            $('#mitraNa').hide()
            $('#roleNa').fadeIn()
            $('#iduser').prop('readonly', false)
            $('#username').prop('readonly', false)
            $('#email').prop('readonly', false)
            $('#phone').prop('readonly', false)
            $('#status').prop('readonly', false)
            $('#user_created').prop('readonly', false)
            $('#password').prop('readonly', false)
            $('#confirmpassword').prop('readonly', false)

            $('#iduser').val('')
            $('#username').val('')
            $('#email').val('')
            $('#phone').val('')
            $('#status').val('0')
            $('#role').val('0')
            $('#user_created').val('')
            $('#password').val('')
            $('#confirmpassword').val('')
        }

        function editAdmin() {
            $('#btnSimpan').fadeIn()
            $('#btnEdit').hide()

            $('#passwordNa').fadeIn()
            $('#username').prop('readonly', false)
            $('#email').prop('readonly', false)
            $('#phone').prop('readonly', false)
            $('#status').prop('readonly', false)
            $('#password').prop('readonly', false)
            $('#confirmpassword').prop('readonly', false)
        }

        function simpanAdmin() {
            if (cekPass()) {
                swal({
                    icon: "warning",
                    title: "Proses",
                    text: "Data Sedang di Proses",
                    button: false,
                });

                dataNa = new FormData(document.getElementById("form-admin"))
                url = serverApi + 'regadmin'
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
                        swalBerhasil()
                        $('#closeModalMitra').click()
                        reloadData()
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
        }

        function cekPass() {
            if ($('#password').val() == $('#confirmpassword').val()) return true
            swal({
                icon: "warning",
                title: "Password",
                text: "Password yang anda inputkan tidak sama",
                button: false,
            });
            return false
        }
    </script>
@endsection
