<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Files extends Model
{
    use HasFactory, Searchable;
    protected $table = 'file';

    // protected $primaryKey = 'nomor_surat';

    protected $fillable = ['nomor_surat', 'nama_file', 'tanggal', 'id_pos', 'file_pdf', 'aksi', 'status', 'keterangan'];
    public $timestamps = false;


    public function posisi()
    {
        return $this->belongsTo(User::class, 'id_pos', 'id_pos');
    }

    public function disposisi()
    {
        return $this->hasOne(Disposisi::class, 'nomor_surat', 'nomor_surat');
    }

    public function disposisistaff()
    {
        return $this->hasOne(Disposisistaff::class, 'nomor_surat', 'nomor_surat');
    }


    public function toSearchableArray()
    {
        return [
            'nomor_surat' => $this->nomor_surat,
            'nama_file' => $this->nama_file
        ];
    }
}
