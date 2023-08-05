@extends ('layout.nasabah')

@section('content')
    <script src="js/layout.js"></script>
    <script src="js/nasabah/dashboard.js"></script>
    <script>
        function scroll_style() {
            var window_top = $(window).scrollTop();
            var div_top = $('#topLimit').offset().top;

            if (window_top > div_top) {
                $('#stepNa').hide()
            }

            if (window_top <= div_top) {
                $('#stepNa').show()
            }
        }
        $(function() {
            $(window).scroll(scroll_style);
            scroll_style();
        });
    </script>

    <head>
        <title>Dashboard - Deposito Syariah</title>
    </head>

    <div class="mx-2 sm:mx-7 sm:mt-20 mt-12">
        <div class="flex flex-col sm:flex-row mb-2 text-xs font-sans sm:text-base">
            <div class="w-full sm:w-4/6 bg-white rounded-lg p-4 mb-2 sm:mb-0 sm:mr-2 sm:font-semibold font-light">
                <div class="">
                    <div class="flex justify-center">Bagi Hasil</div>
                    <div class="flex justify-center" id="userBagiHasil">Rp 0</div>
                </div>
                <hr class="mx-4 my-3 bg-gray-400" style="height: 3px" />
                <div class=" flex flex-row">
                    <div class="w-full ">
                        <div class="flex justify-center">Total Deposito</div>
                        <div class="flex justify-center" id="userTotalDeposito">Rp 0</div>
                    </div>
                    <hr class="-mt-2 h-10 sm:h-14 bg-gray-400" style="width: 5px" />
                    <div class="w-full ">
                        <div class="flex justify-center">Portofolio</div>
                        <div class="flex justify-center" id="userPortofolio">Rp 0</div>
                    </div>
                </div>
            </div>
            <div class="w-full bg-white rounded-lg p-4" id="topLimit">
                <div class="flex justify-center font-thin sm:font-medium">Lengkapi data anda untuk membuka</div>
                <div class="flex justify-center font-thin sm:font-medium mb-2" id="userBagiHasil">dan memulai pendanaan
                </div>
                <div class="flex justify-center">
                    <ul class="steps steps-horizontal font-medium sm:text-sm" id="stepNa">
                        <li class="px-2 step step-warning">Login OTP</li>
                        <li class="px-2 step" id="stepProfil">Lengkapi Profil</li>
                        <li class="px-2 step" id="stepPIN">Buat PIN dan Password</li>
                        <li class="px-2 step" id="stepFinish">Selesai</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg p-4 mb-2">
            <button
                class="from-green-600 to-green-400 bg-gradient-to-t text-white hover:shadow-lg border hover:border-green-900 border-green-700 sm:text-base text-xs
                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 lg:px-5 block p-1 leading-normal text-inherit antialiased"
                href="/produk">
                Lihat semua produk
            </button>
            <div class="mt-3 grid sm:grid-cols-3 grid-cols-1 sm:gap-3 gap-1 sm:text-base text-xs">
                <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                    <div class="font-bold">BPR Kencana Abadi</div>
                    <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-2 gap-1">
                        <div>
                            <div>Target</div>
                            <div>Rp 1 Miliar</div>
                        </div>
                        <div>
                            <div>Minimal Deposito</div>
                            <div>Rp 1.000.000</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Dana Terkumpul</div>
                            <div>Rp 50.000.000</div>
                        </div>
                        <div>
                            <div>Bagi Hasil Setara</div>
                            <div>5% / Tahun</div>
                        </div>
                        <div>
                            <div>Nisbah</div>
                            <div>40 : 60</div>
                        </div>
                        <div>
                            <div>Tenor</div>
                            <div>3 Bulan</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Tanggal Berakhir</div>
                            <div>20 Agustus 2023</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Transaksi</div>
                            <div>50 Transaksi</div>
                        </div>
                        <div class="h-full flex items-center">
                            <button
                                class="items-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400 py-1 sm:py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true" href="/produk">
                                Detail
                            </button>
                        </div>
                    </div>
                    <div
                        class="border border-green-800 flex-start flex h-7 w-full overflow-hidden rounded bg-light-green-50 font-sans text-xs font-medium">
                        <div
                            class="w-3/5 flex h-full items-center justify-center overflow-hidden break-all bg-green-600 text-white">
                        </div>
                    </div>
                    <div style="margin-top: -22px" class="mb-2 font-sans w-full flex-row flex text-xs whitespace-nowrap">
                        <div class="text-white flex w-3/5 items-center justify-center">
                            Terkumpul 60%</div>
                        <div class="flex w-2/5 items-center justify-center">
                            Terkumpul 60%</div>
                    </div>
                </div>
                <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                    <div class="font-bold">BPR Kencana Abadi</div>
                    <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-2 gap-1">
                        <div>
                            <div>Target</div>
                            <div>Rp 1 Miliar</div>
                        </div>
                        <div>
                            <div>Minimal Deposito</div>
                            <div>Rp 1.000.000</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Dana Terkumpul</div>
                            <div>Rp 50.000.000</div>
                        </div>
                        <div>
                            <div>Bagi Hasil Setara</div>
                            <div>5% / Tahun</div>
                        </div>
                        <div>
                            <div>Nisbah</div>
                            <div>40 : 60</div>
                        </div>
                        <div>
                            <div>Tenor</div>
                            <div>3 Bulan</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Tanggal Berakhir</div>
                            <div>20 Agustus 2023</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Transaksi</div>
                            <div>50 Transaksi</div>
                        </div>
                        <div class="h-full flex items-center">
                            <button
                                class="items-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400 py-1 sm:py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true" href="/produk">
                                Detail
                            </button>
                        </div>
                    </div>
                    <div
                        class="border border-green-800 flex-start flex h-7 w-full overflow-hidden rounded bg-light-green-50 font-sans text-xs font-medium">
                        <div
                            class="w-3/5 flex h-full items-center justify-center overflow-hidden break-all bg-green-600 text-white">
                        </div>
                    </div>
                    <div style="margin-top: -22px" class="mb-2 font-sans w-full flex-row flex text-xs whitespace-nowrap">
                        <div class="text-white flex w-3/5 items-center justify-center">
                            Terkumpul 60%</div>
                        <div class="flex w-2/5 items-center justify-center">
                            Terkumpul 60%</div>
                    </div>
                </div>
                <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                    <div class="font-bold">BPR Kencana Abadi</div>
                    <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-2 gap-1">
                        <div>
                            <div>Target</div>
                            <div>Rp 1 Miliar</div>
                        </div>
                        <div>
                            <div>Minimal Deposito</div>
                            <div>Rp 1.000.000</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Dana Terkumpul</div>
                            <div>Rp 50.000.000</div>
                        </div>
                        <div>
                            <div>Bagi Hasil Setara</div>
                            <div>5% / Tahun</div>
                        </div>
                        <div>
                            <div>Nisbah</div>
                            <div>40 : 60</div>
                        </div>
                        <div>
                            <div>Tenor</div>
                            <div>3 Bulan</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Tanggal Berakhir</div>
                            <div>20 Agustus 2023</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Transaksi</div>
                            <div>50 Transaksi</div>
                        </div>
                        <div class="h-full flex items-center">
                            <button
                                class="items-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400 py-1 sm:py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true" href="/produk">
                                Detail
                            </button>
                        </div>
                    </div>
                    <div
                        class="border border-green-800 flex-start flex h-7 w-full overflow-hidden rounded bg-light-green-50 font-sans text-xs font-medium">
                        <div
                            class="w-3/5 flex h-full items-center justify-center overflow-hidden break-all bg-green-600 text-white">
                        </div>
                    </div>
                    <div style="margin-top: -22px" class="mb-2 font-sans w-full flex-row flex text-xs whitespace-nowrap">
                        <div class="text-white flex w-3/5 items-center justify-center">
                            Terkumpul 60%</div>
                        <div class="flex w-2/5 items-center justify-center">
                            Terkumpul 60%</div>
                    </div>
                </div>
                <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                    <div class="font-bold">BPR Kencana Abadi</div>
                    <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-2 gap-1">
                        <div>
                            <div>Target</div>
                            <div>Rp 1 Miliar</div>
                        </div>
                        <div>
                            <div>Minimal Deposito</div>
                            <div>Rp 1.000.000</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Dana Terkumpul</div>
                            <div>Rp 50.000.000</div>
                        </div>
                        <div>
                            <div>Bagi Hasil Setara</div>
                            <div>5% / Tahun</div>
                        </div>
                        <div>
                            <div>Nisbah</div>
                            <div>40 : 60</div>
                        </div>
                        <div>
                            <div>Tenor</div>
                            <div>3 Bulan</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Tanggal Berakhir</div>
                            <div>20 Agustus 2023</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Transaksi</div>
                            <div>50 Transaksi</div>
                        </div>
                        <div class="h-full flex items-center">
                            <button
                                class="items-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400 py-1 sm:py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true" href="/produk">
                                Detail
                            </button>
                        </div>
                    </div>
                    <div
                        class="border border-green-800 flex-start flex h-7 w-full overflow-hidden rounded bg-light-green-50 font-sans text-xs font-medium">
                        <div
                            class="w-3/5 flex h-full items-center justify-center overflow-hidden break-all bg-green-600 text-white">
                        </div>
                    </div>
                    <div style="margin-top: -22px" class="mb-2 font-sans w-full flex-row flex text-xs whitespace-nowrap">
                        <div class="text-white flex w-3/5 items-center justify-center">
                            Terkumpul 60%</div>
                        <div class="flex w-2/5 items-center justify-center">
                            Terkumpul 60%</div>
                    </div>
                </div>
                <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                    <div class="font-bold">BPR Kencana Abadi</div>
                    <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-2 gap-1">
                        <div>
                            <div>Target</div>
                            <div>Rp 1 Miliar</div>
                        </div>
                        <div>
                            <div>Minimal Deposito</div>
                            <div>Rp 1.000.000</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Dana Terkumpul</div>
                            <div>Rp 50.000.000</div>
                        </div>
                        <div>
                            <div>Bagi Hasil Setara</div>
                            <div>5% / Tahun</div>
                        </div>
                        <div>
                            <div>Nisbah</div>
                            <div>40 : 60</div>
                        </div>
                        <div>
                            <div>Tenor</div>
                            <div>3 Bulan</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Tanggal Berakhir</div>
                            <div>20 Agustus 2023</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Transaksi</div>
                            <div>50 Transaksi</div>
                        </div>
                        <div class="h-full flex items-center">
                            <button
                                class="items-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400 py-1 sm:py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true" href="/produk">
                                Detail
                            </button>
                        </div>
                    </div>
                    <div
                        class="border border-green-800 flex-start flex h-7 w-full overflow-hidden rounded bg-light-green-50 font-sans text-xs font-medium">
                        <div
                            class="w-3/5 flex h-full items-center justify-center overflow-hidden break-all bg-green-600 text-white">
                        </div>
                    </div>
                    <div style="margin-top: -22px" class="mb-2 font-sans w-full flex-row flex text-xs whitespace-nowrap">
                        <div class="text-white flex w-3/5 items-center justify-center">
                            Terkumpul 60%</div>
                        <div class="flex w-2/5 items-center justify-center">
                            Terkumpul 60%</div>
                    </div>
                </div>
                <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                    <div class="font-bold">BPR Kencana Abadi</div>
                    <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-2 gap-1">
                        <div>
                            <div>Target</div>
                            <div>Rp 1 Miliar</div>
                        </div>
                        <div>
                            <div>Minimal Deposito</div>
                            <div>Rp 1.000.000</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Dana Terkumpul</div>
                            <div>Rp 50.000.000</div>
                        </div>
                        <div>
                            <div>Bagi Hasil Setara</div>
                            <div>5% / Tahun</div>
                        </div>
                        <div>
                            <div>Nisbah</div>
                            <div>40 : 60</div>
                        </div>
                        <div>
                            <div>Tenor</div>
                            <div>3 Bulan</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Tanggal Berakhir</div>
                            <div>20 Agustus 2023</div>
                        </div>
                        <div class="hidden sm:block">
                            <div>Transaksi</div>
                            <div>50 Transaksi</div>
                        </div>
                        <div class="h-full flex items-center">
                            <button
                                class="items-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400 py-1 sm:py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true" href="/produk">
                                Detail
                            </button>
                        </div>
                    </div>
                    <div
                        class="border border-green-800 flex-start flex h-7 w-full overflow-hidden rounded bg-light-green-50 font-sans text-xs font-medium">
                        <div
                            class="w-3/5 flex h-full items-center justify-center overflow-hidden break-all bg-green-600 text-white">
                        </div>
                    </div>
                    <div style="margin-top: -22px" class="mb-2 font-sans w-full flex-row flex text-xs whitespace-nowrap">
                        <div class="text-white flex w-3/5 items-center justify-center">
                            Terkumpul 60%</div>
                        <div class="flex w-2/5 items-center justify-center">
                            Terkumpul 60%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sm:h-12 h-16"></div>
@endsection
