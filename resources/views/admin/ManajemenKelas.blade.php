@include('admin.partials.header', ['NamaPage' => 'Halaman Utama'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/jadwal.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="ContainerJadwal">
        <h1>Tambah Kelas Baru</h1>

        <div class="LayoutJadwalForm">
            <h2>Tambah Kelas</h2>
            <form action="{{ route('admin.tambahKelas') }}" method="POST">
                @csrf

                <div class="FormFor">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas">
                </div>

                <div class="FormFor">
                    <label for="tahunAjar">Tahun ajar</label>
                    <select name="tahun_ajar" id="tahunAjar">
                        <option value="{{ (now()->year) }}/{{ (now()->year)+1}}">{{ (now()->year) }}/{{ (now()->year)+1}}</option>
                        <option value="{{ (now()->year)-1 }}/{{ (now()->year)}}">{{ (now()->year)-1 }}/{{ (now()->year)}}</option>
                        <option value="{{ (now()->year)-2 }}/{{ (now()->year)}}">{{ (now()->year)-2 }}/{{ (now()->year)-1}}</option>
                    </select>
                </div>

                <div class="FormFor">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester">
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>

                <button type="submit" class="TombolOJT TambahJadwal">
                    Tambah Kelas Baru
                </button>
            </form>

            @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif

            @if ($errors->has('jadwal'))
                <div class="alertD alert-danger">
                    {{ $errors->first('jadwal') }}
                </div>
            @endif

        </div>

        {{-- <div class="LayoutJadwalTable">
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
                                        <form action="{{ route('jadwal.update', $jadwal->jadwal_id) }}" method="GET">
                                            <a href="jadwal/edit/{{ $jadwal->jadwal_id }}" class="TombolOJT Tedit">
                                                <i class='bx bx-edit-alt IconOJT'></i>Edit‎ ‎ ‎ ‎ ‎ 
                                            </a> {{-- Jan diubah wa sengaja bikin cam tu 😂 
                                        </form>

                                        <form action="{{ route('jadwal.destroy', $jadwal->jadwal_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="TombolOJT TombolDelete">
                                                <i class='bx bx-trash IconOJT'></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
</body>