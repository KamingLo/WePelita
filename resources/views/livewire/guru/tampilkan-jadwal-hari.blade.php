<div>
    <label for="hari">Pilih Hari:</label>
    <select wire:model.live="hari" id="hari" class="border p-2 rounded">
        <option value="Senin">Senin</option>
        <option value="Selasa">Selasa</option>
        <option value="Rabu">Rabu</option>
        <option value="Kamis">Kamis</option>
        <option value="Jumat">Jumat</option>
    </select>

    <p>Hari yang dipilih: {{ $hari }}</p>
    <table class="mt-4 w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Pelajaran</th>
                <th class="border px-4 py-2">Guru</th>
                <th class="border px-4 py-2">Kelas</th>
                <th class="border px-4 py-2">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwals as $jadwal)
                <tr>
                    <td class="border px-4 py-2">{{ $jadwal->pelajaran->namaPelajaran }}</td>
                    <td class="border px-4 py-2">{{ $jadwal->pelajaran->guru->profile->name }}</td>
                    <td class="border px-4 py-2">{{ $jadwal->kelasTahun->kelas->nama_kelas }}</td>
                    <td class="border px-4 py-2">{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center border p-4">Tidak ada jadwal untuk hari ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
