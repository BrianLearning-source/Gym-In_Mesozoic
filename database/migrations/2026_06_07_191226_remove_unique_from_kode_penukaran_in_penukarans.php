<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penukarans', function (Blueprint $table) {
            $table->dropUnique(['kode_penukaran']);
            $table->index('kode_penukaran');
        });
    }

    public function down(): void
    {
        Schema::table('penukarans', function (Blueprint $table) {
            $table->dropIndex(['kode_penukaran']);
            $table->unique('kode_penukaran');
        });
    }
};
