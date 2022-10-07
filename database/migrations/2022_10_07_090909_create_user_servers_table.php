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
        Schema::create('user_servers', function (Blueprint $table) {
            $table->id();
            $table->string('akses')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->foreignId('id_ket_servers')->nullable();
            $table->foreignId('id_users')->nullable();
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
        Schema::dropIfExists('user_servers');
    }
};
