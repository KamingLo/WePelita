<body class="font-sans text-gray-700 m-0 p-0 overflow-x-hidden">
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

        <div id="main-content" class="p-5 md:p-8 lg:p-8 xl:p-8 flex flex-col items-center min-h-screen transition-all duration-400 ease-in-out">
            <h1 class="w-full text-gray-800 mb-5 text-2xl font-semibold relative pb-2 text-left
                       before:content-[''] before:absolute before:left-0 before:bottom-0 before:h-1 before:w-full before:bg-blue-600">
                Data Profil
            </h1>
            <div class="flex flex-col md:flex-row justify-center w-full h-auto md:h-[calc(100vh-150px)] gap-5 box-border">
                <div class="flex-none w-full xl:max-w-4xl bg-white rounded-lg shadow-md overflow-y-auto">
                    <div class="p-5">
                        <div class="flex items-center gap-2">
                            <div class="w-full">
                                <div class="w-full">
                                    @if(session('success'))
                                    <div class="p-4 rounded-lg mb-5 text-center font-medium
                                                bg-green-100 text-green-700 border border-green-300 max-w-md text-left text-sm mx-auto">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('postingan.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="delete_avatar" id="delete_avatar" value="0">
                            <div class="mb-8 p-5 bg-white rounded-lg shadow-sm">
                                <h3 class="m-0 mb-5 pb-2 border-b-2 border-gray-200 text-gray-700 text-lg font-semibold">Informasi Akun</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="flex flex-col gap-4">
                                        <div class="mb-4">
                                            <label for="email" class="block mb-2 font-medium text-gray-800 text-sm">Email:</label>
                                            <div class="relative">
                                                <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-md text-sm transition-all duration-300
                                                           focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200 pr-10"
                                                       value="{{ old('email', auth()->user()->email) }}" placeholder="Masukkan email" required>
                                                <button type="button" id="hapusEmail" class="absolute right-3 top-1/2 -translate-y-1/2 bg-none border-none text-gray-400 cursor-pointer text-lg p-1">
                                                    <i class='bx bx-x'></i>
                                                </button>
                                            </div>
                                            @error('email')
                                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="password" class="block mb-2 font-medium text-gray-800 text-sm">Kata Sandi (kosongkan jika tidak diubah):</label>
                                            <div class="relative">
                                                <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-md text-sm transition-all duration-300
                                                           focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200 pr-10"
                                                       placeholder="Masukkan kata sandi baru">
                                                <button type="button" id="hapusKataSandi" class="absolute right-3 top-1/2 -translate-y-1/2 bg-none border-none text-gray-400 cursor-pointer text-lg p-1">
                                                    <i class='bx bx-x'></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="password_confirmation" class="block mb-2 font-medium text-gray-800 text-sm">Konfirmasi Kata Sandi:</label>
                                            <div class="relative">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-3 border border-gray-300 rounded-md text-sm transition-all duration-300
                                                           focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200 pr-10"
                                                       placeholder="Konfirmasi kata sandi baru">
                                                <button type="button" id="hapusKataSandiKonfirmasi" class="absolute right-3 top-1/2 -translate-y-1/2 bg-none border-none text-gray-400 cursor-pointer text-lg p-1">
                                                    <i class='bx bx-x'></i>
                                                </button>
                                            </div>
                                            @error('password_confirmation')
                                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-4">
                                        <div class="mb-4">
                                            <label for="avatar" class="block mb-2 font-medium text-gray-800 text-sm">Avatar:</label>
                                            <div class="flex flex-col items-center gap-5">
                                                <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-blue-600 bg-gray-50 flex items-center justify-center">
                                                    @if(auth()->user()->avatar && file_exists(public_path('storage/file/' . auth()->user()->avatar)))
                                                        <img id="pratinjauAvatar" src="{{ asset('storage/file/' . auth()->user()->avatar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        @if(auth()->user()->admin)
                                                            <div class="text-3xl font-semibold text-blue-600 uppercase">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                                                        @elseif(auth()->user()->guru)
                                                            <div class="text-3xl font-semibold text-blue-600 uppercase">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                                                        @elseif(auth()->user()->murid)
                                                            <div class="text-3xl font-semibold text-blue-600 uppercase">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                                                        @elseif(auth()->user()->orangTua)
                                                            <div class="text-3xl font-semibold text-blue-600 uppercase">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="relative w-full">
                                                    <input type="file" name="avatar" id="avatar" class="w-full p-3 border border-gray-300 rounded-md text-sm transition-all duration-300
                                                               focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200 pr-10"
                                                           accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml">
                                                    <button type="button" id="hapusAvatar" class="absolute right-3 top-1/2 -translate-y-1/2 bg-none border-none text-gray-400 cursor-pointer text-lg p-1">
                                                        <i class='bx bx-x'></i>
                                                    </button>
                                                </div>
                                                <button type="button" id="hapusFoto" class="p-2 px-5 bg-red-600 text-white border-none rounded-md text-sm font-medium cursor-pointer transition-all duration-300
                                                            w-full max-w-[150px] text-center flex items-center justify-center gap-2 hover:bg-red-700 hover:scale-105 hover:shadow-lg">
                                                    Hapus Foto <i class='bx bxs-trash'></i>
                                                </button>
                                            </div>
                                            @error('avatar')
                                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8 p-5 bg-white rounded-lg shadow-sm">
                                <h3 class="m-0 mb-5 pb-2 border-b-2 border-gray-200 text-gray-700 text-lg font-semibold">Informasi Personal</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="flex flex-col gap-4">
                                        <div class="mb-4">
                                            <label class="block mb-2 font-medium text-gray-800 text-sm">Nama:</label>
                                            <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->name }}</div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 font-medium text-gray-800 text-sm">Jenis Kelamin:</label>
                                            <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->jenis_kelamin }}</div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 font-medium text-gray-800 text-sm">Tempat Lahir:</label>
                                            <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->tempat_lahir }}</div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 font-medium text-gray-800 text-sm">No. Telepon:</label>
                                            <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->no_telp }}</div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-4">
                                        <div class="mb-4">
                                            <label class="block mb-2 font-medium text-gray-800 text-sm">Alamat:</label>
                                            <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->alamat }}</div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 font-medium text-gray-800 text-sm">Tanggal Lahir:</label>
                                            <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ \Carbon\Carbon::parse(auth()->user()->tanggal_lahir)->format('d-m-Y') }}</div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 font-medium text-gray-800 text-sm">Pendidikan:</label>
                                            <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->pendidikan }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(auth()->user()->admin || auth()->user()->guru || auth()->user()->murid || auth()->user()->orangTua)
                            <div class="mb-8 p-5 bg-white rounded-lg shadow-sm">
                                <h3 class="m-0 mb-5 pb-2 border-b-2 border-gray-200 text-gray-700 text-lg font-semibold">Informasi Peran</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="flex flex-col gap-4">
                                        @if(auth()->user()->admin)
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">Peran:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">Admin</div>
                                            </div>
                                        @elseif(auth()->user()->guru)
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">Peran:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">Guru</div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">Gelar:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->guru->gelar ?? '-' }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">NUPTK:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->guru->nuptk ?? '-' }}</div>
                                            </div>
                                        @elseif(auth()->user()->murid)
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">Peran:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">Murid</div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">NIS:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->murid->nis ?? '-' }}</div>
                                            </div>
                                        @elseif(auth()->user()->orangTua)
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">Peran:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">Orang Tua</div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex flex-col gap-4">
                                        @if(auth()->user()->guru)
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">Status Menikah:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->guru->statusMenikah ?? '-' }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">Status Kerja:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->guru->statusKerja ?? '-' }}</div>
                                            </div>
                                        @elseif(auth()->user()->murid)
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">Asal Sekolah:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->murid->asal_sekolah ?? '-' }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">NISN:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->murid->nisn ?? '-' }}</div>
                                            </div>
                                        @elseif(auth()->user()->orangTua)
                                            <div class="mb-4">
                                                <label class="block mb-2 font-medium text-gray-800 text-sm">Profesi:</label>
                                                <div class="w-full p-3 bg-gray-50 border border-gray-300 rounded-md text-gray-700 text-sm">{{ auth()->user()->orangTua->profesi ?? '-' }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="flex flex-col md:flex-row justify-center gap-5 mt-5">
                                <button type="submit" class="w-full md:w-auto p-3 px-8 bg-blue-600 text-white border-none rounded-md text-base font-medium cursor-pointer transition-all duration-300 min-w-[200px] hover:bg-blue-700 hover:scale-105 hover:shadow-lg">
                                    Update Profil
                                </button>
                                <a href="{{ auth()->user()->admin ? route('admin.dashboard') : (auth()->user()->guru ? route('guru.dashboard') : (auth()->user()->murid ? route('murid.dashboard') : route('orangtua.dashboard'))) }}"
                                   class="w-full md:w-auto p-3 px-8 bg-gray-500 text-white border-none rounded-md text-base font-medium cursor-pointer transition-all duration-300 text-center inline-block min-w-[200px] hover:bg-gray-600 hover:scale-105 hover:shadow-lg">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p class="text-center text-xl mt-20">Anda tidak memiliki akses ke halaman ini</p>
        <a href="/login" class="block text-center text-blue-600 hover:underline mt-4">Login kembali disini</a>
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
                        if (input.id === 'password_confirmation') {
                            input.value = '';
                        }
                    }
                });
            });

            const inputAvatar = document.getElementById('avatar');
            const pratinjauAvatar = document.getElementById('pratinjauAvatar');

            inputAvatar.addEventListener('change', function(e) {
                const file = e.target.files.length > 0 ? e.target.files.item(0) : null;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        pratinjauAvatar.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    @if(auth()->user()->avatar && file_exists(public_path('storage/file/' . auth()->user()->avatar)))
                        pratinjauAvatar.src = "{{ asset('storage/file/' . auth()->user()->avatar) }}";
                    @else
                        pratinjauAvatar.src = "{{ asset('images/profile.png') }}";
                    @endif
                }
            });

            const hapusFotoButton = document.getElementById('hapusFoto');
            const deleteAvatarInput = document.getElementById('delete_avatar');
            if (hapusFotoButton && deleteAvatarInput) {
                hapusFotoButton.addEventListener('click', function() {
                    const input = document.getElementById('avatar');
                    const pratinjau = document.getElementById('pratinjauAvatar');
                    input.value = '';
                    pratinjau.src = "{{ asset('images/profile.png') }}";
                    deleteAvatarInput.value = '1';
                });
            }
        });
    </script>
</body>