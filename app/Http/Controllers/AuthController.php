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
        $dbname = bestConnection();
        $alluser = User::all();
        foreach ($alluser as $key => $value) {
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

        return response()->json(
            [
                'data' => $alluser,
                'dbname' => $dbname,
            ],
            200,
        );
    }

    public function ceklogin(Request $request)
    {
        $dbname = bestConnection();
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
                    $createotp = $this->createotp($enkripPhone, $dbname);
                }

                if ($enkripPhone == null) {
                    $regphone = $this->regphone($username, $dbname);
                }

                if ($regphone == 'create otp done') {
                    return response()->json('phone', 200);
                }
                if ($createotp == 'create otp done') {
                    return response()->json('phone', 200);
                }

                return response()->json('Register or CreateOTP Failed', 404);
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

    public function regadmin(Request $request)
    {
        $dbname = bestConnection();

        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
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

        // Check if username, email, phone already exist
        $cekData = User::all();
        foreach ($cekData as $key => $value) {
            $dekripUsername = null;
            if ($value->username != null) {
                $dekripUsername = dekripsina($value->username, $value->kriptorone, $value->kriptortwo);
            }
            $dekripEmail = null;
            if ($value->email != null) {
                $dekripEmail = dekripsina($value->email, $value->kriptorone, $value->kriptortwo);
            }
            $dekripPhone = null;
            if ($value->phone != null) {
                $dekripPhone = dekripsina($value->phone, $value->kriptorone, $value->kriptortwo);
            }

            if ($username == $dekripUsername) {
                return response()->json('Username sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
            if ($email == $dekripEmail) {
                return response()->json('Email sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
            if ($phone == $dekripPhone) {
                return response()->json('Phone sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
        }

        // Create new user
        $kriptor = generatekriptor();
        $usernameNa = enkripsina($username, $kriptor['randnum'], $kriptor['randomBytes']);
        $emailNa = enkripsina($email, $kriptor['randnum'], $kriptor['randomBytes']);
        $phoneNa = enkripsina($phone, $kriptor['randnum'], $kriptor['randomBytes']);

        $insertData = [
            'username' => $usernameNa,
            'email' => $emailNa,
            'phone' => $phoneNa,
            'password' => app('hash')->make($password),
            'kriptorone' => $kriptor['kriptorone'],
            'kriptortwo' => $kriptor['kriptortwo'],
            'status' => 1,
            'role' => 99,
        ];

        try {
            DB::table('users')->insert($insertData);

            $syncNa = syncTBUsers($dbname, User::all());

            if ($syncNa) {
                return response()->json(['status' => 'Register Succesfully', 'sync' => 'Done'], 200);
            }
            return response()->json(['status' => 'Register Succesfully', 'sync' => 'Failed'], 200);
        } catch (Exception $e) {
            return response()->json($e->message, 400);
        }
    }

    public function regnasabah(Request $request)
    {
        $dbname = bestConnection();

        $email = $request->email;
        $id_user = auth()->user()->id;
        $nama = $request->nama;
        $ktp = $request->ktp;
        $image_ktp = $request->image_ktp;
        $image_selfie = $request->image_selfie;
        $tmpt_lahir = $request->tmpt_lahir;
        $tgl_lahir = $request->tgl_lahir;
        $ibu_kandung = $request->ibu_kandung;
        $id_privy = $request->id_privy;
        $id_bank = $request->id_bank;
        $norek = $request->norek;
        $status_pernikahan = $request->status_pernikahan;
        $jenis_pekerjaan = $request->jenis_pekerjaan;
        $alamat = $request->alamat;
        $alamat_kerja = $request->alamat_kerja;
        $penghasilan = $request->penghasilan;
        $nama_ahli_waris = $request->nama_ahli_waris;
        $ktp_ahli_waris = $request->ktp_ahli_waris;
        $image_ktp_ahli_waris = $request->image_ktp_ahli_waris;
        $hub_ahli_waris = $request->hub_ahli_waris;
        $phone_ahli_waris = $request->phone_ahli_waris;

        // Check if field is empty
        if (empty($email) or empty($nama) or empty($ktp)) {
            return response()->json('Email, Nama, KTP harus terisi', 400);
        }

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json('Email tidak Valid', 400);
        }

        // Check if password is greater than 5 character
        if (strlen($ktp) < 12) {
            return response()->json('No KTP anda belum lengkap', 400);
        }

        // Check if username, email, phone already exist
        $cekData = User::all();
        foreach ($cekData as $key => $value) {
            $dekripEmail = null;
            if ($value->email != null) {
                $dekripEmail = dekripsina($value->email, $value->kriptorone, $value->kriptortwo);
            }
            $dekripPhone = null;
            if ($value->phone != null) {
                $dekripPhone = dekripsina($value->phone, $value->kriptorone, $value->kriptortwo);
            }

            if ($email == $dekripEmail) {
                return response()->json('Email sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
            if ($phone == $dekripPhone) {
                return response()->json('Phone sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
        }

        $cekNasabah = DB::table('nasabah')->get();
        foreach ($cekNasabah as $key => $value) {
            $dekripKTP = null;
            if ($value->ktp != null) {
                $dekripKTP = dekripsina($value->ktp, $value->kriptorone, $value->kriptortwo);
            }

            if ($ktp == $dekripKTP) {
                return response()->json('No KTP sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
        }

        // Create new user
        // $kriptor = generatekriptor();
        // $usernameNa = enkripsina($username, $kriptor['randnum'], $kriptor['randomBytes']);
        // $emailNa = enkripsina($email, $kriptor['randnum'], $kriptor['randomBytes']);
        // $phoneNa = enkripsina($phone, $kriptor['randnum'], $kriptor['randomBytes']);

        // Start Enkrip Data
        $getNasabah = DB::table('users')->where('id', $id_user);
        $kriptorone = $getNasabah->kriptorone;
        $kriptortwo = $getNasabah->kriptortwo;

        $insertData = [
            'id_user' => $id_user,
            'nama' => enkripsina($nama, $kriptorone, $kriptortwo),
            'ktp' => enkripsina($ktp, $kriptorone, $kriptortwo),
            'image_ktp' => enkripsina($image_ktp, $kriptorone, $kriptortwo),
            'image_selfie' => enkripsina($image_selfie, $kriptorone, $kriptortwo),
            'tmpt_lahir' => enkripsina($tmpt_lahir, $kriptorone, $kriptortwo),
            'tgl_lahir' => enkripsina($tgl_lahir, $kriptorone, $kriptortwo),
            'ibu_kandung' => enkripsina($ibu_kandung, $kriptorone, $kriptortwo),
            'norek' => enkripsina($norek, $kriptorone, $kriptortwo),
            'alamat' => enkripsina($alamat, $kriptorone, $kriptortwo),
            'alamat_kerja' => enkripsina($alamat_kerja, $kriptorone, $kriptortwo),
            'nama_ahli_waris' => enkripsina($nama_ahli_waris, $kriptorone, $kriptortwo),
            'ktp_ahli_waris' => enkripsina($ktp_ahli_waris, $kriptorone, $kriptortwo),
            'image_ktp_ahli_waris' => enkripsina($image_ktp_ahli_waris, $kriptorone, $kriptortwo),
            'phone_ahli_waris' => enkripsina($phone_ahli_waris, $kriptorone, $kriptortwo),
            'id_privy' => $id_privy,
            'id_bank' => $id_bank,
            'status_pernikahan' => $status_pernikahan,
            'jenis_pekerjaan' => $jenis_pekerjaan,
            'penghasilan' => $penghasilan,
            'hub_ahli_waris' => $hub_ahli_waris,
        ];

        try {
            DB::table('nasabah')->insert($insertData);

            $syncNa = syncTBNasabah($dbname, DB::table('nasabah')->get());

            if ($syncNa) {
                return response()->json(['status' => 'Register Succesfully', 'sync' => 'Done'], 200);
            }
            return response()->json(['status' => 'Register Succesfully', 'sync' => 'Failed'], 200);
        } catch (Exception $e) {
            return response()->json($e->message, 400);
        }
    }

    public function updatenasabah(Request $request)
    {
        $dbname = bestConnection();

        $email = $request->email;
        $id_user = auth()->user()->id;
        $nama = $request->nama;
        $ktp = $request->ktp;
        $image_ktp = $request->image_ktp;
        $image_selfie = $request->image_selfie;
        $tmpt_lahir = $request->tmpt_lahir;
        $tgl_lahir = $request->tgl_lahir;
        $ibu_kandung = $request->ibu_kandung;
        $id_privy = $request->id_privy;
        $id_bank = $request->id_bank;
        $norek = $request->norek;
        $status_pernikahan = $request->status_pernikahan;
        $jenis_pekerjaan = $request->jenis_pekerjaan;
        $alamat = $request->alamat;
        $alamat_kerja = $request->alamat_kerja;
        $penghasilan = $request->penghasilan;
        $nama_ahli_waris = $request->nama_ahli_waris;
        $ktp_ahli_waris = $request->ktp_ahli_waris;
        $image_ktp_ahli_waris = $request->image_ktp_ahli_waris;
        $hub_ahli_waris = $request->hub_ahli_waris;
        $phone_ahli_waris = $request->phone_ahli_waris;

        // Check if field is empty
        if (empty($email) or empty($nama) or empty($ktp)) {
            return response()->json('Email, Nama, KTP harus terisi', 400);
        }

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json('Email tidak Valid', 400);
        }

        // Check if password is greater than 5 character
        if (strlen($ktp) < 12) {
            return response()->json('No KTP anda belum lengkap', 400);
        }

        // Check if username, email, phone already exist
        $cekData = DB::table('users')->wherenot('id', auth()->user()->id);
        foreach ($cekData as $key => $value) {
            $dekripEmail = null;
            if ($value->email != null) {
                $dekripEmail = dekripsina($value->email, $value->kriptorone, $value->kriptortwo);
            }
            $dekripPhone = null;
            if ($value->phone != null) {
                $dekripPhone = dekripsina($value->phone, $value->kriptorone, $value->kriptortwo);
            }

            if ($email == $dekripEmail) {
                return response()->json('Email sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
            if ($phone == $dekripPhone) {
                return response()->json('Phone sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
        }

        $cekNasabah = DB::table('nasabah')
            ->wherenot('id_user', auth()->user()->id)
            ->get();
        foreach ($cekNasabah as $key => $value) {
            $dekripKTP = null;
            if ($value->ktp != null) {
                $dekripKTP = dekripsina($value->ktp, $value->kriptorone, $value->kriptortwo);
            }

            if ($ktp == $dekripKTP) {
                return response()->json('No KTP sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
        }

        // Start Enkrip Data
        $getNasabah = DB::table('users')->where('id', auth()->user()->id);
        $kriptorone = $getNasabah->kriptorone;
        $kriptortwo = $getNasabah->kriptortwo;

        $updateData = [
            'nama' => enkripsina($nama, $kriptorone, $kriptortwo),
            'ktp' => enkripsina($ktp, $kriptorone, $kriptortwo),
            'image_ktp' => enkripsina($image_ktp, $kriptorone, $kriptortwo),
            'image_selfie' => enkripsina($image_selfie, $kriptorone, $kriptortwo),
            'tmpt_lahir' => enkripsina($tmpt_lahir, $kriptorone, $kriptortwo),
            'tgl_lahir' => enkripsina($tgl_lahir, $kriptorone, $kriptortwo),
            'ibu_kandung' => enkripsina($ibu_kandung, $kriptorone, $kriptortwo),
            'norek' => enkripsina($norek, $kriptorone, $kriptortwo),
            'alamat' => enkripsina($alamat, $kriptorone, $kriptortwo),
            'alamat_kerja' => enkripsina($alamat_kerja, $kriptorone, $kriptortwo),
            'nama_ahli_waris' => enkripsina($nama_ahli_waris, $kriptorone, $kriptortwo),
            'ktp_ahli_waris' => enkripsina($ktp_ahli_waris, $kriptorone, $kriptortwo),
            'image_ktp_ahli_waris' => enkripsina($image_ktp_ahli_waris, $kriptorone, $kriptortwo),
            'phone_ahli_waris' => enkripsina($phone_ahli_waris, $kriptorone, $kriptortwo),
            'id_privy' => $id_privy,
            'id_bank' => $id_bank,
            'status_pernikahan' => $status_pernikahan,
            'jenis_pekerjaan' => $jenis_pekerjaan,
            'penghasilan' => $penghasilan,
            'hub_ahli_waris' => $hub_ahli_waris,
        ];

        try {
            DB::table('nasabah')
                ->where('id_user', auth()->user()->id)
                ->update($updateData);

            $syncNa = syncTBNasabah($dbname, DB::table('nasabah')->get());

            if ($syncNa) {
                return response()->json(['status' => 'Update Succesfully', 'sync' => 'Done'], 200);
            }
            return response()->json(['status' => 'Update Succesfully', 'sync' => 'Failed'], 200);
        } catch (Exception $e) {
            return response()->json($e->message, 400);
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

    protected function regphone($phone, $dbname)
    {
        $kriptor = generatekriptor();
        $phoneNa = enkripsina($phone, $kriptor['randnum'], $kriptor['randomBytes']);

        $insertData = [
            'phone' => $phoneNa,
            'kriptorone' => $kriptor['kriptorone'],
            'kriptortwo' => $kriptor['kriptortwo'],
        ];

        try {
            DB::table('users')->insert($insertData);

            $syncNa = syncTBUsers($dbname, User::all());

            return $this->createotp($phoneNa, $dbname);
        } catch (Exception $e) {
            return response()->json($e->message, 404);
        }
    }

    protected function createotp($phone, $dbname)
    {
        $updateOTP = [
            'otp' => rand(1000, 9999),
            'created_otp' => date('Y-m-d h:i:s'),
        ];

        try {
            DB::table('users')
                ->where('phone', $phone)
                ->update($updateOTP);

            $alluser = User::all();
            foreach ($dbname['listconn'] as $key => $value) {
                foreach ($alluser as $key => $user) {
                    DB::connection($value)
                        ->table('users')
                        ->updateOrInsert(
                            ['id' => $user->id],
                            [
                                'otp' => $user->otp,
                                'created_otp' => $user->created_otp,
                            ],
                        );
                }
            }

            return 'create otp done';
        } catch (Exception $e) {
            return response()->json($e->message, 404);
        }
    }

    protected function loginotp($phone)
    {
    }
}
