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
        Schema::create('m_anggota', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->string('avatar')->nullable();
            $table->date('join_date');
            $table->integer('points')->default(0);
            $table->integer('streak')->default(0);
            $table->integer('highest_streak')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_anggota');
    }
};
