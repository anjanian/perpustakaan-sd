<div class="p-6 bg-slate-100 rounded-lg shadow-lg w-full max-w-lg mx-auto">
    <div class="flex items-center justify-center gap-x-3 mb-6">
        <img src="{{ asset('logo.jpg') }}" class="h-10 w-10 object-contain rounded-md" alt="Logo">
        <div class="whitespace-nowrap text-gray-800 text-center">
            <div class="text-sm font-bold">Perpustakaan</div>
            <div class="text-sm font-semibold">SDN Tugu Utara 14 Pagi</div>
        </div>
    </div>

    <h1 class="text-lg font-bold mb-6 text-center text-blue-800">Scan Qr Buku</h1>

    @if (session()->has('result'))
        @php $result = session('result'); @endphp

        @if ($result['success'])
            <div class="bg-white p-4 rounded-lg shadow border mt-4">
                <h2 class="text-md font-bold mb-4 text-gray-800 text-center">Detail Buku</h2>
                
                <!-- Gambar Cover di Atas -->
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('storage/' . $result['data']['cover']) }}" alt="Cover" class="w-32 h-44 rounded-lg shadow-lg object-cover">
                </div>
                
                <!-- Detail Buku di Bawah -->
                <div class="w-full">
                    <table class="text-sm w-full">
                        <tr class="border-b border-gray-100">
                            <td class="font-semibold py-2 px-1 w-20">Judul</td>
                            <td class="py-2 px-1">: {{ $result['data']['judul'] }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="font-semibold py-2 px-1">Penulis</td>
                            <td class="py-2 px-1">: {{ $result['data']['penulis'] }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="font-semibold py-2 px-1">Penerbit</td>
                            <td class="py-2 px-1">: {{ $result['data']['penerbit'] }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="font-semibold py-2 px-1">Tahun</td>
                            <td class="py-2 px-1">: {{ $result['data']['tahun'] }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold py-2 px-1">Jumlah</td>
                            <td class="py-2 px-1">: {{ $result['data']['jumlah'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if (count($result['data']['dipinjam_list']) > 0)
                <div class="bg-yellow-50 p-4 mt-4 rounded-lg shadow-md border border-yellow-200 animate-pulse">
                    <h3 class="text-md font-bold text-yellow-800 mb-3">Sedang Dipinjam Oleh:</h3>
                    <table class="w-full text-sm text-yellow-800">
                        <thead>
                            <tr>
                                <th class="text-left py-1">Nama</th>
                                <th class="text-left py-1">Tanggal Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result['data']['dipinjam_list'] as $peminjam)
                                <tr class="border-b border-yellow-200">
                                    <td class="py-1">{{ $peminjam['nama'] }}</td>
                                    <td class="py-1">{{ \Carbon\Carbon::parse($peminjam['tanggal_pinjam'])->locale('id')->translatedFormat('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="mt-4 text-green-700 text-sm bg-green-50 p-3 rounded-lg border border-green-200">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Tidak ada peminjaman aktif untuk buku ini.
                    </div>
                </div>
            @endif
        @else
            <x-alert class="mb-3" title="{{ $result['message'] }}" negative shadow="sm" />
        @endif
    @endif

    <div id="reader" class="mb-6 rounded-lg overflow-hidden"></div>
    <div class="flex justify-center mb-3">
        <a href="/scan-qr-buku" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 ease-in-out transform hover:scale-105">
            Scan QR Code Lagi
        </a>
    </div>

    <script src="{{ asset('assets/html5-qrcode/html5-qrcode.min.js') }}"></script>
    <script>
        let html5QRCodeScanner = new Html5QrcodeScanner("reader", {
            fps: 10,
            qrbox: { width: 200, height: 200 },
            verbose: true
        });

        function onScanSuccess(decodedText, decodedResult) {
            @this.call('handleScan', decodedText);
            html5QRCodeScanner.clear();
        }

        html5QRCodeScanner.render(onScanSuccess);
    </script>
</div>