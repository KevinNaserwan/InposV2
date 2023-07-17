<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisistaff extends Model
{
    use HasFactory;

    protected $table = 'disposisistaff';
    protected $fillable = ['id_disposisi', 'perihal', 'catatan', 'status', 'nomor_surat', 'staff', 'id_pos', 'divisi'];
    public $timestamps = false;

    public function file()
    {
        return $this->belongsTo(Files::class, 'nomor_surat', 'nomor_surat');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pos', 'id_pos');
    }
}
