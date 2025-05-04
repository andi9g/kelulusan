<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = "idsiswa";
    protected $guarded = [];


    public function jurusan()
    {
        return $this->belongsTo(jurusan::class, 'idjurusan','idjurusan');
    }
}
