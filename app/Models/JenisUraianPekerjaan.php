<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUraianPekerjaan extends Model
{
    use HasFactory;

    protected $table='jenis_uraian_pekerjaan';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id','nama'];
}
