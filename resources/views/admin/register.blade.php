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
                    <input type="text" name="name" id="name" class="form-control" required placeholder="Masukkan nama lengkap">
                    @error('name')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Masukkan email">
                    @error('email')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="nik">NIK:</label>
                    <input type="text" name="nik" id="nik" class="form-control" required placeholder="Masukkan NIK">
                    @error('nik')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="no_telp">No Telp:</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" required placeholder="Masukkan nomor telepon">
                    @error('no_telp')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="FormFor">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan password">
                    @error('password')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="FormFor">
                    <label for="role-select">Role:</label>
                    <select name="role" id="role-select" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Role --</option>
                        <option value="guru">Guru</option>
                        <option value="admin">Admin</option>
                        <option value="murid">Murid</option>
                    </select>
                    @error('role')
                      <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="DisplayDataTable" id="murid-fields" style="display:none;">
                    <h2>Data Murid</h2>
                    <div class="FormFor">
                      <label for="nis">NIS:</label>
                      <input type="text" name="nis" id="nis" class="form-control" placeholder="Masukkan NIS">
                    </div>
                    
                    <div class="FormFor">
                      <label for="nisn">NISN:</label>
                      <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukkan NISN">
                    </div>
                    
                    <div class="FormFor">
                      <label for="kelas_id">Kelas:</label>
                      <select name="kelas_id" id="kelas_id" class="form-control">
                          <option value="">-- Pilih Kelas --</option>
                          @foreach ($kelasList as $kelas)
                              <option value="{{ $kelas->kelas_id }}">{{ $kelas->nama_kelas }} - {{ $kelas->tahun_ajaran }}</option>
                          @endforeach
                      </select>
                    </div>

                    <h5>Data Orang Tua</h5>
                    <div class="parent-data-container">
                      <div class="FormFor">
                        <label for="ortu_name">Nama Orang Tua:</label>
                        <input type="text" name="ortu_name" id="ortu_name" class="form-control" placeholder="Nama Orang Tua">
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_email">Email Orang Tua:</label>
                        <input type="email" name="ortu_email" id="ortu_email" class="form-control" placeholder="Email Orang Tua">
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_nik">NIK Orang Tua:</label>
                        <input type="text" name="ortu_nik" id="ortu_nik" class="form-control" placeholder="NIK Orang Tua">
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_no_telp">No Telp Orang Tua:</label>
                        <input type="text" name="ortu_no_telp" id="ortu_no_telp" class="form-control" placeholder="No Telp Orang Tua">
                      </div>
                      
                      <div class="FormFor">
                        <label for="ortu_password">Password Orang Tua:</label>
                        <input type="password" name="ortu_password" id="ortu_password" class="form-control" placeholder="Password Orang Tua">
                      </div>
                    </div>
                </div>
                
                <button type="submit" class="TombolOJT TambahRegister">Daftarkan</button>
            </form>
        </div>
    </div>

    <script>
      const roleSelect = document.getElementById('role-select');
      const muridFields = document.getElementById('murid-fields');

      roleSelect.addEventListener('change', function () {
          const isMurid = this.value === 'murid';
          muridFields.style.display = isMurid ? 'block' : 'none';
      });
    </script>

    @else
      <p>Anda tidak memiliki akses ke halaman ini</p>
      <a href="/login">Login kembali disini</a>
    @endif
</body>