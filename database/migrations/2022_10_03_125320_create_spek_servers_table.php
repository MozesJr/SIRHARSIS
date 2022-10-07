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
        Schema::create('spek_servers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('hostname')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('ip')->nullable();
            $table->text('ket')->nullable();
            $table->foreignId('id_servers')->nullable();
            $table->foreignId('id_userss')->nullable();
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
        Schema::dropIfExists('spek_servers');
    }
};
