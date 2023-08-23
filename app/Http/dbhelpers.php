<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;

function createDbTransaksi($dbname)
{
    $connection = 'db2';
    $query = "CREATE DATABASE $dbname";
    try {
        DB::connection($connection)->statement($query);
        // Switch to the new database
        config(["database.connections.{$connection}.database" => $dbname]);
        DB::purge($connection);
        return true;
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
}

function createTbTransaksi($dbname)
{
    try {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_coa')->nullable();
            $table->string('id_produk');
            $table->string('id_nasabah');
            $table->string('no_transaksi');
            $table->string('amount');
            $table->integer('bagi_hasil')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->integer('tenor')->nullable();
            $table->integer('aro')->nullable();
            $table->datetime('tgl_approve')->nullable();
            $table->integer('jenis')->default(0);
            $table->integer('status')->default(0);
            $table->string('kriptorone');
            $table->string('kriptortwo');
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('rekap', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_coa')->nullable();
            $table->integer('id_produk');
            $table->integer('tahun');
            $table->integer('bulan');
            $table->integer('jenis')->default(0);
            $table->string('kriptorone');
            $table->string('kriptortwo');
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('log_transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->text('keterangan');
            $table->integer('notifikasi');
            $table->string('kriptorone');
            $table->string('kriptortwo');
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        return true;
    } catch (\Throwable $th) {
        // return false;
        return [$dbname, $th->getMessage()];
    }
}

function generateDb($dbname)
{
    $createDbTransaksi = createDbTransaksi($dbname);
    DB::reconnect();
    $createTbTransaksi = createTbTransaksi($dbname);
    if ($createDbTransaksi) {
        if ($createTbTransaksi) {
            return 'Generate DB and TB Succesfully';
        } else {
            return ['Generate DB Successfully, TB Failed', $createDbTransaksi];
        }
    } else {
        return ['Generate DB Failed', $createDbTransaksi];
    }
}

function checkDatabaseName($dbname)
{
    // Get all database names on the current connection
    $databaseNames = DB::connection()->select('SELECT name FROM sys.databases');

    $found = false;
    foreach ($databaseNames as $database) {
        if ($dbname == $database->name) {
            $found = true;
            break;
        }
    }
    return $found;
}

function getDataDbname($dbname, $calldata)
{
    $connection = 'db2';

    // Set the dynamic database connection
    DB::connection($connection)->setDatabaseName($dbname);

    // Retrieve data from the specified table
    // $data = DB::connection($connection)->table('your_table')->get();
    $data = DB::connection($connection)->$calldata;

    // Clear the dynamic database connection
    DB::disconnect($connection);

    return $data;
}
