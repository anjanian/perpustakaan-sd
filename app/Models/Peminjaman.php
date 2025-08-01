<?php
namespace App\Models;

use App\Models\Buku;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Pengembalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;


class Peminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'peminjaman';

    protected $guarded = [];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->petugas_id = auth::check() ? auth::user()->id : null;
        });

        static::updating(function ($model) {
            $model->petugas_id = auth::check() ? auth::user()->id : null;
        });

        static::deleting(function ($model) {
            $model->petugas_id = auth::check() ? auth::user()->id : null;
        });
    }
    
}
