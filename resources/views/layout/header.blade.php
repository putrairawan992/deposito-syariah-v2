<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- SA, Excel to JSON, JQUERY -->
    <script src="plugins/sweetalert.min.js"></script>
    <script src="plugins/jquery-3.7.0.min.js"></script>
    <script src="plugins/xlsx.min.js"></script>
    <link href="/output.css" rel="stylesheet">

    <!-- Material Icons Link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="icon" type="image/x-icon" href="/img/Favicon Harta Insan Karimah.png">
</head>

<body class="bg-gradient-to-l from-green-900 to-green-800 h-full min-h-screen">
    <div class="sticky top-0 z-sticky" id="idHeader">
        <div class="flex flex-wrap">
            <!-- Navbar -->
            <nav
                class="absolute top-0 left-0 right-0 z-50 inset-0 block h-max w-full max-w-full rounded-none border border-white/80
                    bg-white bg-opacity-90 py-2 px-4 text-white shadow-sm shadow-green-100 backdrop-blur-2xl
                    backdrop-saturate-200 lg:px-8 lg:py-4">
                <div class="flex items-center text-gray-900">
                    <a href="#">
                        <img class="h-8 md:h-10 lg:h-16 -my-4" src="/img/Logo Harta Insan Karimah.png" alt="Logo HIK">
                    </a>
                    <ul class="ml-auto hidden items-center gap-2 md:flex md:font-light md:text-sm lg:font-normal">
                        <li id="linkDashboard"
                            class="hover:shadow-lg hover:border hover:border-green-900
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 lg:px-5 block p-1 leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/dashboard">
                                Beranda
                            </a>
                        </li>
                        <li id="linkPromo"
                            class="hover:shadow-lg hover:border hover:border-green-900
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 lg:px-5 block p-1 leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/promo">
                                Promo
                            </a>
                        </li>
                        <li id="linkProduk"
                            class="hover:shadow-lg hover:border hover:border-green-900
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 lg:px-5 block p-1 leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/produk">
                                Produk
                            </a>
                        </li>
                        <li id="linkPortofolio"
                            class="hover:shadow-lg hover:border hover:border-green-900
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 lg:px-5 block p-1 leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/portofolio">
                                Portofolio
                            </a>
                        </li>
                        <li id="linkBlog"
                            class="hover:shadow-lg hover:border hover:border-green-900
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 lg:px-5 block p-1 leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/blog">
                                Blog
                            </a>
                        </li>
                        <li id="linkFAQ"
                            class="hover:shadow-lg hover:border hover:border-green-900
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 lg:px-5 block p-1 leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/faq">
                                FAQ
                            </a>
                        </li>
                        <li id="linkContactUs"
                            class="hover:shadow-lg hover:border hover:border-green-900
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 lg:px-5 block p-1 leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/contactus">
                                Hubungi Kami
                            </a>
                        </li>
                        <a id="signIn" href="/login"
                            class="items-center middle none center hidden rounded-lg bg-gradient-to-tr from-green-600 to-green-400 py-2 px-4 font-sans text-xs font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none md:flex"
                            data-ripple-light="true">
                            <i class="fas fa-sign-in-alt mr-2 text-lg"></i>Masuk
                        </a>
                        <div class="flex-row flex items-center" id="identity">
                            <div class="dropdown dropdown-bottom dropdown-end ml-2 mr-6">
                                <div class="indicator">
                                    <span class="indicator-item badge bg-red-900 text-white text-xs "
                                        id="countNotif">&#8734;</span>
                                    <button tabindex="0"
                                        class="bg-opacity-0 btn-circle btn -m-2 hover:shadow-lg hover:border hover:border-green-900
                                        hover:shadow-green-500/40 active:opacity-[0.85]">
                                        <i class="text-xl far fa-bell text-green-900"></i>
                                    </button>
                                </div>
                                <ul tabindex="0"
                                    class="bg-white dropdown-content z-[1] menu p-2 shadow rounded-box w-52"
                                    id="listNotif">
                                    <li><a>Item 1</a></li>
                                    <li><a>Item 2</a></li>
                                </ul>
                            </div>
                            <div class="dropdown dropdown-bottom dropdown-end">
                                <button tabindex="0"
                                    class="flex-row flex items-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400
                                    py-2 px-3 font-sans font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg
                                    hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    data-ripple-light="true">
                                    <i class="fas fa-user-circle text-xl mr-2"></i>
                                    <div class="text-sm" id="namaNasabah">Nasabah</div>
                                </button>
                                <ul tabindex="0"
                                    class="bg-white dropdown-content z-[1] menu p-2 shadow rounded-box w-40">
                                    <li><a class="hover:bg-green-50"><i class="fas fa-id-card"></i> Profil</a></li>
                                    <li><a class="hover:bg-green-50"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                    <ul style="display: none;" id="menuBar"
                        class="absolute right-0 top-11 z-50 bg-white bg-opacity-90 rounded-md p-1 text-xs overflow-hidden text-blue-gray-900
                         transition-all duration-300 ease-in lg:hidden font-semibold">
                        <li id="linkDashboardBar"
                            class="whitespace-nowrap rounded-md px-2 block p-1 font-sans font-normal leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/dashboard">
                                Beranda
                            </a>
                        </li>
                        <li id="linkPromoBar"
                            class="whitespace-nowrap rounded-md px-2 block p-1 font-sans font-normal leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/promo">
                                Promo
                            </a>
                        </li>
                        <li id="linkProdukBar"
                            class="whitespace-nowrap rounded-md px-2 block p-1 font-sans font-normal leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/produk">
                                Produk
                            </a>
                        </li>
                        <li id="linkPortofolioBar"
                            class="whitespace-nowrap rounded-md px-2 block p-1 font-sans font-normal leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/portofolio">
                                Portofolio
                            </a>
                        </li>
                        <li id="linkBlogBar"
                            class="whitespace-nowrap rounded-md px-2 block p-1 font-sans font-normal leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/blog">
                                Blog
                            </a>
                        </li>
                        <li id="linkFAQBar"
                            class="whitespace-nowrap rounded-md px-2 block p-1 font-sans font-normal leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/faq">
                                FAQ
                            </a>
                        </li>
                        <li id="linkContactUsBar"
                            class="whitespace-nowrap rounded-md px-2 block p-1 font-sans font-normal leading-normal text-inherit antialiased">
                            <a class="flex items-center" href="/contactus">
                                Hubungi Kami
                            </a>
                        </li>
                        <a id="signInBar" href="/"
                            class="my-1 items-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400
                            py-2 px-4 font-sans text-xs font-thin text-white shadow-md shadow-green-500/20 transition-all
                            hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none
                            disabled:opacity-50 disabled:shadow-none flex"
                            data-ripple-light="true">
                            <i class="fas fa-sign-in-alt mr-2 text-xs"></i>Masuk
                        </a>
                        <div class="flex-col flex" id="identityBar">
                            <hr class="h-px m-1 bg-green-900" />
                            <li
                                class="hover:shadow-lg hover:border hover:border-green-900 hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 lg:px-5 block p-1 font-sans font-normal leading-normal text-inherit antialiased">
                                <a class="flex items-center" href="/notifikasi">
                                    <i class="far fa-bell mr-2 text-xs"></i>Notifikasi
                                    <span class="indicator-item badge bg-red-900 text-white text-xs ml-1"
                                        id="countNotifBar">&#8734;</span>
                                </a>
                            </li>
                            <li
                                class="hover:shadow-lg hover:border hover:border-green-900
                            hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2 lg:px-5 block p-1 font-sans font-normal leading-normal text-inherit antialiased">
                                <a class="flex items-center" href="/profil">
                                    <i class="fas fa-id-card mr-2 text-xs"></i>Profil
                                </a>
                            </li>
                            <a id="signOutBar" href="#"
                                class="my-1 items-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400
                        py-1 px-4 font-sans text-xs font-thin text-white shadow-md shadow-green-500/20 transition-all
                        hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none
                        disabled:opacity-50 disabled:shadow-none flex"
                                data-ripple-light="true">
                                <i class="fas fa-sign-in-alt mr-2 text-xs"></i>Keluar
                            </a>
                        </div>
                    </ul>
                    <button onclick="showMenu()"
                        class="middle none relative ml-auto h-6 max-h-[40px] w-6 max-w-[40px] rounded-lg text-center font-sans
                        text-xs font-medium uppercase text-blue-gray-500 transition-all hover:bg-transparent focus:bg-transparent
                        active:bg-transparent disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none md:hidden">
                        <span class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                stroke="currentColor" strokeWidth="2">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M4 6h16M4 12h16M4 18h16">
                                </path>
                            </svg>
                        </span>
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="modalProduk" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-white text-gray-800">
            <div class="text-white text-xs font-sans">
                <div class="flex flex-row">
                    <div class="w-2/3 bg-gradient-to-l from-green-900 to-green-800 rounded-md p-2">
                        <div class="mb-3">BPR Kencana A</div>
                        <div class="flex flex-row">
                            <div class="w-1/2">
                                <div class="flex flex-row">
                                    <div class="mr-3">
                                        <div>Kode OJK</div>
                                        <div>No SK</div>
                                        <div>Alamat</div>
                                        <div>Website</div>
                                    </div>
                                    <div>
                                        <div>32342325</div>
                                        <div>SK0896565</div>
                                        <div>Jakarta</div>
                                        <div>bpr.net</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-1/2">
                                <div class="flex flex-row mb-2">
                                    <div class="mr-3">
                                        <div>No Telepon</div>
                                        <div>Mulai Beroperasi</div>
                                    </div>
                                    <div>
                                        <div>(021) 893792892</div>
                                        <div>3 Maret 2020</div>
                                    </div>
                                </div>
                                <button data-ripple-light="true"
                                    class="text-xs sm:text-sm hover:shadow-lg border bg-gradient-to-tr
                                from-green-600 to-green-400 text-white
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-5 block p-1 leading-normal text-inherit antialiased">
                                    Lihat Profil</button>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/3 bg-gradient-to-l from-green-900 to-green-800 rounded-md p-2 ml-1">
                        <div class="mb-3">Neraca Keuangan Juli 2023</div>
                        <div class="flex flex-row">
                            <div class="mr-4">
                                <div>Asset</div>
                                <div>Kewajiban</div>
                                <div>Ekuitas</div>
                            </div>
                            <div>
                                <div>Rp 10.000.000.000</div>
                                <div>Rp 2.000.000</div>
                                <div>Rp 1.000.000</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="text-black my-3 w-full rounded-lg border border-green-800 shadow-md p-2 text-xs sm:text-sm">
                    <div class="flex justify-between text-xs items-center">
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
                    </div>
                    <div class="grid sm:hidden grid-cols-2 gap-2 text-xs mt-2 items-center">
                        <div class="mr-0">
                            <div>Bagi Hasil Setara</div>
                            <div>5% / Tahun</div>
                        </div>
                        <div class="mr-0">
                            <div>Nisbah</div>
                            <div>40 : 60</div>
                        </div>
                        <div class="mr-0">
                            <div>Tenor</div>
                            <div>6 Bulan</div>
                        </div>
                        <div class="mr-0">
                            <div>Tanggal Berakhir</div>
                            <div>18 Agustus 2023</div>
                        </div>
                        <div class="mr-0">
                            <div>Minimal Deposito</div>
                            <div>Rp 1.000.000</div>
                        </div>
                        <div class="mr-0">
                            <div>Target</div>
                            <div>Rp 500.000.000</div>
                        </div>
                        <div class="mr-0">
                            <div>Dana Terkumpul</div>
                            <div>Rp 50.000.000 (10%)</div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-row text-black my-3 w-full rounded-lg border border-green-800 shadow-md p-2 text-xs sm:text-sm">
                    <div class="w-1/2 mx-3 text-xs">
                        <div class="my-2 relative h-10 w-full min-w-[200px]">
                            <input
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-green-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Masukkan Nominal Deposito Anda
                            </label>
                        </div>
                        <div class="flex justify-center">
                            <button data-ripple-light="true"
                                class="bg-gradient-to-tr from-green-600 to-green-400 text-sm mr-2 hover:shadow-lg
                                hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                                lg:px-5 block p-1 leading-normal text-inherit antialiased text-white">
                                Ajukan</button>
                        </div>
                    </div>
                    <div class="w-1/2 mx-3 text-xs">
                        <div>Estimasi Perhitungan Bagi Hasil</div>
                        <div class="flex flex-col my-1">
                            <div class="h-1 w-1 rounded-full bg-black"></div>
                            <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <div>Penempatan Dana</div>
                                <div>Bagi Hasil</div>
                            </div>
                            <div>
                                <div>Rp 10.000.000</div>
                                <div>Rp 41.000</div>
                            </div>
                        </div>
                        <div class="flex flex-col my-1">
                            <div class="h-1 w-1 rounded-full bg-black"></div>
                            <div class="bg-black" style="margin-top:-2.5px; height: 1px"></div>
                        </div>
                        <div class="flex justify-between">
                            <div>Estimasi Total Pengembalian</div>
                            <div>Rp 10.041.000</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-action">
                <label for="modalProduk" data-ripple-light="true"
                    class="border border-gray-500 cursor-pointer text-sm mr-2 hover:shadow-lg
                        hover:shadow-green-500/40 whitespace-nowrap rounded-md px-2
                        lg:px-5 block p-1 leading-normal text-inherit antialiased">
                    Close</label>
            </div>
        </div>
    </div>

    <script>
        let menuStatus = 0

        function showMenu() {
            if (menuStatus == 0) {
                $('#menuBar').fadeIn()
                menuStatus = 1
            } else {
                $('#menuBar').hide()
                menuStatus = 0
            }
        }
    </script>
</body>

</html>
