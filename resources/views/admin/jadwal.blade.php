@include('partials.header', ['NamaPage' => 'Registrasi Pengguna'])
@include('partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/jadwal.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="ContainerJadwal">
        <h1>Tambah Jadwal Pembelajaran</h1>

        <div class="LayoutJadwalForm">
            <h2>Tambah Jadwal</h2>
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf

                <div class="FormFor">
                    <label for="pelajaran_id">Pelajaran</label>
                    <select name="pelajaran_id" id="pelajaran_id" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Pelajaran --</option>
                        @foreach($pelajaran as $item)
                            <option value="{{ $item->pelajaran_id }}">{{ $item->namaPelajaran }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="FormFor">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Kelas --</option>
                        @foreach($kelas as $item)
                            <option value="{{ $item->kelas_id }}">{{ $item->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="FormFor">
                    <label for="hari">Hari</label>
                    <select name="hari" id="hari" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Hari --</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>

                <div class="FormFor">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                </div>

                <div class="FormFor">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
                </div>

                <button type="submit" class="TombolOJT TambahJadwal">
                    <i class='bx bx-layer-plus IconOJT'></i>Tambah Jadwal
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
                                    <div class="OptionJadwalTabel">
                                        <form action="{{ route('jadwal.destroy', $jadwal->jadwal_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="TombolOJT TombolDelete">
                                                <i class='bx bx-trash IconOJT'></i>Hapus
                                            </button>
                                        </form>

                                        <form action="{{ route('jadwal.update', $jadwal->jadwal_id) }}" method="GET">
                                            <a href="jadwal/edit/{{ $jadwal->jadwal_id }}" class="TombolOJT Tedit">
                                                <i class='bx bx-edit-alt IconOJT'></i>Edit‎ ‎ ‎ ‎ ‎ 
                                            </a> {{-- Jan diubah wa sengaja bikin cam tu 😂 --}}
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>