@include('admin.partials.header', ['NamaPage' => 'Halaman Utama'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/pelajaran.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="ContainerPelajaran">
    <h1>Edit Pelajaran Baru</h1>

    <div class="LayoutPelajaranForm">
        <h2>Form Edit Pelajaran</h2>
        <form action="{{ route('pelajaran.update', ['id' => $pelajaran->pelajaran_id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="FormFor">
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

            <div class="FormFor">
                <label for="namaPelajaran">Nama Pelajaran</label>
                <input type="text" name="namaPelajaran" id="namaPelajaran" class="form-control" required
                    value="{{ old('namaPelajaran') ?? $pelajaran->namaPelajaran }}">
                @error('namaPelajaran')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="OptionPelajaranTabelEdit">
                <button type="submit" class="TombolOJTEdit TambahPelajaranEdit">
                    <i class='bx bx-list-plus IconOJT'></i>Simpan Pelajaran</button>
                <a href="{{ route('admin.pelajaran') }}" class="TombolOJTEdit btn-danger">Batal</a>
            </div>
        </form>
    </div>

    <div class="LayoutPelajaranTable">
        <h2>Data Pelajaran</h2>
        <div class="DisplayDataTable">
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
</div>