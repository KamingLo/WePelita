@include('partials.header', ['NamaPage' => 'Registrasi Pengguna', 'isiPage' => 'Registrasi Siswa Baru'])


<form method="POST" action="{{ route('admin.register') }}">

    @csrf
    <div>
        <label>Nama:</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>NIK:</label>
        <input type="text" name="nik" required>
    </div>
    <div>
        <label>No Telp:</label>
        <input type="text" name="no_telp" required>
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>Role:</label>
        <select name="role" id="role-select" required>
            <option value="guru">Guru</option>
            <option value="admin">Admin</option>
            <option value="murid">Murid</option>
        </select>
    </div>
    
    {{-- Data tambahan untuk murid + orang tua --}}
    <div id="murid-fields" style="display:none;">
        <h4>Data Murid</h4>
        <input type="text" name="nis" placeholder="NIS">
        <input type="text" name="nisn" placeholder="NISN">
        <label>Kelas:</label>
        <select name="kelas_id">
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelasList as $kelas)
                <option value="{{ $kelas->kelas_id }}">{{ $kelas->nama_kelas }} - {{ $kelas->tahun_ajaran }}</option>
            @endforeach
        </select>

    
        <h4>Data Orang Tua</h4>
        <input type="text" name="ortu_name" placeholder="Nama Orang Tua">
        <input type="email" name="ortu_email" placeholder="Email Orang Tua">
        <input type="text" name="ortu_nik" placeholder="NIK Orang Tua">
        <input type="text" name="ortu_no_telp" placeholder="No Telp Orang Tua">
        <input type="password" name="ortu_password" placeholder="Password Orang Tua">
    </div>
    
    <button type="submit">Daftarkan</button>
    <script>
        document.getElementById('role-select').addEventListener('change', function () {
            document.getElementById('murid-fields').style.display = this.value === 'murid' ? 'block' : 'none';
        });
    </script>

@include('partials.footer')
