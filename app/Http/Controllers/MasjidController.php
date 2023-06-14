<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MasjidController extends Controller
{
    public function index()
    {
        $masjid = DB::table('masjid')->where('id', '!=', 0);
        if (auth()->user()->role == 4 || auth()->user()->role == 5 || auth()->user()->role == 6 || auth()->user()->role == 7) {
            $masjid->where('id', auth()->user()->id_masjid);
        }
        $masjid = $masjid->orderBy('nama', 'ASC')->get();
        //Count Donation and Distribution
        foreach ($masjid as $value) {
            $value->donasi = 'Belum Ada';
            $value->penyalur = 'Belum Ada';
            $count_donasi = DB::table('donasi')
                ->where('id_masjid', $value->id)
                ->whereYear('tanggal', date('Y'))
                ->count();
            $count_penyalur = DB::table('penyalur')
                ->where('id_masjid', $value->id)
                ->whereYear('tanggal', date('Y'))
                ->count();
            if ($count_donasi > 0) {
                $value->donasi = $count_donasi . ' Donasi';
            }
            if ($count_penyalur > 0) {
                $value->penyalur = $count_penyalur . ' Penyalur';
            }
        }
        return $masjid;
    }

    public function detail($id)
    {
        $masjid = DB::table('masjid')
            ->where('id', $id)
            ->first();
        return response()->json($masjid, 200);
    }

    public function store(Request $request)
    {
        $dataInsert = [
            'nama' => $request->nama,
            'jalan' => $request->jalan,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'tahun_berdiri' => $request->tahun_berdiri,
            'tipiologi' => $request->tipiologi,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
            'status_tanah' => $request->status_tanah,
            'sertifikat' => $request->sertifikat,
            'jml_imam' => $request->jml_imam,
            'jml_khatib' => $request->jml_khatib,
            'jml_pengurus' => $request->jml_pengurus,
            'jml_jamaah' => $request->jml_jamaah,
            'kondisi_bangunan' => $request->kondisi_bangunan,
            'keg_remaja_masjid' => $request->keg_remaja_masjid,
            'keg_majelis_taklim' => $request->keg_majelis_taklim,
            'keg_tpa' => $request->keg_tpa,
            'kota' => 1,
        ];

        $masjid = DB::table('masjid');

        try {
            $masjid->insert($dataInsert);
            return response()->json($dataInsert, 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function upload(Request $request)
    {
        $dataInsert = $request->all();
        foreach ($dataInsert as $key => $value) {
            // Cek Duplikasi Data
            // foreach ($dataInsert as $keyNa => $valueNa) {
            //     if ($value['nama'] == $valueNa['nama'] && $value['kecamatan'] == $valueNa['kecamatan']) {
            //         unset($dataInsert[$keyNa]);
            //     }
            // }

            // Cek Data di Database
            if (
                DB::table('masjid')
                    ->where('nama', '=', $value['nama'])
                    ->where('kecamatan', '=', $value['kecamatan'])
                    ->first()
            ) {
                unset($dataInsert[$key]);
            }
        }

        // return response()->json(['data1' => $request->all()], 400);
        try {
            $masjid = DB::table('masjid')->insert($dataInsert);
            return response()->json(['dataBaru' => $dataInsert], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request)
    {
        $dataUpdate = [
            'nama' => $request->nama,
            'jalan' => $request->jalan,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'tahun_berdiri' => $request->tahun_berdiri,
            'tipiologi' => $request->tipiologi,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
            'status_tanah' => $request->status_tanah,
            'sertifikat' => $request->sertifikat,
            'jml_imam' => $request->jml_imam,
            'jml_khatib' => $request->jml_khatib,
            'jml_pengurus' => $request->jml_pengurus,
            'jml_jamaah' => $request->jml_jamaah,
            'kondisi_bangunan' => $request->kondisi_bangunan,
            'keg_remaja_masjid' => $request->keg_remaja_masjid,
            'keg_majelis_taklim' => $request->keg_majelis_taklim,
            'keg_tpa' => $request->keg_tpa,
        ];

        try {
            DB::table('masjid')
                ->where('id', $request->id)
                ->update($dataUpdate);
            return response()->json('Update ' . $request->nama . ' Berhasil', 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function aktivasi(Request $request)
    {
        $masjid = DB::table('masjid')
            ->where('id', $id)
            ->first();

        if ($masjid->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $updateData = [
            'status' => $status,
        ];

        try {
            $masjid = DB::table('masjid')->where('id', $id);
            $masjid->update($updateData);
            return response()->json(['Aktivasi Sucess', 200, 'data' => $masjid->first()]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $masjid = DB::table('masjid')->where('id', $id);

            if (auth()->user()->role == 1 || auth()->user()->role == 99) {
                if ($masjid->delete()) {
                    return response()->json(['status' => 'success', 'message' => 'Donasi deleted successfully', 'data' => $masjid]);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'You Not Authorize to Delete this Data']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
