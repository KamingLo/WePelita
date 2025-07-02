@include('admin.partials.header') 
@include('admin.partials.sidebar')

<body class="font-sans text-gray-800">
    @if (session('role') == 'admin')
    <div class="ml-64 p-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-5 pb-2 relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-1 after:w-full after:bg-blue-500">Edit Pengguna</h1>
        <div class="flex h-[calc(100vh-150px)] gap-5 justify-center">
            <div class="w-full max-w-4xl bg-white rounded-lg shadow-md overflow-y-auto p-6">
                <div class="flex justify-between items-center w-full">
                    <h2 class="text-xl text-gray-800 mb-5 pb-3 relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-16 after:bg-blue-500">Edit Data {{ ucfirst($role) }}</h2>
                    <div>
                        @if(session('success'))
                        <div class="p-4 bg-green-100 text-green-800 border border-green-200 rounded-lg max-w-md text-sm">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                </div>
                
                <form method="POST" action="{{ route('admin.user.update', $id) }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    @method('PUT')

                    @php
                        $profile = $role === 'murid' ? $user->murid->profile : $user->profile;
                    @endphp

                    <input type="hidden" name="role" value="{{ $role }}">

                    <div class="mb-5">
                        <label for="name" class="block mb-2 font-medium text-gray-800 text-sm">Nama:</label>
                        <div class="relative">
                            <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('name', $profile->name ?? '') }}" placeholder="Masukkan nama lengkap" required>
                            <button type="button" id="clearName" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-lg'></i>
                            </button>
                        </div>
                        @error('name')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="email" class="block mb-2 font-medium text-gray-800 text-sm">Email:</label>
                        <div class="relative">
                            <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('email', $profile->email ?? '') }}" placeholder="Masukkan email" required>
                            <button type="button" id="clearEmail" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-lg'></i>
                            </button>
                        </div>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="alamat" class="block mb-2 font-medium text-gray-800 text-sm">Alamat:</label>
                        <div class="relative">
                            <input type="text" name="alamat" id="alamat" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('alamat', $profile->alamat ?? '') }}" placeholder="Masukkan alamat" required>
                            <button type="button" id="clearAlamat" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-lg'></i>
                            </button>
                        </div>
                        @error('alamat')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="jenis_kelamin" class="block mb-2 font-medium text-gray-800 text-sm">Jenis kelamin:</label>
                        <div class="relative">
                            <select name="jenis_kelamin" id="jenis_kelamin" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 appearance-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%2712%27%20height%3D%2712%27%20fill%3D%27%23333%27%20viewBox%3D%270%200%2016%2016%27%3E%3Cpath%20d%3D%27M8%209.5a.5.5%200%2001-.354-.146l-4-4a.5.5%200%2001.708-.708L8%208.293l3.646-3.647a.5.5%200%2001.708.708l-4%204A.5.5%200%20018%209.5z%27/%3E%3C/svg%3E')] bg-no-repeat bg-[right_1rem_center]" required>
                                <option value="" disabled {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <button type="button" id="clearJenisKelamin" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-lg'></i>
                            </button>
                        </div>
                        @error('jenis_kelamin')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="tanggal_lahir" class="block mb-2 font-medium text-gray-800 text-sm">Tanggal lahir:</label>
                        <div class="relative">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('tanggal_lahir', $profile->tanggal_lahir ?? '') }}" placeholder="Masukkan tanggal lahir" required>
                            <button type="button" id="clearTanggalLahir" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-lg'></i>
                            </button>
                        </div>
                        @error('tanggal_lahir')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="tempat_lahir" class="block mb-2 font-medium text-gray-800 text-sm">Tempat Lahir:</label>
                        <div class="relative">
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('tempat_lahir', $profile->tempat_lahir ?? '') }}" placeholder="Masukkan tempat lahir" required>
                            <button type="button" id="clearTempatLahir" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-lg'></i>
                            </button>
                        </div>
                        @error('tempat_lahir')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="pendidikan" class="block mb-2 font-medium text-gray-800 text-sm">Pendidikan terakhir:</label>
                        <div class="relative">
                            <select name="pendidikan" id="pendidikan" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 appearance-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%2712%27%20height%3D%2712%27%20fill%3D%27%23333%27%20viewBox%3D%270%200%2016%2016%27%3E%3Cpath%20d%3D%27M8%209.5a.5.5%200%2001-.354-.146l-4-4a.5.5%200%2001.708-.708L8%208.293l3.646-3.647a.5.5%200%2001.708.708l-4%204A.5.5%200%20018%209.5z%27/%3E%3C/svg%3E')] bg-no-repeat bg-[right_1rem_center]" required>
                                <option value="" disabled {{ old('pendidikan', $profile->pendidikan ?? '') ? '' : 'selected' }}>-- Pilih Pendidikan Terakhir --</option>
                                <option value="SD atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'SD atau Setaranya' ? 'selected' : '' }}>SD atau setaranya</option>
                                <option value="SMP atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'SMP atau Setaranya' ? 'selected' : '' }}>SMP atau Setaranya</option>
                                <option value="SMA atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'SMA atau Setaranya' ? 'selected' : '' }}>SMA atau Setaranya</option>
                                <option value="S1 atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'S1 atau Setaranya' ? 'selected' : '' }}>S1 atau Setaranya</option>
                                <option value="S2 atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'S2 atau Setaranya' ? 'selected' : '' }}>S2 atau Setaranya</option>
                                <option value="S3 atau Setaranya" {{ old('pendidikan', $profile->pendidikan ?? '') === 'S3 atau Setaranya' ? 'selected' : '' }}>S3 atau Setaranya</option>
                            </select>
                            <button type="button" id="clearPendidikan" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-lg'></i>
                            </button>
                        </div>
                        @error('pendidikan')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="no_telp" class="block mb-2 font-medium text-gray-800 text-sm">No Telp:</label>
                        <div class="relative">
                            <input type="text" name="no_telp" id="no_telp" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('no_telp', $profile->no_telp ?? '') }}" placeholder="Masukkan nomor telepon" required>
                            <button type="button" id="clearNoTelp" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-lg'></i>
                            </button>
                        </div>
                        @error('no_telp')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="password" class="block mb-2 font-medium text-gray-800 text-sm">Password (kosongkan jika tidak diubah):</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="Masukkan password">
                            <button type="button" id="clearPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                <i class='bx bx-x text-lg'></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($role === 'murid')
                        <div class="col-span-1 md:col-span-2 bg-gray-100 p-6 rounded-lg border-l-4 border-blue-500 mt-6 mb-6">
                            <h2 class="text-lg text-gray-800 mb-5 pb-3 relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-12 after:bg-blue-500">Data Murid</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="mb-5">
                                    <label for="asal_sekolah" class="block mb-2 font-medium text-gray-800 text-sm">Asal Sekolah:</label>
                                    <div class="relative">
                                        <input type="text" name="asal_sekolah" id="asal_sekolah" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('asal_sekolah', $user->murid->asal_sekolah ?? '') }}" placeholder="Masukkan asal sekolah" required>
                                        <button type="button" id="clearAsalSekolah" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-lg'></i>
                                        </button>
                                    </div>
                                    @error('asal_sekolah')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-5">
                                    <label for="nis" class="block mb-2 font-medium text-gray-800 text-sm">NIS:</label>
                                    <div class="relative">
                                        <input type="text" name="nis" id="nis" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('nis', $user->murid->nis ?? '') }}" placeholder="Masukkan NIS" required>
                                        <button type="button" id="clearNis" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-lg'></i>
                                        </button>
                                    </div>
                                    @error('nis')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-5">
                                    <label for="nisn" class="block mb-2 font-medium text-gray-800 text-sm">NISN:</label>
                                    <div class="relative">
                                        <input type="text" name="nisn" id="nisn" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('nisn', $user->murid->nisn ?? '') }}" placeholder="Masukkan NISN" required>
                                        <button type="button" id="clearNisn" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-lg'></i>
                                        </button>
                                    </div>
                                    @error('nisn')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-5">
                                    <label for="kelas_tahun_id" class="block mb-2 font-medium text-gray-800 text-sm">Kelas:</label>
                                    <div class="relative">
                                        <select name="kelas_tahun_id" id="kelas_tahun_id" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 appearance-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%2712%27%20height%3D%2712%27%20fill%3D%27%23333%27%20viewBox%3D%270%200%2016%2016%27%3E%3Cpath%20d%3D%27M8%209.5a.5.5%200%2001-.354-.146l-4-4a.5.5%200%2001.708-.708L8%208.293l3.646-3.647a.5.5%200%2001.708.708l-4%204A.5.5%200%20018%209.5z%27/%3E%3C/svg%3E')] bg-no-repeat bg-[right_1rem_center]" required>
                                            <option value="" disabled {{ old('kelas_tahun_id') ? '' : 'selected' }}>-- Pilih Kelas --</option>
                                            @foreach ($kelasList as $kelas)
                                                <option value="{{ $kelas->kelas_tahun_id }}" {{ old('kelas_tahun_id', $user->murid->kelas_tahun_id ?? '') == $kelas->kelas_tahun_id ? 'selected' : '' }}>
                                                    {{ $kelas->kelas->nama_kelas }} - {{ $kelas->tahunajar->tahun_ajaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" id="clearKelasId" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-lg'></i>
                                        </button>
                                    </div>
                                    @error('kelas_tahun_id')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @elseif ($role === 'guru')
                        <div class="col-span-1 md:col-span-2 bg-gray-100 p-6 rounded-lg border-l-4 border-blue-500 mt-6 mb-6">
                            <h2 class="text-lg text-gray-800 mb-5 pb-3 relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-12 after:bg-blue-500">Data Guru</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="mb-5">
                                    <label for="gelar" class="block mb-2 font-medium text-gray-800 text-sm">Gelar:</label>
                                    <div class="relative">
                                        <input type="text" name="gelar" id="gelar" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('gelar', $user->gelar ?? '') }}" placeholder="Masukkan gelar" required>
                                        <button type="button" id="clearGelar" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-lg'></i>
                                        </button>
                                    </div>
                                    @error('gelar')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-5">
                                    <label for="nuptk" class="block mb-2 font-medium text-gray-800 text-sm">Masukkan Nomor Unik Pendidik dan Tenaga Kependidikan:</label>
                                    <div class="relative">
                                        <input type="text" name="nuptk" id="nuptk" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('nuptk', $user->nuptk ?? '') }}" placeholder="Masukkan NUPTK" required>
                                        <button type="button" id="clearNuptk" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-lg'></i>
                                        </button>
                                    </div>
                                    @error('nuptk')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-5">
                                    <label for="statusMenikah" class="block mb-2 font-medium text-gray-800 text-sm">Status Nikah:</label>
                                    <div class="relative">
                                        <select name="statusMenikah" id="statusMenikah" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 appearance-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%2712%27%20height%3D%2712%27%20fill%3D%27%23333%27%20viewBox%3D%270%200%2016%2016%27%3E%3Cpath%20d%3D%27M8%209.5a.5.5%200%2001-.354-.146l-4-4a.5.5%200%2001.708-.708L8%208.293l3.646-3.647a.5.5%200%2001.708.708l-4%204A.5.5%200%20018%209.5z%27/%3E%3C/svg%3E')] bg-no-repeat bg-[right_1rem_center]" required>
                                            <option value="" disabled {{ old('statusMenikah', $user->statusMenikah ?? '') ? '' : 'selected' }}>-- Pilih status nikah --</option>
                                            <option value="Menikah" {{ old('statusMenikah', $user->statusMenikah ?? '') === 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                            <option value="Belum Menikah" {{ old('statusMenikah', $user->statusMenikah ?? '') === 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                        </select>
                                        <button type="button" id="clearStatusMenikah" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-lg'></i>
                                        </button>
                                    </div>
                                    @error('statusMenikah')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="statusKerja" class="block mb-2 font-medium text-gray-800 text-sm">Status kerja:</label>
                                    <div class="relative">
                                        <select name="statusKerja" id="statusKerja" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 appearance-none bg-[url('data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%2712%27%20height%3D%2712%27%20fill%3D%27%23333%27%20viewBox%3D%270%200%2016%2016%27%3E%3Cpath%20d%3D%27M8%209.5a.5.5%200%2001-.354-.146l-4-4a.5.5%200%2001.708-.708L8%208.293l3.646-3.647a.5.5%200%2001.708.708l-4%204A.5.5%200%20018%209.5z%27/%3E%3C/svg%3E')] bg-no-repeat bg-[right_1rem_center]" required>
                                            <option value="" disabled {{ old('statusKerja', $user->statusKerja ?? '') ? '' : 'selected' }}>-- Pilih status kerja --</option>
                                            <option value="Full time" {{ old('statusKerja', $user->statusKerja ?? '') === 'Full time' ? 'selected' : '' }}>Full time</option>
                                            <option value="Honorer" {{ old('statusKerja', $user->statusKerja ?? '') === 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                        </select>
                                        <button type="button" id="clearStatusKerja" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                            <i class='bx bx-x text-lg'></i>
                                        </button>
                                    </div>
                                    @error('statusKerja')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @elseif ($role === 'orang_tua')
                        <div class="col-span-1 md:col-span-2 bg-gray-100 p-6 rounded-lg border-l-4 border-blue-500 mt-6 mb-6">
                            <h2 class="text-lg text-gray-800 mb-5 pb-3 relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-12 after:bg-blue-500">Data Orang Tua</h2>
                            <div class="mb-5">
                                <label for="profesi" class="block mb-2 font-medium text-gray-800 text-sm">Profesi:</label>
                                <div class="relative">
                                    <input type="text" name="profesi" id="profesi" class="w-full p-3 border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" value="{{ old('profesi', $user->profesi ?? '') }}" placeholder="Masukkan profesi" required>
                                    <button type="button" id="clearProfesi" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                                        <i class='bx bx-x text-lg'></i>
                                    </button>
                                </div>
                                @error('profesi')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="col-span-1 md:col-span-2 pt-8 flex gap-3 justify-center">
                        <button type="submit" class="px-8 py-3 bg-blue-500 text-white rounded-lg font-medium hover:bg-blue-600 hover:scale-105 transition-all min-w-[200px]">Update User</button>
                        <a href="{{ route('admin.ManajemenUser') }}" class="px-8 py-3 bg-red-500 text-white rounded-lg font-medium hover:bg-red-600 transition-all min-w-[200px] text-center">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    @else
        <p class="p-8">Anda tidak memiliki akses ke halaman ini</p>
        <a href="/login" class="text-blue-500 hover:underline">Login kembali disini</a>
    @endif
</body>

<script src="{{ asset('js/CssAdmin.js') }}"></script>