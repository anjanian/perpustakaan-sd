<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes; // BARIS INI DITAMBAHKAN

class Pengembalian extends Model
{
    use HasFactory;
    use SoftDeletes; // BARIS INI DITAMBAHKAN

    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali',
        'tanggal_pengembalian',
        'status',
        'denda',
        'catatan',
    ];

    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
}