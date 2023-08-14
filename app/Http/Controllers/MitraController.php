<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\helpers;
use App\Http\dbhelpers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;

class MitraController extends Controller
{
    public function index()
    {
        $allmitra = DB::table('mitra')->get();
        foreach ($allmitra as $value) {
            $kriptorone = $value->kriptorone;
            $kriptortwo = $value->kriptortwo;
            if (!empty($value->nama)) {
                $value->nama = dekripsina($value->nama, $kriptorone, $kriptortwo);
            }

            if (!empty($value->email)) {
                $value->email = dekripsina($value->email, $kriptorone, $kriptortwo);
            }

            if (!empty($value->phone)) {
                $value->phone = dekripsina($value->phone, $kriptorone, $kriptortwo);
            }

            if (!empty($value->website)) {
                $value->website = dekripsina($value->website, $kriptorone, $kriptortwo);
            }

            if (!empty($value->no_npwp)) {
                $value->no_npwp = dekripsina($value->no_npwp, $kriptorone, $kriptortwo);
            }

            if (!empty($value->no_akta_pendirian)) {
                $value->no_akta_pendirian = dekripsina($value->no_akta_pendirian, $kriptorone, $kriptortwo);
            }

            if (!empty($value->phone_pengurus)) {
                $value->phone_pengurus = dekripsina($value->phone_pengurus, $kriptorone, $kriptortwo);
            }

            if (!empty($value->no_pengesahan_akta)) {
                $value->no_pengesahan_akta = dekripsina($value->no_pengesahan_akta, $kriptorone, $kriptortwo);
            }

            if (!empty($value->no_ijin)) {
                $value->no_ijin = dekripsina($value->no_ijin, $kriptorone, $kriptortwo);
            }

            if (!empty($value->id_privy)) {
                $value->id_privy = dekripsina($value->id_privy, $kriptorone, $kriptortwo);
            }

            if (!empty($value->nama_pengurus)) {
                $value->nama_pengurus = dekripsina($value->nama_pengurus, $kriptorone, $kriptortwo);
            }

            if (!empty($value->jabatan_pengurus)) {
                $value->jabatan_pengurus = dekripsina($value->jabatan_pengurus, $kriptorone, $kriptortwo);
            }

            if (!empty($value->nama_notaris)) {
                $value->nama_notaris = dekripsina($value->nama_notaris, $kriptorone, $kriptortwo);
            }

            if (!empty($value->db_name)) {
                $value->db_name = dekripsina($value->db_name, $kriptorone, $kriptortwo);
            }

            unset($value->kriptorone);
            unset($value->kriptortwo);
        }

        return response()->json($allmitra, 200);
    }

    public function store(Request $request)
    {
        $idmitra = $request->idmitra;
        $nama = $request->nama;
        $email = $request->email;
        $phone = $request->phone;
        $mulai_beroperasi = $request->mulai_beroperasi;
        $website = $request->website;
        $alamat = $request->alamat;
        $kota = $request->kota;

        $no_npwp = $request->no_npwp;
        $npwp_kota = $request->npwp_kota;
        $npwp_alamat = $request->npwp_alamat;
        $no_akta_pendirian = $request->no_akta_pendirian;
        $nama_pengurus = $request->nama_pengurus;
        $jabatan_pengurus = $request->jabatan_pengurus;
        $phone_pengurus = $request->phone_pengurus;

        $no_pengesahan_akta = $request->no_pengesahan_akta;
        $tgl_pengesahan_akta = $request->tgl_pengesahan_akta;
        $nama_notaris = $request->nama_notaris;
        $lokasi_notaris = $request->lokasi_notaris;
        $no_ijin = $request->no_ijin;
        $tgl_ijin = $request->tgl_ijin;

        $id_privy = $request->id_privy;
        $logo = $request->logo;

        $validasi = $request->validasi;
        $id_validator = auth()->user()->iduser;
        $keterangan = $request->keterangan;

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json('Email tidak Valid', 400);
        }

