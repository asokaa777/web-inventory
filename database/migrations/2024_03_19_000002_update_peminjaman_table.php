<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // Drop existing columns if they exist
            if (Schema::hasColumn('peminjaman', 'status')) {
                $table->dropColumn('status');
            }
            
            // Add new columns if they don't exist
            if (!Schema::hasColumn('peminjaman', 'merk')) {
                $table->string('merk')->after('jumlah');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            if (Schema::hasColumn('peminjaman', 'merk')) {
                $table->dropColumn('merk');
            }
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
        });
    }
}; 