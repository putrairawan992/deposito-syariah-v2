<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\helpers;

class NasabahController extends Controller
{
    public function index()
    {
        $alluser = DB::table('users')
            ->where('role', 10)
            ->leftjoin('nasabah', 'users.iduser', 'nasabah.id_user')
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

            unset($value->otp);
            unset($value->pin);
            unset($value->password);
            unset($value->store_token);
            unset($value->reset_token);
            unset($value->role);
            unset($value->kriptorone);
            unset($value->kriptortwo);
        }

        return response()->json($alluser, 200);
    }

    public function getDetail($id)
    {
        $getNasabah = DB::table('users')
            ->where('iduser', $id)
            ->leftjoin('nasabah', 'users.iduser', 'nasabah.id_user')
            ->first();

        $getNasabahBank = DB::table('norek_nasabah')
            ->where('id_user', $id)
            ->get();

        $kriptorone = $getNasabah->kriptorone;
        $kriptortwo = $getNasabah->kriptortwo;
        $pathShowImg = 'upload/dok_nasabah/show/';
        if (!empty($getNasabahBank)) {
            foreach ($getNasabahBank as $value) {
                $value->norek = dekripsina($value->norek, $kriptorone, $kriptortwo);
                $value->atas_nama = dekripsina($value->atas_nama, $kriptorone, $kriptortwo);
            }
        }
        $getNasabah->listbank = $getNasabahBank;

        if ($getNasabah->email != null) {
            $getNasabah->email = dekripsina($getNasabah->email, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->username != null) {
            $getNasabah->username = dekripsina($getNasabah->username, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->phone != null) {
            $getNasabah->phone = dekripsina($getNasabah->phone, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->store_token != null) {
            $getNasabah->store_token = dekripsina($getNasabah->store_token, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->reset_token != null) {
            $getNasabah->reset_token = dekripsina($getNasabah->reset_token, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->nama != null) {
            $getNasabah->nama = dekripsina($getNasabah->nama, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->ktp != null) {
            $getNasabah->ktp = dekripsina($getNasabah->ktp, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->tmpt_lahir != null) {
            $getNasabah->tmpt_lahir = dekripsina($getNasabah->tmpt_lahir, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->tgl_lahir != null) {
            $getNasabah->tgl_lahir = dekripsina($getNasabah->tgl_lahir, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->ibu_kandung != null) {
            $getNasabah->ibu_kandung = dekripsina($getNasabah->ibu_kandung, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->alamat != null) {
            $getNasabah->alamat = dekripsina($getNasabah->alamat, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->alamat_kerja != null) {
            $getNasabah->alamat_kerja = dekripsina($getNasabah->alamat_kerja, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->nama_ahli_waris != null) {
            $getNasabah->nama_ahli_waris = dekripsina($getNasabah->nama_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->ktp_ahli_waris != null) {
            $getNasabah->ktp_ahli_waris = dekripsina($getNasabah->ktp_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->phone_ahli_waris != null) {
            $getNasabah->phone_ahli_waris = dekripsina($getNasabah->phone_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->image_ktp != null) {
            $getNasabah->image_ktp = dekripsinaFile($getNasabah->image_ktp, $kriptorone, $kriptortwo, $pathShowImg);
        }
        if ($getNasabah->image_selfie != null) {
            $getNasabah->image_selfie = dekripsinaFile($getNasabah->image_selfie, $kriptorone, $kriptortwo, $pathShowImg);
        }
        if ($getNasabah->image_ktp_ahli_waris != null) {
            $getNasabah->image_ktp_ahli_waris = dekripsinaFile($getNasabah->image_ktp_ahli_waris, $kriptorone, $kriptortwo, $pathShowImg);
        }

        unset($getNasabah->otp);
        unset($getNasabah->pin);
        unset($getNasabah->password);
        unset($getNasabah->store_token);
        unset($getNasabah->reset_token);
        unset($getNasabah->role);
        unset($getNasabah->status);
        unset($getNasabah->kriptorone);
        unset($getNasabah->kriptortwo);

        return response()->json($getNasabah, 200);
    }

    public function detail()
    {
        $getNasabah = DB::table('users')
            ->where('users.iduser', auth()->user()->iduser)
            ->leftjoin('nasabah', 'users.iduser', 'nasabah.id_user')
            ->first();

        $kriptorone = $getNasabah->kriptorone;
        $kriptortwo = $getNasabah->kriptortwo;
        if ($getNasabah->email != null) {
            $getNasabah->email = dekripsina($getNasabah->email, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->username != null) {
            $getNasabah->username = dekripsina($getNasabah->username, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->phone != null) {
            $getNasabah->phone = dekripsina($getNasabah->phone, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->store_token != null) {
            $getNasabah->store_token = dekripsina($getNasabah->store_token, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->reset_token != null) {
            $getNasabah->reset_token = dekripsina($getNasabah->reset_token, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->nama != null) {
            $getNasabah->nama = dekripsina($getNasabah->nama, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->ktp != null) {
            $getNasabah->ktp = dekripsina($getNasabah->ktp, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->tmpt_lahir != null) {
            $getNasabah->tmpt_lahir = dekripsina($getNasabah->tmpt_lahir, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->tgl_lahir != null) {
            $getNasabah->tgl_lahir = dekripsina($getNasabah->tgl_lahir, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->ibu_kandung != null) {
            $getNasabah->ibu_kandung = dekripsina($getNasabah->ibu_kandung, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->alamat != null) {
            $getNasabah->alamat = dekripsina($getNasabah->alamat, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->alamat_kerja != null) {
            $getNasabah->alamat_kerja = dekripsina($getNasabah->alamat_kerja, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->nama_ahli_waris != null) {
            $getNasabah->nama_ahli_waris = dekripsina($getNasabah->nama_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->ktp_ahli_waris != null) {
            $getNasabah->ktp_ahli_waris = dekripsina($getNasabah->ktp_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($getNasabah->phone_ahli_waris != null) {
            $getNasabah->phone_ahli_waris = dekripsina($getNasabah->phone_ahli_waris, $kriptorone, $kriptortwo);
        }

        unset($getNasabah->otp);
        unset($getNasabah->pin);
        unset($getNasabah->password);
        unset($getNasabah->store_token);
        unset($getNasabah->reset_token);
        unset($getNasabah->role);
        unset($getNasabah->status);
        unset($getNasabah->kriptorone);
        unset($getNasabah->kriptortwo);

        return response()->json($getNasabah, 200);
    }

    public function store(Request $request)
    {
        $email = $request->email;
        $id_user = auth()->user()->iduser;
        $nama = $request->nama;
        $ktp = $request->ktp;
        $tmpt_lahir = $request->tmpt_lahir;
        $tgl_lahir = $request->tgl_lahir;
        $ibu_kandung = $request->ibu_kandung;
        $id_privy = $request->id_privy;
        $status_pernikahan = $request->status_pernikahan;
        $jenis_pekerjaan = $request->jenis_pekerjaan;
        $alamat = $request->alamat;
        $nama_perusahaan = $request->nama_perusahaan;
        $alamat_kerja = $request->alamat_kerja;
        $penghasilan = $request->penghasilan;
        $nama_ahli_waris = $request->nama_ahli_waris;
        $ktp_ahli_waris = $request->ktp_ahli_waris;
        $hub_ahli_waris = $request->hub_ahli_waris;
        $phone_ahli_waris = $request->phone_ahli_waris;

        $image_ktp = $request->image_ktp;
        $image_selfie = $request->image_selfie;
        $image_ktp_ahli_waris = $request->image_ktp_ahli_waris;

        $bank = $request->bank;
        $norek = $request->norek;
        $atas_nama = $request->atas_nama;

        // Check if field is empty
        if (empty($email) or empty($nama) or empty($ktp)) {
            return response()->json('Email, Nama, KTP harus terisi', 400);
        }

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json('Email tidak Valid', 400);
        }

        // Check if password is greater than 5 character
        if (!empty($ktp)) {
            if (strlen($ktp) < 12) {
                return response()->json('No KTP anda belum lengkap', 400);
            }
        }

        // Check if username, email, phone already exist
        $cekData = DB::table('users')
            ->where('iduser', '!=', $id_user)
            ->wherein('role', [0, 10])
            ->get();
        foreach ($cekData as $key => $value) {
            $dekripEmail = null;
            if ($value->email != null) {
                $dekripEmail = dekripsina($value->email, $value->kriptorone, $value->kriptortwo);
            }

            if (!empty($email)) {
                if ($email == $dekripEmail) {
                    return response()->json('Email sudah digunakan, Silahkan gunakan yang lain', 403);
                    break;
                }
            }
        }

        // Check nasabah already exist
        $cekNasabah = DB::table('users')
            ->where('users.iduser', '!=', $id_user)
            ->wherein('role', [0, 10])
            ->leftjoin('nasabah', 'users.iduser', 'nasabah.id_user')
            ->get();
        foreach ($cekNasabah as $key => $value) {
            $dekripKtp = null;
            $kriptorone = $value->kriptorone;
            $kriptortwo = $value->kriptortwo;

            if (!empty($value->ktp)) {
                $dekripKtp = dekripsina($value->nama, $kriptorone, $kriptortwo);
                if ($ktp == $dekripKtp) {
                    return response()->json('No KTP sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }
        }

        // Start Enkrip Data
        $getNasabah = DB::table('users')
            ->where('iduser', $id_user)
            ->leftjoin('nasabah', 'users.iduser', 'nasabah.id_user')
            ->first();
        $kriptorone = $getNasabah->kriptorone;
        $kriptortwo = $getNasabah->kriptortwo;

        // Upload File Function
        if ($request->hasFile('image_ktp')) {
            $image_ktp = oldenkripsinaFile($request->file('image_ktp'), $kriptorone, $kriptortwo, nasabahPath(), $getNasabah->image_ktp);
        }
        if ($request->hasFile('image_selfie')) {
            $image_selfie = oldenkripsinaFile($request->file('image_selfie'), $kriptorone, $kriptortwo, nasabahPath(), $getNasabah->image_selfie);
        }
        if ($request->hasFile('image_ktp_ahli_waris')) {
            $image_ktp_ahli_waris = oldenkripsinaFile($request->file('image_ktp_ahli_waris'), $kriptorone, $kriptortwo, nasabahPath(), $getNasabah->image_ktp_ahli_waris);
        }

        if ($email != null) {
            $email = oldenkripsina($email, $kriptorone, $kriptortwo);
        }
        if ($nama != null) {
            $nama = oldenkripsina($nama, $kriptorone, $kriptortwo);
        }
        if ($ktp != null) {
            $ktp = oldenkripsina($ktp, $kriptorone, $kriptortwo);
        }
        if ($tmpt_lahir != null) {
            $tmpt_lahir = oldenkripsina($tmpt_lahir, $kriptorone, $kriptortwo);
        }
        if ($tgl_lahir != null) {
            $tgl_lahir = oldenkripsina($tgl_lahir, $kriptorone, $kriptortwo);
        }
        if ($ibu_kandung != null) {
            $ibu_kandung = oldenkripsina($ibu_kandung, $kriptorone, $kriptortwo);
        }
        if ($norek != null) {
            $norek = oldenkripsina($norek, $kriptorone, $kriptortwo);
        }
        if ($alamat != null) {
            $alamat = oldenkripsina($alamat, $kriptorone, $kriptortwo);
        }
        if ($alamat_kerja != null) {
            $alamat_kerja = oldenkripsina($alamat_kerja, $kriptorone, $kriptortwo);
        }
        if ($nama_ahli_waris != null) {
            $nama_ahli_waris = oldenkripsina($nama_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($ktp_ahli_waris != null) {
            $ktp_ahli_waris = oldenkripsina($ktp_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($phone_ahli_waris != null) {
            $phone_ahli_waris = oldenkripsina($phone_ahli_waris, $kriptorone, $kriptortwo);
        }

        if (!empty($bank)) {
            $dataBank = [
                'bank' => $bank,
                'norek' => oldenkripsina($norek, $kriptorone, $kriptortwo),
                'atas_nama' => oldenkripsina($atas_nama, $kriptorone, $kriptortwo),
                'id_user' => auth()->user()->iduser,
                'user_created' => auth()->user()->iduser,
            ];
        }

        $cekDataNasabah = DB::table('nasabah')
            ->where('id_user', $id_user)
            ->get();

        try {
            if (count($cekDataNasabah) == 0) {
                $dataNasabah = [
                    'id_user' => $id_user,
                    'nama' => $nama,
                    'ktp' => $ktp,
                    'tmpt_lahir' => $tmpt_lahir,
                    'tgl_lahir' => $tgl_lahir,
                    'ibu_kandung' => $ibu_kandung,
                    'alamat' => $alamat,
                    'alamat_kerja' => $alamat_kerja,
                    'nama_ahli_waris' => $nama_ahli_waris,
                    'ktp_ahli_waris' => $ktp_ahli_waris,
                    'phone_ahli_waris' => $phone_ahli_waris,
                    'image_ktp' => $image_ktp,
                    'image_selfie' => $image_selfie,
                    'image_ktp_ahli_waris' => $image_ktp_ahli_waris,
                    'id_privy' => $id_privy,
                    'status_pernikahan' => $status_pernikahan,
                    'jenis_pekerjaan' => $jenis_pekerjaan,
                    'penghasilan' => $penghasilan,
                    'hub_ahli_waris' => $hub_ahli_waris,
                    'nama_perusahaan' => $nama_perusahaan,
                ];
                $dataNasabah['user_created'] = $id_user;
                DB::table('users')
                    ->where('iduser', $id_user)
                    ->update(['email' => $email, 'role' => 10, 'user_updated' => $id_user, 'updated_at' => date('Y-m-d h:i:s')]);
                DB::table('nasabah')->insert($dataNasabah);
                if (!empty($bank)) {
                    DB::table('norek_nasabah')->insert($dataBank);
                }
                return response()->json('Register Succesfully', 200);
            } else {
                $updateUser['nama'] = $nama;
                $updateUser['ktp'] = $ktp;
                $updateUser['tmpt_lahir'] = $tmpt_lahir;
                $updateUser['tgl_lahir'] = $tgl_lahir;
                $updateUser['ibu_kandung'] = $ibu_kandung;
                $updateUser['alamat'] = $alamat;
                $updateUser['alamat_kerja'] = $alamat_kerja;
                $updateUser['nama_perusahaan'] = $nama_perusahaan;
                $updateUser['nama_ahli_waris'] = $nama_ahli_waris;
                $updateUser['ktp_ahli_waris'] = $ktp_ahli_waris;
                $updateUser['phone_ahli_waris'] = $phone_ahli_waris;
                $updateUser['image_ktp'] = $image_ktp;
                $updateUser['image_selfie'] = $image_selfie;
                $updateUser['image_ktp_ahli_waris'] = $image_ktp_ahli_waris;
                $updateUser['id_privy'] = $id_privy;
                $updateUser['status_pernikahan'] = $status_pernikahan;
                $updateUser['jenis_pekerjaan'] = $jenis_pekerjaan;
                $updateUser['penghasilan'] = $penghasilan;
                $updateUser['hub_ahli_waris'] = $hub_ahli_waris;
                $dataNasabah['user_updated'] = $id_user;
                $dataNasabah['updated_at'] = date('Y-m-d h:i:s');
                DB::table('users')
                    ->where('iduser', $id_user)
                    ->update(['email' => $email, 'user_updated' => $id_user, 'updated_at' => date('Y-m-d h:i:s')]);
                DB::table('nasabah')
                    ->where('id_user', $id_user)
                    ->update($updateUser);
                return response()->json('Update Succesfully', 200);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request)
    {
        $email = $request->email;
        $id_user = auth()->user()->iduser;
        $nama = $request->nama;
        $ktp = $request->ktp;
        $image_ktp = $request->image_ktp;
        $image_selfie = $request->image_selfie;
        $tmpt_lahir = $request->tmpt_lahir;
        $tgl_lahir = $request->tgl_lahir;
        $ibu_kandung = $request->ibu_kandung;
        $id_privy = $request->id_privy;
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

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json('Email tidak Valid', 400);
        }

        // Check if password is greater than 5 character
        if (!empty($ktp)) {
            if (strlen($ktp) < 12) {
                return response()->json('No KTP anda belum lengkap', 400);
            }
        }

        // Check if username, email, phone already exist
        $cekData = DB::table('users')
            ->where('iduser', '!=', $id_user)
            ->wherein('role', [0, 10])
            ->get();
        foreach ($cekData as $key => $value) {
            $dekripEmail = null;
            if ($value->email != null) {
                $dekripEmail = dekripsina($value->email, $value->kriptorone, $value->kriptortwo);
            }

            if (!empty($email)) {
                if ($email == $dekripEmail) {
                    return response()->json('Email sudah digunakan, Silahkan gunakan yang lain', 403);
                    break;
                }
            }
        }

        // Check nasabah already exist
        $cekNasabah = DB::table('users')
            ->where('users.iduser', '!=', $id_user)
            ->wherein('role', [0, 10])
            ->leftjoin('nasabah', 'users.iduser', 'nasabah.id_user')
            ->get();
        foreach ($cekNasabah as $key => $value) {
            $dekripKtp = null;
            $kriptorone = $value->kriptorone;
            $kriptortwo = $value->kriptortwo;

            if (!empty($value->ktp)) {
                $dekripKtp = dekripsina($value->nama, $kriptorone, $kriptortwo);
                if ($ktp == $dekripKtp) {
                    return response()->json('No KTP sudah digunakan, Silahkan gunakan yang lain', 404);
                    break;
                }
            }
        }

        // Create new enkripsi
        $getKriptor = DB::table('users')
            ->where('iduser', $id_user)
            ->first();
        $kriptorone = $getKriptor->kriptorone;
        $kriptortwo = $getKriptor->kriptortwo;

        if ($email != null) {
            $updateUser['email'] = oldenkripsina($email, $kriptorone, $kriptortwo);
        }
        if ($nama != null) {
            $updateData['nama'] = oldenkripsina($nama, $kriptorone, $kriptortwo);
        }
        if ($ktp != null) {
            $updateUser['ktp'] = oldenkripsina($ktp, $kriptorone, $kriptortwo);
        }
        if ($tmpt_lahir != null) {
            $updateData['tmpt_lahir'] = oldenkripsina($tmpt_lahir, $kriptorone, $kriptortwo);
        }
        if ($tgl_lahir != null) {
            $updateData['tgl_lahir'] = oldenkripsina($tgl_lahir, $kriptorone, $kriptortwo);
        }
        if ($ibu_kandung != null) {
            $updateData['ibu_kandung'] = oldenkripsina($ibu_kandung, $kriptorone, $kriptortwo);
        }
        if ($alamat != null) {
            $updateData['alamat'] = oldenkripsina($alamat, $kriptorone, $kriptortwo);
        }
        if ($alamat_kerja != null) {
            $updateData['alamat_kerja'] = oldenkripsina($alamat_kerja, $kriptorone, $kriptortwo);
        }
        if ($nama_ahli_waris != null) {
            $updateData['nama_ahli_waris'] = oldenkripsina($nama_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($ktp_ahli_waris != null) {
            $updateData['ktp_ahli_waris'] = oldenkripsina($ktp_ahli_waris, $kriptorone, $kriptortwo);
        }
        if ($phone_ahli_waris != null) {
            $updateData['phone_ahli_waris'] = oldenkripsina($phone_ahli_waris, $kriptorone, $kriptortwo);
        }

        $updateUser['user_updated'] = $id_user;
        $updateUser['updated_at'] = date('Y-m-d h:i:s');

        // return response()->json([$updateData, $updateUser], 400);
        try {
            DB::table('users')
                ->where('iduser', $id_user)
                ->update($updateUser);
            DB::table('nasabah')
                ->where('id_user', $id_user)
                ->update($updateUser);
            return response()->json('Update Succesfully', 200);
        } catch (\Exception $e) {
            return response()->json([$e->getMessage(), $insertData], 400);
        }
    }

    public function validasi(Request $request)
    {
        $nasabah = DB::table('nasabah')->where('id_user', $request->id);
        if (empty($nasabah->first())) {
            return response()->json('Nasabah tidak ditemukan', 400);
        }

        $status = 0;
        switch ($request->validasi) {
            case 0:
                $res = 'Data Belum Lengkap';
                break;
            case 1:
                $res = 'Nasabah Belum Valid';
                break;
            case 2:
                $res = 'Nasabah Valid';
                $status = 1;
                break;
            case 3:
                $res = 'Nasabah Dinonaktifkan';
                break;
            default:
                return response()->json('Error Validasi', 400);
                break;
        }

        try {
            DB::table('users')
                ->where('iduser', $request->id)
                ->update(['status' => $status]);
            $nasabah->update([
                'validasi' => $request->validasi,
                'ket_validasi' => $request->ket_validasi,
                'id_validator' => auth()->user()->iduser,
            ]);
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function restore($id)
    {
        $nasabah = DB::table('nasabah')->where('id_user', $id);
        if (empty($nasabah->first())) {
            return response()->json('Nasabah tidak ditemukan', 400);
        }

        try {
            $nasabah->update([
                'validasi' => 3,
                'user_deleted' => auth()->user()->iduser,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json('Restore Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function delete($id)
    {
        $nasabah = DB::table('nasabah')->where('id_user', $id);
        if (empty($nasabah->first())) {
            return response()->json('Nasabah tidak ditemukan', 400);
        }

        try {
            $nasabah->update([
                'validasi' => 4,
                'user_deleted' => auth()->user()->iduser,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json('Hapus Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function clearimg(Request $request)
    {
        if (file_exists($request->img)) {
            unlink($request->img);
        }
        return response()->json('Done', 200);
    }
}
