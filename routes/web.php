<?php
use Illuminate\Http\Request;

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
$router->group(['domain' => 'subdomain.localhost:8000'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return $router->app->version() . ' Awal';
    });
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
    $router->post('/login', 'AuthController@login');
    $router->get('/user', 'AuthController@index');
    $router->get('/nasabah', 'AuthController@nasabah');
    $router->get('/mitra', 'AuthController@mitra');
    $router->get('/promo', 'PromoController@index');
    $router->get('/promo/{id}', 'PromoController@detail');
    $router->get('/splash', 'SplashController@index');
    $router->get('/splash/{id}', 'SplashController@detail');
    $router->get('/produk', 'ProductController@index');
    $router->get('/produk/{id}', 'ProductController@detail');

    $router->get('/delall', 'AuthController@deleteall');

    // Test create DB Fixed
    $router->get('/createdb/{dbname}', 'DatabaseController@newDbTransaksi');

    $router->group(['middleware' => 'admin'], function () use ($router) {
        // Admin Section
        $router->post('/regadmin', 'AuthController@regadmin');
        $router->put('/updateadmin', 'AuthController@update');
        $router->put('/aktivadmin/{id}', 'AuthController@aktivasi');

        // Mitra Section
        $router->post('/regmitra', 'MitraController@store');
        $router->put('/updatemitra', 'MitraController@update');
        $router->put('/restoremitra/{id}', 'MitraController@restore');
        $router->delete('/hapusmitra/{id}', 'MitraController@delete');
        $router->post('/validasimitra', 'MitraController@validasimitra');

        // Nasabah Section
        $router->put('/validasinasabah', 'NasabahController@validasinasabah');
        $router->put('/restorenasabah/{id}', 'NasabahController@restore');
        $router->delete('/hapusnasabah/{id}', 'NasabahController@delete');
    });

    $router->group(['middleware' => 'auth'], function () use ($router) {
        // Akses Nasabah
        $router->get('/userprofile', 'AuthController@userprofile');
        $router->get('/refreshtoken', 'AuthController@refresh');
        $router->post('/regnasabah', 'NasabahController@store');
        $router->put('/updatenasabah', 'NasabahController@update');

        // Promo Splash Screen
        $router->get('/showpromo', 'PromoController@show');
    });

    $router->group(['middleware' => 'mitra'], function () use ($router) {
        // Akses BPR
        $router->post('/neraca', 'MitraController@storeneraca');
        $router->put('/neraca', 'MitraController@updateneraca');

        // Promo
        $router->post('/promo', 'PromoController@store');
        $router->post('/updatepromo', 'PromoController@update');
    });

    $router->group(['middleware' => 'owner'], function () use ($router) {
        // Akses Owner
        $router->post('/rekapdonasi', 'LaporanController@rekapDonasi');
        $router->post('/rekappenyalur', 'LaporanController@rekapPenyalur');
    });
});
