@include('admin.partials.header')
@include('admin.partials.sidebar')

<body class="font-sans text-gray-700 m-0 p-0 overflow-x-hidden md:overflow-x-auto">
    @if (session('role') == 'admin')
    <div id="main-content" class="px-4 md:px-8 py-8 flex flex-col gap-8 transition-all duration-400 ease-in-out">
        <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-5 pb-2 relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-1 after:w-24 after:bg-blue-600">Edit Pengguna</h1>
        
        <div class="flex flex-col h-auto gap-5 justify-center lg:flex-row">
            <div class="w-full bg-white rounded-lg shadow-md overflow-y-auto p-4 lg:p-6 lg:max-w-4xl">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full">
                    <h2 class="text-lg sm:text-xl text-gray-800 mb-3 sm:mb-5 pb-2 sm:pb-3 relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-16 after:bg-blue-600">Edit Data {{ ucfirst($role) }}</h2>
                    <div>
                        @if(session('success'))
                        <div class="p-3 bg-green-100 text-green-800 border border-green-200 rounded-lg max-w-sm text-sm mb-4 sm:mb-0 lg:p-4 lg:max-w-md">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.user.update', $id) }}" class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    @csrf
                    @method('PUT')

                    @php
                        $profile = $role === 'murid' ? $user->murid->profile : $user->profile;
                    @endphp

                    <input type="hidden" name="role" value="{{ $role }}">

                    {{-- Common input fields --}}
                    <div class="mb-4">
                        <label for="name" class="block mb-2 font-medium text-gray-800 text-sm">Nama:</label>
                        <div class="relative">
                            <input type="text" name="name" id="name" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('name', $profile->name ?? '') }}" placeholder="Masukkan nama lengkap" required>
                            <button type="button" id="clearName" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-base'></i>
                            </button>
                        </div>
                        @error('name')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block mb-2 font-medium text-gray-800 text-sm">Email:</label>
                        <div class="relative">
                            <input type="email" name="email" id="email" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('email', $profile->email ?? '') }}" placeholder="Masukkan email" required>
                            <button type="button" id="clearEmail" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-base'></i>
                            </button>
                        </div>
                        @error('email')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="block mb-2 font-medium text-gray-800 text-sm">Alamat:</label>
                        <div class="relative">
                            <input type="text" name="alamat" id="alamat" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('alamat', $profile->alamat ?? '') }}" placeholder="Masukkan alamat" required>
                            <button type="button" id="clearAlamat" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-base'></i>
                            </button>
                        </div>
                        @error('alamat')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jenis_kelamin" class="block mb-2 font-medium text-gray-800 text-sm">Jenis kelamin:</label>
                        <div class="relative">
                            <select name="jenis_kelamin" id="jenis_kelamin" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 appearance-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%2712%27%20height%3D%2712%27%20fill%3D%27%23333%27%20viewBox%3D%270%200%2016%2016%27%3E%3Cpath%20d%3D%27M8%209.5a.5.5%200%2001-.354-.146l-4-4a.5.5%200%2001.708-.708L8%208.293l3.646-3.647a.5.5%200%2001.708.708l-4%204A.5.5%200%20018%209.5z%27/%3E%3C/svg%3E')] bg-no-repeat bg-[right_0.75rem_center]" required>
                                <option value="" disabled {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <button type="button" id="clearJenisKelamin" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-base'></i>
                            </button>
                        </div>
                        @error('jenis_kelamin')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_lahir" class="block mb-2 font-medium text-gray-800 text-sm">Tanggal lahir:</label>
                        <div class="relative">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('tanggal_lahir', $profile->tanggal_lahir ? \Carbon\Carbon::parse($profile->tanggal_lahir)->format('Y-m-d') : '') }}" placeholder="Masukkan tanggal lahir" required>
                        </div>
                        @error('tanggal_lahir')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tempat_lahir" class="block mb-2 font-medium text-gray-800 text-sm">Tempat Lahir:</label>
                        <div class="relative">
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('tempat_lahir', $profile->tempat_lahir ?? '') }}" placeholder="Masukkan tempat lahir" required>
                            <button type="button" id="clearTempatLahir" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-base'></i>
                            </button>
                        </div>
                        @error('tempat_lahir')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pendidikan" class="block mb-2 font-medium text-gray-800 text-sm">Pendidikan terakhir:</label>
                        <div class="relative">
                            <select name="pendidikan" id="pendidikan" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 appearance-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%2712%27%20height%3D%2712%27%20fill%3D%27%23333%27%20viewBox%3D%270%200%2016%2016%27%3E%3Cpath%20d%3D%27M8%209.5a.5.5%200%2001-.354-.146l-4-4a.5.5%200%2001.708-.708L8%208.293l3.646-3.647a.5.5%200%2001.708.708l-4%204A.5.5%200%20018%209.5z%27/%3E%3C/svg%3E')] bg-no-repeat bg-[right_0.75rem_center]" required>
                                <option value="" disabled {{ old('pendidikan', $profile->pendidikan ?? '') ? '' : 'selected' }}>-- Pilih Pendidikan Terakhir --</option>
                                <option value="SD atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'SD atau Setaranya' ? 'selected' : '' }}>SD atau setaranya</option>
                                <option value="SMP atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'SMP atau Setaranya' ? 'selected' : '' }}>SMP atau Setaranya</option>
                                <option value="SMA atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'SMA atau Setaranya' ? 'selected' : '' }}>SMA atau Setaranya</option>
                                <option value="S1 atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'S1 atau Setaranya' ? 'selected' : '' }}>S1 atau Setaranya</option>
                                <option value="S2 atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'S2 atau Setaranya' ? 'selected' : '' }}>S2 atau Setaranya</option>
                                <option value="S3 atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'S3 atau Setaranya' ? 'selected' : '' }}>S3 atau Setaranya</option>
                            </select>
                        </div>
                        @error('pendidikan')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="no_telp" class="block mb-2 font-medium text-gray-800 text-sm">No Telp:</label>
                        <div class="relative">
                            <input type="text" name="no_telp" id="no_telp" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('no_telp', $profile->no_telp ?? '') }}" placeholder="Masukkan nomor telepon" required>
                            <button type="button" id="clearNoTelp" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-base'></i>
                            </button>
                        </div>
                        @error('no_telp')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block mb-2 font-medium text-gray-800 text-sm">Password (kosongkan jika tidak diubah):</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" placeholder="Masukkan password">
                            <button type="button" id="clearPassword" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-base'></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($role === 'murid')
                        <div class="col-span-1 md:col-span-2 bg-gray-100 p-4 rounded-lg border-l-4 border-blue-600 mt-4 mb-4">
                            <h2 class="text-md sm:text-lg text-gray-800 mb-3 pb-2 relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-12 after:bg-blue-600">Data Murid</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="asal_sekolah" class="block mb-2 font-medium text-gray-800 text-sm">Asal Sekolah:</label>
                                    <div class="relative">
                                        <input type="text" name="asal_sekolah" id="asal_sekolah" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('asal_sekolah', $user->murid->asal_sekolah ?? '') }}" placeholder="Masukkan asal sekolah" required>
                                        <button type="button" id="clearAsalSekolah" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-base'></i>
                                        </button>
                                    </div>
                                    @error('asal_sekolah')
                                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="nis" class="block mb-2 font-medium text-gray-800 text-sm">NIS:</label>
                                    <div class="relative">
                                        <input type="text" name="nis" id="nis" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('nis', $user->murid->nis ?? '') }}" placeholder="Masukkan NIS" required>
                                        <button type="button" id="clearNis" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-base'></i>
                                        </button>
                                    </div>
                                    @error('nis')
                                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="nisn" class="block mb-2 font-medium text-gray-800 text-sm">NISN:</label>
                                    <div class="relative">
                                        <input type="text" name="nisn" id="nisn" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('nisn', $user->murid->nisn ?? '') }}" placeholder="Masukkan NISN" required>
                                        <button type="button" id="clearNisn" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-base'></i>
                                        </button>
                                    </div>
                                    @error('nisn')
                                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="kelas_tahun_id" class="block mb-2 font-medium text-gray-800 text-sm">Kelas:</label>
                                    <div class="relative">
                                        <select name="kelas_tahun_id" id="kelas_tahun_id" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 appearance-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%2712%27%20height%3D%2712%27%20fill%3D%27%23333%27%20viewBox%3D%270%200%2016%2016%27%3E%3Cpath%20d%3D%27M8%209.5a.5.5%200%2001-.354-.146l-4-4a.5.5%200%2001.708-.708L8%208.293l3.646-3.647a.5.5%200%2001.708.708l-4%204A.5.5%200%20018%209.5z%27/%3E%3C/svg%3E')] bg-no-repeat bg-[right_0.75rem_center]" required>
                                            <option value="" disabled {{ old('kelas_tahun_id') ? '' : 'selected' }}>-- Pilih Kelas --</option>
                                            @foreach ($kelasList as $kelas)
                                                <option value="{{ $kelas->kelas_tahun_id }}" {{ old('kelas_tahun_id', $user->kelas_tahun_id ?? '') == $kelas->kelas_tahun_id ? 'selected' : '' }}>
                                                    {{ $kelas->kelas->nama_kelas }} - {{ $kelas->tahunajar->tahun_ajaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('kelas_tahun_id')
                                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @elseif ($role === 'guru')
                        <div class="col-span-1 md:col-span-2 bg-gray-100 p-4 rounded-lg border-l-4 border-blue-600 mt-4 mb-4">
                            <h2 class="text-md sm:text-lg text-gray-800 mb-3 pb-2 relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-12 after:bg-blue-600">Data Guru</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="gelar" class="block mb-2 font-medium text-gray-800 text-sm">Gelar:</label>
                                    <div class="relative">
                                        <input type="text" name="gelar" id="gelar" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('gelar', $user->gelar ?? '') }}" placeholder="Masukkan gelar" required>
                                        <button type="button" id="clearGelar" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-base'></i>
                                        </button>
                                    </div>
                                    @error('gelar')
                                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="nuptk" class="block mb-2 font-medium text-gray-800 text-sm">Masukkan Nomor Unik Pendidik dan Tenaga Kependidikan:</label>
                                    <div class="relative">
                                        <input type="text" name="nuptk" id="nuptk" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('nuptk', $user->nuptk ?? '') }}" placeholder="Masukkan NUPTK" required>
                                        <button type="button" id="clearNuptk" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-base'></i>
                                        </button>
                                    </div>
                                    @error('nuptk')
                                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="statusMenikah" class="block mb-2 font-medium text-gray-800 text-sm">Status Nikah:</label>
                                    <div class="relative">
                                        <select name="statusMenikah" id="statusMenikah" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 appearance-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%2712%27%20height%3D%2712%27%20fill%3D%27%23333%27%20viewBox%3D%270%200%2016%2016%27%3E%3Cpath%20d%3D%27M8%209.5a.5.5%200%2001-.354-.146l-4-4a.5.5%200%2001.708-.708L8%208.293l3.646-3.647a.5.5%200%2001.708.708l-4%204A.5.5%200%20018%209.5z%27/%3E%3C/svg%3E')] bg-no-repeat bg-[right_0.75rem_center]" required>
                                            <option value="" disabled {{ old('statusMenikah', $user->statusMenikah ?? '') ? '' : 'selected' }}>-- Pilih status nikah --</option>
                                            <option value="Menikah" {{ old('statusMenikah', $user->statusMenikah ?? '') === 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                            <option value="Belum Menikah" {{ old('statusMenikah', $user->statusMenikah ?? '') === 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                        </select>
                                        <button type="button" id="clearStatusMenikah" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-base'></i>
                                        </button>
                                    </div>
                                    @error('statusMenikah')
                                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="statusKerja" class="block mb-2 font-medium text-gray-800 text-sm">Status kerja:</label>
                                    <div class="relative">
                                        <select name="statusKerja" id="statusKerja" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 appearance-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%2712%27%20height%3D%2712%27%20fill%3D%27%23333%27%20viewBox%3D%270%200%2016%2016%27%3E%3Cpath%20d%3D%27M8%209.5a.5.5%200%2001-.354-.146l-4-4a.5.5%200%2001.708-.708L8%208.293l3.646-3.647a.5.5%200%2001.708.708l-4%204A.5.5%200%20018%209.5z%27/%3E%3C/svg%3E')] bg-no-repeat bg-[right_0.75rem_center]" required>
                                            <option value="" disabled {{ old('statusKerja', $user->statusKerja ?? '') ? '' : 'selected' }}>-- Pilih status kerja --</option>
                                            <option value="Full time" {{ old('statusKerja', $user->statusKerja ?? '') === 'Full time' ? 'selected' : '' }}>Full time</option>
                                            <option value="Honorer" {{ old('statusKerja', $user->statusKerja ?? '') === 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                        </select>
                                        <button type="button" id="clearStatusKerja" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-base'></i>
                                        </button>
                                    </div>
                                    @error('statusKerja')
                                        <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @elseif ($role === 'orang_tua')
                        <div class="col-span-1 md:col-span-2 bg-gray-100 p-4 rounded-lg border-l-4 border-blue-600 mt-4 mb-4">
                            <h2 class="text-md sm:text-lg text-gray-800 mb-3 pb-2 relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-12 after:bg-blue-600">Data Orang Tua</h2>
                            <div class="mb-4">
                                <label for="profesi" class="block mb-2 font-medium text-gray-800 text-sm">Profesi:</label>
                                <div class="relative">
                                    <input type="text" name="profesi" id="profesi" class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20" value="{{ old('profesi', $user->profesi ?? '') }}" placeholder="Masukkan profesi" required>
                                    <button type="button" id="clearProfesi" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                        <i class='bx bx-x text-base'></i>
                                    </button>
                                </div>
                                @error('profesi')
                                    <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="col-span-1 md:col-span-2 pt-4 flex flex-col sm:flex-row gap-3 justify-center lg:pt-8">
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 hover:scale-105 transition-all duration-300 ease-in-out w-full sm:w-auto lg:px-8 lg:py-3 lg:min-w-[200px]">Update User</button>
                        <a href="{{ route('admin.ManajemenUser') }}" class="px-6 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-all duration-300 ease-in-out w-full sm:w-auto text-center lg:px-8 lg:py-3 lg:min-w-[200px]">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
        <div id="main-content" class="px-4 md:px-8 py-8 flex flex-col gap-8 transition-all duration-400 ease-in-out">
            <p class="text-red-600">Anda tidak memiliki akses ke halaman ini</p>
            <a href="/login" class="text-blue-600 hover:underline">Login kembali disini</a>
        </div>
    @endif

    <script src="{{ asset('js/CssAdmin.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Clear input functionality
            document.querySelectorAll('[id^="clear"]').forEach(button => {
                button.addEventListener('click', () => {
                    const inputId = button.id.replace('clear', '');
                    const input = document.getElementById(inputId);
                    if (input) {
                        input.value = '';
                    }
                });
            });
        });
    </script>
</body>