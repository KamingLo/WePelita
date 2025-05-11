@include('partials.header', ['NamaPage' => 'Registrasi Pengguna', 'isiPage' => 'Registrasi Siswa Baru'])
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />

@if (session('role') == 'admin')
  @include('partials.sidebar')

  <div class="home">
    <div class="text">Register User</div>
    
    <div class="register-form">
      <form method="POST" action="{{ route('admin.register') }}">
          @csrf
          <div>
              <label>Nama:</label>
              <input type="text" name="name" required placeholder="Masukkan nama lengkap">
              @error('name')
                <span class="error-message">{{ $message }}</span>
              @enderror
          </div>
          <div>
              <label>Email:</label>
              <input type="email" name="email" required placeholder="Masukkan email">
              @error('email')
                <span class="error-message">{{ $message }}</span>
              @enderror
          </div>
          <div>
              <label>NIK:</label>
              <input type="text" name="nik" required placeholder="Masukkan NIK">
              @error('nik')
                <span class="error-message">{{ $message }}</span>
              @enderror
          </div>
          <div>
              <label>No Telp:</label>
              <input type="text" name="no_telp" required placeholder="Masukkan nomor telepon">
              @error('no_telp')
                <span class="error-message">{{ $message }}</span>
              @enderror
          </div>
          <div>
              <label>Password:</label>
              <input type="password" name="password" required placeholder="Masukkan password">
              @error('password')
                <span class="error-message">{{ $message }}</span>
              @enderror
          </div>

          <div>
              <label>Role:</label>
              <select name="role" id="role-select" required>
                  <option value="" disabled selected>-- Pilih Role --</option>
                  <option value="guru">Guru</option>
                  <option value="admin">Admin</option>
                  <option value="murid">Murid</option>
              </select>
              @error('role')
                <span class="error-message">{{ $message }}</span>
              @enderror
          </div>
          
          {{-- Data tambahan untuk murid + orang tua --}}
          <div id="murid-fields" style="display:none;">
              <h4>Data Murid</h4>
              <div>
                <label>NIS:</label>
                <input type="text" name="nis" placeholder="Masukkan NIS">
              </div>
              <div>
                <label>NISN:</label>
                <input type="text" name="nisn" placeholder="Masukkan NISN">
              </div>
              <div>
                <label>Kelas:</label>
                <select name="kelas_id">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas->kelas_id }}">{{ $kelas->nama_kelas }} - {{ $kelas->tahun_ajaran }}</option>
                    @endforeach
                </select>
              </div>

              <h4>Data Orang Tua</h4>
              <div>
                <label>Nama Orang Tua:</label>
                <input type="text" name="ortu_name" placeholder="Nama Orang Tua">
              </div>
              <div>
                <label>Email Orang Tua:</label>
                <input type="email" name="ortu_email" placeholder="Email Orang Tua">
              </div>
              <div>
                <label>NIK Orang Tua:</label>
                <input type="text" name="ortu_nik" placeholder="NIK Orang Tua">
              </div>
              <div>
                <label>No Telp Orang Tua:</label>
                <input type="text" name="ortu_no_telp" placeholder="No Telp Orang Tua">
              </div>
              <div>
                <label>Password Orang Tua:</label>
                <input type="password" name="ortu_password" placeholder="Password Orang Tua">
              </div>
          </div>
          
          <button type="submit" class="TombolRegister TombolCongifure">Daftarkan</button>
      </form>
    </div>
  </div>

<script>
  const roleSelect = document.getElementById('role-select');
  const muridFields = document.getElementById('murid-fields');
  const registerFormWrapper = document.querySelector('.register-form');

  roleSelect.addEventListener('change', function () {
      const isMurid = this.value === 'murid';
      muridFields.style.display = isMurid ? 'grid' : 'none';

      if (isMurid) {
          registerFormWrapper.classList.add('extra-bottom');
      } else {
          registerFormWrapper.classList.remove('extra-bottom');
      }
  });
</script>

@else
  <p>Anda tidak memiliki akses ke halaman ini</p>
  <a href="/login">Login kembali disini</a>
@endif