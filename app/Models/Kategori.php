<?php

namespace App\Models;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'kategori';

    protected $guarded = [];

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }
}
