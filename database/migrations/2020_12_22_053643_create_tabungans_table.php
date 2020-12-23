<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabungans', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->unsignedBigInteger('jenis_sampah');
            $table->integer('berat');
            $table->string('debet')->nullable();
            $table->string('kredit')->nullable();
            $table->string('saldo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('jenis_sampah')->references('id')->on('jenis');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabungans');
    }
}
