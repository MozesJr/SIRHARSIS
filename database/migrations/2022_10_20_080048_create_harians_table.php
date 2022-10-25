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
        Schema::create('harians', function (Blueprint $table) {
            $table->id();
            $table->string('koneksi');
            $table->string('service');
            $table->string('tampilan');
            $table->string('ram');
            $table->string('hardisk');
            $table->string('pengunjung');
            $table->string('tanggal');
            $table->string('waktu');
            $table->string('gambar');
            $table->foreignId('id_server');
            $table->foreignId('id_users');
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
        Schema::dropIfExists('harians');
    }
};
