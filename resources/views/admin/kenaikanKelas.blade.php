@include('admin.partials.header', ['NamaPage' => 'Kenaikan Kelas'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/jadwal.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="ContainerJadwal">
        <h1>Kenaikan Kelas</h1>

        <div class="LayoutJadwalForm">
            <h2>Form Kenaikan Kelas</h2>
            <form action="{{ route('admin.prosesKenaikanKelas') }}" method="POST">
                @csrf

                <div class="FormFor">
                    <label for="kelas_asal">Kelas Asal</label>
                    <select name="kelas_asal" id="kelas_asal" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Kelas Asal --</option>
                        @foreach($kelasSekarang as $kelas)
                            <option value="{{ $kelas->kelas_tahun_id }}">
                                {{ $kelas->kelas->nama_kelas }} - {{ $kelas->tahunajar->tahun_ajaran }} {{ $kelas->tahunajar->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="FormFor">
                    <label for="kelas_tujuan">Kelas Tujuan</label>
                    <select name="kelas_tujuan" id="kelas_tujuan" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Kelas Tujuan --</option>
                        @foreach($semuaKelas as $kelas)
                            <option value="{{ $kelas->kelas_id }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="FormFor">
                    <label for="tahun_ajaran">Tahun Ajaran</label>
                    <select name="tahun_ajaran" id="tahun_ajaran" class="form-control" required>
                        <option value="{{ (now()->year) }}/{{ (now()->year)+1}}">{{ (now()->year) }}/{{ (now()->year)+1}}</option>
                        <option value="{{ (now()->year)-1 }}/{{ (now()->year)}}">{{ (now()->year)-1 }}/{{ (now()->year)}}</option>
                    </select>
                </div>

                <div class="FormFor">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester" class="form-control" required>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>

                <div class="OptionPelajaranTabelEdit">
                    <button type="submit" class="TombolOJT TambahJadwal">
                        <i class='bx bx-layer-plus IconOJT'></i>Proses Kenaikan Kelas
                    </button>
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</body>
