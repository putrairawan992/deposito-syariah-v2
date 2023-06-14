<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// View
$router->get('/', function () use ($router) {
    return $router->app->version();
    // return view('welcome');
    // return view('auth.login');
});

// Main Page
$router->get('/dashboard', function () use ($router) {
    return view('admin.dashboard');
});
$router->get('/donasi', function () use ($router) {
    return view('admin.donasi');
});
$router->get('/penyalur', function () use ($router) {
    return view('admin.penyalur');
});
$router->get('/donatur', function () use ($router) {
    return view('admin.donatur');
});
$router->get('/masjid', function () use ($router) {
    return view('admin.masjid');
});
$router->get('/zismustahik', function () use ($router) {
    return view('admin.zismustahik');
});
$router->get('/users', function () use ($router) {
    return view('admin.users');
});
$router->get('/laporan', function () use ($router) {
    return view('admin.laporan');
});
$router->get('/pengaturan', function () use ($router) {
    return view('admin.pengaturan');
});

// Auth
$router->get('/login', function () use ($router) {
    return view('auth.login');
});
$router->get('/register', function () use ($router) {
    return view('auth.register');
});
$router->get('/forgotpassword', function () use ($router) {
    return view('auth.forgotpassword');
});

$router->get('/test', function () {
    try {
        $results = DB::select('SELECT * from users');
        return response()->json($results);
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

// Api
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/ceklogin', 'AuthController@ceklogin');
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
    $router->get('/user', 'AuthController@index');

    // Admin
    $router->group(['middleware' => 'admin'], function () use ($router) {
        // $router->get('/user', 'AuthController@index');
        // $router->post('/adduser', 'AuthController@adduser');
        // $router->put('/update', 'AuthController@update');
        // $router->get('/jeniszis', 'JeniszisController@index');
        // $router->post('/jeniszis', 'JeniszisController@store');
        // $router->put('/jeniszis', 'JeniszisController@update');
        // $router->delete('/user', 'AuthController@destroy');
        // $router->delete('/jeniszis', 'JeniszisController@destroy');
        // $router->delete('/lokasi', 'LokasiController@destroy');
        // $router->delete('/userzis', 'UserzisController@destroy');
    });

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/userprofile', 'AuthController@userprofile');
        $router->post('/logout', 'AuthController@logout');

        // Masjid
        $router->get('/masjid', 'MasjidController@index');
        $router->get('/masjid/{id}', 'MasjidController@detail');
        $router->post('/masjid', 'MasjidController@store');
        $router->post('/upmasjid', 'MasjidController@upload');
        $router->put('/masjid', 'MasjidController@update');
        $router->put('/masjid/{id}', 'MasjidController@aktivasi');
        $router->delete('/masjid/{id}', 'MasjidController@destroy');

        // Donatur
        $router->get('/donatur', 'DonaturController@index');
        $router->get('/donatur/{id}', 'DonaturController@detail');
        $router->post('/donatur', 'DonaturController@store');
        $router->post('/updonatur', 'DonaturController@upload');
        $router->put('/donatur', 'DonaturController@update');
        $router->put('/donatur/{id}', 'DonaturController@aktivasi');
        $router->delete('/donatur/{id}', 'DonaturController@destroy');

        // Petugas
        $router->get('/petugas', 'PetugasController@index');
        $router->get('/petugas/{id}', 'PetugasController@detail');
        $router->get('/petugasna/{id}', 'PetugasController@detailna');
        $router->post('/petugas', 'PetugasController@store');
        $router->post('/uppetugas', 'PetugasController@upload');
        $router->put('/petugas', 'PetugasController@update');
        $router->put('/petugas/{id}', 'DonaturController@aktivasi');
        $router->delete('/petugas/{id}', 'PetugasController@destroy');

        // Donasi
        $router->get('/donasi', 'DonasiController@index');
        $router->get('/donasi/{id}', 'DonasiController@detail');
        $router->get('/donasi/{masjid}/{zis}', 'DonasiController@rekap');
        $router->post('/donasi', 'DonasiController@store');
        $router->put('/donasi', 'DonasiController@update');
        $router->put('/donasi/{id}', 'DonasiController@aktivasi');
        $router->delete('/donasi/{id}', 'DonasiController@destroy');

        // Jeniszis
        $router->get('/jeniszis', 'JeniszisController@index');
        $router->get('/jeniszis/{id}', 'JeniszisController@detail');
        $router->post('/jeniszis', 'JeniszisController@store');
        $router->put('/jeniszis', 'JeniszisController@update');
        // $router->put('/jeniszis/{id}', 'JeniszisController@aktivasi');

        // JenisTransaksi
        $router->get('/jenistransaksi', 'JenisTransaksiController@index');
        $router->get('/jenistransaksi/{id}', 'JenisTransaksiController@detail');
        $router->post('/jenistransaksi', 'JenisTransaksiController@store');
        $router->put('/jenistransaksi', 'JenisTransaksiController@update');
        // $router->put('/jenistransaksi/{id}', 'JenisTransaksiController@aktivasi');

        // JenisProgram
        $router->get('/jenisprogram', 'JenisProgramController@index');
        $router->get('/jenisprogram/{id}', 'JenisProgramController@detail');
        $router->post('/jenisprogram', 'JenisProgramController@store');
        $router->put('/jenisprogram', 'JenisProgramController@update');
        // $router->put('/jenisprogram/{id}', 'JenisProgramController@aktivasi');

        // JenisMustahik
        $router->get('/jenismustahik', 'JenisMustahikController@index');
        $router->get('/jenismustahik/{id}', 'JenisMustahikController@detail');
        $router->post('/jenismustahik', 'JenisMustahikController@store');
        $router->put('/jenismustahik', 'JenisMustahikController@update');
        // $router->put('/jenismustahik/{id}', 'JenisMustahikController@aktivasi');

        // Mustahik
        $router->get('/mustahik', 'MustahikController@index');
        $router->get('/mustahik/{id}', 'MustahikController@detail');
        $router->post('/mustahik', 'MustahikController@store');
        $router->post('/upmustahik', 'MustahikController@upload');
        $router->put('/mustahik', 'MustahikController@update');
        $router->put('/mustahik/{id}', 'MustahikController@aktivasi');
        $router->delete('/mustahik/{id}', 'MustahikController@destroy');

        // Penyalur
        $router->get('/penyalur', 'PenyalurController@index');
        $router->get('/penyalur/{id}', 'PenyalurController@detail');
        $router->get('/penyalur/{masjid}/{program}', 'PenyalurController@rekap');
        $router->post('/penyalur', 'PenyalurController@store');
        $router->post('/uppenyalur', 'PenyalurController@upload');
        $router->put('/penyalur', 'PenyalurController@update');
        $router->put('/penyalur/{id}', 'PenyalurController@aktivasi');
        $router->delete('/penyalur/{id}', 'PenyalurController@destroy');

        // JenisMustahik
        $router->get('/jenismustahik', 'JenisMustahikController@index');
        // $router->get('/jenismustahik/{id}', 'JenisMustahikController@detail');
        // $router->post('/jenismustahik', 'JenisMustahikController@store');
        // $router->put('/jenismustahik', 'JenisMustahikController@update');
        // $router->put('/jenismustahik/{id}', 'JenisMustahikController@aktivasi');

        // Laporan
        $router->post('/lapdonasi', 'LaporanController@donasi');

        // Rekap Donasi Penyalur
        $router->post('/rekapdonasi', 'LaporanController@rekapDonasi');
        $router->post('/rekappenyalur', 'LaporanController@rekapPenyalur');
    });
});
