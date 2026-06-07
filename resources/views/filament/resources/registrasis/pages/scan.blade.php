<x-filament-panels::page>
    <div class="flex flex-col md:flex-row gap-6 items-start w-full">
        {{-- BAGIAN KIRI: Form Input Manual --}}
        <div class="w-full md:w-1/2 space-y-6">
            <x-filament::section>
                <x-slot name="heading">Input Manual</x-slot>
                <x-slot name="description">Gunakan form ini jika scanner sedang tidak berfungsi.</x-slot>

                <form wire:submit="prosesManual" class="space-y-4 mt-4">
                    {{ $this->form }}
                    
                    <div class="flex justify-end mt-6">
                        <x-filament::button type="submit" color="primary" icon="heroicon-o-paper-airplane">
                            Proses Aktivasi Anggota
                        </x-filament::button>
                    </div>
                </form>
            </x-filament::section>
        </div>

        {{-- BAGIAN KANAN: Scanner Kamera --}}
        <div class="w-full md:w-1/2">
            <x-filament::section>
                <x-slot name="heading">Scan QR Registrasi</x-slot>
                <x-slot name="description">Arahkan kamera ke QR code yang ditunjukkan oleh calon anggota.</x-slot>

                <div class="flex flex-col items-center justify-center mt-4 w-full">
                    <div id="qr-reader" style="width: 100%; max-width: 500px; margin: 0 auto;"></div>
                    <div id="qr-status" class="mt-4 text-center text-sm text-gray-400">
                        Menunggu scan...
                    </div>
                    <button id="restart-btn" class="mt-4 hidden px-4 py-2 bg-primary-600 text-white rounded-lg text-sm hover:bg-primary-700">
                        Mulai Ulang Scanner
                    </button>
                </div>
            </x-filament::section>
        </div>
    </div>
</x-filament-panels::page>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let html5QrCode = null;
        let isProcessing = false;
        
        function onScanSuccess(decodedText, decodedResult) {
            if (isProcessing) return;
            isProcessing = true;
            
            console.log('QR Code detected:', decodedText);
            
            const statusEl = document.getElementById('qr-status');
            statusEl.textContent = '✅ Kode terbaca: ' + decodedText;
            statusEl.className = 'mt-4 text-center text-sm text-green-500 font-semibold';
            
            if (html5QrCode) {
                html5QrCode.stop().catch(err => console.log('Stop error:', err));
            }
            
            Livewire.dispatch('scan-result', { kode: decodedText });
            
            const restartBtn = document.getElementById('restart-btn');
            restartBtn.classList.remove('hidden');
        }
        
        function onScanFailure(error) {
            // Silently ignore
        }
        
        function startScanner() {
            const readerElement = document.getElementById('qr-reader');
            const statusEl = document.getElementById('qr-status');
            
            if (!readerElement) {
                console.error('Reader element not found');
                return;
            }
            
            if (html5QrCode) {
                html5QrCode.clear();
                readerElement.innerHTML = '';
            }
            
            statusEl.textContent = '🔍 Memulai kamera...';
            statusEl.className = 'mt-4 text-center text-sm text-yellow-500';
            
            html5QrCode = new Html5Qrcode("qr-reader");
            
            const config = {
                fps: 10,
                qrbox: { width: 300, height: 300 },
                aspectRatio: 1.0,
            };
            
            html5QrCode.start(
                { facingMode: "environment" },
                config,
                onScanSuccess,
                onScanFailure
            ).then(() => {
                statusEl.textContent = '📷 Kamera siap. Arahkan ke QR code...';
                statusEl.className = 'mt-4 text-center text-sm text-green-500';
            }).catch(err => {
                console.error('Camera error:', err);
                statusEl.textContent = '❌ Gagal mengakses kamera: ' + err.message;
                statusEl.className = 'mt-4 text-center text-sm text-red-500';
            });
        }
        
        startScanner();
        
        const restartBtn = document.getElementById('restart-btn');
        restartBtn.addEventListener('click', function() {
            isProcessing = false;
            this.classList.add('hidden');
            
            if (html5QrCode) {
                html5QrCode.clear();
            }
            
            const readerElement = document.getElementById('qr-reader');
            if (readerElement) {
                readerElement.innerHTML = '';
            }
            
            startScanner();
        });
        
        window.addEventListener('beforeunload', function() {
            if (html5QrCode && html5QrCode.isScanning) {
                html5QrCode.stop().catch(() => {});
            }
        });
    });
</script>
@endpush
