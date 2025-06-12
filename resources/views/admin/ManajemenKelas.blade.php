@include('admin.partials.header')
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenKelas.css') }}" />

<body>
    <div class="ContainerManajemenKelas">
        <h1>Manajemen Kelas</h1>
        
        <div class="HeaderManajemenKelas">
            <div class="SwitchKelas">
                <button class="SwitchKelasTab active" onclick="switchTab('manajemen')" id="tabManajemen">
                    Manajemen Kelas
                </button>
                <button class="SwitchKelasTab" onclick="switchTab('kenaikan')" id="tabKenaikan">
                    Kenaikan Kelas
                </button>
            </div>
        </div>

        <div id="manajemenTab" class="DisSwitchKelas active">
            <div class="LayoutManKelForm">
                <h2>Tambah Kelas</h2>
                <form action="{{ route('admin.tambahKelas') }}" method="POST">
                    @csrf

                    <div class="IsiData">
                        <label for="nama_kelas">Nama Kelas</label>
                        <div style="position: relative;">
                            <input type="text" name="nama_kelas" id="nama_kelas" class="TampilanIsiData" placeholder="Masukkan nama kelas" required>
                            <button type="button" id="clearNamaKelas" class="HapusBar">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>
                    </div>

                    <div class="IsiData">
                        <label for="tahunAjar">Tahun ajar</label>
                        <select name="tahun_ajar" id="tahunAjar" class="TampilanIsiData" required>
                            <option value="{{ (now()->year) }}/{{ (now()->year)+1}}">{{ (now()->year) }}/{{ (now()->year)+1}}</option>
                            <option value="{{ (now()->year)-1 }}/{{ (now()->year)}}">{{ (now()->year)-1 }}/{{ (now()->year)}}</option>
                            <option value="{{ (now()->year)-2 }}/{{ (now()->year)}}">{{ (now()->year)-2 }}/{{ (now()->year)-1}}</option>
                        </select>
                    </div>

                    <div class="IsiData">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" class="TampilanIsiData" required>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>

                    <button type="submit" class="TombolOJT TambahKelasBaru">
                        Tambah Kelas Baru
                    </button>
                    @error('nama_kelas')
                        <div class="UiPsnDis PsnError">{{ $message }}</div>
                    @enderror

                    @error('tahun_ajar')
                        <div class="UiPsnDis PsnError">{{ $message }}</div>
                    @enderror

                    @error('semester')
                        <div class="UiPsnDis PsnError">{{ $message }}</div>
                    @enderror

                    @error('kelas_asal')
                        <div class="UiPsnDis PsnError">{{ $message }}</div>
                    @enderror

                    @error('kelas_tujuan')
                        <div class="UiPsnDis PsnError">{{ $message }}</div>
                    @enderror

                    @error('tahun_ajaran')
                        <div class="UiPsnDis PsnError">{{ $message }}</div>
                    @enderror

                    @error('semester')
                        <div class="UiPsnDis PsnError">{{ $message }}</div>
                    @enderror

                    @if(session('success'))
                        <div class="UiPsnDis PsnBerhasil">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->has('jadwal'))
                        <div class="UiPsnDis PsnError">
                            {{ $errors->first('jadwal') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="UiPsnDis PsnError">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="UiPsnDis PsnError">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div id="kenaikanTab" class="DisSwitchKelas">
            <div class="LayoutKenaikanKelasForm">
                <h2>Form Kenaikan Kelas</h2>
                <form action="{{ route('admin.prosesKenaikanKelas') }}" method="POST">
                    @csrf

                    <div class="IsiData">
                        <label for="kelas_asal">Kelas Asal</label>
                        <select name="kelas_asal" id="kelas_asal" class="TampilanIsiData" required>
                            <option value="" disabled {{ old('kelas_asal') ? '' : 'selected' }}>-- Pilih Kelas Asal --</option>
                            @if(isset($kelasSekarang) && $kelasSekarang->isNotEmpty())
                                @foreach($kelasSekarang as $kelas)
                                    <option value="{{ $kelas->kelas_tahun_id }}" {{ old('kelas_asal') == $kelas->kelas_tahun_id ? 'selected' : '' }}>
                                        {{ $kelas->kelas->nama_kelas }} - {{ $kelas->tahunajar->tahun_ajaran }} {{ $kelas->tahunajar->semester }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>Tidak ada kelas aktif</option>
                            @endif
                        </select>
                    </div>

                    <div class="IsiData">
                        <label for="kelas_tujuan">Kelas Tujuan</label>
                        <select name="kelas_tujuan" id="kelas_tujuan" class="TampilanIsiData" required>
                            <option value="" disabled {{ old('kelas_tujuan') ? '' : 'selected' }}>-- Pilih Kelas Tujuan --</option>
                            @if(isset($semuaKelas) && $semuaKelas->isNotEmpty())
                                @foreach($semuaKelas as $kelas)
                                    <option value="{{ $kelas->kelas_id }}" {{ old('kelas_tujuan') == $kelas->kelas_id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>Tidak ada kelas tersedia</option>
                            @endif
                        </select>
                    </div>

                    <div class="IsiData">
                        <label for="tahun_ajaran_kenaikan">Tahun Ajaran</label>
                        <select name="tahun_ajaran" id="tahun_ajaran_kenaikan" class="TampilanIsiData" required>
                            <option value="{{ now()->year }}/{{ now()->year + 1 }}" {{ old('tahun_ajaran') == now()->year . '/' . (now()->year + 1) ? 'selected' : '' }}>
                                {{ now()->year }}/{{ now()->year + 1 }}
                            </option>
                            <option value="{{ now()->year - 1 }}/{{ now()->year }}" {{ old('tahun_ajaran') == (now()->year - 1) . '/' . now()->year ? 'selected' : '' }}>
                                {{ now()->year - 1 }}/{{ now()->year }}
                            </option>
                        </select>

                    </div>

                    <div class="IsiData">
                        <label for="semester_kenaikan">Semester</label>
                        <select name="semester" id="semester_kenaikan" class="TampilanIsiData" required>
                            <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>

                    <div class="TombolKenaikanKelas">
                        <button type="submit" class="TombolOJT ProsesKenaikanKelas">
                            Proses Kenaikan Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="tabelManajemen" class="LayoutManKelTable">
            <h2>Semua kelas</h2>
            <div class="DisplayDataTable">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama kelas</th>
                            <th>Tahun ajaran</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($kelastahuns))
                            @foreach($kelastahuns as $kelastahun)
                                <tr>
                                    <td>{{ $kelastahun->kelas->nama_kelas ?? 'N/A' }}</td>
                                    <td>{{ $kelastahun->tahunajar->tahun_ajaran ?? 'N/A' }}</td>
                                    <td>{{ $kelastahun->tahunajar->semester ?? 'N/A' }}</td>
                                    <td>{{ $kelastahun->tahunajar->status ?? 'N/A' }}</td>
                                    <td>
                                        <div class="OptionJadwalTabel">
                                            <form action="{{ route('kelas.update', $kelastahun->kelas_tahun_id) }}" method="GET">
                                                <a href="manajemenKelas/edit/{{ $kelastahun->kelas_tahun_id }}" class="TombolOJT Tedit">
                                                    ‎ ‎ ‎Edit‎ ‎ ‎
                                                </a>
                                            </form>

                                            <form action="{{ route('kelas.destroy', $kelastahun->kelas_tahun_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="TombolOJT TombolDelete">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="5">Tidak ada data kelas.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div id="tabelKenaikan" class="LayoutManKelTable" style="display: none;">
            <h2>Kelas Aktif</h2>
            <div class="DisplayDataTable">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama kelas</th>
                            <th>Tahun ajaran</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Jumlah Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($kelasSekarang) && $kelasSekarang->isNotEmpty())
                            @foreach($kelasSekarang as $kelas)
                                <tr>
                                    <td>{{ $kelas->kelas->nama_kelas ?? 'N/A' }}</td>
                                    <td>{{ $kelas->tahunajar->tahun_ajaran ?? 'N/A' }}</td>
                                    <td>{{ $kelas->tahunajar->semester ?? 'N/A' }}</td>
                                    <td>{{ $kelas->tahunajar->status ?? 'N/A' }}</td>
                                    <td>{{ $kelas->siswa_count ?? 0 }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="5">Tidak ada kelas aktif.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('js/CssAdmin.js') }}"></script>