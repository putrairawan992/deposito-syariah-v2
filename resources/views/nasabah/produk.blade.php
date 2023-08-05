@extends ('layout.nasabah')

@section('content')
    <script src="js/layout.js"></script>
    <script></script>

    <div class="mx-2 sm:mx-7 sm:mt-20 mt-12 text-black flex items-center justify-center">
        <div style="max-width: 1100px">
            <div class="bg-white rounded-lg p-4 mb-2 w-80 sm:w-full">
                <div class="sm:flex sm:items-center sm:justify-center">
                    <div class="w-full sm:w-52 mr-0 sm:mr-2">
                        <div class="relative h-10 w-full min-w-[200px]">
                            <div
                                class="absolute top-2/4 right-3 grid h-5 w-5 -translate-y-2/4 place-items-center text-blue-gray-500">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </div>
                            <input
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-800 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Cari
                            </label>
                        </div>
                    </div>
                    <div class="my-2 sm:my-0 relative h-10 w-full sm:w-52 mr-0 sm:mr-2 min-w-[200px]">
                        <select
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-green-700 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                            <option value="brazil">Brazil</option>
                            <option value="bucharest">Bucharest</option>
                            <option value="london">London</option>
                            <option value="washington">Washington</option>
                        </select>
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-800 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Bagi Hasil
                        </label>
                    </div>
                    <div class="relative h-10 w-full sm:w-52 mr-0 sm:mr-2 min-w-[200px]">
                        <select
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-green-700 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                            <option value="brazil">Brazil</option>
                            <option value="bucharest">Bucharest</option>
                            <option value="london">London</option>
                            <option value="washington">Washington</option>
                        </select>
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-800 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Tenor
                        </label>
                    </div>
                </div>
                <div class="mt-3 grid sm:grid-cols-2 grid-cols-1 sm:gap-3 gap-1 sm:text-base text-xs">
                    <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                        <div class="font-bold">BPR Kencana Abadi</div>
                        <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-3 gap-1">
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
                        <div style="margin-top: -22px"
                            class="mb-2 font-sans font-bold w-full justify-center flex text-xs whitespace-nowrap">
                            Terkumpul 60%</div>
                    </div>
                    <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                        <div class="font-bold">BPR Kencana Abadi</div>
                        <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-3 gap-1">
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
                        <div style="margin-top: -22px"
                            class="mb-2 font-sans font-bold w-full justify-center flex text-xs whitespace-nowrap">
                            Terkumpul 60%</div>
                    </div>
                    <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                        <div class="font-bold">BPR Kencana Abadi</div>
                        <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-3 gap-1">
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
                        <div style="margin-top: -22px"
                            class="mb-2 font-sans font-bold w-full justify-center flex text-xs whitespace-nowrap">
                            Terkumpul 60%</div>
                    </div>
                    <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                        <div class="font-bold">BPR Kencana Abadi</div>
                        <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-3 gap-1">
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
                        <div style="margin-top: -22px"
                            class="mb-2 font-sans font-bold w-full justify-center flex text-xs whitespace-nowrap">
                            Terkumpul 60%</div>
                    </div>
                    <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                        <div class="font-bold">BPR Kencana Abadi</div>
                        <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-3 gap-1">
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
                        <div style="margin-top: -22px"
                            class="mb-2 font-sans font-bold w-full justify-center flex text-xs whitespace-nowrap">
                            Terkumpul 60%</div>
                    </div>
                    <div class="rounded-md border py-2 px-4 border-green-800 shadow-md shadow-green-500/40">
                        <div class="font-bold">BPR Kencana Abadi</div>
                        <div class="text-xs my-2 font-body grid sm:grid-cols-3 grid-cols-2 sm:gap-3 gap-1">
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
                        <div style="margin-top: -22px"
                            class="mb-2 font-sans font-bold w-full justify-center flex text-xs whitespace-nowrap">
                            Terkumpul 60%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sm:h-12 h-16"></div>

    <script>
        $("#linkProduk").css('pointer-events', 'none')
        $("#linkProduk").addClass('bg-gradient-to-tr from-green-600 to-green-400 text-white py-1')
        $('#linkProdukBar').hide()

        $('#signIn').hide()
        $('#signInBar').hide()
    </script>
@endsection
