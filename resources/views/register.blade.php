<!-- resources/views/register.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrasi Murid & Orang Tua</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Form Registrasi Murid & Orang Tua</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <h4>Data Murid</h4>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Murid</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Murid</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required />
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}" required />
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required />
        </div>

        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required />
        </div>

        <div class="mb-3">
            <label for="pendidikan" class="form-label">Pendidikan</label>
            <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}" required />
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">No. Telp</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required />
        </div>

        <h4>Data Murid Tambahan</h4>
        <div class="mb-3">
            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required />
        </div>

        <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis') }}" required />
        </div>

        <div class="mb-3">
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" class="form-control" id="nisn" name="nisn" value="{{ old('nisn') }}" required />
        </div>

        <div class="mb-3">
            <label for="kelas_tahun_id" class="form-label">Kelas Tahun</label>
            <select class="form-select" id="kelas_tahun_id" name="kelas_tahun_id" required>
                <option value="">-- Pilih --</option>
                @foreach($kelasTahunList as $kelasTahun)
                    <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ old('kelas_tahun_id') == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
                        {{ $kelasTahun->kelas->nama ?? 'Kelas' }} - {{ $kelasTahun->tahunAjaran->nama ?? 'Tahun Ajaran' }}
                    </option>
                @endforeach
            </select>
        </div>

        <h4>Data Orang Tua</h4>
        <div class="mb-3">
            <label for="ortu_name" class="form-label">Nama Orang Tua</label>
            <input type="text" class="form-control" id="ortu_name" name="ortu_name" value="{{ old('ortu_name') }}" required />
        </div>

        <div class="mb-3">
            <label for="ortu_email" class="form-label">Email Orang Tua</label>
            <input type="email" class="form-control" id="ortu_email" name="ortu_email" value="{{ old('ortu_email') }}" required />
        </div>

        <div class="mb-3">
            <label for="ortu_alamat" class="form-label">Alamat Orang Tua</label>
            <input type="text" class="form-control" id="ortu_alamat" name="ortu_alamat" value="{{ old('ortu_alamat') }}" required />
        </div>

        <div class="mb-3">
            <label for="ortu_tempat_lahir" class="form-label">Tempat Lahir Orang Tua</label>
            <input type="text" class="form-control" id="ortu_tempat_lahir" name="ortu_tempat_lahir" value="{{ old('ortu_tempat_lahir') }}" required />
        </div>

        <div class="mb-3">
            <label for="ortu_tanggal_lahir" class="form-label">Tanggal Lahir Orang Tua</label>
            <input type="date" class="form-control" id="ortu_tanggal_lahir" name="ortu_tanggal_lahir" value="{{ old('ortu_tanggal_lahir') }}" required />
        </div>

        <div class="mb-3">
            <label for="ortu_jenis_kelamin" class="form-label">Jenis Kelamin Orang Tua</label>
            <select class="form-select" id="ortu_jenis_kelamin" name="ortu_jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('ortu_jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('ortu_jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="ortu_pendidikan" class="form-label">Pendidikan Orang Tua</label>
            <input type="text" class="form-control" id="ortu_pendidikan" name="ortu_pendidikan" value="{{ old('ortu_pendidikan') }}" required />
        </div>

        <div class="mb-3">
            <label for="ortu_no_telp" class="form-label">No. Telp Orang Tua</label>
            <input type="text" class="form-control" id="ortu_no_telp" name="ortu_no_telp" value="{{ old('ortu_no_telp') }}" required />
        </div>

        <div class="mb-3">
            <label for="ortu_profesi" class="form-label">Profesi Orang Tua</label>
            <input type="text" class="form-control" id="ortu_profesi" name="ortu_profesi" value="{{ old('ortu_profesi') }}" required />
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
</body>
</html>
