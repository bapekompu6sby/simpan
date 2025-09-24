<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->string('nama_penandatangan', 255)->nullable()->after('tipe');
            $table->string('nip_penandatangan', 255)->nullable()->after('nama_penandatangan');
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn(['nama_penandatangan', 'nip_penandatangan']);
        });
    }
};