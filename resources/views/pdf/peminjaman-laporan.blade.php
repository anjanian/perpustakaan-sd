@extends('layouts.pdf')

@section('title', 'Laporan Data Peminjaman Buku')

@section('main')
    <table width="100%" border="1" cellspacing="0" cellpadding="4">
        <thead>
            <tr style="background-color: #f0f0f0;">
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->anggota->nama ?? '-' }}</td>
                    <td>{{ $item->buku->judul ?? '-' }}</td>
                    <td align="center">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') }}</td>
                    <td align="center">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->locale('id')->translatedFormat('d F Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
