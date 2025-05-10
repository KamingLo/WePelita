@include('partials.header', ['NamaPage' => 'Registrasi Pengguna'])
@include('partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/jadwal.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="ContainerJadwal">
        <h1>Pengaturan Jadwal Pembelajaran</h1>
        
        <div class="form-container">
            <h2>Tambah Jadwal</h2>
            <form action="{{ route('jadwal.update', ['id' => $jadwal->jadwal_id]) }}" method="POST">
                @csrf
                @method('PUT')
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

                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
            </form>
        </div>
        
        <div class="table-container">
            <h2>Jadwal Pembelajaran</h2>
            <div class="table-responsive">
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
                            <tr>
                                <td>{{ $jadwal->pelajaran->namaPelajaran }}</td>
                                <td>{{ $jadwal->kelas->nama_kelas }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->waktu_mulai }}</td>
                                <td>{{ $jadwal->waktu_selesai }}</td>
                                <td>{{ $jadwal->pelajaran->guru->profile->name }}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>