        // Check mitra already exist, Generate DB Name, Idmitra
        if (empty($idmitra)) {
            $cekMitra = DB::table('mitra')->get();

            $key = true;
            while ($key) {
                $count = 0;
                $idmitra = 'M' . date('y') . rand(100, 999) . date('m');
                foreach ($cekMitra as $value) {
                    $value->idmitra == $idmitra ? $count++ : null;
                }
                $count == 0 ? ($key = false) : null;
            }
            $db_name = 'ds_txm_' . $idmitra;
            $generateDBName = 'ds_txm_' . $idmitra;

            foreach ($cekMitra as $key => $value) {
                $dekripnama = null;
                $dekripemail = null;
                $dekriphone = null;
                $dekripwebsite = null;

                $dekripno_npwp = null;
                $dekripno_akta_pendirian = null;
                $dekripphone_pengurus = null;

                $dekripno_pengesahan_akta = null;
                $dekripno_ijin = null;

                $dekripid_privy = null;

                $kriptorone = $value->kriptorone;
                $kriptortwo = $value->kriptortwo;

                if (!empty($value->nama)) {
                    $dekripnama = dekripsina($value->nama, $kriptorone, $kriptortwo);
                    if ($nama == $dekripnama) {
                        return response()->json('Nama Bank sudah digunakan, Silahkan gunakan yang lain', 404);
                        break;
                    }
                }

                if (!empty($value->email)) {
                    $dekripemail = dekripsina($value->email, $kriptorone, $kriptortwo);
                    if ($email == $dekripemail) {
                        return response()->json('Email ini sudah digunakan, Silahkan gunakan yang lain', 404);
                        break;
                    }
                }

                if (!empty($value->phone)) {
                    $dekriphone = dekripsina($value->phone, $kriptorone, $kriptortwo);
                    if ($phone == $dekriphone) {
                        return response()->json('No Telepon Mitra Bank ini sudah digunakan, Silahkan gunakan yang lain', 404);
                        break;
                    }
                }

                if (!empty($value->website)) {
                    $dekripwebsite = dekripsina($value->website, $kriptorone, $kriptortwo);
                    if ($website == $dekripwebsite) {
                        return response()->json('Website ini sudah digunakan, Silahkan gunakan yang lain', 404);
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

                if (!empty($value->phone_pengurus)) {
                    $dekripphone_pengurus = dekripsina($value->phone_pengurus, $kriptorone, $kriptortwo);
                    if ($phone_pengurus == $dekripphone_pengurus) {
                        return response()->json('No Telpon Pengurus sudah digunakan, Silahkan gunakan yang lain', 404);
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

                if (!empty($value->no_ijin)) {
                    $dekripno_ijin = dekripsina($value->no_ijin, $kriptorone, $kriptortwo);
                    if ($no_ijin == $dekripno_ijin) {
                        return response()->json('No Ijin Akta sudah digunakan, Silahkan gunakan yang lain', 404);
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
            }
        }

        // Create new enkripsi Mitra
        $kriptor = generatekriptor();
        $kriptorone = $kriptor['randnum'];
        $kriptortwo = $kriptor['randomBytes'];

        $nama = newenkripsina($nama, $kriptorone, $kriptortwo);
        $email = newenkripsina($email, $kriptorone, $kriptortwo);
        $phone = newenkripsina($phone, $kriptorone, $kriptortwo);
        $db_name = newenkripsina($db_name, $kriptorone, $kriptortwo);

        if (!empty($website)) {
            $website = newenkripsina($website, $kriptorone, $kriptortwo);
        }

        if (!empty($no_npwp)) {
            $no_npwp = newenkripsina($no_npwp, $kriptorone, $kriptortwo);
        }

        if (!empty($no_akta_pendirian)) {
            $no_akta_pendirian = newenkripsina($no_akta_pendirian, $kriptorone, $kriptortwo);
        }

        if (!empty($phone_pengurus)) {
            $phone_pengurus = newenkripsina($phone_pengurus, $kriptorone, $kriptortwo);
        }

        if (!empty($no_pengesahan_akta)) {
            $no_pengesahan_akta = newenkripsina($no_pengesahan_akta, $kriptorone, $kriptortwo);
        }

        if (!empty($no_ijin)) {
            $no_ijin = newenkripsina($no_ijin, $kriptorone, $kriptortwo);
        }

        if (!empty($id_privy)) {
            $id_privy = newenkripsina($id_privy, $kriptorone, $kriptortwo);
        }

        if (!empty($nama_pengurus)) {
            $nama_pengurus = newenkripsina($nama_pengurus, $kriptorone, $kriptortwo);
        }

        if (!empty($jabatan_pengurus)) {
            $jabatan_pengurus = newenkripsina($jabatan_pengurus, $kriptorone, $kriptortwo);
        }

        if (!empty($nama_notaris)) {
            $nama_notaris = newenkripsina($nama_notaris, $kriptorone, $kriptortwo);
        }

        $insertDataMitra = [
            'nama' => $nama,
            'email' => $email,
            'phone' => $phone,
            'mulai_beroperasi' => $mulai_beroperasi,
            'website' => $website,
            'alamat' => $alamat,
            'kota' => $kota,

            'no_npwp' => $no_npwp,
            'npwp_kota' => $npwp_kota,
            'npwp_alamat' => $npwp_alamat,
            'no_akta_pendirian' => $no_akta_pendirian,
            'nama_pengurus' => $nama_pengurus,
            'jabatan_pengurus' => $jabatan_pengurus,
            'phone_pengurus' => $phone_pengurus,

            'no_pengesahan_akta' => $no_pengesahan_akta,
            'tgl_pengesahan_akta' => $tgl_pengesahan_akta,
            'nama_notaris' => $nama_notaris,
            'lokasi_notaris' => $lokasi_notaris,
            'no_ijin' => $no_ijin,
            'tgl_ijin' => $tgl_ijin,

            'id_privy' => $id_privy,
            'logo' => $logo,

            'validasi' => $validasi,
            'id_validator' => $id_validator,
            'keterangan' => $keterangan,

            'idmitra' => $idmitra,
            'db_name' => $db_name,
            'user_created' => auth()->user()->iduser,

            'kriptorone' => $kriptor['kriptorone'],
            'kriptortwo' => $kriptor['kriptortwo'],
        ];

        $cekMitra = DB::table('mitra')
            ->where('idmitra', $idmitra)
            ->get();

        if (count($cekMitra) == 0) {
            $checkDB = checkDatabaseName($generateDBName);
            try {
                DB::table('mitra')->insert($insertDataMitra);
                $createDB = 'DB Not Created';
                if (!$checkDB) {
                    $createDB = generateDb($generateDBName);
                }
                return response()->json(['Register Mitra Succesfully', $createDB], 200);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            !empty($nama) ? ($updateMitra['nama'] = $nama) : null;
            !empty($email) ? ($updateMitra['email'] = $email) : null;
            !empty($phone) ? ($updateMitra['phone'] = $phone) : null;
            !empty($mulai_beroperasi) ? ($updateMitra['mulai_beroperasi'] = $mulai_beroperasi) : null;
            !empty($website) ? ($updateMitra['website'] = $website) : null;
            !empty($alamat) ? ($updateMitra['alamat'] = $alamat) : null;
            !empty($kota) ? ($updateMitra['kota'] = $kota) : null;

            !empty($no_npwp) ? ($updateMitra['no_npwp'] = $no_npwp) : null;
            !empty($npwp_kota) ? ($updateMitra['npwp_kota'] = $npwp_kota) : null;
            !empty($npwp_alamat) ? ($updateMitra['npwp_alamat'] = $npwp_alamat) : null;
            !empty($no_akta_pendirian) ? ($updateMitra['no_akta_pendirian'] = $no_akta_pendirian) : null;
            !empty($nama_pengurus) ? ($updateMitra['nama_pengurus'] = $nama_pengurus) : null;
            !empty($jabatan_pengurus) ? ($updateMitra['jabatan_pengurus'] = $jabatan_pengurus) : null;
            !empty($phone_pengurus) ? ($updateMitra['phone_pengurus'] = $phone_pengurus) : null;

            !empty($no_pengesahan_akta) ? ($updateMitra['no_pengesahan_akta'] = $no_pengesahan_akta) : null;
            !empty($tgl_pengesahan_akta) ? ($updateMitra['tgl_pengesahan_akta'] = $tgl_pengesahan_akta) : null;
            !empty($nama_notaris) ? ($updateMitra['nama_notaris'] = $nama_notaris) : null;
            !empty($lokasi_notaris) ? ($updateMitra['lokasi_notaris'] = $lokasi_notaris) : null;
            !empty($no_ijin) ? ($updateMitra['no_ijin'] = $no_ijin) : null;
            !empty($tgl_ijin) ? ($updateMitra['tgl_ijin'] = $tgl_ijin) : null;

            !empty($id_privy) ? ($updateMitra['id_privy'] = $id_privy) : null;
            !empty($logo) ? ($updateMitra['logo'] = $logo) : null;

            !empty($validasi) ? ($updateMitra['validasi'] = $validasi) : null;
            !empty($id_validator) ? ($updateMitra['id_validator'] = $id_validator) : null;
            !empty($keterangan) ? ($updateMitra['keterangan'] = $keterangan) : null;

            $updateMitra['user_updated'] = auth()->user()->iduser;
            $updateMitra['updated_at'] = date('Y-m-d H:i:s');
            $updateMitra['kriptorone'] = $kriptor['kriptorone'];
            $updateMitra['kriptortwo'] = $kriptor['kriptortwo'];

            // Get DB Name
            $cekMitraNa = DB::table('mitra')
                ->where('idmitra', $idmitra)
                ->first();
            $kriptorone = $cekMitraNa->kriptorone;
            $kriptortwo = $cekMitraNa->kriptortwo;
            $genDBName = dekripsina($cekMitraNa->db_name, $kriptorone, $kriptortwo);
            $checkDB = checkDatabaseName($genDBName);
            try {
                DB::table('mitra')
                    ->where('$idmitra', $$idmitra)
                    ->update($updateMitra);
                if (!$checkDB) {
                    $createDB = generateDb($genDBName);
                }
                return response()->json('Update Mitra Succesfully', 200);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function update(Request $request)
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
        $nama_pengurus = $request->nama_pengurus;
        $jabatan_pengurus = $request->jabatan_pengurus;
        $keterangan = $request->keterangan;

        $mulai_beroperasi = $request->mulai_beroperasi;
        $tgl_pendirian = $request->tgl_pendirian;
        $tgl_pengesahan_akta = $request->tgl_pengesahan_akta;
        $tgl_ijin = $request->tgl_ijin;
        $id_bank = $request->id_bank;
        $logo = $request->logo;
        $validasi = $request->validasi;
        $id_validator = auth()->user()->iduser;

        // Check if username, email, phone already exist
        $cekData = DB::table('users')
            ->where('id', '!=', $idUser)
            ->get();
        foreach ($cekData as $key => $value) {
            $dekripEmail = null;
            $dekripUsername = null;
            $dekripPhone = null;
            if (!empty($value->email)) {
                $dekripEmail = dekripsina($value->email, $value->kriptorone, $value->kriptortwo);
            }
            if ($email == $dekripEmail) {
                return response()->json('Email sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }

            if (!empty($value->username)) {
                $dekripUsername = dekripsina($value->username, $value->kriptorone, $value->kriptortwo);
            }
            if ($username == $dekripUsername) {
                return response()->json('Username sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }

            if (!empty($value->phone)) {
                $dekripPhone = dekripsina($value->phone, $value->kriptorone, $value->kriptortwo);
            }

            if ($phone == $dekripPhone) {
                return response()->json('No Telepon sudah digunakan, Silahkan gunakan yang lain', 404);
                break;
            }
        }

        // Check mitra already exist
        $cekMitra = DB::table('users')
            ->where('users.iduser', '!=', $idUser)
            ->where('role', 2)
            ->leftjoin('mitra', 'users.iduser', 'mitra.id_user')
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
        $kriptorone = $getKriptor->kriptorone;
        $kriptortwo = $getKriptor->kriptortwo;

        if (!empty($username)) {
            $username = oldenkripsina($username, $kriptorone, $kriptortwo);
        }
        if (!empty($email)) {
            $email = oldenkripsina($email, $kriptorone, $kriptortwo);
        }
        if (!empty($phone)) {
            $phone = oldenkripsina($phone, $kriptorone, $kriptortwo);
        }
        if (!empty($nama)) {
            $nama = oldenkripsina($nama, $kriptorone, $kriptortwo);
        }
        if (!empty($kode_bank)) {
            $kode_bank = oldenkripsina($kode_bank, $kriptorone, $kriptortwo);
        }
        if (!empty($no_npwp)) {
            $no_npwp = oldenkripsina($no_npwp, $kriptorone, $kriptortwo);
        }
        if (!empty($no_akta_pendirian)) {
            $no_akta_pendirian = oldenkripsina($no_akta_pendirian, $kriptorone, $kriptortwo);
        }
        if (!empty($no_pengesahan_akta)) {
            $no_pengesahan_akta = oldenkripsina($no_pengesahan_akta, $kriptorone, $kriptortwo);
        }
        if (!empty($website)) {
            $website = oldenkripsina($website, $kriptorone, $kriptortwo);
        }
        if (!empty($phone_pengurus)) {
            $phone_pengurus = oldenkripsina($phone_pengurus, $kriptorone, $kriptortwo);
        }
        if (!empty($id_privy)) {
            $id_privy = oldenkripsina($id_privy, $kriptorone, $kriptortwo);
        }
        if (!empty($norek_bank)) {
            $norek_bank = oldenkripsina($norek_bank, $kriptorone, $kriptortwo);
        }
        if (!empty($nama_notaris)) {
            $nama_notaris = oldenkripsina($nama_notaris, $kriptorone, $kriptortwo);
        }
        if (!empty($lokasi_notaris)) {
            $lokasi_notaris = oldenkripsina($lokasi_notaris, $kriptorone, $kriptortwo);
        }
        if (!empty($no_ijin)) {
            $no_ijin = oldenkripsina($no_ijin, $kriptorone, $kriptortwo);
        }
        if (!empty($alamat)) {
            $alamat = oldenkripsina($alamat, $kriptorone, $kriptortwo);
        }
        if (!empty($npwp_provinsi)) {
            $npwp_provinsi = oldenkripsina($npwp_provinsi, $kriptorone, $kriptortwo);
        }
        if (!empty($npwp_kota)) {
            $npwp_kota = oldenkripsina($npwp_kota, $kriptorone, $kriptortwo);
        }
        if (!empty($npwp_alamat)) {
            $npwp_alamat = oldenkripsina($npwp_alamat, $kriptorone, $kriptortwo);
        }
        if (!empty($nama_pengurus)) {
            $nama_pengurus = oldenkripsina($nama_pengurus, $kriptorone, $kriptortwo);
        }
        if (!empty($jabatan_pengurus)) {
            $jabatan_pengurus = oldenkripsina($jabatan_pengurus, $kriptorone, $kriptortwo);
        }
        if (!empty($keterangan)) {
            $keterangan = oldenkripsina($keterangan, $kriptorone, $kriptortwo);
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
            'nama_pengurus' => $nama_pengurus,
            'jabatan_pengurus' => $jabatan_pengurus,
            'keterangan' => $keterangan,

            'mulai_beroperasi' => $mulai_beroperasi,
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
            return response()->json('Update Mitra Succesfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function aktivasi($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->where('role', 2);
        if (empty($user->first())) {
            return response()->json('User tidak ditemukan', 400);
        }

        $status = 1;
        $res = 'Aktivasi Berhasil';
        if ($user->first()->status == 1) {
            $status = 0;
            $res = 'Deaktivasi Berhasil';
        }

        try {
            $user->update(['status' => $status]);
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function storeneraca(Request $request)
    {
    }

    public function updateneraca(Request $request)
    {
    }

    public function validasi(Request $request)
    {
        $dbName = null;
        $res = [];
        $validasi = $request->validasi;
        $mitra = DB::table('mitra')->where('id', $request->id);
        $getMitra = $mitra->first();
        $idMitra = $getMitra->id;
        if (empty($mitra->first())) {
            return response()->json('Mitra tidak ditemukan', 400);
        }

        $getKriptor = DB::table('users')
            ->where('id', $getMitra->id_user)
            ->first();
        $kriptorone = $getKriptor->kriptorone;
        $kriptortwo = $getKriptor->kriptortwo;

        $dbName = dekripsina($getMitra->db_name, $kriptorone, $kriptortwo);
        if (empty($getMitra->db_name)) {
            $idMitra < 100 ? ($lastNameDB = 'M0' . $idMitra) : null;
            $idMitra < 10 ? ($lastNameDB = 'M00' . $idMitra) : null;
            $dbName = 'ds_tx_' . $lastNameDB;
            $updateData['db_name'] = oldenkripsina($dbName, $kriptorone, $kriptortwo);
        }

        $updateData['validasi'] = $validasi;
        $updateData['id_validator'] = auth()->user()->iduser;
        $updateData['updated_at'] = date('Y-m-d H:i:s');
        $updateData['user_updated'] = auth()->user()->iduser;

        switch ($validasi) {
            case 0:
                $res['validasi'] = 'Data Belum Lengkap';
                break;
            case 1:
                $res['validasi'] = 'Status Mitra Valid';
                break;
            case 2:
                $res['validasi'] = 'Status Mitra Belum Valid';
                break;
            case 3:
                $res['validasi'] = 'Status Mitra Dinonaktifkan';
                break;
            default:
                return response()->json('Error Validasi', 400);
                break;
        }

        try {
            DB::table('mitra')
                ->where('id', $request->id)
                ->update($updateData);

            !$this->checkDatabaseName($dbName) && $validasi == 1 ? ($res['genDB'] = $this->generateDb($dbName)) : null;
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function restore($id)
    {
        $mitra = DB::table('mitra')->where('id_mitra', $id);
        if (empty($mitra->first())) {
            return response()->json('Mitra tidak ditemukan', 400);
        }

        try {
            $mitra->update([
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
        $mitra = DB::table('mitra')->where('id_mitra', $id);
        if (empty($mitra->first())) {
            return response()->json('Mitra tidak ditemukan', 400);
        }

        try {
            $mitra->update([
                'validasi' => 4,
                'user_deleted' => auth()->user()->iduser,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json('Hapus Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
