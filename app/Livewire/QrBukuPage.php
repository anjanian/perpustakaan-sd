<?php
namespace App\Livewire;

use App\Models\Buku;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrBukuPage extends Component
{
    public $buku     = null;
    public $bukuId   = null;
    public $isValid  = false;
    public $qrBase64 = null;

    public function mount($bukuId)
    {
        try {
            $this->bukuId = $bukuId;
            $this->buku   = Buku::find($this->bukuId);

            if ($this->buku) {
                $qr = QrCode::format('png')->size(200)->generate($this->bukuId);
                Log::info('QR Raw:', ['qr' => $qr]);

                $this->qrBase64 = 'data:image/png;base64,' . base64_encode($qr);
                Log::info('QR Base64:', ['base64' => $this->qrBase64]);

                $this->isValid = true;
            }
        } catch (\Exception $e) {
            Log::error('QR Error:', ['message' => $e->getMessage()]);
            $this->isValid = false;
        }
    }

    public function render()
    {
        return view('livewire.qr-buku-page')
            ->layout('layouts.app', ['title' => $this->buku ? $this->buku->judul : 'Buku Tidak Ditemukan']);
    }
}
