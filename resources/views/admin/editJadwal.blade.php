@include('partials.header', ['NamaPage' => 'Registrasi Pengguna'])
@include('partials.sidebar')

<link rel="stylesheet" href="{{ asset('css/jadwal.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="ContainerJadwal">
        <h1>Edit Jadwal Pembelajaran</h1>

        <div class="LayoutJadwalForm">
            <h2>Edit Jadwal</h2>
            <form action="{{ route('pelajaran.update', ['id' => $jadwal->jadwal_id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="FormFor">
                    <label for="pelajaran_id">Pelajaran</label>
                    <select name="pelajaran_id" id="pelajaran_id" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Pelajaran --</option>
                        @foreach($pelajaran as $item)
                            <option value="{{ $item->pelajaran_id }}"
                                {{ old('pelajaran_id', $jadwal->pelajaran_id) == $item->pelajaran_id ? 'selected' : '' }}>
                                {{ $item->namaPelajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="FormFor">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Kelas --</option>
                        @foreach($kelas as $item)
                            <option value="{{ $item->kelas_id }}"
                                {{ old('kelas_id', $jadwal->kelas_id) == $item->kelas_id ? 'selected' : '' }}>
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="FormFor">
                    <label for="hari">Hari</label>
                    <select name="hari" id="hari" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Hari --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                            <option value="{{ $day }}"
                                {{ old('hari', $jadwal->hari) == $day ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="FormFor">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="{{ old('waktu_mulai', $jadwal->waktu_mulai) }}" required>
                </div>

                <div class="FormFor">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ old('waktu_selesai', $jadwal->waktu_selesai) }}" required>
                </div>

                <button type="submit" class="TombolOJT TambahJadwal">
                    <i class='bx bx-layer-plus IconOJT'></i>Simpan Jadwal
                </button>
            </form>
        </div>

        <div class="LayoutJadwalTable">
            <h2>Jadwal Pembelajaran</h2>
            <div class="DisplayDataTable">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pelajaran</th>
                            <th>Kelas</th>
                            <th>Hari</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Guru Pengajar</th>
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
