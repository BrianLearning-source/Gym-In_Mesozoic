<x-filament-panels::page>
    <div class="space-y-8">
        <div class="p-8 rounded-xl bg-white/5 border border-white/10">
            <h2 class="text-xl font-semibold mb-6">Tambah Presensi</h2>
            <form wire:submit="submit" class="space-y-6">
                {{ $this->form }}

                <div class="pt-4 flex justify-end">
                    <x-filament::button type="submit">
                        Catat Presensi
                    </x-filament::button>
                </div>
            </form>
        </div>

        <div class="pt-4">
            <h2 class="text-xl font-semibold mb-6">Riwayat Absensi</h2>
            {{ $this->table }}
        </div>
    </div>
</x-filament-panels::page>
