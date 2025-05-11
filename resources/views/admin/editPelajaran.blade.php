@include('partials.header', ['NamaPage' => 'Registrasi Pengguna'])
@include('partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/pelajaran.css') }}" />
<div class="ContainerPelajaran">
    <h1>Edit Pelajaran Baru</h1>

    <!-- Form untuk menambah pelajaran baru -->
    <form action="{{ route('pelajaran.update', ['id' => $pelajaran->pelajaran_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
        <label for="guru_id">Guru</label>
        <select name="guru_id" id="guru_id" class="form-control" required>
            @foreach($gurus as $guru)
                <option value="{{ $guru->guru_id }}"
                    {{ (old('guru_id') ?? $pelajaran->guru_id) == $guru->guru_id ? 'selected' : '' }}>
                    {{ $guru->profile->name }}
                </option>
            @endforeach
        </select>
        @error('guru_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="namaPelajaran">Nama Pelajaran</label>
        <input type="text" name="namaPelajaran" id="namaPelajaran" class="form-control" required
            value="{{ old('namaPelajaran') ?? $pelajaran->namaPelajaran }}">
        @error('namaPelajaran')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mt-3">Simpan Pelajaran</button>
</form>


    <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $pelajaran->guru->profile->name }}</td>
                                <td>{{ $pelajaran->namaPelajaran }}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
</div>