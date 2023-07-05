<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\helpers;

class PromoController extends Controller
{
    public function index()
    {
        $promo = DB::table('promo')->get();

        foreach ($promo as $value) {
            !empty($value->deskripsi) ? ($value->deskripsi = dekripsina($value->deskripsi, $value->kriptorone, $value->kriptortwo)) : null;
            !empty($value->image) ? ($value->showImage = dekripsinaFile($value->image, $value->kriptorone, $value->kriptortwo)) : null;
        }

        return $promo;
    }

    public function show()
    {
        $promo = DB::table('promo')
            ->where('status', 1)
            ->orderbt('id', 'desc')
            ->get();

        foreach ($promo as $value) {
            $userId = DB::table('users')
                ->where('id', $value->user_created)
                ->first();
            $value->deskripsi = dekripna($value->deskripsi, $userId->kriptorone, $userId->kriptortwo);
        }

        return $promo;
    }

    public function detail($id)
    {
        $promoDetail = DB::table('promo')
            ->where('id', $id)
            ->first();
        if ($promoDetail) {
            $userId = DB::table('users')
                ->where('id', $promoDetail->user_created)
                ->first();
            $promoDetail->deskripsi = dekripna($promoDetail->deskripsi, $userId->kriptorone, $userId->kriptortwo);
        }

        return $promoDetail;
    }

    public function store(Request $request)
    {
        $kriptor = generatekriptor();
        $deskripsi = newenkripsina($request->deskripsi, $kriptor['randnum'], $kriptor['randomBytes']);

        // $uploadFilename = uploadFile($request->file('image'), $kriptor['randomBytes']);
        $uploadFilename = newenkripsinaFile($request->file('image'), $kriptor['randnum'], $kriptor['randomBytes']);

        $mitraId = DB::table('mitra')
            ->where('id_user', auth()->user()->id)
            ->first();

        $insertData = [
            'id_mitra' => $mitraId->id,
            'image' => $uploadFilename,
            'deskripsi' => $deskripsi,
            'user_created' => auth()->user()->id,
            'kriptorone' => $kriptor['kriptorone'],
            'kriptortwo' => $kriptor['kriptortwo'],
        ];

        try {
            DB::table('promo')->insert([$insertData]);
            return response()->json($insertData, 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update(Request $request)
    {
        if (empty(DB::table('promo')->where('id', $request->id)->first)) {
            return response()->json('Data tidak ditemukan', 400);
        }

        if (empty($request->image)) {
            $updateData['image'] = $request->image;
        }

        $updateData = [
            'deskripsi' => oldenkripsina($request->deskripsi, auth()->user()->kriptorone, auth()->user()->kriptortwo),
            'user_updated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        try {
            DB::table('promo')
                ->where('id', $request->id)
                ->update([$updateData]);
            return response()->json('Update Promo Screen Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function aktivasi($id)
    {
        $$promoNa = DB::table('promo')->where('id', $id);
        if (empty($$promoNa->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }

        $$promoNa->status == 0 ? ($status = 1) : ($status = 0);

        try {
            $$promoNa->update([
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
        $$promoNa = DB::table('promo')->where('id', $id);
        if (empty($$promoNa->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }

        try {
            $$promoNa->update([
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
        $$promoNa = DB::table('promo')->where('id', $id);
        if (empty($$promoNa->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }

        try {
            $$promoNa->update([
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
