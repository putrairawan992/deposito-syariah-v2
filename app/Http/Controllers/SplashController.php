<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\helpers;

class SplashController extends Controller
{
    public function index()
    {
        $splashScreen = DB::table('splash_screen')->get();

        foreach ($splashScreen as $value) {
            $userId = DB::table('users')
                ->where('id', $value->user_created)
                ->first();
            $value->deskripsi = dekripna($value->deskripsi, $userId->kriptorone, $userId->kriptortwo);
        }

        return $splashScreen;
    }

    public function show()
    {
        $splashScreen = DB::table('splash_screen')
            ->where('status', 1)
            ->get();

        foreach ($splashScreen as $value) {
            $userId = DB::table('users')
                ->where('id', $value->user_created)
                ->first();
            $value->deskripsi = dekripna($value->deskripsi, $userId->kriptorone, $userId->kriptortwo);
        }

        return $splashScreen;
    }

    public function detail($id)
    {
    }

    public function store(Request $request)
    {
        $insertData = [
            'image' => $request->image,
            'deskripsi' => oldenkripsina($request->deskripsi, auth()->user()->kriptorone, auth()->user()->kriptortwo),
            'user_created' => auth()->user()->id,
        ];

        try {
            DB::table('splash_screen')->insert([$insertData]);
            return response()->json('Tambah Splash Screen Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update(Request $request)
    {
        if (empty(DB::table('splash_screen')->where('id', $request->id)->first)) {
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
            DB::table('splash_screen')
                ->where('id', $request->id)
                ->update([$updateData]);
            return response()->json('Update Splash Screen Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function aktivasi($id)
    {
        $splashScreen = DB::table('splash_screen')->where('id', $id);
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
        $splashScreen = DB::table('splash_screen')->where('id', $id);
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
        $splashScreen = DB::table('splash_screen')->where('id', $id);
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
