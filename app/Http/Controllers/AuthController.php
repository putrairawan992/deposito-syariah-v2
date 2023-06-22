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
            if ($value->store_token != null) {
                $value->store_token = dekripsina($value->store_token, $kriptorone, $kriptortwo);
            }
            if ($value->reset_token != null) {
                $value->reset_token = dekripsina($value->reset_token, $kriptorone, $kriptortwo);
            }
        }

        return response()->json($alluser, 200);
    }

    public function nasabah()
    {
        $dbname = bestConnection();
        $alluser = DB::table('users')
            ->wherein('role', [0, 10])
            ->leftjoin('nasabah', 'users.id', 'nasabah.id_user')
            ->get();
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
            if ($value->store_token != null) {
                $value->store_token = dekripsina($value->store_token, $kriptorone, $kriptortwo);
            }
            if ($value->reset_token != null) {
                $value->reset_token = dekripsina($value->reset_token, $kriptorone, $kriptortwo);
            }
            if ($value->nama != null) {
                $value->nama = dekripsina($value->nama, $kriptorone, $kriptortwo);
            }
            if ($value->ktp != null) {
                $value->ktp = dekripsina($value->ktp, $kriptorone, $kriptortwo);
            }
            if ($value->tmpt_lahir != null) {
                $value->tmpt_lahir = dekripsina($value->tmpt_lahir, $kriptorone, $kriptortwo);
            }
            if ($value->tgl_lahir != null) {
                $value->tgl_lahir = dekripsina($value->tgl_lahir, $kriptorone, $kriptortwo);
            }
            if ($value->ibu_kandung != null) {
                $value->ibu_kandung = dekripsina($value->ibu_kandung, $kriptorone, $kriptortwo);
            }
            if ($value->norek != null) {
                $value->norek = dekripsina($value->norek, $kriptorone, $kriptortwo);
            }
            if ($value->alamat != null) {
                $value->alamat = dekripsina($value->alamat, $kriptorone, $kriptortwo);
            }
            if ($value->alamat_kerja != null) {
                $value->alamat_kerja = dekripsina($value->alamat_kerja, $kriptorone, $kriptortwo);
            }
            if ($value->nama_ahli_waris != null) {
                $value->nama_ahli_waris = dekripsina($value->nama_ahli_waris, $kriptorone, $kriptortwo);
            }
            if ($value->ktp_ahli_waris != null) {
                $value->ktp_ahli_waris = dekripsina($value->ktp_ahli_waris, $kriptorone, $kriptortwo);
            }
            if ($value->phone_ahli_waris != null) {
                $value->phone_ahli_waris = dekripsina($value->phone_ahli_waris, $kriptorone, $kriptortwo);
            }
        }

        return response()->json($alluser, 200);
    }

    public function mitra()
    {
        $dbname = bestConnection();
        $alluser = DB::table('users')
            ->where('role', 2)
            ->leftjoin('mitra', 'users.id', 'mitra.id_user')
            ->get();
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
            if ($value->store_token != null) {
                $value->store_token = dekripsina($value->store_token, $kriptorone, $kriptortwo);
            }
            if ($value->reset_token != null) {
                $value->reset_token = dekripsina($value->reset_token, $kriptorone, $kriptortwo);
            }
            if (!empty($value->nama)) {
                $value->nama = dekripsina($value->nama, $kriptorone, $kriptortwo);
            }
            if (!empty($value->kode_bank)) {
                $value->kode_bank = dekripsina($value->kode_bank, $kriptorone, $kriptortwo);
            }
            if (!empty($value->no_npwp)) {
                $value->no_npwp = dekripsina($value->no_npwp, $kriptorone, $kriptortwo);
            }
            if (!empty($value->no_akta_pendirian)) {
                $value->no_akta_pendirian = dekripsina($value->no_akta_pendirian, $kriptorone, $kriptortwo);
            }
            if (!empty($value->no_pengesahan_akta)) {
                $value->no_pengesahan_akta = dekripsina($value->no_pengesahan_akta, $kriptorone, $kriptortwo);
            }
            if (!empty($value->website)) {
                $value->website = dekripsina($value->website, $kriptorone, $kriptortwo);
            }
            if (!empty($value->phone_pengurus)) {
                $value->phone_pengurus = dekripsina($value->phone_pengurus, $kriptorone, $kriptortwo);
            }
            if (!empty($value->id_privy)) {
                $value->id_privy = dekripsina($value->id_privy, $kriptorone, $kriptortwo);
            }
            if (!empty($value->db_name)) {
                $value->db_name = dekripsina($value->db_name, $kriptorone, $kriptortwo);
            }
            if (!empty($value->norek_bank)) {
                $value->norek_bank = dekripsina($value->norek_bank, $kriptorone, $kriptortwo);
            }
        }

        return response()->json($alluser, 200);
    }

    public function ceklogin(Request $request)
    {
        $dbname = bestConnection();
        $username = $request->username;
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
                return response()->json('User Tidak Terdaftar', 404);
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

    public function login(Request $request)
    {
        $dbname = bestConnection();
        $username = $request->username;
        $password = $request->password;
        $otp = $request->password;
        $credentials = null;
        $loginField = $username;

        // Check if field is empty
        if (empty($username)) {
            return response()->json(['status' => 'error', 'message' => 'You must fill all the fields']);
        } else {
            $cekRole = User::all();
            $loginType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'other';
            if ($loginType == 'other') {
                if (is_numeric($username)) {
                    $loginType = 'phone';

                    // Cek Data
                    $oldToken = null;
                    $idNa = null;
                    foreach ($cekRole as $key => $value) {
                        $dekripPhone = dekripsina($value->phone, $value->kriptorone, $value->kriptortwo);
                        if ($username == $dekripPhone) {
                            $idNa = $value->id;
                            $enkripPhone = $value->phone;
                            $rolena = $value->role;
                            $kriptorone = $value->kriptorone;
                            $kriptortwo = $value->kriptortwo;
                            if ($value->store_token != null) {
                                $oldToken = dekripsina($value->store_token, $kriptorone, $kriptortwo);
                            }
                            break;
                        }
                    }

                    // Login OTP
                    if ($idNa != null) {
                        $dateTime = strtotime('-5 minutes', strtotime(date('Y-m-d H:i:s')));
                        $cekOtp = User::where('id', $idNa)
                            ->where('otp', $password)
                            ->where('created_otp', '>', date('Y-m-d H:i:s', $dateTime))
                            ->firstOrFail();

                        if ($cekOtp) {
                            $token = JWTAuth::fromUser($cekOtp);
                            if ($oldToken != null) {
                                $this->revoke($oldToken);
                            }

                            $this->storeToken($idNa, $token, $kriptorone, $kriptortwo);
                            return $this->respondWithToken($token);
                        }
                    } else {
                        return response()->json(['error' => 'User not found'], 404);
                    }
                } else {
                    $loginType = 'username';
                }
            }
            // Cek Data
            $oldToken = null;
            $idNa = null;
            $enkripUsername = null;
            foreach ($cekRole as $key => $value) {
                $dekripUsername = dekripsina($value->username, $value->kriptorone, $value->kriptortwo);
                $dekripEmail = dekripsina($value->email, $value->kriptorone, $value->kriptortwo);
                if ($username == $dekripUsername) {
                    $idNa = $value->id;
                    $enkripUsername = $value->username;
                    $rolena = $value->role;
                    $kriptorone = $value->kriptorone;
                    $kriptortwo = $value->kriptortwo;
                    if ($value->store_token != null) {
                        $oldToken = dekripsina($value->store_token, $kriptorone, $kriptortwo);
                    }
                    break;
                }
                if ($username == $dekripEmail) {
                    $idNa = $value->id;
                    $enkripUsername = $value->email;
                    $rolena = $value->role;
                    $kriptorone = $value->kriptorone;
                    $kriptortwo = $value->kriptortwo;
                    if ($value->store_token != null) {
                        $oldToken = dekripsina($value->store_token, $kriptorone, $kriptortwo);
                    }
                    break;
                }
            }

            if ($enkripUsername != null) {
                $loginField = $enkripUsername;
            }

            request()->merge([$loginType => $loginField]);
            $credentials = request([$loginType, 'password']);

            if (!($token = auth()->attempt($credentials))) {
                return response()->json(['status' => 'failed', 'message' => 'Username atau Password Salah']);
            }

            if (auth()->user()->role == 0) {
                return response()->json(['status' => 'error', 'message' => 'Akun Anda Belum Aktif, Hubungi Admin']);
            }

            if ($oldToken != null) {
                $this->revoke($oldToken);
            }

            $this->storeToken($idNa, $token, $kriptorone, $kriptortwo);
            return $this->respondWithToken($token);
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
            'role' => 1,
        ];

        try {
            DB::table('users')->insert($insertData);
            return response()->json('Register Succesfully', 200);
        } catch (\Exception $e) {
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

            if ($email == $dekripEmail) {
                return response()->json('Email sudah digunakan, Silahkan gunakan yang lain', 404);
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

        // Start Enkrip Data
        $getNasabah = DB::table('users')
            ->where('id', $id_user)
            ->first();
        $kriptorone = $getNasabah->kriptorone;
        $kriptortwo = $getNasabah->kriptortwo;
        $kriptortwo = hex2bin($kriptortwo);
        $kriptorone = convertFromOpensll($kriptorone, $kriptortwo);

        if ($email != null) {
            $email = enkripsina($email, $kriptorone, $kriptortwo);
        }
        if ($nama != null) {
            $nama = enkripsina($nama, $kriptorone, $kriptortwo);
        }
        if ($ktp != null) {
            $ktp = enkripsina($ktp, $kriptorone, $kriptortwo);
        }
        if ($tmpt_lahir != null) {
            $tmpt_lahir = enkripsina($tmpt_lahir, $kriptorone, $kriptortwo);
        }
        if ($tgl_lahir != null) {
            $tgl_lahir = enkripsina($tgl_lahir, $kriptorone, $kriptortwo);
        }
        if ($ibu_kandung != null) {
            $ibu_kandung = enkripsina($ibu_kandung, $kriptorone, $kriptortwo);
        }
        if ($norek != null) {
            $norek = enkripsina($norek, $kriptorone, $kriptortwo);
        }
        if ($alamat != null) {
            $alamat = enkripsina($alamat, $kriptorone, $kriptortwo);
        }
        if ($alamat_kerja != null) {
            $alamat_kerja = enkripsina($alamat_kerja, $kriptorone, $kriptortwo);
        }
        if ($nama_ahli_waris != null) {
            $nama_ahli_waris = enkripsina($nama_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($ktp_ahli_waris != null) {
            $ktp_ahli_waris = enkripsina($ktp_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($phone_ahli_waris != null) {
            $phone_ahli_waris = enkripsina($phone_ahli_waris, $kriptorone, $kriptortwo);
        }

        $insertData = [
            'id_user' => $id_user,
            'nama' => $nama,
            'ktp' => $ktp,
            'tmpt_lahir' => $tmpt_lahir,
            'tgl_lahir' => $tgl_lahir,
            'ibu_kandung' => $ibu_kandung,
            'norek' => $norek,
            'alamat' => $alamat,
            'alamat_kerja' => $alamat_kerja,
            'nama_ahli_waris' => $nama_ahli_waris,
            'ktp_ahli_waris' => $ktp_ahli_waris,
            'phone_ahli_waris' => $phone_ahli_waris,
            'image_ktp' => $image_ktp,
            'image_selfie' => $image_selfie,
            'image_ktp_ahli_waris' => $image_ktp_ahli_waris,
            'id_privy' => $id_privy,
            'id_bank' => $id_bank,
            'status_pernikahan' => $status_pernikahan,
            'jenis_pekerjaan' => $jenis_pekerjaan,
            'penghasilan' => $penghasilan,
            'hub_ahli_waris' => $hub_ahli_waris,
        ];

        try {
            DB::table('users')
                ->where('id', $id_user)
                ->update(['email' => $email, 'role' => 10, 'updated_at' => date('Y-m-d h:i:s')]);
            DB::table('nasabah')->insert($insertData);
            return response()->json('Register Succesfully', 200);
        } catch (\Exception $e) {
            return response()->json([$e->getMessage(), $insertData], 400);
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
        $cekData = DB::table('users')
            ->where('id', '!=', $id_user)
            ->get();
        foreach ($cekData as $key => $value) {
            $dekripEmail = null;
            if ($value->email != null) {
                $dekripEmail = dekripsina($value->email, $value->kriptorone, $value->kriptortwo);
            }

            if ($email == $dekripEmail) {
                return response()->json('Email sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
        }

        $cekNasabah = DB::table('nasabah')
            ->where('id_user', '!=', $id_user)
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
        $getNasabah = DB::table('users')
            ->where('id', $id_user)
            ->first();
        $kriptorone = $getNasabah->kriptorone;
        $kriptortwo = $getNasabah->kriptortwo;
        $kriptortwo = hex2bin($kriptortwo);
        $kriptorone = convertFromOpensll($kriptorone, $kriptortwo);

        if ($email != null) {
            $email = enkripsina($email, $kriptorone, $kriptortwo);
        }
        if ($nama != null) {
            $nama = enkripsina($nama, $kriptorone, $kriptortwo);
        }
        if ($ktp != null) {
            $ktp = enkripsina($ktp, $kriptorone, $kriptortwo);
        }
        if ($tmpt_lahir != null) {
            $tmpt_lahir = enkripsina($tmpt_lahir, $kriptorone, $kriptortwo);
        }
        if ($tgl_lahir != null) {
            $tgl_lahir = enkripsina($tgl_lahir, $kriptorone, $kriptortwo);
        }
        if ($ibu_kandung != null) {
            $ibu_kandung = enkripsina($ibu_kandung, $kriptorone, $kriptortwo);
        }
        if ($norek != null) {
            $norek = enkripsina($norek, $kriptorone, $kriptortwo);
        }
        if ($alamat != null) {
            $alamat = enkripsina($alamat, $kriptorone, $kriptortwo);
        }
        if ($alamat_kerja != null) {
            $alamat_kerja = enkripsina($alamat_kerja, $kriptorone, $kriptortwo);
        }
        if ($nama_ahli_waris != null) {
            $nama_ahli_waris = enkripsina($nama_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($ktp_ahli_waris != null) {
            $ktp_ahli_waris = enkripsina($ktp_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($phone_ahli_waris != null) {
            $phone_ahli_waris = enkripsina($phone_ahli_waris, $kriptorone, $kriptortwo);
        }

        $updateData = [
            'nama' => $nama,
            'ktp' => $ktp,
            'tmpt_lahir' => $tmpt_lahir,
            'tgl_lahir' => $tgl_lahir,
            'ibu_kandung' => $ibu_kandung,
            'norek' => $norek,
            'alamat' => $alamat,
            'alamat_kerja' => $alamat_kerja,
            'nama_ahli_waris' => $nama_ahli_waris,
            'ktp_ahli_waris' => $ktp_ahli_waris,
            'phone_ahli_waris' => $phone_ahli_waris,
            'image_ktp' => $image_ktp,
            'image_selfie' => $image_selfie,
            'image_ktp_ahli_waris' => $image_ktp_ahli_waris,
            'id_privy' => $id_privy,
            'id_bank' => $id_bank,
            'status_pernikahan' => $status_pernikahan,
            'jenis_pekerjaan' => $jenis_pekerjaan,
            'penghasilan' => $penghasilan,
            'hub_ahli_waris' => $hub_ahli_waris,
            'updated_at' => date('Y-m-d h:i:s'),
        ];

        try {
            DB::table('users')
                ->where('id', $id_user)
                ->update(['email' => $email, 'updated_at' => date('Y-m-d h:i:s')]);
            DB::table('nasabah')
                ->where('id_user', $id_user)
                ->update($updateData);
            return response()->json('Update Succesfully', 200);
        } catch (\Exception $e) {
            return response()->json([$e->getMessage(), $insertData], 400);
        }
    }

    public function regmitra(Request $request)
    {
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $phone = $request->phone;
        $nama = $request->nama;

        $kode_bank = $request->kode_bank;
        $no_npwp = $request->no_npwp;
        $no_akta_pendirian = $request->no_akta_pendirian;
        $no_pengesahan_akta = $request->no_pengesahan_akta;
        $website = $request->website;
        $phone_pengurus = $request->phone_pengurus;
        $id_privy = $request->id_privy;
        $db_name = 'ds_transaksi_' . $kode_bank;
        $norek_bank = $request->norek_bank;
        $dbname = $db_name;

        $nama_notaris = $request->nama_notaris;
        $lokasi_notaris = $request->lokasi_notaris;
        $no_ijin = $request->no_ijin;
        $kota = $request->kota;
        $alamat = $request->alamat;
        $npwp_provinsi = $request->npwp_provinsi;
        $npwp_kota = $request->npwp_kota;
        $npwp_alamat = $request->npwp_alamat;
        $mulai_beroperasi = $request->mulai_beroperasi;
        $nama_pengurus = $request->nama_pengurus;
        $jabatan_pengurus = $request->jabatan_pengurus;
        $keterangan = $request->keterangan;

        $tgl_pendirian = $request->tgl_pendirian;
        $tgl_pengesahan_akta = $request->tgl_pengesahan_akta;
        $tgl_ijin = $request->tgl_ijin;
        $id_bank = $request->id_bank;
        $logo = $request->logo;
        $validasi = $request->validasi;
        $id_validator = auth()->user()->id;

        // Check if field is empty
        if (empty($email) or empty($username) or empty($password) or empty($phone)) {
            return response()->json('Semua Kolom harus terisi', 400);
        }

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json('Email tidak Valid', 400);
        }

        // Check if password is greater than 5 character
        if (strlen($password) < 8) {
            return response()->json('Password Kurang Dari 6 Digit', 400);
        }

        // Check if username, email, phone already exist
        $cekData = DB::table('users')->get();
        foreach ($cekData as $key => $value) {
            $dekripEmail = null;
            $dekripUsername = null;
            $dekripPhone = null;
            if ($value->email != null) {
                $dekripEmail = dekripsina($value->email, $value->kriptorone, $value->kriptortwo);
            }
            if ($email == $dekripEmail) {
                return response()->json('Email sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }

            if ($value->username != null) {
                $dekripUsername = dekripsina($value->username, $value->kriptorone, $value->kriptortwo);
            }
            if ($username == $dekripUsername) {
                return response()->json('Username sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }

            if ($value->phone != null) {
                $dekripPhone = dekripsina($value->phone, $value->kriptorone, $value->kriptortwo);
            }

            if ($phone == $dekripPhone) {
                return response()->json('No Telepon sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
        }

        // Check mitra already exist
        $cekMitra = DB::table('users')
            ->where('role', 2)
            ->leftjoin('mitra', 'users.id', 'mitra.id_user')
            ->get();
        foreach ($cekMitra as $key => $value) {
            $dekripnama = null;
            $dekripkode_bank = null;
            $dekripno_npwp = null;
            $dekripno_akta_pendirian = null;
            $dekripno_pengesahan_akta = null;
            $dekripwebsite = null;
            $dekripphone_pengurus = null;
            $dekripid_privy = null;
            $dekripdb_name = null;
            $dekripnorek_bank = null;

            $kriptorone = $value->kriptorone;
            $kriptortwo = $value->kriptortwo;

            if (!empty($value->nama)) {
                $dekripnama = dekripsina($value->nama, $kriptorone, $kriptortwo);
                if ($nama == $dekripnama) {
                    return response()->json('Nama Bank sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->kode_bank)) {
                $dekripkode_bank = dekripsina($value->kode_bank, $kriptorone, $kriptortwo);
                if ($kode_bank == $dekripkode_bank) {
                    return response()->json('Kode Bank sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->no_npwp)) {
                $dekripno_npwp = dekripsina($value->no_npwp, $kriptorone, $kriptortwo);
                if ($no_npwp == $dekripno_npwp) {
                    return response()->json('NPWP Bank sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }
            return response()->json('npwp ga deteksi', 400);
            if (!empty($value->no_akta_pendirian)) {
                $dekripno_akta_pendirian = dekripsina($value->no_akta_pendirian, $kriptorone, $kriptortwo);
                if ($no_akta_pendirian == $dekripno_akta_pendirian) {
                    return response()->json('No Akta Pendirian sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->no_pengesahan_akta)) {
                $dekripno_pengesahan_akta = dekripsina($value->no_pengesahan_akta, $kriptorone, $kriptortwo);
                if ($no_pengesahan_akta == $dekripno_pengesahan_akta) {
                    return response()->json('No Pengesahan Akta sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->website)) {
                $dekripwebsite = dekripsina($value->website, $kriptorone, $kriptortwo);
                if ($website == $dekripwebsite) {
                    return response()->json('Website sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->phone_pengurus)) {
                $dekripphone_pengurus = dekripsina($value->phone_pengurus, $kriptorone, $kriptortwo);
                if ($phone_pengurus == $dekripphone_pengurus) {
                    return response()->json('No Telp Pengurus sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->id_privy)) {
                $dekripid_privy = dekripsina($value->id_privy, $kriptorone, $kriptortwo);
                if ($id_privy == $dekripid_privy) {
                    return response()->json('ID PrivyID sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->db_name)) {
                $dekripdb_name = dekripsina($value->db_name, $kriptorone, $kriptortwo);
                if ($db_name == $dekripdb_name) {
                    return response()->json('DB sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->norek_bank)) {
                $dekripnorek_bank = dekripsina($value->norek_bank, $kriptorone, $kriptortwo);
                if ($id_bank . $norek_bank == $id_bank . $dekripnorek_bank) {
                    return response()->json('Norek Bank sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }
        }

        // Create new enkripsi Mitra
        $kriptor = generatekriptor();
        $kriptorone = $kriptor['randnum'];
        $kriptortwo = $kriptor['randomBytes'];
        $username = enkripsina($username, $kriptorone, $kriptortwo);
        $email = enkripsina($email, $kriptorone, $kriptortwo);
        $phone = enkripsina($phone, $kriptorone, $kriptortwo);
        $nama = enkripsina($nama, $kriptorone, $kriptortwo);
        $password = app('hash')->make($password);

        if ($kode_bank != null) {
            $kode_bank = enkripsina($kode_bank, $kriptorone, $kriptortwo);
        }
        if ($no_npwp != null) {
            $no_npwp = enkripsina($no_npwp, $kriptorone, $kriptortwo);
        }
        if ($no_akta_pendirian != null) {
            $no_akta_pendirian = enkripsina($no_akta_pendirian, $kriptorone, $kriptortwo);
        }
        if ($no_pengesahan_akta != null) {
            $no_pengesahan_akta = enkripsina($no_pengesahan_akta, $kriptorone, $kriptortwo);
        }
        if ($website != null) {
            $website = enkripsina($website, $kriptorone, $kriptortwo);
        }
        if ($phone_pengurus != null) {
            $phone_pengurus = enkripsina($phone_pengurus, $kriptorone, $kriptortwo);
        }
        if ($id_privy != null) {
            $id_privy = enkripsina($id_privy, $kriptorone, $kriptortwo);
        }
        if ($db_name != null) {
            $db_name = enkripsina($db_name, $kriptorone, $kriptortwo);
        }
        if ($norek_bank != null) {
            $norek_bank = enkripsina($norek_bank, $kriptorone, $kriptortwo);
        }
        if ($dbname != null) {
            $dbname = enkripsina($dbname, $kriptorone, $kriptortwo);
        }
        if ($nama_notaris != null) {
            $nama_notaris = enkripsina($nama_notaris, $kriptorone, $kriptortwo);
        }
        if ($lokasi_notaris != null) {
            $lokasi_notaris = enkripsina($lokasi_notaris, $kriptorone, $kriptortwo);
        }
        if ($no_ijin != null) {
            $no_ijin = enkripsina($no_ijin, $kriptorone, $kriptortwo);
        }
        if ($kota != null) {
            $kota = enkripsina($kota, $kriptorone, $kriptortwo);
        }
        if ($alamat != null) {
            $alamat = enkripsina($alamat, $kriptorone, $kriptortwo);
        }
        if ($npwp_provinsi != null) {
            $npwp_provinsi = enkripsina($npwp_provinsi, $kriptorone, $kriptortwo);
        }
        if ($npwp_kota != null) {
            $npwp_kota = enkripsina($npwp_kota, $kriptorone, $kriptortwo);
        }
        if ($npwp_alamat != null) {
            $npwp_alamat = enkripsina($npwp_alamat, $kriptorone, $kriptortwo);
        }
        if ($mulai_beroperasi != null) {
            $mulai_beroperasi = enkripsina($mulai_beroperasi, $kriptorone, $kriptortwo);
        }
        if ($nama_pengurus != null) {
            $nama_pengurus = enkripsina($nama_pengurus, $kriptorone, $kriptortwo);
        }
        if ($jabatan_pengurus != null) {
            $jabatan_pengurus = enkripsina($jabatan_pengurus, $kriptorone, $kriptortwo);
        }
        if ($keterangan != null) {
            $keterangan = enkripsina($keterangan, $kriptorone, $kriptortwo);
        }

        $insertDataUsers = [
            'username' => $username,
            'email' => $email,
            'password' => app('hash')->make($password),
            'phone' => $phone,
            'role' => 2,
            'kriptorone' => $kriptor['kriptorone'],
            'kriptortwo' => $kriptor['kriptortwo'],
        ];

        $insertDataMitra = [
            'nama' => $nama,
            'kode_bank' => $kode_bank,
            'no_npwp' => $no_npwp,
            'no_akta_pendirian' => $no_akta_pendirian,
            'no_pengesahan_akta' => $no_pengesahan_akta,
            'website' => $website,
            'phone_pengurus' => $phone_pengurus,
            'id_privy' => $id_privy,
            'db_name' => $db_name,
            'norek_bank' => $norek_bank,

            'nama_notaris' => $nama_notaris,
            'lokasi_notaris' => $lokasi_notaris,
            'no_ijin' => $no_ijin,
            'kota' => $kota,
            'alamat' => $alamat,
            'npwp_provinsi' => $npwp_provinsi,
            'npwp_kota' => $npwp_kota,
            'npwp_alamat' => $npwp_alamat,
            'mulai_beroperasi' => $mulai_beroperasi,
            'nama_pengurus' => $nama_pengurus,
            'jabatan_pengurus' => $jabatan_pengurus,
            'keterangan' => $keterangan,

            'tgl_pendirian' => $tgl_pendirian,
            'tgl_pengesahan_akta' => $tgl_pengesahan_akta,
            'tgl_ijin' => $tgl_ijin,
            'id_bank' => $id_bank,
            'logo' => $logo,
            'validasi' => $validasi,
            'id_validator' => $id_validator,
        ];

        try {
            DB::table('users')->insert([$insertDataUsers]);
            $getId = DB::table('users')
                ->where('email', $email)
                ->first();
            $insertDataMitra['id_user'] = $getId->id;
            DB::table('mitra')->insert([$insertDataMitra]);
            return response()->json('Register Mitra Succesfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function updatemitra(Request $request)
    {
        $idUser = $request->id;
        $username = $request->username;
        $email = $request->email;
        $phone = $request->phone;
        $nama = $request->nama;

        $kode_bank = $request->kode_bank;
        $no_npwp = $request->no_npwp;
        $no_akta_pendirian = $request->no_akta_pendirian;
        $no_pengesahan_akta = $request->no_pengesahan_akta;
        $website = $request->website;
        $phone_pengurus = $request->phone_pengurus;
        $id_privy = $request->id_privy;
        $norek_bank = $request->norek_bank;

        $nama_notaris = $request->nama_notaris;
        $lokasi_notaris = $request->lokasi_notaris;
        $no_ijin = $request->no_ijin;
        $kota = $request->kota;
        $alamat = $request->alamat;
        $npwp_provinsi = $request->npwp_provinsi;
        $npwp_kota = $request->npwp_kota;
        $npwp_alamat = $request->npwp_alamat;
        $mulai_beroperasi = $request->mulai_beroperasi;
        $nama_pengurus = $request->nama_pengurus;
        $jabatan_pengurus = $request->jabatan_pengurus;
        $keterangan = $request->keterangan;

        $tgl_pendirian = $request->tgl_pendirian;
        $tgl_pengesahan_akta = $request->tgl_pengesahan_akta;
        $tgl_ijin = $request->tgl_ijin;
        $id_bank = $request->id_bank;
        $logo = $request->logo;
        $validasi = $request->validasi;
        $id_validator = auth()->user()->id;

        // Check if username, email, phone already exist
        $cekData = DB::table('users')
            ->where('id', '!=', $idUser)
            ->get();
        foreach ($cekData as $key => $value) {
            $dekripEmail = null;
            $dekripUsername = null;
            $dekripPhone = null;
            if ($value->email != null) {
                $dekripEmail = dekripsina($value->email, $value->kriptorone, $value->kriptortwo);
            }
            if ($email == $dekripEmail) {
                return response()->json('Email sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }

            if ($value->username != null) {
                $dekripUsername = dekripsina($value->username, $value->kriptorone, $value->kriptortwo);
            }
            if ($username == $dekripUsername) {
                return response()->json('Username sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }

            if ($value->phone != null) {
                $dekripPhone = dekripsina($value->phone, $value->kriptorone, $value->kriptortwo);
            }

            if ($phone == $dekripPhone) {
                return response()->json('No Telepon sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
        }

        // Check mitra already exist
        $cekMitra = DB::table('users')
            ->where('users.id', '!=', $idUser)
            ->where('role', 2)
            ->leftjoin('mitra', 'users.id', 'mitra.id_user')
            ->get();
        foreach ($cekMitra as $key => $value) {
            $dekripnama = null;
            $dekripkode_bank = null;
            $dekripno_npwp = null;
            $dekripno_akta_pendirian = null;
            $dekripno_pengesahan_akta = null;
            $dekripwebsite = null;
            $dekripphone_pengurus = null;
            $dekripid_privy = null;
            $dekripdb_name = null;
            $dekripnorek_bank = null;

            $kriptorone = $value->kriptorone;
            $kriptortwo = $value->kriptortwo;

            if (!empty($value->nama)) {
                $dekripnama = dekripsina($value->nama, $kriptorone, $kriptortwo);
                if ($nama == $dekripnama) {
                    return response()->json('Nama Bank sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->kode_bank)) {
                $dekripkode_bank = dekripsina($value->kode_bank, $kriptorone, $kriptortwo);
                if ($kode_bank == $dekripkode_bank) {
                    return response()->json('Kode Bank sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->no_npwp)) {
                $dekripno_npwp = dekripsina($value->no_npwp, $kriptorone, $kriptortwo);
                if ($no_npwp == $dekripno_npwp) {
                    return response()->json('NPWP Bank sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->no_akta_pendirian)) {
                $dekripno_akta_pendirian = dekripsina($value->no_akta_pendirian, $kriptorone, $kriptortwo);
                if ($no_akta_pendirian == $dekripno_akta_pendirian) {
                    return response()->json('No Akta Pendirian sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->no_pengesahan_akta)) {
                $dekripno_pengesahan_akta = dekripsina($value->no_pengesahan_akta, $kriptorone, $kriptortwo);
                if ($no_pengesahan_akta == $dekripno_pengesahan_akta) {
                    return response()->json('No Pengesahan Akta sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->website)) {
                $dekripwebsite = dekripsina($value->website, $kriptorone, $kriptortwo);
                if ($website == $dekripwebsite) {
                    return response()->json('Website sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->phone_pengurus)) {
                $dekripphone_pengurus = dekripsina($value->phone_pengurus, $kriptorone, $kriptortwo);
                if ($phone_pengurus == $dekripphone_pengurus) {
                    return response()->json('No Telp Pengurus sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->id_privy)) {
                $dekripid_privy = dekripsina($value->id_privy, $kriptorone, $kriptortwo);
                if ($id_privy == $dekripid_privy) {
                    return response()->json('ID PrivyID sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }

            if (!empty($value->norek_bank)) {
                $dekripnorek_bank = dekripsina($value->norek_bank, $kriptorone, $kriptortwo);
                if ($id_bank . $norek_bank == $id_bank . $dekripnorek_bank) {
                    return response()->json('Norek Bank sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }
        }

        // Create new enkripsi Mitra
        $getKriptor = DB::table('users')
            ->where('id', $idUser)
            ->first();
        $kriptortwo = hex2bin($getKriptor->kriptortwo);
        $kriptorone = convertFromOpensll($getKriptor->kriptorone, $kriptortwo);

        if ($username != null) {
            $username = enkripsina($username, $kriptorone, $kriptortwo);
        }
        if ($email != null) {
            $email = enkripsina($email, $kriptorone, $kriptortwo);
        }
        if ($phone != null) {
            $phone = enkripsina($phone, $kriptorone, $kriptortwo);
        }
        if ($nama != null) {
            $nama = enkripsina($nama, $kriptorone, $kriptortwo);
        }
        if ($kode_bank != null) {
            $kode_bank = enkripsina($kode_bank, $kriptorone, $kriptortwo);
        }
        if ($no_npwp != null) {
            $no_npwp = enkripsina($no_npwp, $kriptorone, $kriptortwo);
        }
        if ($no_akta_pendirian != null) {
            $no_akta_pendirian = enkripsina($no_akta_pendirian, $kriptorone, $kriptortwo);
        }
        if ($no_pengesahan_akta != null) {
            $no_pengesahan_akta = enkripsina($no_pengesahan_akta, $kriptorone, $kriptortwo);
        }
        if ($website != null) {
            $website = enkripsina($website, $kriptorone, $kriptortwo);
        }
        if ($phone_pengurus != null) {
            $phone_pengurus = enkripsina($phone_pengurus, $kriptorone, $kriptortwo);
        }
        if ($id_privy != null) {
            $id_privy = enkripsina($id_privy, $kriptorone, $kriptortwo);
        }
        if ($norek_bank != null) {
            $norek_bank = enkripsina($norek_bank, $kriptorone, $kriptortwo);
        }
        if ($nama_notaris != null) {
            $nama_notaris = enkripsina($nama_notaris, $kriptorone, $kriptortwo);
        }
        if ($lokasi_notaris != null) {
            $lokasi_notaris = enkripsina($lokasi_notaris, $kriptorone, $kriptortwo);
        }
        if ($no_ijin != null) {
            $no_ijin = enkripsina($no_ijin, $kriptorone, $kriptortwo);
        }
        if ($kota != null) {
            $kota = enkripsina($kota, $kriptorone, $kriptortwo);
        }
        if ($alamat != null) {
            $alamat = enkripsina($alamat, $kriptorone, $kriptortwo);
        }
        if ($npwp_provinsi != null) {
            $npwp_provinsi = enkripsina($npwp_provinsi, $kriptorone, $kriptortwo);
        }
        if ($npwp_kota != null) {
            $npwp_kota = enkripsina($npwp_kota, $kriptorone, $kriptortwo);
        }
        if ($npwp_alamat != null) {
            $npwp_alamat = enkripsina($npwp_alamat, $kriptorone, $kriptortwo);
        }
        if ($mulai_beroperasi != null) {
            $mulai_beroperasi = enkripsina($mulai_beroperasi, $kriptorone, $kriptortwo);
        }
        if ($nama_pengurus != null) {
            $nama_pengurus = enkripsina($nama_pengurus, $kriptorone, $kriptortwo);
        }
        if ($jabatan_pengurus != null) {
            $jabatan_pengurus = enkripsina($jabatan_pengurus, $kriptorone, $kriptortwo);
        }
        if ($keterangan != null) {
            $keterangan = enkripsina($keterangan, $kriptorone, $kriptortwo);
        }

        $updateDataUsers = [
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
        ];

        $updateDataMitra = [
            'nama' => $nama,
            'kode_bank' => $kode_bank,
            'no_npwp' => $no_npwp,
            'no_akta_pendirian' => $no_akta_pendirian,
            'no_pengesahan_akta' => $no_pengesahan_akta,
            'website' => $website,
            'phone_pengurus' => $phone_pengurus,
            'id_privy' => $id_privy,
            'norek_bank' => $norek_bank,

            'nama_notaris' => $nama_notaris,
            'lokasi_notaris' => $lokasi_notaris,
            'no_ijin' => $no_ijin,
            'kota' => $kota,
            'alamat' => $alamat,
            'npwp_provinsi' => $npwp_provinsi,
            'npwp_kota' => $npwp_kota,
            'npwp_alamat' => $npwp_alamat,
            'mulai_beroperasi' => $mulai_beroperasi,
            'nama_pengurus' => $nama_pengurus,
            'jabatan_pengurus' => $jabatan_pengurus,
            'keterangan' => $keterangan,

            'tgl_pendirian' => $tgl_pendirian,
            'tgl_pengesahan_akta' => $tgl_pengesahan_akta,
            'tgl_ijin' => $tgl_ijin,
            'id_bank' => $id_bank,
            'logo' => $logo,
            'validasi' => $validasi,
            'id_validator' => $id_validator,
        ];

        try {
            DB::table('users')
                ->where('id', $idUser)
                ->update($updateDataUsers);
            DB::table('mitra')
                ->where('id_user', $idUser)
                ->update($updateDataMitra);
            // $createDB = createDB($dbname);
            return response()->json('Register Mitra Succesfully', 200);
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
        $id = auth()->user()->id;
        auth()->logout();
        $del = DB::table('users')
            ->where('id', $id)
            ->update(['store_token' => null]);
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return response()->json(auth()->refresh(), 200);
    }

    public function userprofile()
    {
        $detailUser = DB::table('users')
            ->where('id', auth()->user()->id)
            ->select('username', 'email', 'phone', 'role', 'status', 'kriptorone', 'kriptortwo')
            ->first();

        $kriptorone = $detailUser->kriptorone;
        $kriptortwo = $detailUser->kriptortwo;
        if ($detailUser->email != null) {
            $detailUser->email = dekripsina($detailUser->email, $kriptorone, $kriptortwo);
        }
        if ($detailUser->username != null) {
            $detailUser->username = dekripsina($detailUser->username, $kriptorone, $kriptortwo);
        }
        if ($detailUser->phone != null) {
            $detailUser->phone = dekripsina($detailUser->phone, $kriptorone, $kriptortwo);
        }
        unset($detailUser->kriptorone);
        unset($detailUser->kriptortwo);
        switch ($detailUser->role) {
            case 0:
                $detailUser->jabatan = 'Non Register Nasabah';
                break;
            case 1:
                $detailUser->jabatan = 'Admin Aplikasi';
                break;
            case 2:
                $detailUser->jabatan = 'Mitra BPR';
                break;
            case 3:
                $detailUser->jabatan = 'Owner';
                break;
            case 10:
                $detailUser->jabatan = 'Registered Nasabah';
                break;
                break;
            case 99:
                $detailUser->jabatan = 'SuperAdmin';
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
            return $this->createotp($phoneNa, $dbname);
        } catch (\Exception $e) {
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
                if (isConnectionAvailable($value)) {
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
            }

            return 'create otp done';
        } catch (\Exception $e) {
            return response()->json($e->message, 404);
        }
    }

    protected function storeToken($id, $token, $kriptorone, $kriptortwo)
    {
        $kriptortwo = hex2bin($kriptortwo);
        $kriptorone = convertFromOpensll($kriptorone, $kriptortwo);
        $storeToken = enkripsina($token, $kriptorone, $kriptortwo);
        $store = DB::table('users')
            ->where('id', $id)
            ->update(['store_token' => $storeToken]);
        return false;
    }

    protected function revoke($tokenId)
    {
        // Revoke the token by ID
        $token = JWTAuth::setToken($tokenId);
        if ($token->invalidate()) {
            return true;
        }
        return false;
    }
}
