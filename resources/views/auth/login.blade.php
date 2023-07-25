@extends('layout.nasabah')

@section('content')

    <head>
        <title>Login - Deposito Syariah</title>
    </head>

    <iframe name="hiddenFrame" style="position:absolute; top:-1px; left:-1px; width:1px; height:1px;"></iframe>

    <div class="flex items-center justify-center h-4/5">
        <div
            class="p-3 relative flex w-5/6 sm:w-3/5 md:w-2/5 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-sm shadow-white">
            <div class="flex items-center justify-center">
                <img class="h-8 md:h-10 lg:h-16" src="/img/Logo Harta Insan Karimah.png" alt="Logo HIK">
            </div>
            <div class="text-center text-md md:text-xl font-semibold mt-2">Selamat Datang</div>
            <div class="text-center text-xs md:text-sm">Silahkan masukan nomor handphone anda.</div>

            <div class="px-3">
                <form action="" method="post" target="hiddenFrame">
                    <div class="mb-6 relative h-10 w-full min-w-[100px] my-4">
                        <input id="username"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent 
                        px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all 
                        placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 
                        focus:border-2 focus:border-green-800 focus:border-t-transparent focus:outline-0 disabled:border-0 
                        disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-800 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-800 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-800 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Phone
                        </label>
                    </div>
                    <div id="password" class="relative h-10 w-full min-w-[100px] mt-4">
                        <input id="username" type="password"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent 
                        px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all 
                        placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 
                        focus:border-2 focus:border-green-800 focus:border-t-transparent focus:outline-0 disabled:border-0 
                        disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-green-800 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-green-800 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-green-800 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Password
                        </label>
                    </div>
                    <label class="mb-6 text-xs italic">Anda lupa password ? <a href="#"
                            class="underline">Klik</a></label>
                    <div class="flex justify-center my-4">
                        <button id="nextUsername"
                            class="w-2/6 items-center justify-center middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400 
                    py-2 px-4 font-sans text-xs font-thin text-white shadow-md shadow-green-500/20 transition-all 
                    hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none 
                    disabled:opacity-50 disabled:shadow-none flex"
                            data-ripple-light="true">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>Lanjut
                        </button>
                    </div>
                </form>

                <div>
                    <form action="" method="post">
                        <div class="flex flex-col space-y-16">
                            <div class="flex flex-row items-center justify-between mx-auto w-full max-w-xs">
                                <div class="w-12 h-12">
                                    <input
                                        class="w-full h-full flex flex-col items-center justify-center text-center 
                                    px-1 outline-none rounded-md border border-gray-200 text-sm bg-white 
                                    focus:bg-gray-50 focus:ring-1 ring-green-700"
                                        type="text" name="otp1" id="otp1">
                                </div>
                                <div class="w-12 h-12">
                                    <input
                                        class="w-full h-full flex flex-col items-center justify-center text-center 
                                    px-1 outline-none rounded-md border border-gray-200 text-sm bg-white 
                                    focus:bg-gray-50 focus:ring-1 ring-green-700"
                                        type="text" name="otp2" id="otp2">
                                </div>
                                <div class="w-12 h-12">
                                    <input
                                        class="w-full h-full flex flex-col items-center justify-center text-center 
                                    px-1 outline-none rounded-md border border-gray-200 text-sm bg-white 
                                    focus:bg-gray-50 focus:ring-1 ring-green-700"
                                        type="text" name="otp3" id="otp3">
                                </div>
                                <div class="w-12 h-12">
                                    <input
                                        class="w-full h-full flex flex-col items-center justify-center text-center 
                                    px-1 outline-none rounded-md border border-gray-200 text-sm bg-white 
                                    focus:bg-gray-50 focus:ring-1 ring-green-700"
                                        type="text" name="otp4" id="otp4">
                                </div>
                            </div>

                            <div class="flex flex-col space-y-5">
                                <div>
                                    <button
                                        class="flex flex-row items-center justify-center text-center w-full border rounded-xl outline-none py-5 bg-blue-700 border-none text-white text-sm shadow-sm">
                                        Verify Account
                                    </button>
                                </div>

                                <div
                                    class="flex flex-row items-center justify-center text-center text-sm font-medium space-x-1 text-gray-500">
                                    <p>Didn't recieve code?</p> <a class="flex flex-row items-center text-blue-600"
                                        href="http://" target="_blank" rel="noopener noreferrer">Resend</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="md:hidden flex justify-center items-center w-full text-xs absolute bottom-16 sm:bottom-10 text-green-100">
        <div>Tercatat dan diawasi oleh OJK &nbsp;</div>
        <div class="font-semibold">No.S-123/MS.123/122/2023</div>
    </div>
    <div class="hidden md:block absolute text-xs bottom-12 left-8 text-green-100">
        <div>Tercatat dan diawasi oleh OJK</div>
        <div class="font-semibold">No.S-123/MS.123/122/2023</div>
    </div>
@endsection
