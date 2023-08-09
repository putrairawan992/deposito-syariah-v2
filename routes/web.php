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
$router->get('/', function () use ($router) {
    // return [$router->app->version(),phpversion()];
    return view('welcome');
    // return view('auth.login');
});

// Admin Page
$router->get('/admin', function () use ($router) {
    return view('admin.dashboard');
});
$router->get('/admin/dashboard', function () use ($router) {
    return view('admin.dashboard');
});

// Nasabah Page
$router->get('/dashboard', function () use ($router) {
    return view('nasabah.dashboard');
});
$router->get('/produk', function () use ($router) {
    return view('nasabah.produk');
});
$router->get('/portofolio', function () use ($router) {
    return view('nasabah.portofolio');
});
$router->get('/profil', function () use ($router) {
    return view('nasabah.profil');
});
$router->get('/promo', function () use ($router) {
    return view('nasabah.promo');
});
$router->get('/pemberitahuan', function () use ($router) {
    return view('nasabah.pemberitahuan');
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

// Api
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/user', 'AuthController@index');
    $router->get('/listnasabah', 'AuthController@nasabah');
    $router->get('/listmitra', 'AuthController@mitra');
    $router->get('/produk', 'ProductController@index');

    // Fix Function
    $router->get('/userprofile', 'AuthController@userprofile');
    $router->post('/ceklogin', 'AuthController@ceklogin');
    $router->post('/cekloginmobile', 'AuthController@cekloginmobile');
    $router->post('/login', 'AuthController@login');
    $router->get('/showpromo', 'PromoController@show');
    $router->get('/promo/{id}', 'PromoController@detail');
    $router->get('/showproduk', 'ProductController@show');
    $router->get('/produk/{id}', 'ProductController@detail');

    $router->get('/delall', 'AuthController@deleteall');

    // Test create DB Fixed
    $router->post('/createdb/{dbname}', 'DatabaseController@generateDb');
    $router->get('/cekdb/{dbname}', 'DatabaseController@checkDatabaseName');

    $router->group(['middleware' => 'admin'], function () use ($router) {
        // Admin Section
        $router->post('/regadmin', 'AuthController@regadmin');
        $router->put('/updateadmin', 'AuthController@update');
        $router->put('/aktivadmin/{id}', 'AuthController@aktivasi');

        // Mitra Section
        $router->post('/regmitra', 'MitraController@store');
        $router->put('/regmitra', 'MitraController@update');
        $router->put('/validasimitra', 'MitraController@validasi');
        $router->put('/restoremitra/{id}', 'MitraController@restore');
        $router->delete('/hapusmitra/{id}', 'MitraController@delete');

        // Nasabah Section
        $router->put('/validasinasabah', 'NasabahController@validasinasabah');
        $router->put('/restorenasabah/{id}', 'NasabahController@restore');
        $router->delete('/hapusnasabah/{id}', 'NasabahController@delete');

        // Splash Section
        $router->get('/splash', 'SplashController@index');
        $router->post('/splash', 'SplashController@store');
        $router->post('/updatesplash', 'SplashController@update');
        $router->put('/splashaktivasi/{id}', 'SplashController@aktivasi');
        $router->put('/splashrestore/{id}', 'SplashController@restore');
        $router->put('/splashdelete/{id}', 'SplashController@delete');

        // Validasi Pembelian
        $router->put('/validasipembelian', 'ProductController@buyvalidasi');
    });

    $router->group(['middleware' => 'nasabah'], function () use ($router) {
        // Akses Nasabah
        $router->get('/refreshtoken', 'AuthController@refresh');
        $router->get('/nasabah', 'NasabahController@detail');
        $router->post('/regnasabah', 'NasabahController@store');

        // Promo Splash Screen
        $router->get('/showsplash', 'SplashController@show');
        $router->get('/splash/{id}', 'SplashController@detail');

        // Pembelian
        $router->get('/pembelian', 'ProductController@buyshow');
        $router->post('/pembeliandetail', 'ProductController@buydetail');
        $router->post('/pembelian', 'ProductController@buystore');
        $router->put('/pembelian', 'ProductController@buyupdate');
        $router->put('/pembeliancancel', 'ProductController@buycancel');
    });

    $router->group(['middleware' => 'mitra'], function () use ($router) {
        // Akses BPR
        $router->post('/neraca', 'MitraController@storeneraca');
        $router->put('/neraca', 'MitraController@updateneraca');

        // Promo
        $router->get('/promo', 'PromoController@index');
        $router->post('/promo', 'PromoController@store');
        $router->post('/updatepromo', 'PromoController@update');
        $router->put('/promoaktivasi/{id}', 'PromoController@aktivasi');
        $router->put('/promorestore/{id}', 'PromoController@restore');
        $router->put('/promodelete/{id}', 'PromoController@delete');

        // Produk
        $router->post('/produk', 'ProductController@store');
        $router->post('/updateproduk', 'ProductController@update');
        $router->put('/produkaktivasi/{id}', 'ProductController@aktivasi');
        $router->put('/produkrestore/{id}', 'ProductController@restore');
        $router->put('/produkdelete/{id}', 'ProductController@delete');
    });

    $router->group(['middleware' => 'owner'], function () use ($router) {
        // Akses Owner
        $router->post('/rekapdonasi', 'LaporanController@rekapDonasi');
        $router->post('/rekappenyalur', 'LaporanController@rekapPenyalur');
    });

    $router->group(['middleware' => 'authuser'], function () use ($router) {
        // Update Pass PIN Email Username Phone
        $router->put('/upuser', 'AuthController@update');
        $router->get('/logout', 'AuthController@logout');
    });
});
