<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Smk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelulusan', function (Blueprint $table) {
            $table->bigIncrements('idkelulusan');
            $table->Integer('nisn')->unique();
            $table->enum('ket', ['lulus', 'tidak lulus'])->nullable();
            $table->timestamps();
        });

        Schema::create('adminkelulusan', function (Blueprint $table) {
            $table->bigIncrements('idadminkelulusan');
            $table->String('username')->unique();
            $table->String('password');
            $table->enum('posisi', ['tu','perpus','superadmin']);
            $table->timestamps();
        });

        Schema::create('tunggakanspp', function (Blueprint $table) {
            $table->bigIncrements('idtunggakanspp');
            $table->Integer('nisn');
            $table->bigInteger('spp');
            $table->timestamps();
        });

        Schema::create('tunggakanbuku', function (Blueprint $table) {
            $table->bigIncrements('idtunggakanbuku');
            $table->Integer('nisn');
            $table->String('judulbuku');
            $table->timestamps();
        });

        Schema::create('pengaturankelulusan', function (Blueprint $table) {
            $table->bigIncrements('idpengaturankelulusan');
            $table->dateTime('open');
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
        //
    }
}
