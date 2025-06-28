<?php
namespace App\Models;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengembalian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengembalian';

    protected $guarded = [];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->petugas_id = auth()->check() ? auth()->user()->id : null;
        });

        static::updating(function ($model) {
            $model->petugas_id = auth()->check() ? auth()->user()->id : null;
        });

        static::deleting(function ($model) {
            $model->petugas_id = auth()->check() ? auth()->user()->id : null;
        });
    }
}
