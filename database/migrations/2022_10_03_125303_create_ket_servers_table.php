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
        Schema::create('ket_servers', function (Blueprint $table) {
            $table->id();
            $table->text('ket')->nullable();
            $table->string('dns')->nullable();
            $table->foreignId('id_ext')->nullable();
            $table->string('ndb')->nullable();
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
        Schema::dropIfExists('ket_servers');
    }
};
