<?php

namespace App\Models;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'kelas';

    protected $guarded = [];

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }
}
