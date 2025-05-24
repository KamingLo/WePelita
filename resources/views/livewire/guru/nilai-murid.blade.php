<div>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Input Nilai Murid</h1>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <!-- Step 1: Pilih Pelajaran -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Pilih Pelajaran
                </label>
                <select wire:model.live="pilihanPelajaran" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Pelajaran --</option>
                    @foreach($pelajaranList as $pelajaran)
                        <option value="{{ $pelajaran->pelajaran_id }}">{{ $pelajaran->namaPelajaran }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Step 2: Pilih Kelas -->
            @if($pilihanPelajaran)
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Pilih Kelas
                </label>
                <select wire:model.live="pilihanKelasTahun" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelasTahunList as $kelasTahun)
                        <option value="{{ $kelasTahun->kelas_tahun_id }}">
                            {{ $kelasTahun->kelas->nama_kelas }} - {{ $kelasTahun->tahun_ajaran }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif

            <!-- Step 3: Input Nilai -->
            @if($pilihanKelasTahun)
            <form wire:submit.prevent="submitNilai">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Daftar Murid</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Nama Murid</th>
                                    <th class="px-4 py-2">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($muridList as $muridKelas)
                                    <tr>
                                        <td class="border px-4 py-2">
                                            {{ $muridKelas->murid->profile->name }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            <input type="number" 
                                                wire:model="nilai.{{ $muridKelas->murid_kelas_id }}"
                                                class="w-20 border rounded px-2 py-1"
                                                min="0"
                                                max="100">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="border px-4 py-2 text-center">
                                            Tidak ada murid dalam kelas ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Nilai
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>