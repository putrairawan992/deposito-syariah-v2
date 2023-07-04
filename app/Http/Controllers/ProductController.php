<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\helpers;
use App\Models\File;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = DB::table('produk');
        if (auth()->user()->id != 1 && auth()->user()->id != 99) {
            $idMitra = DB::table('mitra')
                ->where('id_user', auth()->user()->id)
                ->first();
            $produk->where('id_mitra', $idMitra->id);
        }
        return $produk->get();
    }

    public function show()
    {
        return DB::table('produk')
            ->where('status', 1)
            ->orderbt('id', 'desc')
            ->get();
    }

    public function detail($id)
    {
    }

    public function store(Request $request)
    {
        $insertData = [
            'minimal' => $request->minimal,
            'target' => $request->target,
            'bagi_hasil' => $request->bagi_hasil,
            'tenor' => $request->tenor,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_created' => auth()->user()->id,
        ];

        try {
            DB::table('produk')->insert([$insertData]);
            return response()->json('Tambah Produk Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update(Request $request)
    {
        !empty($request->minimal) ? ($updateData['minimal'] = $request->minimal) : null;

        !empty($request->target) ? ($updateData['target'] = $request->target) : null;

        !empty($request->bagi_hasil) ? ($updateData['bagi_hasil'] = $request->bagi_hasil) : null;

        !empty($request->tenor) ? ($updateData['tenor'] = $request->tenor) : null;

        !empty($request->start_date) ? ($updateData['start_date'] = $request->start_date) : null;

        !empty($request->end_date) ? ($updateData['end_date'] = $request->end_date) : null;

        if (!empty($request->minimal) || !empty($request->target) || !empty($request->bagi_hasil) || !empty($request->tenor) || !empty($request->start_date) || !empty($request->end_date)) {
            $updateData['user_updated'] = auth()->user()->id;
            $updateData['updated_at'] = date('Y-m-d H:i:s');
        }

        try {
            DB::table('produk')
                ->where('id', $request->id)
                ->update([$updateData]);
            return response()->json('Update Produk Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function aktivasi($id)
    {
        $splash = DB::table('produk')->where('id', $id);
        if (empty($splashScreen->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }

        $splashScreen->status == 0 ? ($status = 1) : ($status = 0);

        try {
            $splashScreen->update([
                'status' => $status,
                'user_deleted' => auth()->user()->id,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json('Restore Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function restore($id)
    {
        $splash = DB::table('produk')->where('id', $id);
        if (empty($splashScreen->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }

        try {
            $splashScreen->update([
                'status' => 0,
                'user_deleted' => auth()->user()->id,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json('Restore Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function delete($id)
    {
        $splash = DB::table('produk')->where('id', $id);
        if (empty($splashScreen->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }

        try {
            $splashScreen->update([
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
