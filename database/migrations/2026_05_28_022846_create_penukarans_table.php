<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penukarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('m_anggota', 'id')->cascadeOnDelete();
            $table->foreignId('reward_id')->constrained('m_rewards', 'reward_id')->cascadeOnDelete();
            $table->integer('points_used');
            $table->string('kode_penukaran')->unique();
            $table->enum('status', ['pending', 'claimed', 'cancelled'])->default('pending');
            $table->timestamp('claimed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penukarans');
    }
};
