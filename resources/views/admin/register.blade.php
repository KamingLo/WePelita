@include('partials.header', ['NamaPage' => 'Registrasi Pengguna', 'isiPage' => 'Registrasi Siswa Baru'])
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@include('partials.sidebar')
@if (session('role') == 'admin')

  <div class="ContainerNewRegister">
    <h1>Registrasi Pengguna</h1>
    
    <div class="LayoutNewRegister">
        <h2>Daftarkan Pengguna Baru</h2>

        <div class="form-container">
            <div class="form-left">
                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pilih Role</label><br>
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

                    <div id="main-fields">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input class="form-control" type="text" name="name" required placeholder="Masukkan nama lengkap">
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" required placeholder="Masukkan email">
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input class="form-control" type="text" name="nik" required placeholder="Masukkan NIK">
                            @error('nik')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telp</label>
                            <input class="form-control" type="text" name="no_telp" required placeholder="Masukkan nomor telepon">
                            @error('no_telp')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" name="password" required placeholder="Masukkan password">
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="InfoSubmit">
                        <button type="submit" class="btn btn-primary">Daftarkan</button>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            
            <div class="form-right">
                <div class="preview-header">
                    <div class="preview-title">Data Tambahan</div>
                    <div class="preview-subtitle">Informasi Detail Murid</div>
                </div>
                <div id="student-detail-container" class="student-detail-container">
                    <div id="murid-fields" style="display:none;">
                        <div class="mb-3">
                            <h4>Data Murid</h4>
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input class="form-control" type="text" name="nis" placeholder="Masukkan NIS">
                            </div>
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input class="form-control" type="text" name="nisn" placeholder="Masukkan NISN">
                            </div>
                            <div class="mb-3">
                                <label for="kelas_id" class="form-label">Kelas</label>
                                <select name="kelas_id" class="form-control">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelasList as $kelas)
                                        <option value="{{ $kelas->kelas_id }}">{{ $kelas->nama_kelas }} - {{ $kelas->tahun_ajaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h4>Data Orang Tua</h4>
                            <div class="mb-3">
                                <label for="ortu_name" class="form-label">Nama Orang Tua</label>
                                <input class="form-control" type="text" name="ortu_name" placeholder="Nama Orang Tua">
                            </div>
                            <div class="mb-3">
                                <label for="ortu_email" class="form-label">Email Orang Tua</label>
                                <input class="form-control" type="email" name="ortu_email" placeholder="Email Orang Tua">
                            </div>
                            <div class="mb-3">
                                <label for="ortu_nik" class="form-label">NIK Orang Tua</label>
                                <input class="form-control" type="text" name="ortu_nik" placeholder="NIK Orang Tua">
                            </div>
                            <div class="mb-3">
                                <label for="ortu_no_telp" class="form-label">No Telp Orang Tua</label>
                                <input class="form-control" type="text" name="ortu_no_telp" placeholder="No Telp Orang Tua">
                            </div>
                            <div class="mb-3">
                                <label for="ortu_password" class="form-label">Password Orang Tua</label>
                                <input class="form-control" type="password" name="ortu_password" placeholder="Password Orang Tua">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Enhanced registration form interaction
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role-select');
    const muridFields = document.getElementById('murid-fields');
    const formRight = document.querySelector('.form-right');
    const layoutNewRegister = document.querySelector('.LayoutNewRegister');
    const formContainer = document.querySelector('.form-container');
    const formLeft = document.querySelector('.form-left');

    roleSelect.addEventListener('change', function () {
        const isMurid = this.value === 'murid';
        
        if (isMurid) {
            // Prevent layout shift
            formLeft.style.width = `${formLeft.offsetWidth}px`;
            
            muridFields.style.display = 'block';
            
            // Add classes for expansion
            formRight.classList.add('preview-active');
            formContainer.classList.add('preview-active');
            layoutNewRegister.classList.add('preview-active');
        } else {
            // Reset width when not murid
            formLeft.style.width = '';
            
            muridFields.style.display = 'none';
            
            // Remove expansion classes
            formRight.classList.remove('preview-active');
            formContainer.classList.remove('preview-active');
            layoutNewRegister.classList.remove('preview-active');
        }
    });
});
</script>

@else
  <p>Anda tidak memiliki akses ke halaman ini</p>
  <a href="/login">Login kembali disini</a>
@endif