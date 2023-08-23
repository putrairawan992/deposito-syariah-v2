<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\helpers;
use App\Http\dbhelpers;
use App\Models\File;

class ProductController extends Controller
{
    protected $connection = 'db2';

    public function index()
    {
        $produk = DB::table('produk');
        auth()->user()->role == 2 ? ($produk = $produk->where('id_mitra', auth()->user()->idmitra)) : null;
        $produk = $produk
            ->leftjoin('mitra', 'produk.id_mitra', '=', 'mitra.idmitra')
            ->select('produk.*', 'mitra.nama', 'mitra.kriptorone', 'mitra.kriptortwo')
            ->orderby('created_at', 'DESC')
            ->get();

        foreach ($produk as $value) {
            !empty($value->nama) ? ($value->nama = dekripsina($value->nama, $value->kriptorone, $value->kriptortwo)) : null;
            $value->expire = date('d M Y', strtotime($value->end_date));
            unset($value->kriptorone);
            unset($value->kriptortwo);
        }

        return $produk;
    }

    public function show()
    {
        $produk = DB::table('produk')
            ->where('status', 1)
            ->where('end_date', '>=', date('Y-m-d'))
            ->where('start_date', '<=', date('Y-m-d'))
            ->leftjoin('mitra', 'mitra.idmitra', 'produk.id_mitra')
            ->select('produk.*', 'mitra.db_name', 'mitra.kriptorone', 'mitra.kriptortwo')
            ->orderby('id', 'desc')
            ->get();

        foreach ($produk as $value) {
            $dbname = dekripsina($value->db_name, $value->kriptorone, $value->kriptortwo);
            $checkDB = checkDatabaseName($dbname);
            $value->terkumpul = 0;
            $value->terkumpulpersen = 0;
            if ($checkDB) {
                config(["database.connections.{$this->connection}.database" => $dbname]);
                DB::purge($this->connection);

                $getTerkumpul = DB::table('transaksi')
                    ->where('id_produk', $value->no_produk)
                    ->where('jenis', 3)
                    ->wherein('status', [5, 6])
                    ->get();
                $kalTerkumpul = 0;
                foreach ($getTerkumpul as $valueNa) {
                    $kalTerkumpul = $kalTerkumpul + dekripsina($valueNa->amount, $valueNa->kriptorone, $valueNa->kriptortwo);
                }

                $getPenarikan = DB::table('transaksi')
                    ->where('id_produk', $value->no_produk)
                    ->where('jenis', 2)
                    ->wherein('status', [5, 6])
                    ->get();
                $kalPenarikan = 0;
                foreach ($getPenarikan as $valueNa) {
                    $kalPenarikan = $kalPenarikan + dekripsina($valueNa->amount, $valueNa->kriptorone, $valueNa->kriptortwo);
                }

                DB::disconnect($this->connection);

                $value->terkumpul = $kalTerkumpul - $kalPenarikan;
                $value->terkumpulpersen = $value->terkumpul / $value->target;
            }

            unset($value->db_name);
            unset($value->updated_at);
            unset($value->deleted_at);
            unset($value->user_created);
            unset($value->user_updated);
            unset($value->user_deleted);
            unset($value->kriptorone);
            unset($value->kriptortwo);
        }

        return $produk;
    }

    public function detail($id)
    {
        $produkDetail = DB::table('produk')
            ->where('no_produk', $id)
            ->leftjoin('mitra', 'produk.id_mitra', '=', 'mitra.idmitra')
            ->select('produk.*', 'mitra.nama', 'mitra.kriptorone', 'mitra.kriptortwo')
            ->first();
        !empty($produkDetail->nama) ? ($produkDetail->nama = dekripsina($produkDetail->nama, $produkDetail->kriptorone, $produkDetail->kriptortwo)) : null;

        return response()->json($produkDetail, 200);
    }

