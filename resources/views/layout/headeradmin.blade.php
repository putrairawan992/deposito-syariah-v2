<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- SA, Excel to JSON, JQUERY -->
    <script src="/plugins/sweetalert.min.js"></script>
    <script src="/plugins/jquery-3.7.0.min.js"></script>
    <script src="/plugins/xlsx.min.js"></script>
    <link href="/output.css" rel="stylesheet">

    <!-- Material Icons Link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="icon" type="image/x-icon" href="/img/Favicon Harta Insan Karimah.png">

    <title>Admin Panel - Deposito Syariah</title>
</head>

<body class="bg-gradient-to-l from-green-900 to-green-800 h-full min-h-screen">

    <div class="fixed w-full z-30 flex bg-white p-2 items-center justify-center h-16 px-10">
        <div class="logo ml-12  transform ease-in-out duration-500 flex-none h-full flex items-center justify-center">
            <img class="h-10" src="/img/Logo Harta Insan Karimah.png" alt="Logo HIK">
        </div>
        <!-- SPACER -->
        <div class="grow h-full flex items-center justify-center"></div>
        <div class="flex-none h-full text-center flex items-center justify-center">

            <div class="flex space-x-3 items-center px-3">
                <div class="flex-row flex items-center" id="identity">
                    <div class="dropdown dropdown-bottom dropdown-end ml-2 mr-6">
                        <div class="indicator">
                            <span class="indicator-item badge bg-red-900 text-white text-xs "
                                id="countNotif">&#8734;</span>
                            <button tabindex="0"
                                class="bg-opacity-0 btn-circle border-0 btn -m-2 hover:shadow-lg hover:bg-green-100 hover:border hover:border-green-900
                                    hover:shadow-green-500/40 active:opacity-[0.85]">
                                <i class="text-xl far fa-bell text-green-900"></i>
                            </button>
                        </div>
                        <ul tabindex="0"
                            class="bg-white dropdown-content z-[1] menu p-2 shadow rounded-md w-72 mt-5 font-sans text-gray-700"
                            id="listNotif">
                            <li><a class="rounded-md border-0 hover:text-black hover:border hover:border-green-700">
                                    Nasabah No 00001 menunggu Validasi</a></li>
                            <li><a class="rounded-md border-0 hover:text-black hover:border hover:border-green-700">
                                    Nasabah No 00001 menunggu Validasi</a></li>
                            <li><a class="rounded-md border-0 hover:text-black hover:border hover:border-green-700">
                                    Nasabah No 00001 menunggu Validasi</a></li>
                            <li><a class="rounded-md border-0 hover:text-black hover:border hover:border-green-700">
                                    Nasabah No 00001 menunggu Validasi</a></li>
                        </ul>
                    </div>
                    <div class="dropdown dropdown-bottom dropdown-end">
                        <button tabindex="0"
                            class="flex-row flex items-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400
                                py-2 px-3 font-sans font-bold text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg
                                hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            data-ripple-light="true">
                            <i class="fas fa-user-circle text-xl mr-2"></i>
                            <div class="text-sm" id="namaAdminKanan">Admin</div>
                        </button>
                        <ul tabindex="0"
                            class="bg-white dropdown-content z-[1] menu p-2 shadow rounded-md mt-5 w-52 text-gray-700">
                            <li><a href="/profil"
                                    class="rounded-md border-0 hover:text-black hover:border hover:border-green-700"><i
                                        class="fas fa-id-card"></i>
                                    Profil</a></li>
                            <li><a onclick="logoutUser()"
                                    class="rounded-md border-0 hover:text-black hover:border hover:border-green-700"><i
                                        class="fas fa-sign-out-alt"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <aside
        class="w-60 -translate-x-48 fixed transition transform ease-in-out duration-1000 z-50 flex h-screen bg-[#233b1e] ">
        <!-- open sidebar button -->
        <div
            class="max-toolbar translate-x-24 scale-x-0 w-full -right-6 transition transform ease-in duration-300 flex items-center justify-between border-4 border-white dark:border-[#0F172A] bg-[#233b1e]  absolute top-2 rounded-full h-12">
            <div class="flex items-center space-x-3 group pl-4 pr-2 py-1 rounded-full text-white  ">
                <div class="transform ease-in-out duration-300 mr-4" id="namaAdminKiri">
                    Admin
                </div>
            </div>
        </div>
        <div onclick="openNav()"
            class="-right-6 transition transform ease-in-out duration-500 flex border-4 border-white dark:border-[#0F172A] bg-[#233b1e] hover:bg-green-500 absolute top-2 p-3 rounded-full text-white hover:rotate-45">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3}
                stroke="currentColor" class="w-4 h-4">
                <path strokeLinecap="round" strokeLinejoin="round"
                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
        </div>
        <!-- MAX SIDEBAR-->
        <div class="max hidden text-white pr-2 mt-16 flex-col space-y-2 w-full h-[calc(100vh)]">
            <a href="/admin/dashboard"
                class="-ml-2 hover:ml-1 rounded-md hover:bg-green-800 w-full text-white hover:text233b1e] p-2 pl-8 transform ease-in-out duration-300 flex justify-between items-center space-x-3">
                <div> Dashboard</div><i class="fas fa-tachometer-alt pr-5"></i>
            </a>
            <a href="/admin/mitra"
                class="-ml-2 hover:ml-1 rounded-md hover:bg-green-800 w-full text-white hover:text233b1e] p-2 pl-8 transform ease-in-out duration-300 flex justify-between items-center space-x-3">
                <div>Mitra</div><i class="fas fa-handshake pr-5"></i>
            </a>
            <a href="/admin/nasabah"
                class="-ml-2 hover:ml-1 rounded-md hover:bg-green-800 w-full text-white hover:text233b1e] p-2 pl-8 transform ease-in-out duration-300 flex justify-between items-center space-x-3">
                <div>Nasabah</div><i class="fas fa-users pr-5"></i>
            </a>
            <a href="/admin/promo"
                class="-ml-2 hover:ml-1 rounded-md hover:bg-green-800 w-full text-white hover:text233b1e] p-2 pl-8 transform ease-in-out duration-300 flex justify-between items-center space-x-3">
                <div>Promo</div><i class="fas fa-percentage pr-5"></i>
            </a>
            <a href="/admin/produk"
                class="-ml-2 hover:ml-1 rounded-md hover:bg-green-800 w-full text-white hover:text233b1e] p-2 pl-8 transform ease-in-out duration-300 flex justify-between items-center space-x-3">
                <div>Produk</div><i class="fas fa-file-contract pr-5"></i>
            </a>
            <a href="/admin/transaksi"
                class="-ml-2 hover:ml-1 rounded-md hover:bg-green-800 w-full text-white hover:text233b1e] p-2 pl-8 transform ease-in-out duration-300 flex justify-between items-center space-x-3">
                <div>Portofolio</div><i class="fas fa-wallet pr-5"></i>
            </a>
            <a href="#"
                class="-ml-2 hover:ml-1 rounded-md hover:bg-green-800 w-full text-white hover:text233b1e] p-2 pl-8 transform ease-in-out duration-300 flex justify-between items-center space-x-3">
                <div>Splash Screen</div><i class="fas fa-tv pr-5"></i>
            </a>
            <a href="/admin/aksesuser"
                class="-ml-2 hover:ml-1 rounded-md hover:bg-green-800 w-full text-white hover:text233b1e] p-2 pl-8 transform ease-in-out duration-300 flex justify-between items-center space-x-3">
                <div>Akses User</div><i class="fas fa-users-cog pr-5"></i>
            </a>
            <a href="/admin/aksesuser"
                class="-ml-2 hover:ml-1 rounded-md hover:bg-green-800 w-full text-white hover:text233b1e] p-2 pl-8 transform ease-in-out duration-300 flex justify-between items-center space-x-3">
                <div>Aktivitas</div><i class="fas fa-list-alt pr-5"></i>
            </a>
            <a href="#"
                class="-ml-2 hover:ml-1 rounded-md hover:bg-green-800 w-full text-white hover:text233b1e] p-2 pl-8 transform ease-in-out duration-300 flex justify-between items-center space-x-3">
                <div>Laporan</div><i class="fas fa-file-alt pr-5"></i>
            </a>
        </div>
        <!-- MINI SIDEBAR-->
        <div class="mini mt-16 flex flex-col space-y-2 w-full h-[calc(100vh)]">
            <a href="/admin/dashboard"
                class="-ml-1 hover:ml-0 rounded-md hover:bg-green-800 justify-end text-white w-full bg-[#233b1e] p-3 transform ease-in-out duration-300 flex">
                <i class="fas fa-tachometer-alt"></i>
            </a>
            <a href="/admin/mitra"
                class="-ml-1 hover:ml-0 rounded-md hover:bg-green-800 justify-end text-white w-full bg-[#233b1e] p-3 transform ease-in-out duration-300 flex">
                <i class="fas fa-handshake"></i>
            </a>
            <a href="/admin/nasabah"
                class="-ml-1 hover:ml-0 rounded-md hover:bg-green-800 justify-end text-white w-full bg-[#233b1e] p-3 transform ease-in-out duration-300 flex">
                <i class="fas fa-users"></i>
            </a>
            <a href="/admin/promo"
                class="-ml-1 hover:ml-0 rounded-md hover:bg-green-800 justify-end text-white w-full bg-[#233b1e] p-3 transform ease-in-out duration-300 flex">
                <i class="fas fa-percentage"></i>
            </a>
            <a href="/admin/produk"
                class="-ml-1 hover:ml-0 rounded-md hover:bg-green-800 justify-end text-white w-full bg-[#233b1e] p-3 transform ease-in-out duration-300 flex">
                <i class="fas fa-file-contract"></i>
            </a>
            <a href="/admin/transaksi"
                class="-ml-1 hover:ml-0 rounded-md hover:bg-green-800 justify-end text-white w-full bg-[#233b1e] p-3 transform ease-in-out duration-300 flex">
                <i class="fas fa-wallet"></i>
            </a>
            <a href="#"
                class="-ml-1 hover:ml-0 rounded-md hover:bg-green-800 justify-end text-white w-full bg-[#233b1e] p-3 transform ease-in-out duration-300 flex">
                <i class="fas fa-tv"></i>
            </a>
            <a href="/admin/aksesuser"
                class="-ml-1 hover:ml-0 rounded-md hover:bg-green-800 justify-end text-white w-full bg-[#233b1e] p-3 transform ease-in-out duration-300 flex">
                <i class="fas fa-users-cog"></i>
            </a>
            <a href="#"
                class="-ml-1 hover:ml-0 rounded-md hover:bg-green-800 justify-end text-white w-full bg-[#233b1e] p-3 transform ease-in-out duration-300 flex">
                <i class="fas fa-list-alt"></i>
            </a>
            <a href="#"
                class="-ml-1 hover:ml-0 rounded-md hover:bg-green-800 justify-end text-white w-full bg-[#233b1e] p-3 transform ease-in-out duration-300 flex">
                <i class="fas fa-file-alt"></i>
            </a>
        </div>

    </aside>

    <script>
        const sidebar = document.querySelector("aside");
        const maxSidebar = document.querySelector(".max")
        const miniSidebar = document.querySelector(".mini")
        const roundout = document.querySelector(".roundout")
        const maxToolbar = document.querySelector(".max-toolbar")
        const logo = document.querySelector('.logo')
        const content = document.querySelector('.content')
        const moon = document.querySelector(".moon")
        const sun = document.querySelector(".sun")

        function openNav() {
            if (sidebar.classList.contains('-translate-x-48')) {
                // max sidebar
                sidebar.classList.remove("-translate-x-48")
                sidebar.classList.add("translate-x-none")
                maxSidebar.classList.remove("hidden")
                maxSidebar.classList.add("flex")
                miniSidebar.classList.remove("flex")
                miniSidebar.classList.add("hidden")
                maxToolbar.classList.add("translate-x-0")
                maxToolbar.classList.remove("translate-x-24", "scale-x-0")
                logo.classList.remove("ml-12")
                content.classList.remove("ml-12")
                content.classList.add("ml-12", "md:ml-60")
            } else {
                // mini sidebar
                sidebar.classList.add("-translate-x-48")
                sidebar.classList.remove("translate-x-none")
                maxSidebar.classList.add("hidden")
                maxSidebar.classList.remove("flex")
                miniSidebar.classList.add("flex")
                miniSidebar.classList.remove("hidden")
                maxToolbar.classList.add("translate-x-24", "scale-x-0")
                maxToolbar.classList.remove("translate-x-0")
                logo.classList.add('ml-12')
                content.classList.remove("ml-12", "md:ml-60")
                content.classList.add("ml-12")

            }

        }
    </script>


</html>
