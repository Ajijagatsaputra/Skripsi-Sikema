<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerStudy extends Model
{
    use HasFactory;

    protected $table = 'tracerstudy';

    protected $fillable = [
        'id_alumni',
        'tanggal_isi',
        'bekerja',
        'nama_perusahaan',
        'jabatan',
        'alamat_pekerjaan',
        'gaji',
        'nama_usaha',
        'posisi_usaha',
        'tingkat_usaha',
        'alamat_usaha',
        'pendapatan_usaha',
        'status_kerja',
        'etika',
        'keahlian',
        'penggunaanteknologi',
        'teamwork',
        'komunikasi',
        'pengembangan',
        'relevansi_pekerjaan',
        'saran'
    ];

    protected $casts = [
        'tanggal_isi' => 'date',
        'gaji' => 'decimal:2',
    ];

    // Relasi ke model Alumni
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni');
    }
    // public function users()
    // {
    //     return $this->belongsTo(User::class, 'id_users');
    // }
    public function getrelevansiNameAttribute()
    {
        $relevansiNames = [
            'relevan' => 'relevan',
            'tidak_relevan' => 'tidak relevan',
            'sangat_relevan' => 'sangat relevan',
            'sangat_tidak_relevan' => 'sangat tidak relevan',
            'cukup' => 'cukup',
        ];

        return $relevansiNames[$this->relevansi_pekerjaan] ?? $this->relevansi_pekerjaan;
    }

}
