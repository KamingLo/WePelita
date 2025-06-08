<link rel="stylesheet" href="{{ asset('css/AdminCSS/ProfileUser.css') }}" />

<body>
    @if (auth()->check())
        @if (auth()->user()->admin)
            @include('admin.partials.header')
            @include('admin.partials.sidebar')
        @elseif (auth()->user()->guru)
            @include('guru.partials.header')
            @include('guru.partials.sidebar')
        @elseif (auth()->user()->murid)
            @include('murid.partials.header')
            @include('murid.partials.sidebar')
        @elseif (auth()->user()->orangTua)
            @include('orangtua.partials.header')
            @include('orangtua.partials.sidebar')
        @endif
    
        <div class="KontainerUtamaProfilPengguna">
            <h1>Data Profil</h1>
            <div class="BagianFormulirProfil">
                <div class="KotakRegistrasi">
                    <div class="TataLetakFormulir">
                        <div class="NotifikasiFormulirProfil">
                            <div class="KepalaRegistrasi">
                                <h2>Data Profil</h2>
                                <div class="PesanKhususBerhasil">
                                    @if(session('success'))
                                    <div class="TampilanPesan PesanBerhasil">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('postingan.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="BagianProfil">
                                <h3 class="JudulBagian">Informasi Akun</h3>
                                <div class="KisiProfil">
                                    <div class="KolomProfilInfoAkun">
                                        <div class="IsiData">
                                            <label for="email">Email:</label>
                                            <div style="position: relative;">
                                                <input type="email" name="email" id="email" class="TampilanIsiData" value="{{ old('email', auth()->user()->email) }}" placeholder="Masukkan email" style="padding-right: 40px;" required>
                                                <button type="button" id="hapusEmail" class="TombolHapus">
                                                    <i class='bx bx-x'></i>
                                                </button>
                                            </div>
                                            @error('email')
                                                <span class="PesanError">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="IsiData">
                                            <label for="password">Kata Sandi (kosongkan jika tidak diubah):</label>
                                            <div style="position: relative;">
                                                <input type="text" name="password" id="password" class="TampilanIsiData" placeholder="Masukkan kata sandi baru" style="padding-right: 40px;">
                                                <button type="button" id="hapusKataSandi" class="TombolHapus">
                                                    <i class='bx bx-x'></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <span class="PesanError">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="KolomProfilAvatar">
                                        <div class="IsiData">
                                            <label for="avatar">Avatar:</label>
                                            <div class="KontainerAvatar">
                                            <div class="KontainerAvatar">
                                                <div class="PratinjauAvatar">
                                                    @if(auth()->user()->avatar && file_exists(public_path('storage/file/' . auth()->user()->avatar)))
                                                        <img id="pratinjauAvatar" src="{{ asset('storage/file/' . auth()->user()->avatar) }}">
                                                    @else
                                                        <img id="pratinjauAvatar" src="{{ asset('images/profile.png') }}">
                                                    @endif
                                                </div>
                                                <div style="position: relative;">
                                                    <input type="file" name="avatar" id="avatar" class="TampilanIsiData" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml" style="padding-right: 40px;">
                                                    <button type="button" id="hapusAvatar" class="TombolHapus">
                                                        <i class='bx bx-x'></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @error('avatar')
                                                <span class="PesanError">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="BagianProfil">
                                <h3 class="JudulBagian">Informasi Personal</h3>
                                <div class="KisiProfil">
                                    <div class="KolomProfil">
                                        <div class="IsiData">
                                            <label>Nama:</label>
                                            <div class="TampilanIsiData readonly">{{ auth()->user()->name }}</div>
                                        </div>
                                        <div class="IsiData">
                                            <label>Jenis Kelamin:</label>
                                            <div class="TampilanIsiData readonly">{{ auth()->user()->jenis_kelamin }}</div>
                                        </div>
                                        <div class="IsiData">
                                            <label>Tempat Lahir:</label>
                                            <div class="TampilanIsiData readonly">{{ auth()->user()->tempat_lahir }}</div>
                                        </div>
                                        <div class="IsiData">
                                            <label>No. Telepon:</label>
                                            <div class="TampilanIsiData readonly">{{ auth()->user()->no_telp }}</div>
                                        </div>
                                    </div>

                                    <div class="KolomProfil">
                                        <div class="IsiData">
                                            <label>Alamat:</label>
                                            <div class="TampilanIsiData readonly">{{ auth()->user()->alamat }}</div>
                                        </div>
                                        <div class="IsiData">
                                            <label>Tanggal Lahir:</label>
                                            <div class="TampilanIsiData readonly">{{ \Carbon\Carbon::parse(auth()->user()->tanggal_lahir)->format('d-m-Y') }}</div>
                                        </div>
                                        <div class="IsiData">
                                            <label>Pendidikan:</label>
                                            <div class="TampilanIsiData readonly">{{ auth()->user()->pendidikan }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(auth()->user()->admin || auth()->user()->guru || auth()->user()->murid || auth()->user()->orangTua)
                            <div class="BagianProfil">
                                <h3 class="JudulBagian">Informasi Peran</h3>
                                <div class="KisiProfil">
                                    <div class="KolomProfil">
                                        @if(auth()->user()->admin)
                                            <div class="IsiData">
                                                <label>Peran:</label>
                                                <div class="TampilanIsiData readonly">Admin</div>
                                            </div>
                                        @elseif(auth()->user()->guru)
                                            <div class="IsiData">
                                                <label>Peran:</label>
                                                <div class="TampilanIsiData readonly">Guru</div>
                                            </div>
                                            <div class="IsiData">
                                                <label>Gelar:</label>
                                                <div class="TampilanIsiData readonly">{{ auth()->user()->guru->gelar }}</div>
                                            </div>
                                            <div class="IsiData">
                                                <label>NUPTK:</label>
                                                <div class="TampilanIsiData readonly">{{ auth()->user()->guru->nuptk }}</div>
                                            </div>
                                        @elseif(auth()->user()->murid)
                                            <div class="IsiData">
                                                <label>Peran:</label>
                                                <div class="TampilanIsiData readonly">Murid</div>
                                            </div>
                                            <div class="IsiData">
                                                <label>NIS:</label>
                                                <div class="TampilanIsiData readonly">{{ auth()->user()->murid->nis }}</div>
                                            </div>
                                        @elseif(auth()->user()->orangTua)
                                            <div class="IsiData">
                                                <label>Peran:</label>
                                                <div class="TampilanIsiData readonly">Orang Tua</div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="KolomProfil">
                                        @if(auth()->user()->guru)
                                            <div class="IsiData">
                                                <label>Status Menikah:</label>
                                                <div class="TampilanIsiData readonly">{{ auth()->user()->guru->statusMenikah }}</div>
                                            </div>
                                            <div class="IsiData">
                                                <label>Status Kerja:</label>
                                                <div class="TampilanIsiData readonly">{{ auth()->user()->guru->statusKerja }}</div>
                                            </div>
                                        @elseif(auth()->user()->murid)
                                            <div class="IsiData">
                                                <label>Asal Sekolah:</label>
                                                <div class="TampilanIsiData readonly">{{ auth()->user()->murid->asal_sekolah }}</div>
                                            </div>
                                            <div class="IsiData">
                                                <label>NISN:</label>
                                                <div class="TampilanIsiData readonly">{{ auth()->user()->murid->nisn }}</div>
                                            </div>
                                        @elseif(auth()->user()->orangTua)
                                            <div class="IsiData">
                                                <label>Profesi:</label>
                                                <div class="TampilanIsiData readonly">{{ auth()->user()->orangTua->profesi }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="KontainerTombol">
                                <button type="submit" class="TombolTambah">Update Profil</button>
                                <a href="{{ auth()->user()->admin ? route('admin.dashboard') : (auth()->user()->guru ? route('guru.dashboard') : (auth()->user()->murid ? route('murid.dashboard') : route('orangtua.dashboard'))) }}" class="TombolBatal">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>Anda tidak memiliki akses ke halaman ini</p>
        <a href="/login">Login kembali disini</a>
    @endif

    <script src="{{ asset('js/CssAdmin.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const tombolHapus = document.querySelectorAll('.TombolHapus');
            tombolHapus.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    if (input.tagName === 'INPUT' || input.tagName === 'SELECT') {
                        input.value = '';
                        if (input.id === 'avatar') {
                            const pratinjau = document.getElementById('pratinjauAvatar');
                            pratinjau.src = "{{ asset('images/profile.png') }}";
                        }
                    }
                });
            });

            const inputAvatar = document.getElementById('avatar');
            const pratinjauAvatar = document.getElementById('pratinjauAvatar');

            inputAvatar.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        pratinjauAvatar.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>