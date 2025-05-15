@include('admin.partials.header', ['NamaPage' => 'Halaman Utama'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/jadwal.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="ContainerJadwal">
        <h1>Tambah Kelas Baru</h1>

        <div class="LayoutJadwalForm">
            <h2>Tambah Kelas</h2>
            <form action="{{ route('kelas.update', $kelastahun->kelas_tahun_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="FormFor">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas" value="{{ $kelastahun->kelas->nama_kelas }}">
                </div>
                    @error('nama_kelas')
                        <span class="error-message">{{ $message }}</span>
                      @enderror

                <div class="FormFor">
                    <label for="tahunAjar">Tahun ajar</label>
                    <select name="tahun_ajaran" id="tahunAjar">
                        <option value="{{ (now()->year) }}/{{ (now()->year)+1}}" {{ $kelastahun->tahunajar->tahun_ajaran == (now()->year) . '/' . (now()->year)+1 ? 'selected' : '' }}>{{ (now()->year) }}/{{ (now()->year)+1}}</option>
                        <option value="{{ (now()->year)-1 }}/{{ (now()->year)}}" {{ $kelastahun->tahunajar->tahun_ajaran == (now()->year)-1 . '/' . (now()->year) ? 'selected' : '' }}>{{ (now()->year)-1 }}/{{ (now()->year)}}</option>
                        <option value="{{ (now()->year)-2 }}/{{ (now()->year)}}" {{ $kelastahun->tahunajar->tahun_ajaran == (now()->year)-2 . '/' . (now()->year) ? 'selected' : '' }}>{{ (now()->year)-2 }}/{{ (now()->year)-1}}</option>
                    </select>
                </div>


                <div class="FormFor">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester">
                        <option value="Ganjil" {{ $kelastahun->tahunajar->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ $kelastahun->tahunajar->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>

                <div class="FormFor">
                    <label for="status">status</label>
                    <select name="status" id="status">
                        <option value="Aktif" {{ $kelastahun->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ $kelastahun->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak aktif</option>
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

            @if ($errors->has('kelas'))
                <div class="alertD alert-danger">
                    {{ $errors->first('kelas') }}
                </div>
            @endif

        </div>

        <div class="LayoutJadwalTable">
            <h2>Jadwal Pembelajaran</h2>
            <div class="DisplayDataTable">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama kelas</th>
                            <th>Tahun ajaran</th>
                            <th>Semester</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $kelastahun->kelas->nama_kelas}}</td>
                                <td>{{ $kelastahun->tahunajar->tahun_ajaran }}</td>
                                <td>{{ $kelastahun->tahunajar->semester}}</td>
                                <td>{{ $kelastahun->tahunajar->status}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>