@extends ('layout.nasabah')

@section('content')
    <script src="js/layout.js"></script>

    <head>
        <title>Pertanyaan - Deposito Syariah</title>
    </head>

    <div class="content text-black transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4 flex justify-center">
        <div style="max-width: 1100px">
            <div class="font-sans bg-white rounded-lg p-2 sm:p-4 mb-2 w-80 sm:w-full">
                <div class="font-semibold mb-4 flex justify-between mx-2 pl-1 items-center text-base md:text-xl font-sans">
                    <div>Semua Pertanyaan</div>
                    <div class="w-72">
                        <div class="relative h-10 w-full min-w-[200px]">
                            <div
                                class="absolute top-2/4 right-3 grid h-5 w-5 -translate-y-2/4 place-items-center text-blue-gray-500">
                                <i class="fas fa-search text-sm" aria-hidden="true"></i>
                            </div>
                            <input
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-800 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-800 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-800 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-800 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Cari Pertanyaan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mx-2">
                    <div class="collapse collapse-arrow border mb-3 shadow-md">
                        <input type="radio" name="my-accordion-2" checked="checked" />
                        <div class="collapse-title text-base md:text-xl font-medium">
                            Apa itu Deposito Syariah ?
                        </div>
                        <div class="collapse-content text-sm md:text-base">
                            <p>Pengertian deposito secara umum adalah produk investasi yang dikeluarkan oleh perbankan dalam
                                bentuk simpanan berjangka dengan tingkat pengembalian yang lebih tinggi. Produk simpanan
                                berjangka ini dapat digunakan untuk nasabah individu maupun perusahaan.</p>
                        </div>
                    </div>
                    <div class="collapse collapse-arrow border mb-3 shadow-md">
                        <input type="radio" name="my-accordion-2" />
                        <div class="collapse-title text-base md:text-xl font-medium">
                            Apa itu Deposito Syariah ?
                        </div>
                        <div class="collapse-content text-sm md:text-base">
                            <p>Pengertian deposito secara umum adalah produk investasi yang dikeluarkan oleh perbankan dalam
                                bentuk simpanan berjangka dengan tingkat pengembalian yang lebih tinggi. Produk simpanan
                                berjangka ini dapat digunakan untuk nasabah individu maupun perusahaan.</p>
                        </div>
                    </div>
                    <div class="collapse collapse-arrow border mb-3 shadow-md">
                        <input type="radio" name="my-accordion-2" />
                        <div class="collapse-title text-base md:text-xl font-medium">
                            Apa itu Deposito Syariah ?
                        </div>
                        <div class="collapse-content text-sm md:text-base">
                            <p>Pengertian deposito secara umum adalah produk investasi yang dikeluarkan oleh perbankan dalam
                                bentuk simpanan berjangka dengan tingkat pengembalian yang lebih tinggi. Produk simpanan
                                berjangka ini dapat digunakan untuk nasabah individu maupun perusahaan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="sm:h-12 h-16"></div>

    <script>
        $('#signIn').hide()
        $('#signInBar').hide()
    </script>
@endsection
