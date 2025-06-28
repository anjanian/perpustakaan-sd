<div class="p-6 bg-slate-100 rounded-lg shadow-lg w-full max-w-lg mx-auto">
    <div class="flex items-center justify-center gap-x-3 mb-6">
        <img src="{{ asset('logo.jpg') }}" class="h-10 w-10 object-contain rounded-md" alt="Logo">
        <div class="whitespace-nowrap text-gray-800 text-center">
            <div class="text-sm font-bold">Perpustakaan</div>
            <div class="text-sm font-semibold">SDN Tuku Utara 14 Pagi</div>
        </div>
    </div>
    <h1 class="text-lg font-bold mb-6 text-center text-blue-800">Qr Buku</h1>
    @if ($buku && $isValid)
        <div class="bg-blue-50 p-5 rounded-lg shadow-sm mb-8 border-l-4 border-blue-500">
            <h2 class="text-lg font-semibold mb-4 text-blue-700 text-center">{{ $buku->judul }}</h2>
            <div class="flex justify-center mt-6">
                <img src="{{ $qrBase64 }}" alt="QR Code" class="h-64 w-64">
            </div>
        </div>
    @elseif ($buku && !$isValid)
        <div class="bg-yellow-50 p-8 rounded-lg shadow-md border border-yellow-200 text-center">
            <x-icon name="exclamation-circle" class="h-20 w-20 mx-auto text-yellow-400 mb-4" />
            <h3 class="text-lg font-bold text-yellow-800 mb-3">Buku Tidak Ditemukan</h3>
            <p class="text-yellow-700 mb-4 text-lg">Maaf, Buku yang Anda cari tidak tersedia</p>
        </div>
    @else
        <div class="bg-yellow-50 p-8 rounded-lg shadow-md border border-yellow-200 text-center">
            <x-icon name="exclamation-circle" class="h-20 w-20 mx-auto text-yellow-400 mb-4" />
            <h3 class="text-lg font-bold text-yellow-800 mb-3">Buku Tidak Ditemukan</h3>
            <p class="text-yellow-700 mb-4 text-lg">Maaf, Buku yang Anda cari tidak tersedia</p>
        </div>
    @endif
</div>
