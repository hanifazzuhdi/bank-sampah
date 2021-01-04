<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaRekeningToPenarikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penarikan', function (Blueprint $table) {
            $table->string('nama')->after('user_id');
            $table->string('rekening')->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penarikan', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('rekening');
        });
    }
}
