<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\helpers;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AuthController extends Controller
{
    public function index()
    {
        // $allUser = User::all();
        $allUser = User::select('id', 'email', 'username', 'phone', 'otp', 'created_otp', 'kriptorone', 'kriptortwo', 'role')
            // ->where('created_otp', '>', limitDatetimeOTP(-5))
            ->get();
        foreach ($allUser as $key => $value) {
            $kriptorone = $value->kriptorone;
            $kriptortwo = $value->kriptortwo;
            if ($value->email != null) {
                $value->email = dekripsina($value->email, $kriptorone, $kriptortwo);
            }
            if ($value->username != null) {
                $value->username = dekripsina($value->username, $kriptorone, $kriptortwo);
            }
            if ($value->phone != null) {
                $value->phone = dekripsina($value->phone, $kriptorone, $kriptortwo);
            }
        }
        return $allUser;
    }

    public function ceklogin(Request $request)
    {
        $username = $request->email;
        $loginType = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'other';
        if ($loginType == 'other') {
            $pattern = '/^\d{10,}$/';
            if (filter_var($username, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $pattern]])) {
                $regphone = null;
                $createotp = null;
                $enkripPhone = null;
                $rolena = null;
                $cekRole = User::all();
                foreach ($cekRole as $key => $value) {
                    $dekripPhone = dekripsina($value->phone, $value->kriptorone, $value->kriptortwo);
                    if ($username == $dekripPhone) {
                        $enkripPhone = $value->phone;
                        $rolena = $value->role;
                        break;
                    }
                }

                if ($rolena == 10 || $rolena == 0) {
                    $createotp = $this->createotp($enkripPhone);
                }

                if ($enkripPhone == null) {
                    $regphone = $this->regphone($username);
                }

                if ($regphone == 'create otp done') {
                    return response()->json('phone', 200);
                }
                if ($createotp == 'create otp done') {
                    return response()->json('phone', 200);
                }

                return response()->json('Register, CreateOTP Failed', 200);
            } else {
                $cekRole = DB::table('users')
                    ->where('username', $username)
                    ->first();
                if ($cekRole) {
                    if ($cekRole->role > 9) {
                        return response()->json('phone', 200);
                    } else {
                        return response()->json('username', 200);
                    }
                }
                return response()->json('Username Tidak Terdaftar', 404);
            }
        } else {
            $cekRole = DB::table('users')
                ->where('email', $username)
                ->first();
            if ($cekRole) {
                if ($cekRole->role > 9) {
                    return response()->json('phone', 200);
                } else {
                    return response()->json('email', 200);
                }
            }
            return response()->json('Email Tidak Terdaftar', 404);
        }
    }

    public function regnasabah(Request $request)
    {
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $alamat = $request->alamat;
        $phone = $request->phone;

        // Check if field is empty
        if (empty($email) or empty($username) or empty($password)) {
            return response()->json('Semua Kolom harus terisi', 400);
        }

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json('Email tidak Valid', 400);
        }

        // Check if password is greater than 5 character
        if (strlen($password) < 6) {
            return response()->json('Password Kurang Dari 6 Digit', 400);
        }

        // Check if user already exist
        if (User::where('email', '=', $email)->exists()) {
            return response()->json('Email yang anda input tidak dapat digunakan, coba yang lain', 400);
        }

        // Check if username already exist
        if (User::where('username', '=', $username)->exists()) {
            return response()->json('Username yang anda input tidak dapat digunakan, coba yang lain', 400);
        }

        // Check if phone already exist
        if (User::where('phone', '=', $phone)->exists()) {
            return response()->json('No Telepon yang anda input tidak dapat digunakan, coba yang lain', 400);
        }

        // Create new user
        try {
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = app('hash')->make($request->password);

            if ($user->save()) {
                return response()->json('Registrasi Berhasil', 200);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function regnamitra(Request $request)
    {
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $alamat = $request->alamat;
        $phone = $request->phone;

        // Check if field is empty
        if (empty($email) or empty($username) or empty($password)) {
            return response()->json('Semua Kolom harus terisi', 400);
        }

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json('Email tidak Valid', 400);
        }

        // Check if password is greater than 5 character
        if (strlen($password) < 6) {
            return response()->json('Password Kurang Dari 6 Digit', 400);
        }

        // Check if user already exist
        if (User::where('email', '=', $email)->exists()) {
            return response()->json('Email yang anda input tidak dapat digunakan, coba yang lain', 400);
        }

        // Check if username already exist
        if (User::where('username', '=', $username)->exists()) {
            return response()->json('Username yang anda input tidak dapat digunakan, coba yang lain', 400);
        }

        // Check if phone already exist
        if (User::where('phone', '=', $phone)->exists()) {
            return response()->json('No Telepon yang anda input tidak dapat digunakan, coba yang lain', 400);
        }

        // Create new user
        try {
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = app('hash')->make($request->password);

            if ($user->save()) {
                return response()->json('Registrasi Berhasil', 200);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request)
    {
        $updateDataUser = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
        ];

        try {
            $user = DB::table('users');
            if (auth()->user()->role == 99 || auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 3) {
                $user
                    ->where('id', $request->id)
                    ->whereNotIn('role', [1, 99, 2, 3])
                    ->get();
            } elseif (auth()->user()->role != 0) {
                $user
                    ->where('id', $request->id)
                    ->whereIn('role', [0, 4, 5, 6, 10])
                    ->get();
            } else {
                return response()->json('Not Authorized', 401);
            }
            $user->update($updateDataUser);
            return response()->json('Updating Successfully', 200);
        } catch (\Exception $e) {
            return response()->json('Bad Request', 400);
        }
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return response()->json(auth()->refresh(), 200);
    }

    public function login(Request $request)
    {
        $username = $request->email;
        $password = $request->password;
        $otp = $request->password;
        $credentials = null;

        // Check if field is empty
        if (empty($username) or empty($password)) {
            return response()->json(['status' => 'error', 'message' => 'You must fill all the fields']);
        } else {
            $loginField = $username;
            $loginType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'other';
            if ($loginType == 'other') {
                if (is_numeric($username)) {
                    $loginType = 'phone';
                    $cekOtp = User::where($loginType, $username)
                        ->where('otp', $password)
                        ->firstOrFail();

                    if ($cekOtp) {
                        $token = JWTAuth::fromUser($cekOtp);

                        return response()->json([
                            'token' => $token,
                            'cekOtp' => $cekOtp,
                        ]);
                    } else {
                        return response()->json(['error' => 'User not found'], 404);
                    }
                }
                $loginType = 'username';

                return response()->json(['error' => 'User not found'], 404);
            }
            request()->merge([$loginType => $loginField]);
            $asciina = convertToAscii($username, str_split(765));
            $credentials = request([$loginType, 'otp']);
            return response()->json(
                [
                    'asciiNa' => $asciina,
                    'decyptna' => convertFromAscii($asciina, str_split(765)),
                    'credentials' => $credentials,
                ],
                400,
            );
        }

        if (!($token = auth()->attempt($credentials))) {
            return response()->json(['status' => 'failed', 'message' => 'Username atau Password Salah']);
        }

        if (auth()->user()->role == 0) {
            return response()->json(['status' => 'error', 'message' => 'Akun Anda Belum Aktif, Hubungi Admin']);
        }

        return $this->respondWithToken($token);
    }

    public function userprofile()
    {
        $detailUser = DB::table('users')
            ->leftjoin('masjid', 'users.id_masjid', 'masjid.id')
            ->where('users.id', auth()->user()->id)
            ->select('users.*', 'masjid.nama as namaMasjid')
            ->first();
        switch ($detailUser->role) {
            case 4:
                $detailUser->jabatan = 'Ketua UPZ';
                break;
            case 5:
                $detailUser->jabatan = 'Sekertaris UPZ';
                break;
            case 6:
                $detailUser->jabatan = 'Bendahara UPZ';
                break;
            default:
            // echo 'Your favorite color is neither red, blue, nor green!';
        }

        $userResponse = [
            'expire_in' =>
                auth()
                    ->factory()
                    ->getTTL() /
                    (60 * 24) .
                ' days',
            'userProfile' => $detailUser,
        ];

        return response()->json($userResponse);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        auth()
            ->factory()
            ->setTTL(24 * 7);
        return response()->json([
            'status' => 'success',
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>
                auth()
                    ->factory()
                    ->getTTL() /
                (60 * 24),
        ]);
    }

    protected function regphone($phone)
    {
        $kriptor = generatekriptor();
        $phoneNa = enkripsina($phone, $kriptor['randnum'], $kriptor['randomBytes']);

        $insertData = [
            'phone' => $phoneNa,
            'kriptorone' => $kriptor['kriptorone'],
            'kriptortwo' => $kriptor['kriptortwo'],
        ];

        try {
            // Begin the transaction
            DB::beginTransaction();

            // Write data to the master database
            DB::table('users')->insert($insertData);

            // Write data to the slave database

            // Commit the transaction
            DB::commit();

            // Success Operation
            return $this->createotp($phoneNa);
        } catch (Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();
        }

        // if ($user->save()) {
        //     $createotp = $this->createotp($phoneNa);
        //     return $createotp;
        // }
        return false;
    }

    protected function createotp($phone)
    {
        $updateOTP = [
            'otp' => rand(1000, 9999),
            'created_otp' => date('Y-m-d h:i:s'),
        ];

        try {
            User::where('phone', $phone)->update($updateOTP);
            return 'create otp done';
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

        // $databaseName = 'ds_utama_slave';
        // $databaseConfig = [
        //     'driver' => 'sqlsrv',
        //     'host' => env('DB_HOST', '192.168.0.106'),
        //     'database' => env('DB_DATABASE', $databaseName),
        //     'username' => env('DB_USERNAME', 'sa'),
        //     'password' => env('DB_PASSWORD', '123'),
        //     'charset' => 'utf8',
        //     'prefix' => '',
        //     'encrypt' => 'yes',
        //     'trust_server_certificate' => true,
        // ];

        // Config::set('database.connections.' . $databaseName, $databaseConfig);

        // try {
        //     // Begin the transaction
        //     DB::beginTransaction();

        //     // Write data to the master database
        //     // Config::set('database.connections.sqlsrv.database', 'ds_utama');
        //     // DB::table('users')
        //     //     ->where('phone', $phone)
        //     //     ->update($updateOTP);

        //     // Write data to the slave database
        //     // Config::set('database.connections.sqlsrv.database', 'ds_utama_slave');
        //     // DB::table('users')
        //     //     ->where('phone', $phone)
        //     //     ->update($updateOTP);

        //     // DB::connection($databaseName)
        //     //     ->table('users')
        //     //     ->where('phone', $phone)
        //     //     ->update($updateOTP);

        //     // Commit the transaction
        //     DB::commit();

        //     // Success Operation
        //     return 'create otp done';
        // } catch (Exception $e) {
        //     // Rollback the transaction in case of an exception
        //     DB::rollBack();
        //     return response()->json($e->getMessage(), 400);
        // }
    }

    protected function loginotp($phone)
    {
    }
}
