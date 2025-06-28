@extends('layouts.pdf')

@section('title', 'Laporan Data Pengembalian Buku')

@section('main')
    <table width="100%" border="1" cellspacing="0" cellpadding="4">
        <thead>
            <tr style="background-color: #f0f0f0;">
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @php $totalDenda = 0; @endphp

            @foreach ($data as $i => $item)
                @php
                    $denda = $item->denda ?? 0;
                    $totalDenda += $denda;
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->peminjaman->anggota->nama ?? '-' }}</td>
                    <td>{{ $item->peminjaman->buku->judul ?? '-' }}</td>
                    <td align="center">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->locale('id')->translatedFormat('d F Y') }}</td>
                    <td align="center">{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->locale('id')->translatedFormat('d F Y') }}</td>
                    <td>{{ strtoupper($item->status) }}</td>
                    <td>Rp {{ number_format($denda, 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="6" align="right"><strong>Total Denda</strong></td>
                <td><strong>Rp {{ number_format($totalDenda, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
@endsection
