@include('admin.partials.header', ['NamaPage' => 'Halaman Utama'])
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
                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama lengkap">
                    @error('name')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control"  placeholder="Masukkan email">
                    @error('email')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="alamat">Alamat:</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat">
                    @error('alamat')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="jenis_kelamin">Jenis_kelamin:</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" >
                        <option value="none" disabled selected>-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="tanggal_lahir">Tanggal lahir:</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"  placeholder="Masukkan tanggal lahir">
                    @error('tanggal_lahir')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="tempat_lahir">Tempat Lahir:</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukkan tempat lahir">
                    @error('tempat_lahir')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="pendidikan">Pendidikan :</label>
                    <input type="text" name="pendidikan" id="pendidikan" class="form-control" placeholder="Masukkan pendidikan terakhir">
                    @error('pendidikan')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="no_telp">No Telp:</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Masukkan nomor telepon">
                    @error('no_telp')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password">
                    @error('password')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="role-select">Role:</label>
                    <select name="role" id="role-select" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="guru"{{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="murid"{{ old('role') == 'murid' ? 'selected' : '' }}>Murid</option>
                    </select>
                    @error('role')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
              
              <div class="DisplayDataTable" id="murid-fields">
                    <h2>Data Murid</h2>
                    
                    <div class="FormFor">
                      <label for="asal_sekolah">Asal Sekolah:</label>
                      <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" placeholder="Masukkan Asal Sekolah">
                      @error('asal_sekolah')
                        <span class="error-message">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    <div class="FormFor">
                      <label for="nis">NIS:</label>
                      <input type="text" name="nis" id="nis" class="form-control" placeholder="Masukkan NIS">
                      @error('nis')
                        <span class="error-message">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    <div class="FormFor">
                      <label for="nisn">NISN:</label>
                      <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukkan NISN">
                      @error('nisn')
                        <span class="error-message">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    <div class="FormFor">
                      <label for="kelas_id">Kelas:</label>
                      <select name="kelas_tahun_id" id="kelas_id" class="form-control">
                          <option value="">-- Pilih Kelas --</option>
                          @foreach ($kelasList as $kelas)
                              <option value="{{ $kelas->kelas_tahun_id }}">{{ $kelas->kelas->nama_kelas }} - {{ $kelas->tahunajar->tahun_ajaran }}</option>
                          @endforeach
                      </select>
                      @error('kelas_id')
                        <span class="error-message">{{ $message }}</span>
                      @enderror
                    </div>

                    <h5>Data Wali Murid</h5>
                    <div class="parent-data-container">
                      <div class="FormFor">
                        <label for="ortu_name">Nama Wali Murid:</label>
                        <input type="text" name="ortu_name" id="ortu_name" class="form-control" placeholder="Nama wali murid">
                        @error('ortu_name')
                          <span class="error-message">{{ $message }}</span>
                        @enderror
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_email">Email Wali Murid:</label>
                        <input type="email" name="ortu_email" id="ortu_email" class="form-control" placeholder="Email wali murid">
                        @error('ortu_email')
                          <span class="error-message">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="FormFor">
                        <label for="ortu_alamat">Alamat Wali Murid:</label>
                        <input type="text" name="ortu_alamat" id="ortu_alamat" class="form-control" placeholder="Alamat wali murid">
                        @error('ortu_alamat')
                          <span class="error-message">{{ $message }}</span>
                        @enderror
                      </div>
                      
                      <div class="FormFor">
                          <label for="ortu_jenis_kelamin">Jenis Kelamin Wali Murid:</label>
                          <select name="ortu_jenis_kelamin" id="ortu_jenis_kelamin" class="form-control">
                              <option value="none" disabled selected>-- Pilih Jenis Kelamin --</option>
                              <option value="Laki-laki">Laki-laki</option>
                              <option value="Perempuan">Perempuan</option>
                          </select>
                          @error('ortu_jenis_kelamin')
                            <span class="error-message">{{ $message }}</span>
                          @enderror
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_tempat_lahir">Tempat Lahir Wali Murid:</label>
                        <input type="text" name="ortu_tempat_lahir" id="ortu_tempat_lahir" class="form-control" placeholder="Tempat lahir wali murid">
                        @error('ortu_tempat_lahir')
                          <span class="error-message">{{ $message }}</span>
                        @enderror
                      </div>
                      
                      <div class="FormFor">
                          <label for="ortu_tanggal_lahir">Tanggal lahir:</label>
                          <input type="date" name="ortu_tanggal_lahir" id="ortu_tanggal_lahir" class="form-control" placeholder="Tanggal lahir wali murid">
                          @error('ortu_tanggal_lahir')
                            <span class="error-message">{{ $message }}</span>
                          @enderror
                      </div>

                      <div class="FormFor">
                        <label for="ortu_profesi">Profesi Wali Murid:</label>
                        <input type="text" name="ortu_profesi" id="ortu_profesi" class="form-control" placeholder="Profesi wali murid">
                        @error('ortu_profesi')
                          <span class="error-message">{{ $message }}</span>
                        @enderror  
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_pendidikan">Pendidikan terakhir Wali Murid:</label>
                        <input type="text" name="ortu_pendidikan" id="ortu_pendidikan" class="form-control" placeholder="Pendidikan terakhir wali murid">
                        @error('ortu_pendidikan')
                          <span class="error-message">{{ $message }}</span>
                        @enderror  
                      </div>

                      <div class="FormFor">
                        <label for="ortu_no_telp">No Telp Wali Murid:</label>
                        <input type="text" name="ortu_no_telp" id="ortu_no_telp" class="form-control" placeholder="No Telp wali murid">
                        @error('ortu_no_telp')
                            <span class="error-message">{{ $message }}</span>
                        @enderror 
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_password">Password Wali Murid:</label>
                        <input type="password" name="ortu_password" id="ortu_password" class="form-control" placeholder="Password wali murid">
                        @error('ortu_password')
                          <span class="error-message">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                </div>

                <div class="DisplayDataTable" id="guru-fields">
                  <h2>Data Guru</h2>

                    <div class="FormFor">
                      <label for="gelar">Gelar:</label>
                      <input type="text" name="gelar" id="gelar" class="form-control" placeholder="Masukkan gelar">
                      @error('gelar')
                        <span class="error-message">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    
                    <div class="FormFor">
                      <label for="nuptk">Masukkan Nomor Unik Pendidik dan Tenaga Kependidikan:</label>
                      <input type="text" name="nuptk" id="nuptk" class="form-control" placeholder="Masukkan NUPTK">
                      @error('nuptk')
                        <span class="error-message">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    <div class="FormFor">
                      <label for="statusMenikah">Status Nikah:</label>
                      <select name="statusMenikah" id="statusMenikah" class="form-control">
                          <option value="" disable selected>-- Pilih status nikah --</option>
                              <option value="Menikah">Menikah</option>
                              <option value="Belum Menikah">Belum Menikah</option>
                      </select>
                      @error('statusMenikah')
                        <span class="error-message">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="FormFor">
                      <label for="statusKerja">Status kerja:</label>
                      <select name="statusKerja" id="statusKerja" class="form-control">
                          <option value="" disable selected>-- Pilih status kerja --</option>
                              <option value="Full time">Full time</option>
                              <option value="Honorer">Honorer</option>
                      </select>
                      @error('statusKerja')
                        <span class="error-message">{{ $message }}</span>
                      @enderror
                    </div>
                </div>

                <button type="submit" class="TombolOJT TambahRegister">Daftarkan</button>
            </form>
        </div>
    </div>

    @else
      <p>Anda tidak memiliki akses ke halaman ini</p>
      <a href="/login">Login kembali disini</a>
    @endif
</body>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role-select');
    const muridFields = document.getElementById('murid-fields');
    const guruFields = document.getElementById('guru-fields');

    function toggleFields() {
        const selectedRole = roleSelect.value;
        if (selectedRole === 'murid') {
            muridFields.style.display = 'block';
            guruFields.style.display = 'none';
        } else if (selectedRole === 'guru') {
            guruFields.style.display = 'block';
            muridFields.style.display = 'none';
        } else {
            guruFields.style.display = 'none';
            muridFields.style.display = 'none';
        }
    }

    // Hide fields on load
    toggleFields();

    // Listen for role changes
    roleSelect.addEventListener('change', toggleFields);
});
</script>
