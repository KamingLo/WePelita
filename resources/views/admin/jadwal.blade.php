<div class="container">
    <h1>Pengaturan Jadwal Pembelajaran</h1>

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="pelajaran_id">Pelajaran</label>
            <select name="pelajaran_id" id="pelajaran_id" class="form-control" required>
                @foreach($pelajaran as $item)
                    <option value="{{ $item->pelajaran_id }}">{{ $item->namaPelajaran }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-control" required>
                @foreach($kelas as $item)
                    <option value="{{ $item->kelas_id }}">{{ $item->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="hari">Hari</label>
            <input type="text" name="hari" id="hari" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="waktu_mulai">Waktu Mulai</label>
            <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="waktu_selesai">Waktu Selesai</label>
            <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
    </form>

    <h2 class="mt-5">Jadwal Pembelajaran</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Pelajaran</th>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Guru pengajar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwals as $jadwal)
                <tr>
                    <td>{{ $jadwal->pelajaran->namaPelajaran }}</td>
                    <td>{{ $jadwal->kelas->nama_kelas }}</td>
                    <td>{{ $jadwal->hari }}</td>
                    <td>{{ $jadwal->waktu_mulai }}</td>
                    <td>{{ $jadwal->waktu_selesai }}</td>
                    <td>{{ $jadwal->pelajaran->guru->profile->name }}</td>
                    <td>
                        <form action="{{ route('jadwal.destroy', $jadwal->jadwal_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>