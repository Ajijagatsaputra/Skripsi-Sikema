<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerPengguna extends Model
{
    use HasFactory;

    protected $table = 'tracer_pengguna';

    protected $fillable = [
        'user_id',
        // Informasi Pribadi
        'nama',
        'alamat',
        'prodi',
        'jabatan',

        // Survey Kompetensi Lulusan
        'integritas',
        'keahlian',
        'kemampuan',
        'penguasaan',
        'komunikasi',
        'kerja_tim',
        'pengembangan',

        // Penilaian Atasan
        'nama_atasan',
        'nip_atasan',
        'posisi_jabatan_atasan',
        'nama_perusahaan',
        'alamat_perusahaan',

        // Saran dan Masukan
        'saran'
    ];

    protected $casts = [
        'prodi' => 'string',
        'integritas' => 'string',
        'keahlian' => 'string',
        'kemampuan' => 'string',
        'penguasaan' => 'string',
        'komunikasi' => 'string',
        'kerja_tim' => 'string',
        'pengembangan' => 'string',
    ];

    // Accessor untuk menampilkan nama program studi yang lebih readable
    public function getProdiNameAttribute()
    {
        $prodiNames = [
            'teknik_informatika' => 'Teknik Informatika',
            'sistem_informasi' => 'Sistem Informasi',
            'manajemen' => 'Manajemen',
            'akuntansi' => 'Akuntansi'
        ];

        return $prodiNames[$this->prodi] ?? $this->prodi;
    }

    // Accessor untuk menampilkan rating yang lebih readable
    public function getRatingDisplayAttribute($field)
    {
        $ratings = [
            'sangat_baik' => 'Sangat Baik',
            'baik' => 'Baik',
            'cukup' => 'Cukup',
            'kurang_baik' => 'Kurang Baik',
            'tidak_baik' => 'Tidak Baik'
        ];

        return $ratings[$this->$field] ?? $this->$field;
    }

    // Scope untuk filter berdasarkan program studi
    public function scopeByProdi($query, $prodi)
    {
        return $query->where('prodi', $prodi);
    }

    // Scope untuk filter berdasarkan tahun
    public function scopeByYear($query, $year)
    {
        return $query->whereYear('created_at', $year);
    }

}
