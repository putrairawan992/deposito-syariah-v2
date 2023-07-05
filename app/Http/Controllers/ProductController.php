<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\helpers;
use App\Models\File;

class ProductController extends Controller
{
    public function index()
    {
        $produk = DB::table('produk')->get();

        foreach ($produk as $value) {
            !empty($value->no_produk) ? ($value->no_produk = dekripsina($value->no_produk, $value->kriptorone, $value->kriptortwo)) : null;
            !empty($value->minimal) ? ($value->minimal = dekripsina($value->minimal, $value->kriptorone, $value->kriptortwo)) : null;
            !empty($value->target) ? ($value->target = dekripsina($value->target, $value->kriptorone, $value->kriptortwo)) : null;
            !empty($value->bagi_hasil) ? ($value->bagi_hasil = dekripsina($value->bagi_hasil, $value->kriptorone, $value->kriptortwo)) : null;
            !empty($value->tenor) ? ($value->tenor = dekripsina($value->tenor, $value->kriptorone, $value->kriptortwo)) : null;
        }

        return $produk;
    }

    public function show()
    {
        $produk = DB::table('produk')
            ->where('status', 1)
            ->where('end_date', '>=', date('Y-m-d'))
            ->where('start_date', '<=', date('Y-m-d'))
            ->orderby('id', 'desc')
            ->get();

        foreach ($produk as $value) {
            !empty($value->no_produk) ? ($value->no_produk = dekripsina($value->no_produk, $value->kriptorone, $value->kriptortwo)) : null;
            !empty($value->minimal) ? ($value->minimal = dekripsina($value->minimal, $value->kriptorone, $value->kriptortwo)) : null;
            !empty($value->target) ? ($value->target = dekripsina($value->target, $value->kriptorone, $value->kriptortwo)) : null;
            !empty($value->bagi_hasil) ? ($value->bagi_hasil = dekripsina($value->bagi_hasil, $value->kriptorone, $value->kriptortwo)) : null;
            !empty($value->tenor) ? ($value->tenor = dekripsina($value->tenor, $value->kriptorone, $value->kriptortwo)) : null;
        }

        return $produk;
    }

    public function detail($id)
    {
        $produkDetail = DB::table('produk')
            ->where('id', $id)
            ->first();
        if ($produkDetail) {
            !empty($produkDetail->no_produk) ? ($produkDetail->no_produk = dekripsina($produkDetail->no_produk, $produkDetail->kriptorone, $produkDetail->kriptortwo)) : null;
            !empty($produkDetail->minimal) ? ($produkDetail->minimal = dekripsina($produkDetail->minimal, $produkDetail->kriptorone, $produkDetail->kriptortwo)) : null;
            !empty($produkDetail->target) ? ($produkDetail->target = dekripsina($produkDetail->target, $produkDetail->kriptorone, $produkDetail->kriptortwo)) : null;
            !empty($produkDetail->bagi_hasil) ? ($produkDetail->bagi_hasil = dekripsina($produkDetail->bagi_hasil, $produkDetail->kriptorone, $produkDetail->kriptortwo)) : null;
            !empty($produkDetail->tenor) ? ($produkDetail->tenor = dekripsina($produkDetail->tenor, $produkDetail->kriptorone, $produkDetail->kriptortwo)) : null;
        } else {
            return response()->json('Data tidak Ada', 400);
        }

        return $produkDetail;
    }

