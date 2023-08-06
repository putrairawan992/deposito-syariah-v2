@extends ('layout.nasabah')

@section('content')
    <script src="js/layout.js"></script>
    <script></script>

    <head>
        <title>Pemberitahuan - Deposito Syariah</title>
    </head>

    <div class="mx-1 sm:mx-7 sm:mt-20 mt-12 text-black flex items-center justify-center">
        <div style="max-width: 1100px">
            <div class="font-sans bg-white rounded-lg p-2 sm:p-4 mb-2 w-80 sm:w-full">
                <div class="font-semibold mb-4 w-full text-center">Semua Pemberitahuan</div>
                <table class="table table-sm" id="tbPemberitahuan">
                    <!-- head -->
                    <thead>
                        <tr class="text-black text-base">
                            <th></th>
                            <th class="text-center">Pemberitahuan</th>
                            <th class="text-center">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr>
                            <th>1</th>
                            <td>Pengajuan penarilan untuk no D001-M001-23409404 sedang kami validasi maksimal 2x24jam</td>
                            <td>28 Juli 2023, 10:00</td>
                        </tr>
                        <!-- row 2 -->
                        <tr>
                            <th>2</th>
                            <td>Pembelian Deposito dengan no D001-M002-34234223 telah divalidasi tidak valid oleh Admin BPR
                            </td>
                            <td>28 Juli 2023, 10:00</td>
                        </tr>
                        <!-- row 3 -->
                        <tr>
                            <th>3</th>
                            <td>Pembatalan pemblian deposito no DS-29394234 telah dibatalkan oleh nasabah</td>
                            <td>28 Juli 2023, 10:00</td>
                        </tr>
                    </tbody>
                </table>
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
