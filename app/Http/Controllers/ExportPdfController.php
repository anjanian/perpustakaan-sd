<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportPdfController extends Controller
{
    public function peminjamanExport(Request $request)
    {
        $filters = $request->input('tableFilters', []);

        $query = Peminjaman::with(['anggota', 'buku']);

        if (! empty($filters['tanggal_dari']['tanggal_dari'])) {
            $query->whereDate('tanggal_pinjam', '>=', $filters['tanggal_dari']['tanggal_dari']);
        }

        if (! empty($filters['tanggal_sampai']['tanggal_sampai'])) {
            $query->whereDate('tanggal_pinjam', '<=', $filters['tanggal_sampai']['tanggal_sampai']);
        }

        $data = $query->get();

        $pdf = Pdf::loadView('pdf.peminjaman-laporan', [
                'data' => $data,
                'filters' => $filters,
            ])
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-peminjaman.pdf');
    }

    public function pengembalianExport(Request $request)
    {
        $filters = $request->input('tableFilters', []);

        $query = Pengembalian::with(['peminjaman.anggota', 'peminjaman.buku']);

        if (! empty($filters['tanggal_dari']['tanggal_dari'])) {
            $query->whereDate('tanggal_pengembalian', '>=', $filters['tanggal_dari']['tanggal_dari']);
        }

        if (! empty($filters['tanggal_sampai']['tanggal_sampai'])) {
            $query->whereDate('tanggal_pengembalian', '<=', $filters['tanggal_sampai']['tanggal_sampai']);
        }

        if (! empty($filters['status']['value'])) {
            $query->where('status', $filters['status']['value']);
        }

        $pengembalian = $query->get();

        $pdf = Pdf::loadView('pdf.pengembalian-laporan', [
                'data' => $pengembalian,
                'filters' => $filters,
            ])
            ->setPaper('a4', 'landscape'); 

        return $pdf->download('laporan-pengembalian.pdf');
    }
}