    public function store(Request $request)
    {
        // return response()->json($request->all(), 400);
        // Check No Produk
        if (empty($request->no_produk)) {
            $cekProduk = DB::table('produk')->get();
            $key = true;
            while ($key) {
                $count = 0;
                $no_produkNa = 'D' . date('ym') . rand(999, 9999) . date('d');
                foreach ($cekProduk as $value) {
                    $no_produkNa == $value->no_produk ? $count++ : null;
                }
                $count == 0 ? ($key = false) : null;
            }
            $no_produk = $no_produkNa;
        }

        $minimal = $request->minimal;
        $target = $request->target;
        $nisbah = $request->nisbah;
        $bagi_hasil = $request->bagi_hasil;
        $tenor = $request->tenor;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // Cek Produk
        $req_produk = $request->no_produk;
        $cekProduk = DB::table('produk')
            ->where('no_produk', $req_produk)
            ->get();

        if (count($cekProduk) == 0) {
            $insertData = [
                'id_mitra' => auth()->user()->idmitra,
                'no_produk' => $no_produk,
                'minimal' => $minimal,
                'target' => $target,
                'nisbah' => $nisbah,
                'bagi_hasil' => $bagi_hasil,
                'tenor' => $tenor,
                'start_date' => $start_date,
                'end_date' => $request->end_date,
                'user_created' => auth()->user()->iduser,
                // 'kriptorone' => $kriptor['kriptorone'],
                // 'kriptortwo' => $kriptor['kriptortwo'],
            ];

            try {
                DB::table('produk')->insert([$insertData]);
                return response()->json('Tambah Produk Berhasil', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        } else {
            !empty($minimal) ? ($updateProduk['minimal'] = $minimal) : null;
            !empty($target) ? ($updateProduk['target'] = $target) : null;
            !empty($nisbah) ? ($updateProduk['nisbah'] = $nisbah) : null;
            !empty($bagi_hasil) ? ($updateProduk['bagi_hasil'] = $bagi_hasil) : null;
            !empty($tenor) ? ($updateProduk['tenor'] = $tenor) : null;
            !empty($start_date) ? ($updateProduk['start_date'] = $start_date) : null;
            !empty($end_date) ? ($updateProduk['end_date'] = $end_date) : null;
            $updateProduk['updated_at'] = date('Y-m-d H:i:s');
            $updateProduk['user_updated'] = auth()->user()->iduser;

            try {
                DB::table('produk')
                    ->where('no_produk', $req_produk)
                    ->update($updateProduk);
                return response()->json('Update Produk Berhasil', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
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
                'user_updated' => auth()->user()->iduser,
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
                'user_updated' => auth()->user()->iduser,
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
                'user_deleted' => auth()->user()->iduser,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json('Hapus Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function buyshow()
    {
        $listDbTrx = DB::table('mitra')
            ->select('kriptorone', 'kriptortwo', 'db_name')
            ->get();

        // Check transaksi every db transaksi
        $result = [];
        foreach ($listDbTrx as $value) {
            $value->dbname = dekripsina($value->db_name, $value->kriptorone, $value->kriptortwo);
            config(["database.connections.{'db2'}.database" => $value->dbname]);
            DB::purge('db2');

            // Get transaksi every db transaksi
            // Jenis = 3 (Pembelian)
            if (auth()->user()->iduser == 1 || auth()->user()->iduser == 99) {
                $getTrx = DB::table('transaksi')->get();
            } else {
                $getTrx = DB::table('transaksi')
                    ->where('id_nasabah', auth()->user()->iduser)
                    ->where('jenis', 3)
                    ->get();
            }
            foreach ($getTrx as $value) {
                !empty($value->amount) ? ($value->amount = dekripsina($value->amount, $value->kriptorone, $value->kriptortwo)) : null;
                unset($value->kriptorone);
                unset($value->kriptortwo);
            }
            array_push($result, $getTrx);
        }

        return $result;
    }

    public function buydetail(Request $req)
    {
        $connection = 'db2';
        $id = $req->id;
        $id_mitra = $req->id_mitra;

        $getMitra = DB::table('mitra')
            ->where('mitra.id', $req->id_mitra)
            ->leftjoin('users', 'mitra.id_user', 'users.iduser')
            ->select('users.kriptorone', 'users.kriptortwo', 'db_name')
            ->first();

        $dbname = dekripsina($getMitra->db_name, $getMitra->kriptorone, $getMitra->kriptortwo);
        config(["database.connections.{$connection}.database" => $dbname]);
        DB::purge($connection);

        $detailTrx = DB::table('transaksi')
            ->where('id', $id)
            ->first();
        $detailTrx->amount = dekripsina($detailTrx->amount, $detailTrx->kriptorone, $detailTrx->kriptortwo);
        $detailTrx->bagi_hasil = dekripsina($detailTrx->bagi_hasil, $detailTrx->kriptorone, $detailTrx->kriptortwo);
        $detailTrx->tenor = dekripsina($detailTrx->tenor, $detailTrx->kriptorone, $detailTrx->kriptortwo);
        unset($detailTrx->kriptorone);
        unset($detailTrx->kriptortwo);
        return response()->json($detailTrx, 200);
    }

    public function buystore(Request $req)
    {
        $produk = DB::table('produk')
            ->leftjoin('mitra', 'produk.id_mitra', 'mitra.idmitra')
            ->where('produk.no_produk', $req->no_produk)
            ->first();
        $dbname = dekripsina($produk->db_name, $produk->kriptorone, $produk->kriptortwo);

        // Generate No Transaksi
        config(["database.connections.{$this->connection}.database" => $dbname]);
        DB::purge($this->connection);
        $cekTransaksi = DB::table('transaksi')->get();
        $key = true;
        while ($key) {
            $count = 0;
            $no_transaksi = 'P' . date('ym') . rand(999999, 9999999);
            foreach ($cekTransaksi as $value) {
                $value->no_transaksi == $no_transaksi ? $count++ : null;
            }
            $count == 0 ? ($key = false) : null;
        }

        // Create Enkripsi
        $kriptor = generatekriptor();
        $amount = newenkripsina($req->amount, $kriptor['randnum'], $kriptor['randomBytes']);

        $insertData = [
            'id_nasabah' => auth()->user()->iduser,
            'id_coa' => '',
            'id_produk' => $req->no_produk,
            'no_transaksi' => $no_transaksi,
            'amount' => $amount,
            'bagi_hasil' => $produk->bagi_hasil,
            'tenor' => $produk->tenor,
            'aro' => $req->aro,
            'jenis' => 3,
            'status' => 1,
            'kriptorone' => $kriptor['kriptorone'],
            'kriptortwo' => $kriptor['kriptortwo'],
        ];

        $cekTransaksi = DB::table('transaksi')
            ->where('id_nasabah', auth()->user()->iduser)
            ->where('id_produk', $req->no_produk)
            ->where('jenis', 3)
            ->where('status', 1)
            ->first();
        // return response()->json([$insertData, $cekTransaksi], 400);
        if (empty($cekTransaksi)) {
            try {
                DB::table('transaksi')->insert([$insertData]);
                return response()->json('Pengajuan Pembelian Berhasil', 200);
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        } else {
            return response()->json('Anda tidak bisa melakukan pengajuan, Karena transaksi Anda sebelumnya belum di Proses', 400);
        }
    }

    public function buycancel(Request $req)
    {
        $connection = 'db2';
        $id = $req->id;
        $id_mitra = $req->id_mitra;

        $getMitra = DB::table('mitra')
            ->where('mitra.id', $req->id_mitra)
            ->leftjoin('users', 'mitra.id_user', 'users.iduser')
            ->select('users.kriptorone', 'users.kriptortwo', 'db_name')
            ->first();

        $dbname = dekripsina($getMitra->db_name, $getMitra->kriptorone, $getMitra->kriptortwo);
        config(["database.connections.{$connection}.database" => $dbname]);
        DB::purge($connection);

        $trxNa = DB::table('transaksi')->where('id', $id);
        if (empty($trxNa->where('status', '!=', 0)->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }
        try {
            $trxNa->update(['status' => '0']);
            return response()->json('Pembatalan Berhasil', 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function buyvalidasi(Request $req)
    {
        $connection = 'db2';
        $id = $req->id;
        $id_mitra = $req->id_mitra;
        $status = $req->status;

        $getMitra = DB::table('mitra')
            ->where('mitra.id', $req->id_mitra)
            ->leftjoin('users', 'mitra.id_user', 'users.iduser')
            ->select('users.kriptorone', 'users.kriptortwo', 'db_name')
            ->first();

        $dbname = dekripsina($getMitra->db_name, $getMitra->kriptorone, $getMitra->kriptortwo);
        config(["database.connections.{$connection}.database" => $dbname]);
        DB::purge($connection);

        $trxNa = DB::table('transaksi')->where('id', $id);
        if (empty($trxNa->where('status', '!=', 0)->first())) {
            return response()->json('Data tidak ditemukan', 400);
        }
        $updateData['status'] = $status;
        $status == 5 ? ($updateData['tgl_approve'] = date('Y-m-d H:i:s')) : null;
        if (empty($trxNa->where('status', 5)->first())) {
            try {
                $trxNa->update($updateData);
                return response()->json('Update Validasi Berhasil', 200);
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        } else {
            return response()->json('Validasi dibatalkan, karena data ini sudah di Approve', 400);
        }
    }
}
