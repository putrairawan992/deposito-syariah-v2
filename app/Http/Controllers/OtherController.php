<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\helpers;

class OtherController extends Controller
{
    public function getprovinsi()
    {
        return response()->json(
            DB::table('kota')
                ->groupBy('provinsi')
                ->select('provinsi')
                ->get(),
            200,
        );
    }

    public function getkota(Request $req)
    {
        return DB::table('kota')
            ->where('provinsi', $req->provinsi)
            ->get();
    }
}
