@include('partials.header', ['NamaPage' => 'Registrasi Pengguna'])
@include('partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/pelajaran.css') }}" />
<div class="ContainerPelajaran">
    <h1>Tambah Pelajaran Baru</h1>

    <!-- Menampilkan pesan sukses jika pelajaran berhasil ditambahkan -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form untuk menambah pelajaran baru -->
    <form action="{{ route('admin.pelajaran') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="guru_id">Guru</label>
            <select name="guru_id" id="guru_id" class="form-control" required>
            @foreach($gurus as $guru)
                <option value="{{ $guru->guru_id }}">
                    {{ json_encode($guru->profile->name) }}
                </option>
            @endforeach
            

            </select>
            @error('guru_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="namaPelajaran">Nama Pelajaran</label>
            <input type="text" name="namaPelajaran" id="namaPelajaran" class="form-control" required>
            @error('namaPelajaran')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Tambah Pelajaran</button>
    </form>
</div>