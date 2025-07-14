<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_users')->unsigned()->nullable();
            $table->integer('nim');   
            $table->string('nama_lengkap')->unique();
            $table->string('prodi');
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('kelas');
            $table->string('jalur');
            $table->string('tahun_masuk');
            $table->string('tahun_lulus')->nullable();
            $table->string('status_mahasiswa');
            $table->timestamps();
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropForeign('alumni_id_users_foreign');
        });
        
        Schema::dropIfExists('alumni');
    }
};
