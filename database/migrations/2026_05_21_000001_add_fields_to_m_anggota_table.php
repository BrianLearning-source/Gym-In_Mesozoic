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
        Schema::table('m_anggota', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('id');
            $table->decimal('height', 5, 2)->nullable()->after('phone_number');
            $table->decimal('weight', 5, 2)->nullable()->after('height');
            $table->integer('rest_days')->default(0)->after('weight');
            $table->string('qr_code')->unique()->nullable()->after('rest_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_anggota', function (Blueprint $table) {
            $table->dropColumn(['username', 'title', 'height', 'weight', 'rest_days', 'qr_code']);
        });
    }
};
