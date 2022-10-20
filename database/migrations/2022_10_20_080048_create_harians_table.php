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
            $table->string('jobHarian');
            $table->string('value');
            $table->string('tanggal');
            $table->string('waktu');
            $table->foreignId('id_server');
            $table->foreignId('id_ketCatServer');
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
