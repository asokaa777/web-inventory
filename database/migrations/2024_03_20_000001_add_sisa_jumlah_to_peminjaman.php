<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->integer('sisa_jumlah')->after('jumlah')->default(0);
        });

        // Set initial sisa_jumlah equal to jumlah
        DB::table('peminjaman')->update(['sisa_jumlah' => DB::raw('jumlah')]);
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('sisa_jumlah');
        });
    }
}; 