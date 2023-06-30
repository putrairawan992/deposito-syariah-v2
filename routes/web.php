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
    $router->get('/delall', 'AuthController@deleteall');

    // Test create DB Fixed
    $router->get('/createdb/{dbname}', 'DatabaseController@newDbTransaksi');

    $router->group(['middleware' => 'admin'], function () use ($router) {
        // Akses Admin
        $router->post('/regadmin', 'AuthController@regadmin');
        $router->put('/aktivadmin/{id}', 'AuthController@aktivasi');
        $router->put('/updateadmin', 'AuthController@updateadmin');
        $router->post('/regmitra', 'MitraController@regmitra');
        $router->put('/updatemitra', 'MitraController@updatemitra');
        $router->post('/validasinasabah', 'NasabahController@validasinasabah');
        $router->put('/restorenasabah/{id}', 'NasabahController@restorenasabah');
        $router->delete('/hapusnasabah/{id}', 'NasabahController@deletenasabah');
        $router->post('/validasimitra', 'MitraController@validasimitra');
        $router->put('/restoremitra/{id}', 'MitraController@restoremitra');
        $router->delete('/hapusmitra/{id}', 'MitraController@deletemitra');
    });

    $router->group(['middleware' => 'auth'], function () use ($router) {
        // Akses Nasabah
        $router->get('/userprofile', 'AuthController@userprofile');
        $router->post('/regnasabah', 'NasabahController@regnasabah');
        $router->put('/updatenasabah', 'NasabahController@updatenasabah');
        $router->get('/refreshtoken', 'AuthController@refresh');
    });

    $router->group(['middleware' => 'mitra'], function () use ($router) {
        // Akses BPR
        $router->post('/neraca', 'MitraController@neraca');
    });

    $router->group(['middleware' => 'owner'], function () use ($router) {
        // Akses Owner
        $router->post('/rekapdonasi', 'LaporanController@rekapDonasi');
        $router->post('/rekappenyalur', 'LaporanController@rekapPenyalur');
    });
});
