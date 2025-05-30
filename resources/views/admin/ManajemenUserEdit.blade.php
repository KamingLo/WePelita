@include('admin.partials.header') 
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenUser.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    @if (session('role') == 'admin')
    <div class="ContainerUtamaManajemenUserEdit">
        <h1>Edit Pengguna</h1>
        <div class="SplitFormMuEdit">
            <div class="ReisterUser">
                <div class="ContainerRegister">
                    <div class="LayoutRegisterForm">
                        <div class="NotifikasiMUFormRegUser">
                            <div class="HeaderRegisUser">
                                <h2>Edit Data {{ ucfirst($role) }}</h2>
                                <div class="KhususPsnBerhasil">
                                    @if(session('success'))
                                    <div class="UiPsnDis PsnBerhasil">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('admin.user.update', $id) }}">
                            @csrf
                            @method('PUT')

                            @php
                                $profile = $role === 'murid' ? $user->murid->profile : $user->profile;
                            @endphp

                            <input type="hidden" name="role" value="{{ $role }}">

                            <div class="IsiData">
                                <label for="name">Nama:</label>
                                <div style="position: relative;">
                                    <input type="text" name="name" id="name" class="TampilanIsiData" value="{{ old('name', $profile->name ?? '') }}" placeholder="Masukkan nama lengkap" style="padding-right: 40px;" required>
                                    <button type="button" id="clearName" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('name')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="IsiData">
                                <label for="email">Email:</label>
                                <div style="position: relative;">
                                    <input type="email" name="email" id="email" class="TampilanIsiData" value="{{ old('email', $profile->email ?? '') }}" placeholder="Masukkan email" style="padding-right: 40px;" required>
                                    <button type="button" id="clearEmail" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('email')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="IsiData">
                                <label for="alamat">Alamat:</label>
                                <div style="position: relative;">
                                    <input type="text" name="alamat" id="alamat" class="TampilanIsiData" value="{{ old('alamat', $profile->alamat ?? '') }}" placeholder="Masukkan alamat" style="padding-right: 40px;" required>
                                    <button type="button" id="clearAlamat" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('alamat')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="IsiData">
                                <label for="jenis_kelamin">Jenis kelamin:</label>
                                <div style="position: relative;">
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="TampilanIsiData" style="padding-right: 40px;" required>
                                        <option value="" disabled {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <button type="button" id="clearJenisKelamin" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('jenis_kelamin')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="IsiData">
                                <label for="tanggal_lahir">Tanggal lahir:</label>
                                <div style="position: relative;">
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="TampilanIsiData" value="{{ old('tanggal_lahir', $profile->tanggal_lahir ?? '') }}" placeholder="Masukkan tanggal lahir" style="padding-right: 40px;" required>
                                    <button type="button" id="clearTanggalLahir" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('tanggal_lahir')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="IsiData">
                                <label for="tempat_lahir">Tempat Lahir:</label>
                                <div style="position: relative;">
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="TampilanIsiData" value="{{ old('tempat_lahir', $profile->tempat_lahir ?? '') }}" placeholder="Masukkan tempat lahir" style="padding-right: 40px;" required>
                                    <button type="button" id="clearTempatLahir" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('tempat_lahir')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="IsiData">
                                <label for="pendidikan">Pendidikan terakhir:</label>
                                <div style="position: relative;">
                                    <select name="pendidikan" id="pendidikan" class="TampilanIsiData" style="padding-right: 40px;" required>
                                        <option value="" disabled {{ old('pendidikan', $profile->pendidikan ?? '') ? '' : 'selected' }}>-- Pilih Pendidikan Terakhir --</option>
                                        <option value="SD atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'SD atau Setaranya' ? 'selected' : '' }}>SD atau setaranya</option>
                                        <option value="SMP atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'SMP atau Setaranya' ? 'selected' : '' }}>SMP atau Setaranya</option>
                                        <option value="SMA atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'SMA atau Setaranya' ? 'selected' : '' }}>SMA atau Setaranya</option>
                                        <option value="S1 atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'S1 atau Setaranya' ? 'selected' : '' }}>S1 atau Setaranya</option>
                                        <option value="S2 atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'S2 atau Setaranya' ? 'selected' : '' }}>S2 atau Setaranya</option>
                                        <option value="S3 atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'S3 atau Setaranya' ? 'selected' : '' }}>S3 atau Setaranya</option>
                                    </select>
                                    <button type="button" id="clearPendidikan" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('pendidikan')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="IsiData">
                                <label for="no_telp">No Telp:</label>
                                <div style="position: relative;">
                                    <input type="text" name="no_telp" id="no_telp" class="TampilanIsiData NomorOnly" value="{{ old('no_telp', $profile->no_telp ?? '') }}" placeholder="Masukkan nomor telepon" style="padding-right: 40px;" required>
                                    <button type="button" id="clearNoTelp" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('no_telp')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="IsiData">
                                <label for="password">Password (kosongkan jika tidak diubah):</label>
                                <div style="position: relative;">
                                    <input type="password" name="password" id="password" class="TampilanIsiData" placeholder="Masukkan password" style="padding-right: 40px;">
                                    <button type="button" id="clearPassword" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($role === 'murid')
                                <div class="DisplayDataTable" id="FormUntukMurid">
                                    <h2>Data Murid</h2>
                                    
                                    <div class="IsiData">
                                        <label for="asal_sekolah">Asal Sekolah:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="asal_sekolah" id="asal_sekolah" class="TampilanIsiData" value="{{ old('asal_sekolah', $user->murid->asal_sekolah ?? '') }}" placeholder="Masukkan asal sekolah" style="padding-right: 40px;" required>
                                            <button type="button" id="clearAsalSekolah" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('asal_sekolah')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="IsiData">
                                        <label for="nis">NIS:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="nis" id="nis" class="TampilanIsiData" value="{{ old('nis', $user->murid->nis ?? '') }}" placeholder="Masukkan NIS" style="padding-right: 40px;" required>
                                            <button type="button" id="clearNis" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('nis')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="IsiData">
                                        <label for="nisn">NISN:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="nisn" id="nisn" class="TampilanIsiData" value="{{ old('nisn', $user->murid->nisn ?? '') }}" placeholder="Masukkan NISN" style="padding-right: 40px;" required>
                                            <button type="button" id="clearNisn" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('nisn')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="IsiData">
                                        <label for="kelas_tahun_id">Kelas:</label>
                                        <div style="position: relative;">
                                            <select name="kelas_tahun_id" id="kelas_tahun_id" class="TampilanIsiData" style="padding-right: 40px;" required>
                                                <option value="" disabled {{ old('kelas_tahun_id') ? '' : 'selected' }}>-- Pilih Kelas --</option>
                                                @foreach ($kelasList as $kelas)
                                                    <option value="{{ $kelas->kelas_tahun_id }}" {{ old('kelas_tahun_id', $user->murid->kelas_tahun_id ?? '') == $kelas->kelas_tahun_id ? 'selected' : '' }}>
                                                        {{ $kelas->kelas->nama_kelas }} - {{ $kelas->tahunajar->tahun_ajaran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="button" id="clearKelasId" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('kelas_tahun_id')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @elseif ($role === 'guru')
                                <div class="DisplayDataTable" id="FormUntukGuru">
                                    <h2>Data Guru</h2>
                                    
                                    <div class="IsiData">
                                        <label for="gelar">Gelar:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="gelar" id="gelar" class="TampilanIsiData" value="{{ old('gelar', $user->gelar ?? '') }}" placeholder="Masukkan gelar" style="padding-right: 40px;" required>
                                            <button type="button" id="clearGelar" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('gelar')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="IsiData">
                                        <label for="nuptk">Masukkan Nomor Unik Pendidik dan Tenaga Kependidikan:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="nuptk" id="nuptk" class="TampilanIsiData" value="{{ old('nuptk', $user->nuptk ?? '') }}" placeholder="Masukkan NUPTK" style="padding-right: 40px;" required>
                                            <button type="button" id="clearNuptk" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('nuptk')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="IsiData">
                                        <label for="statusMenikah">Status Nikah:</label>
                                        <div style="position: relative;">
                                            <select name="statusMenikah" id="statusMenikah" class="TampilanIsiData" style="padding-right: 40px;" required>
                                                <option value="" disabled {{ old('statusMenikah', $user->statusMenikah ?? '') ? '' : 'selected' }}>-- Pilih status nikah --</option>
                                                <option value="Menikah" {{ old('statusMenikah', $user->statusMenikah ?? '') === 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                                <option value="Belum Menikah" {{ old('statusMenikah', $user->statusMenikah ?? '') === 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                            </select>
                                            <button type="button" id="clearStatusMenikah" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('statusMenikah')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="IsiData">
                                        <label for="statusKerja">Status kerja:</label>
                                        <div style="position: relative;">
                                            <select name="statusKerja" id="statusKerja" class="TampilanIsiData" style="padding-right: 40px;" required>
                                                <option value="" disabled {{ old('statusKerja', $user->statusKerja ?? '') ? '' : 'selected' }}>-- Pilih status kerja --</option>
                                                <option value="Full time" {{ old('statusKerja', $user->statusKerja ?? '') === 'Full time' ? 'selected' : '' }}>Full time</option>
                                                <option value="Honorer" {{ old('statusKerja', $user->statusKerja ?? '') === 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                            </select>
                                            <button type="button" id="clearStatusKerja" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('statusKerja')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @elseif ($role === 'orang_tua')
                                <div class="DisplayDataTable">
                                    <h2>Data Orang Tua</h2>
                                    <div class="IsiData">
                                        <label for="profesi">Profesi:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="profesi" id="profesi" class="TampilanIsiData" value="{{ old('profesi', $user->profesi ?? '') }}" placeholder="Masukkan profesi" style="padding-right: 40px;" required>
                                            <button type="button" id="clearProfesi" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('profesi')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <button type="submit" class="TambahRegister">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <p>Anda tidak memiliki akses ke halaman ini</p>
        <a href="/login">Login kembali disini</a>
    @endif
</body>

<script src="{{ asset('js/CssAdmin.js') }}"></script>