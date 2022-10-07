<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penugasans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('penugasan');
            $table->string('daterange');
            $table->string('gambar')->nullable();
            $table->text('excerpt');
            $table->foreignId('id_levels');
            $table->foreignId('id_users');
            $table->foreignId('id_statuses')->nullable();
            $table->foreignId('id_catatans')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penugasans');
    }
};