    public function store(Request $request)
    {
        if (auth()->user()->role == 2) {
            $mitraId = DB::table('mitra')
                ->where('id_user', auth()->user()->id)
                ->first();
            $mitraIDNa = $mitraId->id;
        } else {
            $mitraIDNa = $request->id_mitra;
        }

        $no_produkNa = 'D' . $mitraIDNa;
        $mitraIDNa < 100 ? ($no_produkNa = 'D0' . $mitraIDNa) : null;
        $mitraIDNa < 10 ? ($no_produkNa = 'D00' . $mitraIDNa) : null;

        // Check No Produk
        $cekProduk = DB::table('produk')->get();
        $key = true;
        while ($key) {
            $count = 0;
            $no_produkNa .= '-' . date('ym') . rand(99, 999);
            foreach ($cekProduk as $value) {
                $noProdukNa = dekripsina($value->no_produk, $value->kriptorone, $value->kriptortwo);
                $noProdukNa == $no_produkNa ? $count++ : null;
            }
            $count == 0 ? ($key = false) : null;
        }

        // Start Enkripsi
        $kriptor = generatekriptor();
        $no_produk = newenkripsina($no_produkNa, $kriptor['randnum'], $kriptor['randomBytes']);
        $minimal = newenkripsina($request->minimal, $kriptor['randnum'], $kriptor['randomBytes']);
        $target = newenkripsina($request->target, $kriptor['randnum'], $kriptor['randomBytes']);
        $bagi_hasil = newenkripsina($request->bagi_hasil, $kriptor['randnum'], $kriptor['randomBytes']);
        $tenor = newenkripsina($request->tenor, $kriptor['randnum'], $kriptor['randomBytes']);
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $insertData = [
            'id_mitra' => $mitraIDNa,
            'no_produk' => $no_produk,
            'minimal' => $minimal,
            'target' => $target,
            'bagi_hasil' => $bagi_hasil,
            'tenor' => $tenor,
            'start_date' => $start_date,
            'end_date' => $request->end_date,
            'user_created' => auth()->user()->id,
            'kriptorone' => $kriptor['kriptorone'],
            'kriptortwo' => $kriptor['kriptortwo'],
        ];

        try {
            DB::table('produk')->insert([$insertData]);
            return response()->json($insertData, 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update(Request $request)
    {
        $minimal = $request->minimal;
        $target = $request->target;
        $bagi_hasil = $request->bagi_hasil;
        $tenor = $request->tenor;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // Create new enkripsi Mitra
        $getProduk = DB::table('produk')
            ->where('id', $request->id)
            ->first();
        if (empty($getProduk)) {
            return response()->json('Data tidak ditemukan', 400);
        }
        $kriptorone = $getProduk->kriptorone;
        $kriptortwo = $getProduk->kriptortwo;

        !empty($minimal) ? ($updateData['minimal'] = oldenkripsina($minimal, $kriptorone, $kriptortwo)) : null;
        !empty($target) ? ($updateData['target'] = oldenkripsina($target, $kriptorone, $kriptortwo)) : null;
        !empty($bagi_hasil) ? ($updateData['bagi_hasil'] = oldenkripsina($bagi_hasil, $kriptorone, $kriptortwo)) : null;
        !empty($tenor) ? ($updateData['tenor'] = oldenkripsina($tenor, $kriptorone, $kriptortwo)) : null;
        !empty($start_date) ? ($updateData['start_date'] = $start_date) : null;
        !empty($end_date) ? ($updateData['end_date'] = $end_date) : null;

        $updateData['updated_at'] = date('Y-m-d H:i:s');
        $updateData['user_updated'] = auth()->user()->id;

        try {
            DB::table('produk')
                ->where('id', $request->id)
                ->update($updateData);
            return response()->json($updateData, 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function aktivasi($id)
    {
        $produkNa = DB::table('produk')->where('id', $id);
        if (empty($produkNa->wherein('status', [0, 1])->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }

        $status = 0;
        $msg = 'Deaktivasi Berhasil';
        if ($produkNa->first()->status == 0) {
            $status = 1;
            $msg = 'Aktivasi Berhasil';
        }

        try {
            $produkNa->update([
                'status' => $status,
                'user_updated' => auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json($msg, 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function restore($id)
    {
        $produkNa = DB::table('produk')->where('id', $id);
        if (empty($produkNa->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }

        try {
            $produkNa->update([
                'status' => 0,
                'user_updated' => auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s'),
                'user_deleted' => null,
                'deleted_at' => null,
            ]);
            return response()->json('Restore Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function delete($id)
    {
        $produkNa = DB::table('produk')->where('id', $id);
        if (empty($produkNa->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }

        try {
            $produkNa->update([
                'status' => 3,
                'user_deleted' => auth()->user()->id,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json('Hapus Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
