@extends ('layout.nasabah')

@section('content')
    <script src="js/layout.js"></script>
    <script></script>

    <div class="mx-1 sm:mx-7 sm:mt-20 mt-12 text-black flex items-center justify-center">
        <div style="max-width: 1100px">
            <div class="font-sans bg-white rounded-lg p-2 sm:p-4 mb-2 w-80 sm:w-full">
                <div class="text-xl font-semibold mb-2 w-full">Portofolio Anda</div>
                <div class="flex flex-row mb-4">
                    <button data-ripple-light="true" id="semua" onclick="semua()"
                        class="text-xs sm:text-sm mr-2 hover:shadow-lg border
                        hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                        lg:px-5 block p-1 leading-normal text-inherit antialiased">
                        Semua</button>
                    <button data-ripple-light="true" id="proses" onclick="proses()"
                        class="text-xs sm:text-sm mr-2 hover:shadow-lg border
                        hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                        lg:px-5 block p-1 leading-normal text-inherit antialiased">
                        Proses</button>
                    <button data-ripple-light="true" id="aktif" onclick="aktif()"
                        class="text-xs sm:text-sm mr-2 hover:shadow-lg border
                        hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                        lg:px-5 block p-1 leading-normal text-inherit antialiased">
                        Aktif</button>
                    <button data-ripple-light="true" id="lunas" onclick="lunas()"
                        class="text-xs sm:text-sm mr-2 hover:shadow-lg border
                        hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                        lg:px-5 block p-1 leading-normal text-inherit antialiased">
                        Lunas</button>
                    <button data-ripple-light="true" id="batal" onclick="batal()"
                        class="text-xs sm:text-sm hover:shadow-lg border
                        hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                        lg:px-5 block p-1 leading-normal text-inherit antialiased">
                        Batal</button>
                </div>
                <div>
                    <div class="mb-3 w-full rounded-lg border border-green-800 shadow-md p-2 text-xs sm:text-sm">
                        <div class="flex justify-between">
                            <div class="font-semibold">BPR Kencana</div>
                            <div class="bg-blue-800 text-white rounded-md py-1 px-4">Aktif</div>
                        </div>
                        <div class="hidden sm:flex justify-between text-xs mt-2 items-center">
                            <div class="mr-5">
                                <div>Nilai Deposito</div>
                                <div>Rp 10.000.000</div>
                            </div>
                            <div class="mr-5">
                                <div>Bagi Hasil Setara</div>
                                <div>5% / Tahun</div>
                            </div>
                            <div class="mr-5">
                                <div>Nisbah</div>
                                <div>40 : 60</div>
                            </div>
                            <div class="mr-5">
                                <div>Estimasi Bagi Hasil</div>
                                <div>Rp 125.000</div>
                            </div>
                            <div class="mr-5">
                                <div>Tenor</div>
                                <div>6 Bulan</div>
                            </div>
                            <div class="mr-5">
                                <div>Tanggal Jatuh Tempo</div>
                                <div>18 September 2023</div>
                            </div>
                            <label for="modalPortofolio" data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-4 block p-1 leading-normal text-inherit antialiased text-white">
                                Lihat Detail</label>
                        </div>
                        <div class="grid sm:hidden grid-cols-2 gap-2 text-xs mt-2 items-center">
                            <div class="mr-0">
                                <div>Nilai Deposito</div>
                                <div>Rp 10.000.000</div>
                            </div>
                            <div class="mr-0">
                                <div>Bagi Hasil Setara</div>
                                <div>5% / Tahun</div>
                            </div>
                            <div class="mr-0">
                                <div>Nisbah</div>
                                <div>40 : 60</div>
                            </div>
                            <div class="mr-0">
                                <div>Estimasi Bagi Hasil</div>
                                <div>Rp 125.000</div>
                            </div>
                            <div class="mr-0">
                                <div>Tenor</div>
                                <div>6 Bulan</div>
                            </div>
                            <div class="mr-0">
                                <div>Tanggal Jatuh Tempo</div>
                                <div>18 September 2023</div>
                            </div>
                            <button data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-4 block p-1 leading-normal text-inherit antialiased text-white">
                                Lihat Detail</button>
                        </div>
                    </div>
                    <div class="mb-3 w-full rounded-lg border border-green-800 shadow-md p-2 text-xs sm:text-sm">
                        <div class="flex justify-between">
                            <div class="font-semibold">BPR Kencana</div>
                            <div class="bg-orange-500 text-white rounded-md py-1 px-4">Proses</div>
                        </div>
                        <div class="hidden sm:flex justify-between text-xs mt-2 items-center">
                            <div class="mr-5">
                                <div>Nilai Deposito</div>
                                <div>Rp 10.000.000</div>
                            </div>
                            <div class="mr-5">
                                <div>Bagi Hasil Setara</div>
                                <div>5% / Tahun</div>
                            </div>
                            <div class="mr-5">
                                <div>Nisbah</div>
                                <div>40 : 60</div>
                            </div>
                            <div class="mr-5">
                                <div>Estimasi Bagi Hasil</div>
                                <div>Rp 125.000</div>
                            </div>
                            <div class="mr-5">
                                <div>Tenor</div>
                                <div>6 Bulan</div>
                            </div>
                            <div class="mr-5">
                                <div>Tanggal Jatuh Tempo</div>
                                <div>18 September 2023</div>
                            </div>
                            <button data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-4 block p-1 leading-normal text-inherit antialiased text-white">
                                Lihat Detail</button>
                        </div>
                        <div class="grid sm:hidden grid-cols-2 gap-2 text-xs mt-2 items-center">
                            <div class="mr-0">
                                <div>Nilai Deposito</div>
                                <div>Rp 10.000.000</div>
                            </div>
                            <div class="mr-0">
                                <div>Bagi Hasil Setara</div>
                                <div>5% / Tahun</div>
                            </div>
                            <div class="mr-0">
                                <div>Nisbah</div>
                                <div>40 : 60</div>
                            </div>
                            <div class="mr-0">
                                <div>Estimasi Bagi Hasil</div>
                                <div>Rp 125.000</div>
                            </div>
                            <div class="mr-0">
                                <div>Tenor</div>
                                <div>6 Bulan</div>
                            </div>
                            <div class="mr-0">
                                <div>Tanggal Jatuh Tempo</div>
                                <div>18 September 2023</div>
                            </div>
                            <button data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-4 block p-1 leading-normal text-inherit antialiased text-white">
                                Lihat Detail</button>
                        </div>
                    </div>
                    <div class="mb-3 w-full rounded-lg border border-green-800 shadow-md p-2 text-xs sm:text-sm">
                        <div class="flex justify-between">
                            <div class="font-semibold">BPR Kencana</div>
                            <div class="bg-green-800 text-white rounded-md py-1 px-4">Lunas</div>
                        </div>
                        <div class="hidden sm:flex justify-between text-xs mt-2 items-center">
                            <div class="mr-5">
                                <div>Nilai Deposito</div>
                                <div>Rp 10.000.000</div>
                            </div>
                            <div class="mr-5">
                                <div>Bagi Hasil Setara</div>
                                <div>5% / Tahun</div>
                            </div>
                            <div class="mr-5">
                                <div>Nisbah</div>
                                <div>40 : 60</div>
                            </div>
                            <div class="mr-5">
                                <div>Estimasi Bagi Hasil</div>
                                <div>Rp 125.000</div>
                            </div>
                            <div class="mr-5">
                                <div>Tenor</div>
                                <div>6 Bulan</div>
                            </div>
                            <div class="mr-5">
                                <div>Tanggal Jatuh Tempo</div>
                                <div>18 September 2023</div>
                            </div>
                            <button data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-4 block p-1 leading-normal text-inherit antialiased text-white">
                                Lihat Detail</button>
                        </div>
                        <div class="grid sm:hidden grid-cols-2 gap-2 text-xs mt-2 items-center">
                            <div class="mr-0">
                                <div>Nilai Deposito</div>
                                <div>Rp 10.000.000</div>
                            </div>
                            <div class="mr-0">
                                <div>Bagi Hasil Setara</div>
                                <div>5% / Tahun</div>
                            </div>
                            <div class="mr-0">
                                <div>Nisbah</div>
                                <div>40 : 60</div>
                            </div>
                            <div class="mr-0">
                                <div>Estimasi Bagi Hasil</div>
                                <div>Rp 125.000</div>
                            </div>
                            <div class="mr-0">
                                <div>Tenor</div>
                                <div>6 Bulan</div>
                            </div>
                            <div class="mr-0">
                                <div>Tanggal Jatuh Tempo</div>
                                <div>18 September 2023</div>
                            </div>
                            <button data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-4 block p-1 leading-normal text-inherit antialiased text-white">
                                Lihat Detail</button>
                        </div>
                    </div>
                    <div class="mb-3 w-full rounded-lg border border-green-800 shadow-md p-2 text-xs sm:text-sm">
                        <div class="flex justify-between">
                            <div class="font-semibold">BPR Kencana</div>
                            <div class="bg-red-800 text-white rounded-md py-1 px-4">Batal</div>
                        </div>
                        <div class="hidden sm:flex justify-between text-xs mt-2 items-center">
                            <div class="mr-5">
                                <div>Nilai Deposito</div>
                                <div>Rp 10.000.000</div>
                            </div>
                            <div class="mr-5">
                                <div>Bagi Hasil Setara</div>
                                <div>5% / Tahun</div>
                            </div>
                            <div class="mr-5">
                                <div>Nisbah</div>
                                <div>40 : 60</div>
                            </div>
                            <div class="mr-5">
                                <div>Estimasi Bagi Hasil</div>
                                <div>Rp 125.000</div>
                            </div>
                            <div class="mr-5">
                                <div>Tenor</div>
                                <div>6 Bulan</div>
                            </div>
                            <div class="mr-5">
                                <div>Tanggal Jatuh Tempo</div>
                                <div>18 September 2023</div>
                            </div>
                            <button data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-4 block p-1 leading-normal text-inherit antialiased text-white">
                                Lihat Detail</button>
                        </div>
                        <div class="grid sm:hidden grid-cols-2 gap-2 text-xs mt-2 items-center">
                            <div class="mr-0">
                                <div>Nilai Deposito</div>
                                <div>Rp 10.000.000</div>
                            </div>
                            <div class="mr-0">
                                <div>Bagi Hasil Setara</div>
                                <div>5% / Tahun</div>
                            </div>
                            <div class="mr-0">
                                <div>Nisbah</div>
                                <div>40 : 60</div>
                            </div>
                            <div class="mr-0">
                                <div>Estimasi Bagi Hasil</div>
                                <div>Rp 125.000</div>
                            </div>
                            <div class="mr-0">
                                <div>Tenor</div>
                                <div>6 Bulan</div>
                            </div>
                            <div class="mr-0">
                                <div>Tanggal Jatuh Tempo</div>
                                <div>18 September 2023</div>
                            </div>
                            <button data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-4 block p-1 leading-normal text-inherit antialiased text-white">
                                Lihat Detail</button>
                        </div>
                    </div>
                    <div class="mb-3 w-full rounded-lg border border-green-800 shadow-md p-2 text-xs sm:text-sm">
                        <div class="flex justify-between">
                            <div class="font-semibold">BPR Kencana</div>
                            <div class="bg-blue-800 text-white rounded-md py-1 px-4">Aktif</div>
                        </div>
                        <div class="hidden sm:flex justify-between text-xs mt-2 items-center">
                            <div class="mr-5">
                                <div>Nilai Deposito</div>
                                <div>Rp 10.000.000</div>
                            </div>
                            <div class="mr-5">
                                <div>Bagi Hasil Setara</div>
                                <div>5% / Tahun</div>
                            </div>
                            <div class="mr-5">
                                <div>Nisbah</div>
                                <div>40 : 60</div>
                            </div>
                            <div class="mr-5">
                                <div>Estimasi Bagi Hasil</div>
                                <div>Rp 125.000</div>
                            </div>
                            <div class="mr-5">
                                <div>Tenor</div>
                                <div>6 Bulan</div>
                            </div>
                            <div class="mr-5">
                                <div>Tanggal Jatuh Tempo</div>
                                <div>18 September 2023</div>
                            </div>
                            <button data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-4 block p-1 leading-normal text-inherit antialiased text-white">
                                Lihat Detail</button>
                        </div>
                        <div class="grid sm:hidden grid-cols-2 gap-2 text-xs mt-2 items-center">
                            <div class="mr-0">
                                <div>Nilai Deposito</div>
                                <div>Rp 10.000.000</div>
                            </div>
                            <div class="mr-0">
                                <div>Bagi Hasil Setara</div>
                                <div>5% / Tahun</div>
                            </div>
                            <div class="mr-0">
                                <div>Nisbah</div>
                                <div>40 : 60</div>
                            </div>
                            <div class="mr-0">
                                <div>Estimasi Bagi Hasil</div>
                                <div>Rp 125.000</div>
                            </div>
                            <div class="mr-0">
                                <div>Tenor</div>
                                <div>6 Bulan</div>
                            </div>
                            <div class="mr-0">
                                <div>Tanggal Jatuh Tempo</div>
                                <div>18 September 2023</div>
                            </div>
                            <button data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-4 block p-1 leading-normal text-inherit antialiased text-white">
                                Lihat Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sm:h-12 h-16"></div>

    <!-- Modal Portofolio -->
    <input type="checkbox" id="modalPortofolio" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-white text-gray-800 font-sans text-sm">
            <h3 class="font-bold text-lg text-center -mt-2">Detail Portofolio</h3>
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
            <div class="flex items-center mb-2">
                <i class="fas fa-check-circle text-xl mr-2" style="color: green"></i>
                <div>Deposito Aktif</div>
            </div>
            <div class="flex items-center mb-2">
                <i class="fas fa-times-circle text-xl mr-2" style="color: gray"></i>
                <div>Pelunasan</div>
            </div>

            <div class="modal-action flex justify-center items-center">
                <button data-ripple-light="true"
                    class="text-xs sm:text-sm mr-2 hover:shadow-lg border bg-gradient-to-tr from-green-600 to-green-400 text-white
                        hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                        lg:px-5 block p-1 leading-normal text-inherit antialiased">
                    Penarikan</button>
                <button data-ripple-light="true"
                    class="text-xs sm:text-sm mr-2 hover:shadow-lg border bg-gradient-to-tr from-green-600 to-green-400 text-white
                        hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                        lg:px-5 block p-1 leading-normal text-inherit antialiased">
                    Pembatalan</button>
                <label for="modalPortofolio" data-ripple-light="true"
                    class="text-xs sm:text-sm mr-2 hover:shadow-lg border hover:cursor-pointer bg-gray-500
                        hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 text-white
                        lg:px-5 block p-1 leading-normal text-inherit antialiased">
                    Close</label>
            </div>
        </div>
    </div>

    <script>
        $("#linkPortofolio").css('pointer-events', 'none')
        $("#linkPortofolio").addClass('bg-gradient-to-tr from-green-600 to-green-400 text-white py-1')
        $('#linkPortofolioBar').hide()

        $('#signIn').hide()
        $('#signInBar').hide()

        semua()

        function allNormal() {
            $('#semua').removeClass('bg-gradient-to-tr from-green-600 to-green-400 text-white')
            $('#proses').removeClass('bg-gradient-to-tr from-green-600 to-green-400 text-white')
            $('#aktif').removeClass('bg-gradient-to-tr from-green-600 to-green-400 text-white')
            $('#lunas').removeClass('bg-gradient-to-tr from-green-600 to-green-400 text-white')
            $('#batal').removeClass('bg-gradient-to-tr from-green-600 to-green-400 text-white')

            $('#semua').css('pointer-events', 'auto')
            $('#proses').css('pointer-events', 'auto')
            $('#aktif').css('pointer-events', 'auto')
            $('#lunas').css('pointer-events', 'auto')
            $('#batal').css('pointer-events', 'auto')
        }

        function semua() {
            allNormal()
            $('#semua').addClass('bg-gradient-to-tr from-green-600 to-green-400 text-white')
            $('#semua').css('pointer-ements', 'none')
        }

        function proses() {
            allNormal()
            $('#proses').addClass('bg-gradient-to-tr from-green-600 to-green-400 text-white')
            $('#proses').css('pointer-ements', 'none')
        }

        function aktif() {
            allNormal()
            $('#aktif').addClass('bg-gradient-to-tr from-green-600 to-green-400 text-white')
            $('#aktif').css('pointer-ements', 'none')
        }

        function lunas() {
            allNormal()
            $('#lunas').addClass('bg-gradient-to-tr from-green-600 to-green-400 text-white')
            $('#lunas').css('pointer-ements', 'none')
        }

        function batal() {
            allNormal()
            $('#batal').addClass('bg-gradient-to-tr from-green-600 to-green-400 text-white')
            $('#batal').css('pointer-ements', 'none')
        }
    </script>
@endsection
