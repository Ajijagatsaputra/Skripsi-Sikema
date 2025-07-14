<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracerstudy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alumni')->nullable();
            $table->foreign('id_alumni')->references('id')->on('alumni')->onDelete('cascade');
            $table->date('tanggal_isi');
            $table->string('bekerja'); // ya / wirausaha / tidak

            // Jika bekerja (pegawai/karyawan)
            $table->string('nama_perusahaan')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('alamat_pekerjaan')->nullable();
            $table->string('gaji')->nullable(); // Bisa untuk pendapatan wirausaha

            // Jika wirausaha
            $table->string('nama_usaha')->nullable();
            $table->string('posisi_usaha')->nullable();
            $table->string('tingkat_usaha')->nullable();
            $table->string('alamat_usaha')->nullable();
            $table->string('pendapatan_usaha')->nullable();

            // Status kerja
            $table->string('status_kerja')->nullable();

            // Kompetensi lulusan (penilaian diri)
            $table->string('etika')->nullable();
            $table->string('keahlian')->nullable();
            $table->string('penggunaanteknologi')->nullable();
            $table->string('teamwork')->nullable();
            $table->string('komunikasi')->nullable();
            $table->string('pengembangan')->nullable();

            // Evaluasi pendidikan
            $table->string('relevansi_pekerjaan')->nullable();

            // Saran
            $table->string('saran', 500)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracerstudy');
    }
};
