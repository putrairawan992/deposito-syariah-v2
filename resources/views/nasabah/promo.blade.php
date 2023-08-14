@extends ('layout.nasabah')

@section('content')
    <script src="js/layout.js"></script>
    <script></script>

    <head>
        <title>Promo - Deposito Syariah</title>
    </head>

    <div class="mx-2 sm:mx-7 sm:mt-20 mt-12 text-black flex items-center justify-center">
        <div>
            <div class="bg-white rounded-lg p-4 mb-2 w-80 sm:w-full font-sans text-xs">
                <div class="text-lg font-semibold mb-3">Semua Promo</div>
                <div class="mt-3 grid sm:grid-cols-2 lg:grid-cols-3 grid-cols-1 sm:gap-3 gap-2 sm:text-base text-xs">
                    <div>
                        <div class="flex flex-col md:flex-row rounded-md border border-green-800 shadow-md shadow-green-300">
                            <img class="object-cover h-36 w-full sm:w-48"
                                src="https://static.bmdstatic.com/st/home/76e4c0-MB.jpg" alt="">
                            <div class="ml-3 p-2 flex flex-col justify-between text-xs sm:text-sm lg:text-md font-sans">
                                <div>Ada Promo Bank dan Partner, Ayo Bergabung sebelum Kehabisan promonya</div>
                                <div>by Bank BPR A<br>Hingga 1 Semptember 2023</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-col md:flex-row rounded-md border border-green-800 shadow-md shadow-green-300">
                            <img class="object-cover h-36 w-full sm:w-48"
                                src="https://static.bmdstatic.com/st/home/76e4c0-MB.jpg" alt="">
                            <div class="ml-3 p-2 flex flex-col justify-between text-xs sm:text-sm lg:text-md font-sans">
                                <div>Ada Promo Bank dan Partner, Ayo Bergabung sebelum Kehabisan promonya</div>
                                <div>by Bank BPR A<br>Hingga 1 Semptember 2023</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="flex flex-col md:flex-row rounded-md border border-green-800 shadow-md shadow-green-300">
                            <img class="object-cover h-36 w-full sm:w-48"
                                src="https://static.bmdstatic.com/st/home/76e4c0-MB.jpg" alt="">
                            <div class="ml-3 p-2 flex flex-col justify-between text-xs sm:text-sm lg:text-md font-sans">
                                <div>Ada Promo Bank dan Partner, Ayo Bergabung sebelum Kehabisan promonya</div>
                                <div>by Bank BPR A<br>Hingga 1 Semptember 2023</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="flex flex-col md:flex-row rounded-md border border-green-800 shadow-md shadow-green-300">
                            <img class="object-cover h-36 w-full sm:w-48"
                                src="https://static.bmdstatic.com/st/home/76e4c0-MB.jpg" alt="">
                            <div class="ml-3 p-2 flex flex-col justify-between text-xs sm:text-sm lg:text-md font-sans">
                                <div>Ada Promo Bank dan Partner, Ayo Bergabung sebelum Kehabisan promonya</div>
                                <div>by Bank BPR A<br>Hingga 1 Semptember 2023</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sm:h-12 h-16"></div>

    <script>
        $("#linkPromo").css('pointer-events', 'none')
        $("#linkPromo").addClass('bg-gradient-to-tr from-green-600 to-green-400 text-white py-1')
        $('#linkPromoBar').hide()

        $('#signIn').hide()
        $('#signInBar').hide()
    </script>
@endsection
