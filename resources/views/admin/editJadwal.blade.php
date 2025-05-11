@include('partials.header', ['NamaPage' => 'Registrasi Pengguna'])
@include('partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/jadwal.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="ContainerJadwal">
        <h1>Edit Jadwal Pembelajaran</h1>
        
        <div class="form-container">
            <h2>Tambah Jadwal</h2>
            <form action="{{ route('pelajaran.update', ['id' => $jadwal->jadwal_id]) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Pelajaran --}}
                <div class="form-group">
                    <label for="pelajaran_id">Pelajaran</label>
                    <select name="pelajaran_id" id="pelajaran_id" class="form-control" required>
                        @foreach($pelajaran as $item)
                            <option value="{{ $item->pelajaran_id }}"
                                {{ (old('pelajaran_id') ?? $jadwal->pelajaran_id) == $item->pelajaran_id ? 'selected' : '' }}>
                                {{ $item->namaPelajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Kelas --}}
                <div class="form-group">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control" required>
                        @foreach($kelas as $item)
                            <option value="{{ $item->kelas_id }}"
                                {{ (old('kelas_id') ?? $jadwal->kelas_id) == $item->kelas_id ? 'selected' : '' }}>
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Hari --}}
                <div class="form-group">
                    <label for="hari">Hari</label>
                    <input type="text" name="hari" id="hari" class="form-control" required
                        value="{{ old('hari') ?? $jadwal->hari }}">
                </div>

                {{-- Waktu Mulai --}}
                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" required
                        value="{{ old('waktu_mulai') ?? $jadwal->waktu_mulai }}">
                </div>

                {{-- Waktu Selesai --}}
                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" required
                        value="{{ old('waktu_selesai') ?? $jadwal->waktu_selesai }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
            </form>
        </div>
    </div>
</body>