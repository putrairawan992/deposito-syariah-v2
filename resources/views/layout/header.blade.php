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
                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52"
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
                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-40">
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

{{-- <style>
    /* Preloader styles */
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader {
        border: 6px solid whitesmoke;
        /* Light grey border */
        border-top: 6px solid #3498db;
        /* Blue border for the loader animation */
        border-radius: 50%;
        width: 74px;
        height: 74px;
        animation: spin 1.5s linear infinite;
        /* Animation for the loader */
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style> --}}

<script>
    const preloader = document.querySelector('.preloader');
    setTimeout(function() {
        $('#preloader').fadeOut()
    }, 1500);
</script>

</html>
