{{-- resources/views/admin/register.blade.php --}}
@include('partials.header', ['NamaPage' => 'Registrasi Pengguna', 'isiPage' => 'Registrasi Siswa Baru'])
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />

@if (session('role') == 'admin')
  {{-- Include sidebar dari partial --}}
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
              <input type="text" name="nis" placeholder="Masukkan NIS">
              <input type="text" name="nisn" placeholder="Masukkan NISN">
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
          
          <button type="submit" class="TombolRegister TombolCongifure">Daftarkan</button>
      </form>
    </div>
  </div>

  <script>
      document.getElementById('role-select').addEventListener('change', function () {
          document.getElementById('murid-fields').style.display = this.value === 'murid' ? 'block' : 'none';
      });
  </script>
@else
  <p>Anda tidak memiliki akses ke halaman ini</p>
  <a href="/login">Login kembali disini</a>
@endif