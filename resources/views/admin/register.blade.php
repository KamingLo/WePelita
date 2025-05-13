@include('admin.partials.header', ['NamaPage' => 'Registrasi Pengguna'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/register.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    @if (session('role') == 'admin')
    <div class="ContainerRegister">
        <h1>Registrasi Pengguna Baru</h1>

        <div class="LayoutRegisterForm">
            <h2>Register User</h2>
            
            @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif
            
            <form method="POST" action="{{ route('admin.register') }}">
                @csrf
                <div class="FormFor">
                    <label for="name">Nama:</label>
                    <input type="text" name="name" id="name" class="form-control" required placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                    @error('name')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Masukkan email" value="{{ old('email') }}">
                    @error('email')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="no_telp">No Telp:</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" required placeholder="Masukkan nomor telepon" value="{{ old('no_telp') }}">
                    @error('no_telp')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan password" value="{{ old('password') }}">
                    @error('password')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="alamat">alamat:</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" required placeholder="Masukkan alamat" value="{{ old('alamat') }}">
                    @error('alamat')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    @error('jenis_kelamin')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="tanggal_lahir">Tanggal lahir:</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required placeholder="Masukkan tanggal lahir" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="tempat_lahir">Tempat Lahir:</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}">
                    @error('tanggal_lahir')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="pendidikan">Pendidikan:</label>
                    <input type="text" name="pendidikan" id="pendidikan" class="form-control" required placeholder="Masukkan pendidikan terakhir" value="{{ old('tempat_lahir') }}">
                    @error('tanggal_lahir')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="role-select">Role:</label>
                    <select name="role" id="role-select" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Role --</option>
                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="murid" {{ old('role') == 'murid' ? 'selected' : '' }}>Murid</option>
                    </select>
                    @error('role')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="DisplayDataTable" id="murid-fields" style="display:none;">
                    <h2>Data Murid</h2>
                    <div class="FormFor">
                      <label for="nis">NIS:</label>
                      <input type="text" name="nis" id="nis" class="form-control" placeholder="Masukkan NIS" value="{{ old('nis') }}">
                    </div>
                    
                    <div class="FormFor">
                      <label for="nisn">NISN:</label>
                      <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukkan NISN" value="{{ old('nisn') }}">
                    </div>

                    <div class="FormFor">
                      <label for="asal_sekolah">Asal Sekolah:</label>
                      <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" placeholder="Masukkan Asal Sekolah" value="{{ old('asal_sekolah') }}">
                    </div>
                    
                    <div class="FormFor">
                      <label for="kelas_id">Kelas:</label>
                      <select name="kelas_id" id="kelas_id" class="form-control">
                          <option value="">-- Pilih Kelas --</option>
                          @foreach ($kelasList as $kelas)
                              <option value="{{ $kelas->kelas_id }}" {{ old('kelas_id') == $kelas->kelas_id ? 'selected' : '' }}>{{ $kelas->nama_kelas }} - {{ $kelas->tahun_ajaran }}</option>
                          @endforeach
                      </select>
                    </div>

                    <h5>Data Orang Tua</h5>
                    <div class="parent-data-container">
                      <div class="FormFor">
                        <label for="ortu_name">Nama Orang Tua:</label>
                        <input type="text" name="ortu_name" id="ortu_name" class="form-control" placeholder="Nama Orang Tua" value="{{ old('ortu_name') }}">
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_email">Email Orang Tua:</label>
                        <input type="email" name="ortu_email" id="ortu_email" class="form-control" placeholder="Email Orang Tua" value="{{ old('ortu_email') }}">
                      </div>
                      
                      <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                      
                      <div class="FormFor">
                        <label for="ortu_tanggal_lahir">Tanggal lahir orang tua:</label>
                        <input type="date" name="ortu_tanggal_lahir" id="ortu_tanggal_lahir" class="form-control" placeholder="Tanggal lahir orang tua" value="{{ old('ortu_tanggal_lahir') }}">
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_tempat_lahir">Tempat lahir orang tua:</label>
                        <input type="text" name="ortu_tempat_lahir" id="ortu_tempat_lahir" class="form-control" placeholder="Tempat lahir orang tua" value="{{ old('ortu_tempat_lahir') }}">
                      </div>

                      <div class="FormFor">
                        <label for="ortu_pendidikan">Pendidikan terakhir orang tua:</label>
                        <input type="text" name="ortu_pendidikan" id="ortu_pendidikan" class="form-control" placeholder="Pendidikan terakhir orang tua" value="{{ old('ortu_pendidikan') }}">
                      </div>

                      <div class="FormFor">
                        <label for="ortu_profesi">Profesi orang tua:</label>
                        <input type="text" name="ortu_profesi" id="ortu_profesi" class="form-control" placeholder="profesi orang tua" value="{{ old('ortu_profesi') }}">
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_no_telp">No Telp Orang Tua:</label>
                        <input type="text" name="ortu_no_telp" id="ortu_no_telp" class="form-control" placeholder="No Telp Orang Tua" value="{{ old('ortu_no_telp') }}">
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_password">Password Orang Tua:</label>
                        <input type="password" name="ortu_password" id="ortu_password" class="form-control" placeholder="Password Orang Tua" value="{{ old('ortu_password') }}">
                      </div>
                    </div>
                </div>

                <div class="DisplayDataTable" id="guru-fields" style="display:none;">
                    <h2>Data Guru</h2>
                    <div class="FormFor">
                      <label for="nis">NIS:</label>
                      <input type="text" name="nis" id="nis" class="form-control" placeholder="Masukkan NIS" value="{{ old('nis') }}">
                    </div>
                    
                    <div class="FormFor">
                      <label for="nisn">NISN:</label>
                      <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukkan NISN" value="{{ old('nisn') }}">
                    </div>
                </div>
                
                <button type="submit" class="TombolOJT TambahRegister">Daftarkan</button>
            </form>
        </div>
    </div>

    <script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role-select');
    const muridFields = document.getElementById('murid-fields');
    const guruFields = document.getElementById('guru-fields'); // tambahkan ini di form nanti

    function toggleFields() {
        const role = roleSelect.value;
        muridFields.style.display = role === 'murid' ? 'block' : 'none';
        guruFields.style.display = role === 'guru' ? 'block' : 'none';
    }

    roleSelect.addEventListener('change', toggleFields);
    toggleFields(); // jalan saat pertama kali halaman dibuka
});
</script>


    </script>

    @else
      <p>Anda tidak memiliki akses ke halaman ini</p>
      <a href="/login">Login kembali disini</a>
    @endif
</body>
