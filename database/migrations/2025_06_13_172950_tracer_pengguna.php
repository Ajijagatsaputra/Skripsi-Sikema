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
        Schema::create('tracer_pengguna', function (Blueprint $table) {
            $table->id();
            
            // Informasi Pribadi
            $table->string('nama');
            $table->text('alamat');
            $table->enum('prodi', ['teknik_informatika', 'sistem_informasi', 'manajemen', 'akuntansi']);
            $table->string('jabatan');
            
            // Survey Kompetensi Lulusan
            $table->enum('integritas', ['sangat_baik', 'baik', 'cukup', 'kurang_baik', 'tidak_baik']);
            $table->enum('keahlian', ['sangat_baik', 'baik', 'cukup', 'kurang_baik', 'tidak_baik']);
            $table->enum('kemampuan', ['sangat_baik', 'baik', 'cukup', 'kurang_baik', 'tidak_baik']);
            $table->enum('penguasaan', ['sangat_baik', 'baik', 'cukup', 'kurang_baik', 'tidak_baik']);
            $table->enum('komunikasi', ['sangat_baik', 'baik', 'cukup', 'kurang_baik', 'tidak_baik']);
            $table->enum('kerja_tim', ['sangat_baik', 'baik', 'cukup', 'kurang_baik', 'tidak_baik']);
            $table->enum('pengembangan', ['sangat_baik', 'baik', 'cukup', 'kurang_baik', 'tidak_baik']);
            
            // Penilaian Atasan
            $table->string('nama_atasan');
            $table->string('nip_atasan');
            $table->string('posisi_jabatan_atasan');
            $table->string('nama_perusahaan');
            $table->text('alamat_perusahaan');
            
            // Saran dan Masukan
            $table->text('saran')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracer_studies');
    }
};