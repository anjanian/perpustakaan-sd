<?php
namespace App\Livewire;

use App\Models\Buku;
use Livewire\Component;

class ScanQrBukuPage extends Component
{
    public $buku         = null;
    public $dipinjamList = [];

    public function handleScan($text)
    {
        $buku = Buku::with(['peminjaman' => function ($query) {
            $query->whereDoesntHave('pengembalian')->with('anggota');
        }])->find($text);

        if ($buku) {
            $dipinjamList = $buku->peminjaman->map(function ($peminjaman) {
                return [
                    'nama'           => $peminjaman->anggota->nama ?? 'Tidak diketahui',
                    'tanggal_pinjam' => $peminjaman->tanggal_pinjam,
                ];
            });

            session()->flash('result', [
                'success' => true,
                'data'    => [
                    'judul'         => $buku->judul,
                    'penulis'       => $buku->penulis,
                    'penerbit'      => $buku->penerbit,
                    'tahun'         => $buku->tahun,
                    'jumlah'        => $buku->jumlah,
                    'dipinjam_list' => $dipinjamList,
                    'cover'         => $buku->cover,
                ],
            ]);
        } else {
            session()->flash('result', [
                'success' => false,
                'message' => 'Buku Tidak Ditemukan. Maaf, buku yang Anda cari tidak ditemukan atau telah dihapus.',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.scan-qr-buku-page')
            ->layout('layouts.app', ['title' => 'Scan QR Buku']);
    }
}
