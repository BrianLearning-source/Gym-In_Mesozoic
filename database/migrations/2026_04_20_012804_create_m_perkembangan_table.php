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
        Schema::create('m_perkembangan', function (Blueprint $table) {
            $table->id('perkembangan_id');
            $table->unsignedBigInteger('anggota_id');
            $table->date('date')->nullable(); // Delete data if in the said date, the nullable's values are null, then reset the streak to 0. If not null, then continue counting the streak
            $table->time('start_time')->nullable(); // If null, then reset streak to 0. If not null, then continue counting the streak
            $table->time('end_time')->nullable(); // Start and end time for counting the whole workout session
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('calory_burned')->nullable();
            $table->string('diary')->nullable();

            $table->foreign('anggota_id')->references('id')->on('m_anggota');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_perkembangan');
    }
};
