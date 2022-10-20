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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->text('nameServer');
            $table->text('ket');
            $table->text('ketServer')->nullable();
            $table->text('excerpt');
            $table->foreignId('id_statuses')->nullable();
            $table->foreignId('id_levels')->nullable();
            $table->foreignId('id_ipAddress')->nullable();
            $table->foreignId('id_pathDB')->nullable();
            $table->foreignId('id_pathApp')->nullable();
            $table->foreignId('id_enDB')->nullable();
            $table->string('nDB')->nullable();
            $table->foreignId('id_pathAkses')->nullable();
            $table->foreignId('id_enApp')->nullable();
            $table->foreignId('id_bhsApp')->nullable();
            $table->foreignId('id_tglGo')->nullable();
            $table->string('bpo')->nullable();
            $table->string('intgs')->nullable();
            $table->string('hostName')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('os')->nullable();
            $table->string('cpu')->nullable();
            $table->string('memory')->nullable();
            $table->string('hdd')->nullable();
            $table->string('terpakai')->nullable();
            $table->string('usDB')->nullable();
            $table->string('psDB')->nullable();
            $table->string('usApp')->nullable();
            $table->string('psApp')->nullable();
            $table->string('usServer')->nullable();
            $table->string('psServer')->nullable();
            $table->foreignId('id_pic_idUsers')->nullable();
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
        Schema::dropIfExists('servers');
    }
};
