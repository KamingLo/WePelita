@include('admin.partials.header')
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenUser.css') }}" />

<body>
    @if (session('role') == 'admin')
    <div class="ContainerUtamaManajemenUser">
        <h1>Registrasi Pengguna Baru</h1>
        <div class="SplitFormMu">
            <div class="ReisterUser">
                <div class="ContainerRegister">
                    <div class="LayoutRegisterForm">
                        <div class="NotifikasiMUFormRegUser">
                            <div class="HeaderRegisUser">
                                <h2>Register User</h2>
                                <div class="KhususPsnBerhasil">
                                    @if(session('success'))
                                    <div class="UiPsnDis PsnBerhasil">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        

                        {{-- Menampilkan pesan error validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Terjadi kesalahan:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Menampilkan pesan sukses --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Menampilkan pesan gagal --}}
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif


                        <form method="POST" action="{{ route('admin.register') }}">
                            @csrf
                            <div class="IsiData">
                                <label for="name">Nama:</label>
                                <div style="position: relative;">
                                    <input type="text" name="name" id="name" class="TampilanIsiData" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" style="padding-right: 40px;">
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
                                    <input type="email" name="email" id="email" class="TampilanIsiData" placeholder="Masukkan email" value="{{ old('email') }}" style="padding-right: 40px;">
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
                                    <input type="text" name="alamat" id="alamat" class="TampilanIsiData" placeholder="Masukkan alamat" value="{{ old('alamat') }}" style="padding-right: 40px;">
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
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="TampilanIsiData" style="padding-right: 40px;">
                                        <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="TampilanIsiData" value="{{ old('tanggal_lahir') }}" style="padding-right: 40px;">
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
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="TampilanIsiData" placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}" style="padding-right: 40px;">
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
                                    <select name="pendidikan" id="pendidikan" class="TampilanIsiData" style="padding-right: 40px;">
                                        <option value="" disabled {{ old('pendidikan') ? '' : 'selected' }}>-- Pilih Pendidikan Terakhir --</option>
                                        <option value="SD atau Setaranya" {{ old('pendidikan') == 'SD atau Setaranya' ? 'selected' : '' }}>SD atau setaranya</option>
                                        <option value="SMP atau Setaranya" {{ old('pendidikan') == 'SMP atau Setaranya' ? 'selected' : '' }}>SMP atau Setaranya</option>
                                        <option value="SMA atau Setaranya" {{ old('pendidikan') == 'SMA atau Setaranya' ? 'selected' : '' }}>SMA atau Setaranya</option>
                                        <option value="S1 atau Setaranya" {{ old('pendidikan') == 'S1 atau Setaranya' ? 'selected' : '' }}>S1 atau Setaranya</option>
                                        <option value="S2 atau Setaranya" {{ old('pendidikan') == 'S2 atau Setaranya' ? 'selected' : '' }}>S2 atau Setaranya</option>
                                        <option value="S3 atau Setaranya" {{ old('pendidikan') == 'S3 atau Setaranya' ? 'selected' : '' }}>S3 atau Setaranya</option>
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
                                    <input type="text" name="no_telp" id="no_telp" class="TampilanIsiData NomorOnly" placeholder="Masukkan nomor telepon" value="{{ old('no_telp') }}" style="padding-right: 40px;">
                                    <button type="button" id="clearNoTelp" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('no_telp')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="IsiData">
                                <label for="role-select">Role:</label>
                                <div style="position: relative;">
                                    <select name="role" id="UserUntuk" class="TampilanIsiData" style="padding-right: 40px;">
                                        <option value="" disabled selected>-- Pilih Role --</option>
                                        <option value="murid" {{ old('role') == 'murid' ? 'selected' : '' }}>Murid</option>
                                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <button type="button" id="clearRole" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('role')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            <div class="DisplayDataTable" id="FormUntukMurid" style="display: none;">
                                <h2>Data Murid</h2>
                                
                                <div class="IsiData">
                                    <label for="asal_sekolah">Asal Sekolah:</label>
                                    <div style="position: relative;">
                                        <input type="text" name="asal_sekolah" id="asal_sekolah" class="TampilanIsiData" placeholder="Masukkan asal sekolah" value="{{ old('asal_sekolah') }}" style="padding-right: 40px;">
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
                                        <input type="text" name="nis" id="nis" class="TampilanIsiData" placeholder="Masukkan NIS" value="{{ old('nis') }}" style="padding-right: 40px;">
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
                                        <input type="text" name="nisn" id="nisn" class="TampilanIsiData" placeholder="Masukkan NISN" value="{{ old('nisn') }}" style="padding-right: 40px;">
                                        <button type="button" id="clearNisn" class="HapusBar">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    </div>
                                    @error('nisn')
                                        <span class="PsnError">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="IsiData">
                                    <label for="kelas_tahun_id">Kelas Tahun:</label>
                                    <div style="position: relative;">
                                        <select name="kelas_tahun_id" id="kelas_tahun_id" class="TampilanIsiData" style="padding-right: 40px;">
                                            <option value="" disabled selected>-- Pilih Kelas --</option>
                                            @foreach ($kelasList as $kelas)
                                                <option value="{{ $kelas->kelas_tahun_id }}" {{ old('kelas_tahun_id') == $kelas->kelas_tahun_id ? 'selected' : '' }}>
                                                    {{ $kelas->kelas->nama_kelas }} - {{ $kelas->tahunajar->tahun_ajaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" id="clearKelasTahunId" class="HapusBar">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    </div>
                                    @error('kelas_tahun_id')
                                        <span class="PsnError">{{ $message }}</span>
                                    @enderror
                                </div>

                                <h5>Data Wali Murid</h5>
                                <div class="FormUntukOrtu">
                                    <div class="IsiData">
                                        <label for="ortu_name">Nama Wali Murid:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="ortu_name" id="ortu_name" class="TampilanIsiData" placeholder="Nama wali murid" value="{{ old('ortu_name') }}" style="padding-right: 40px;">
                                            <button type="button" id="clearOrtuName" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('ortu_name')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="IsiData">
                                        <label for="ortu_email">Email Wali Murid:</label>
                                        <div style="position: relative;">
                                            <input type="email" name="ortu_email" id="ortu_email" class="TampilanIsiData" placeholder="Email wali murid" value="{{ old('ortu_email') }}" style="padding-right: 40px;">
                                            <button type="button" id="clearOrtuEmail" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('ortu_email')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="IsiData">
                                        <label for="ortu_alamat">Alamat Wali Murid:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="ortu_alamat" id="ortu_alamat" class="TampilanIsiData" placeholder="Alamat wali murid" value="{{ old('ortu_alamat') }}" style="padding-right: 40px;">
                                            <button type="button" id="clearOrtuAlamat" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('ortu_alamat')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="IsiData">
                                        <label for="ortu_jenis_kelamin">Jenis Kelamin Wali Murid:</label>
                                        <div style="position: relative;">
                                            <select name="ortu_jenis_kelamin" id="ortu_jenis_kelamin" class="TampilanIsiData" style="padding-right: 40px;">
                                                <option value="" disabled {{ old('ortu_jenis_kelamin') ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                                                <option value="Laki-laki" {{ old('ortu_jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('ortu_jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            <button type="button" id="clearOrtuJenisKelamin" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('ortu_jenis_kelamin')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="IsiData">
                                        <label for="ortu_tempat_lahir">Tempat Lahir Wali Murid:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="ortu_tempat_lahir" id="ortu_tempat_lahir" class="TampilanIsiData" placeholder="Tempat lahir wali murid" value="{{ old('ortu_tempat_lahir') }}" style="padding-right: 40px;">
                                            <button type="button" id="clearOrtuTempatLahir" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('ortu_tempat_lahir')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="IsiData">
                                        <label for="ortu_tanggal_lahir">Tanggal Lahir Wali Murid:</label>
                                        <div style="position: relative;">
                                            <input type="date" name="ortu_tanggal_lahir" id="ortu_tanggal_lahir" class="TampilanIsiData" value="{{ old('ortu_tanggal_lahir') }}" style="padding-right: 40px;">
                                            <button type="button" id="clearOrtuTanggalLahir" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('ortu_tanggal_lahir')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="IsiData">
                                        <label for="ortu_profesi">Profesi Wali Murid:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="ortu_profesi" id="ortu_profesi" class="TampilanIsiData" placeholder="Profesi wali murid" value="{{ old('ortu_profesi') }}" style="padding-right: 40px;">
                                            <button type="button" id="clearOrtuProfesi" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('ortu_profesi')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror  
                                    </div>
                                    
                                    <div class="IsiData">
                                        <label for="ortu_pendidikan">Pendidikan Terakhir Wali Murid:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="ortu_pendidikan" id="ortu_pendidikan" class="TampilanIsiData" placeholder="Pendidikan terakhir wali murid" value="{{ old('ortu_pendidikan') }}" style="padding-right: 40px;">
                                            <button type="button" id="clearOrtuPendidikan" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('ortu_pendidikan')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror  
                                    </div>

                                    <div class="IsiData">
                                        <label for="ortu_no_telp">No Telp Wali Murid:</label>
                                        <div style="position: relative;">
                                            <input type="text" name="ortu_no_telp" id="ortu_no_telp" class="TampilanIsiData NomorOnly" placeholder="No Telp wali murid" value="{{ old('ortu_no_telp') }}" style="padding-right: 40px;">
                                            <button type="button" id="clearOrtuNoTelp" class="HapusBar">
                                                <i class='bx bx-x'></i>
                                            </button>
                                        </div>
                                        @error('ortu_no_telp')
                                            <span class="PsnError">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div>

                            <div class="DisplayDataTable" id="FormUntukGuru" style="display: none;">
                                <h2>Data Guru</h2>
                                <div class="IsiData">
                                    <label for="gelar">Gelar:</label>
                                    <div style="position: relative;">
                                        <input type="text" name="gelar" id="gelar" class="TampilanIsiData" placeholder="Masukkan gelar" value="{{ old('gelar') }}" style="padding-right: 40px;">
                                        <button type="button" id="clearGelar" class="HapusBar">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    </div>
                                    @error('gelar')
                                        <span class="PsnError">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="IsiData">
                                    <label for="nuptk">Nomor Unik Pendidik dan Tenaga Kependidikan:</label>
                                    <div style="position: relative;">
                                        <input type="text" name="nuptk" id="nuptk" class="TampilanIsiData" placeholder="Masukkan NUPTK" value="{{ old('nuptk') }}" style="padding-right: 40px;">
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
                                        <select name="statusMenikah" id="statusMenikah" class="TampilanIsiData" style="padding-right: 40px;">
                                            <option value="" disabled {{ old('statusMenikah') ? '' : 'selected' }}>-- Pilih Status Nikah --</option>
                                            <option value="Menikah" {{ old('statusMenikah') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                            <option value="Belum Menikah" {{ old('statusMenikah') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
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
                                    <label for="statusKerja">Status Kerja:</label>
                                    <div style="position: relative;">
                                        <select name="statusKerja" id="statusKerja" class="TampilanIsiData" style="padding-right: 40px;">
                                            <option value="" disabled {{ old('statusKerja') ? '' : 'selected' }}>-- Pilih Status Kerja --</option>
                                            <option value="Full time" {{ old('statusKerja') == 'Full time' ? 'selected' : '' }}>Full time</option>
                                            <option value="Honorer" {{ old('statusKerja') == 'Honorer' ? 'selected' : '' }}>Honorer</option>
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

                            <button type="submit" class="TambahRegister">Daftarkan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="TabelDataUser">
                <div class="HeaderTabelData">
                    <form method="GET" action="{{ route('admin.ManajemenUser') }}">
                        <label for="role">Filter berdasarkan peran:</label>
                        <select name="role" id="role_select" onchange="this.form.submit()">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="murid" {{ request('role') == 'murid' ? 'selected' : '' }}>Murid</option>
                            <option value="orang_tua" {{ request('role') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                        </select>
                    </form>
                    
                    <div class="SearchBarMU">
                        <form method="GET" action="{{ route('admin.ManajemenUser') }}" class="SearchBarTabelData">
                            <div class="KotakInputSB">
                                <input type="text" placeholder="Masukan nama user" class="SearchBarInput" name="search" value="{{ request('search') }}">
                                <i class='bx bx-search'></i>
                            </div>
                            <input type="hidden" name="role" value="{{ request('role') }}">
                            <input type="hidden" name="additional_filter" value="{{ request('additional_filter') }}">
                        </form>
                    </div>
                </div>

                @php $role = request('role'); @endphp

                <div class="FormTabelDataUser">
                    @if ($role === 'admin')
                    <div class="KhususHeaderTabelUser">
                        <h3>Data Admin</h3>
                        <div class="HanyaMaginAuto">
                            <a href="{{ route('admin.downloaduser', ['role' => $role]) }}" class="TombolOJT DownloadJadwal"><i class="fa-solid fa-file-excel"></i>‎ ‎ ‎ Unduh Data {{ $role }}</a>
                        </div>
                    </div>
                        @if (isset($admins) && $admins->isNotEmpty())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->profile->name }}</td>
                                            <td>{{ $admin->profile->email }}</td>
                                            <td>{{ $admin->profile->alamat }}</td>
                                            <td>
                                                <div class="OptionManajemenTabel">
                                                    <a href="{{ route('admin.user.edit', ['id' => $admin->admin_id, 'role' => 'admin']) }}" class="Tedit">
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.user.delete', ['id' => $admin->admin_id, 'role' => 'admin']) }}" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="TombolDelete" onclick="return confirm('Yakin hapus user ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada data admin yang ditemukan.</p>
                        @endif
                    
                    @elseif ($role === 'guru')
                        <div class="HeaderGuruMU">
                            <div class="KhususHeaderTabelUser">
                                <h3>Data Guru</h3>
                                <div class="HanyaMaginAutoV2">
                                <a href="{{ route('admin.downloaduser', ['role' => $role]) }}" class="TombolOJT DownloadJadwal"><i class="fa-solid fa-file-excel"></i>‎ ‎ ‎ Unduh Data {{ $role }}</a>                                </div>
                            </div>
                            <div class="FilterHeaderGuruMu">
                                <form method="GET" action="{{ route('admin.ManajemenUser') }}" class="filter-form">
                                    <div class="ForFilterRoleOnly additional-filter">
                                        <select name="additional_filter" id="additional_filter" onchange="this.form.submit()" class="TampilanIsiData" style="padding-right: 40px; min-width: 150px;">
                                            <option value="" {{ request('additional_filter') == '' ? 'selected' : '' }}>-- Pilih Status Kerja --</option>
                                            <option value="Full time" {{ request('additional_filter') == 'Full time' ? 'selected' : '' }}>Full time</option>
                                            <option value="Honorer" {{ request('additional_filter') == 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="role" value="guru">
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                </form>
                            </div>
                        </div>
                        
                        @if (isset($gurus) && $gurus->isNotEmpty())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Nuptk</th>
                                        <th>Status Kerja</th>
                                        <th>Email</th>
                                        <th>No Telpon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gurus as $guru)
                                        <tr>
                                            <td>{{ $guru->profile->name }} {{ $guru->gelar }}</td>
                                            <td>{{ $guru->nuptk }}</td>
                                            <td>{{ $guru->statusKerja }}</td>
                                            <td>{{ $guru->profile->email }}</td>
                                            <td>{{ $guru->profile->no_telp }}</td>
                                            <td>
                                                <div class="OptionManajemenTabel">
                                                    <a href="{{ route('admin.user.edit', ['id' => $guru->guru_id, 'role' => 'guru']) }}" class="Tedit">
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.user.delete', ['id' => $guru->guru_id, 'role' => 'guru']) }}" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="TombolDelete" onclick="return confirm('Yakin hapus user ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada data guru yang ditemukan.</p>
                        @endif

                    @elseif ($role === 'murid')
                        <div class="HeaderMuridMU">
                            <div class="KhususHeaderTabelUser">
                                <h3>Data Murid</h3>
                                <div class="HanyaMaginAutoV2">
                                    <a href="{{ route('admin.downloaduser', ['role' => $role]) }}" class="TombolOJT DownloadJadwal">
                                        <i class="fa-solid fa-file-excel"></i>‎ ‎ ‎ Unduh Data {{ $role }}
                                    </a>
                                </div>
                            </div>


                                <div class="FilterHeaderMuridMu">
                                    <form method="GET" action="{{ route('admin.ManajemenUser') }}" class="filter-form">
                                        <div class="ForFilterRoleOnly additional-filter">
                                            <label for="additional_filter" class="sr-only">Filter Tambahan</label>
                                            <select name="additional_filter" id="additional_filter" onchange="this.form.submit()"
                                                class="TampilanIsiData" style="padding-right: 40px; min-width: 150px;">
                                                <option value="" {{ request('additional_filter') == '' ? 'selected' : '' }}>-- Pilih Kelas --</option>
                                                @foreach ($kelasList as $kelas)
                                                    <option value="{{ $kelas->kelas_tahun_id }}" {{ request('additional_filter') == $kelas->kelas_tahun_id ? 'selected' : '' }}>
                                                        {{ $kelas->kelas->nama_kelas }} - {{ $kelas->tahunajar->tahun_ajaran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="role" value="murid">
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    </form>
                                </div>
                            </div>
                        
                        @if (isset($muridOrangTuas) && $muridOrangTuas->isNotEmpty())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Kelas</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Semester</th>
                                        <th>NIS</th>
                                        <th>NSSN</th>
                                        <th>Nama Orang Tua</th>
                                        <th>Asal Sekolah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($muridOrangTuas as $muridOrangTua)
                                        <tr>
                                            <td>{{ $muridOrangTua->muridKelas->murid->profile->name }}</td>
                                            <td>{{ $muridOrangTua->muridKelas->murid->profile->email }}</td>
                                            <td>{{ $muridOrangTua->muridKelas->kelasTahun->kelas->nama_kelas }}</td>
                                            <td>{{ $muridOrangTua->muridKelas->kelasTahun->tahunajar->tahun_ajaran }}</td>
                                            <td>{{ $muridOrangTua->muridKelas->kelasTahun->tahunajar->semester }}</td>
                                            <td>{{ $muridOrangTua->muridKelas->murid->nis }}</td>
                                            <td>{{ $muridOrangTua->muridKelas->murid->nisn }}</td>
                                            <td>{{ $muridOrangTua->orangTua->profile->name }}</td>
                                            <td>{{ $muridOrangTua->muridKelas->murid->asal_sekolah }}</td>
                                            <td>
                                                <div class="OptionManajemenTabel">
                                                    <a href="{{ route('admin.user.edit', ['id' => $muridOrangTua->muridKelas->murid_kelas_id, 'role' => 'murid']) }}" class="Tedit">
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.user.delete', ['id' => $muridOrangTua->muridKelas->murid_kelas_id, 'role' => 'murid']) }}" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="TombolDelete" onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada data murid yang ditemukan.</p>
                        @endif

                    @elseif ($role === 'orang_tua')
                    <div class="KhususHeaderTabelUser">
                        <h3>Data Orang Tua</h3>
                        <div class="HanyaMaginAuto">
                                <a href="{{ route('admin.downloaduser', ['role' => $role]) }}" class="TombolOJT DownloadJadwal"><i class="fa-solid fa-file-excel"></i>‎ ‎ ‎ Unduh Data {{ $role }}</a>
                        </div>
                    </div>

                        @if (isset($muridOrangTuas) && $muridOrangTuas->isNotEmpty())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Profesi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($muridOrangTuas as $muridOrangTua)
                                        <tr>
                                            <td>{{ $muridOrangTua->orangTua->profile->name }}</td>
                                            <td>{{ $muridOrangTua->orangTua->profile->email }}</td>
                                            <td>{{ $muridOrangTua->orangTua->profesi }}</td>
                                            <td>
                                                <div class="OptionManajemenTabel">
                                                    <a href="{{ route('admin.user.edit', ['id' => $muridOrangTua->orangTua->orang_tua_id, 'role' => 'orang_tua']) }}" class="Tedit">
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.user.delete', ['id' => $muridOrangTua->orangTua->orang_tua_id, 'role' => 'orang_tua']) }}" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="TombolDelete" onclick="return confirm('Yakin hapus user ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada data orang tua yang ditemukan.</p>
                        @endif

                    @else
                        <p>Silakan pilih peran untuk menampilkan data user tertentu.</p>
                    @endif
                </div>
            </div>
        </div>
        </div>
        @else
            <p>Anda tidak memiliki akses ke halaman ini.</p>
            <a href="{{ route('login') }}">Login kembali di sini</a>
        @endif
    </body>
    
        <script src="{{ asset('js/CssAdmin.js') }}"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('UserUntuk');
            const formMurid = document.getElementById('FormUntukMurid');
            const formGuru = document.getElementById('FormUntukGuru');

            function toggleForms() {
                if (roleSelect.value === 'murid') {
                    formMurid.style.display = 'block';
                    formGuru.style.display = 'none';
                } else if (roleSelect.value === 'guru') {
                    formMurid.style.display = 'none';
                    formGuru.style.display = 'block';
                } else {
                    formMurid.style.display = 'none';
                    formGuru.style.display = 'none';
                }
            }

            roleSelect.addEventListener('change', toggleForms);
            toggleForms();

            document.querySelectorAll('.HapusBar').forEach(button => {
                button.addEventListener('click', () => {
                    const input = button.previousElementSibling;
                    if (input.tagName === 'INPUT' || input.tagName === 'SELECT') {
                        input.value = '';
                    }
                });
            });

            document.querySelectorAll('.NomorOnly').forEach(input => {
                input.addEventListener('input', () => {
                    input.value = input.value.replace(/[^0-9]/g, '');
                });
            });
        });
    </script>
</body>