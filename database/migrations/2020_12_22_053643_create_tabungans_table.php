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
            $table->unsignedBigInteger('jenis_sampah')->nullable();
            $table->integer('berat')->nullable();
            $table->integer('debet')->nullable();
            $table->integer('kredit')->nullable();
            $table->integer('saldo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('status')->default(0);
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
