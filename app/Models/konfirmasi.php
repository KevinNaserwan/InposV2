<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konfirmasi extends Model
{
    use HasFactory;

    protected $table = 'konfirmasi';

    protected $fillable = ['id_konfirmasi', 'nama_file', 'nomor_surat', 'keterangan','id_pos'];
    public $timestamps = false;

    public function konfirmasi()
    {
        return $this->belongsTo(Files::class, 'nomor_surat', 'nomor_surat');
    }
}
