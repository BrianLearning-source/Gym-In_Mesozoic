<x-filament-panels::page>
    <style>
        #qr-reader {
            width: 100% !important;
            max-width: 350px !important;
            margin: 0 auto !important;
            border: none !important;
            border-radius: 1rem !important;
            overflow: hidden !important;
            background: transparent !important;
        }
        #qr-reader video {
            object-fit: cover !important;
            width: 100% !important;
            height: 100% !important;
            border-radius: 1rem !important;
        }
        #qr-reader__scan_region { background-color: transparent !important; }
        #qr-reader__dashboard_section_csr span, 
        #qr-reader__dashboard_section_swaplink { display: none !important; }
    </style>

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

            <x-filament::section>
                <x-slot name="heading">Hasil Scan Terakhir</x-slot>
                <p class="text-sm text-gray-400 mt-2">
                    Hasil dari proses scan maupun input manual akan muncul di notifikasi sistem.
                </p>
            </x-filament::section>
        </div>

        {{-- BAGIAN KANAN: Scanner Kamera --}}
        <div class="w-full md:w-1/2">
            <x-filament::section>
                <x-slot name="heading">Scan QR Registrasi</x-slot>
                <x-slot name="description">Arahkan kamera ke QR code yang ditunjukkan oleh calon anggota.</x-slot>

                <div class="flex flex-col items-center justify-center mt-4 w-full">
                    <div class="w-full flex justify-center items-center rounded-2xl bg-black/40 p-3 border border-white/10 shadow-lg">
                        <div id="qr-reader"></div>
                    </div>
                    
                    <div class="mt-6 text-center text-sm font-semibold text-gray-400 px-5 py-2.5 bg-gray-800/60 rounded-full border border-gray-700" id="scan-status">
                        Menunggu scan...
                    </div>
                </div>
            </x-filament::section>
        </div>
        
    </div>

    @push('scripts')
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusEl = document.getElementById('scan-status');
            const readerEl = document.getElementById('qr-reader');
            const scanner = new Html5Qrcode('qr-reader');
            let scanning = false;

            if (!readerEl) return;

            function onScanSuccess(decodedText) {
                if (scanning) return;
                scanning = true;
                scanner.stop().catch(() => {});
                statusEl.textContent = '✅ Kode terbaca: ' + decodedText;
                statusEl.classList.remove('text-gray-400', 'text-yellow-400', 'text-red-400');
                statusEl.classList.add('text-emerald-400');
                Livewire.dispatch('scan-result', { kode: decodedText });
                setTimeout(() => { scanning = false; }, 2000);
            }

            function onScanFailure(err) {
            }

            function startScanner(cameraId) {
                const config = { facingMode: cameraId ? undefined : 'user' };
                const deviceConfig = cameraId
                    ? { deviceId: { exact: cameraId } }
                    : { facingMode: 'user' };

                return scanner.start(deviceConfig, {
                    fps: 5,
                    qrbox: { width: 280, height: 280 },
                }, onScanSuccess, onScanFailure);
            }

            function initScanner() {
                statusEl.textContent = '🔍 Mencari kamera...';
                statusEl.classList.remove('text-gray-400', 'text-yellow-400', 'text-red-400');
                statusEl.classList.add('text-yellow-400');

                Html5Qrcode.getCameras().then((cameras) => {
                    if (!cameras || cameras.length === 0) {
                        statusEl.textContent = '⚠️ Tidak ada kamera ditemukan. Gunakan input manual.';
                        statusEl.classList.add('text-red-400');
                        return;
                    }
                    startScanner(cameras[0].id).catch((err) => {
                        statusEl.textContent = '⚠️ Gagal akses kamera. Izinkan akses kamera di browser, lalu klik "Coba Lagi".';
                        statusEl.classList.add('text-red-400');
                        console.warn('QR Scanner start error:', err);
                    });
                }).catch((err) => {
                    statusEl.textContent = '⚠️ Gagal akses kamera. Izinkan akses kamera di browser, lalu klik "Coba Lagi".';
                    statusEl.classList.add('text-red-400');
                    console.warn('QR Scanner getCameras error:', err);
                });
            }

            initScanner();

            const retryBtn = document.createElement('button');
            retryBtn.textContent = '🔄 Coba Lagi';
            retryBtn.className = 'mt-4 px-5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-full text-sm font-semibold transition-all';
            retryBtn.onclick = (e) => {
                e.preventDefault();
                initScanner();
            };
            statusEl.parentNode.appendChild(retryBtn);

            Livewire.on('scan-result', (data) => {
            });
        });
    </script>
    @endpush
</x-filament-panels::page>
