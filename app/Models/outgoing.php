<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class outgoing extends Model
{
    use HasFactory, Searchable;

    protected $table = 'outgoing';
    // protected $primaryKey = 'nomor_surat';

    protected $fillable = ['nomor_surat', 'tanggal', 'id_pos', 'level', 'divisi', 'perihal', 'isi_surat', 'tujuan', 'lampiran','status'];
    public $timestamps = false;

    public function jabatan()
    {
        return $this->belongsTo(User::class, 'id_pos', 'id_pos');
    }

    public function toSearchableArray()
    {
        return [
            'nomor_surat' => $this->nomor_surat,
            'perihal' => $this->perihal
        ];
    }

}
