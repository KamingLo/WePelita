<div>
    <label for="hari">Pilih Hari:</label>
    <select wire:model.live="hari" id="hari">
        <option value="Senin">Senin</option>
        <option value="Selasa">Selasa</option>
        <option value="Rabu">Rabu</option>
        <option value="Kamis">Kamis</option>
        <option value="Jumat">Jumat</option>
    </select>

    <p>Hari yang dipilih: {{ $hari }}</p>
    <table >
        <thead>
            <tr >
                <th>Pelajaran</th>
                <th>Guru</th>
                <th>Kelas</th>
                <th >Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwals as $jadwal)
                <tr>
                    <td>{{ $jadwal->pelajaran->namaPelajaran }}</td>
                    <td >{{ $jadwal->pelajaran->guru->profile->name }}</td>
                    <td >{{ $jadwal->kelasTahun->kelas->nama_kelas }}</td>
                    <td >{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" >Tidak ada jadwal untuk hari ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
