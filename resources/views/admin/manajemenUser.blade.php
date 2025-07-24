@include('admin.partials.header')
@include('admin.partials.sidebar')
<body class="font-sans text-gray-700 m-0 p-0 overflow-x-hidden md:overflow-x-auto">
    @if (session('role') == 'admin')
    <div id="main-content" class="px-4 md:px-8 py-8 flex flex-col gap-8 transition-all duration-400 ease-in-out lg:ml-72 sidebar-minimized:lg:ml-20">
        <h1 class="text-gray-800 mb-2 text-2xl font-bold relative pb-2">
            Registrasi Pengguna Baru
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
        </h1>
        <div class="flex flex-col lg:flex-row h-auto lg:h-[calc(100vh-150px)] gap-5 box-border">
            <div class="flex-none lg:flex-[0_0_45%] bg-white rounded-lg shadow-md overflow-y-auto w-full mb-5 lg:mb-0">
                <div class="p-4 lg:p-6">
                    <div class="p-2 w-full max-w-full lg:max-w-6xl mx-auto box-border">
                        <div class="flex flex-col sm:flex-row justify-between items-center w-full mb-5">
                            <h2 class="text-gray-800 text-xl lg:text-2xl text-center pb-2 relative mb-3 sm:mb-0">Register User
                                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] w-16 bg-blue-600 sm:left-0 sm:translate-x-0"></span>
                            </h2>
                            <div class="flex items-center gap-2 flex-wrap justify-center sm:justify-start">
                                @if(session('success'))
                                <div class="px-4 py-3 rounded-lg text-center font-medium bg-green-100 text-green-700 border border-green-300 max-w-full text-left text-sm">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm" role="alert">
                                <strong class="font-bold">Terjadi kesalahan:</strong>
                                <ul class="mt-1 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6 items-start">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block mb-2 font-medium text-gray-800 text-sm">Nama:</label>
                                <div class="relative">
                                    <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block mb-2 font-medium text-gray-800 text-sm">Email:</label>
                                <div class="relative">
                                    <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Masukkan email" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="block mb-2 font-medium text-gray-800 text-sm">Alamat:</label>
                                <div class="relative">
                                    <input type="text" name="alamat" id="alamat" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Masukkan alamat" value="{{ old('alamat') }}">
                                </div>
                                @error('alamat')
                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="jenis_kelamin" class="block mb-2 font-medium text-gray-800 text-sm">Jenis kelamin:</label>
                                <div class="relative">
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white appearance-none bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-[right_0.9375rem_center]">
                                        <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                @error('jenis_kelamin')
                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="tanggal_lahir" class="block mb-2 font-medium text-gray-800 text-sm">Tanggal lahir:</label>
                                <div class="relative">
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" value="{{ old('tanggal_lahir') }}">
                                </div>
                                @error('tanggal_lahir')
                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="tempat_lahir" class="block mb-2 font-medium text-gray-800 text-sm">Tempat Lahir:</label>
                                <div class="relative">
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}">
                                </div>
                                @error('tempat_lahir')
                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="pendidikan" class="block mb-2 font-medium text-gray-800 text-sm">Pendidikan terakhir:</label>
                                <div class="relative">
                                    <select name="pendidikan" id="pendidikan" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white appearance-none bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-[right_0.9375rem_center]">
                                        <option value="" disabled {{ old('pendidikan') ? '' : 'selected' }}>-- Pilih Pendidikan Terakhir --</option>
                                        <option value="SD atau Setaranya" {{ old('pendidikan') == 'SD atau Setaranya' ? 'selected' : '' }}>SD atau setaranya</option>
                                        <option value="SMP atau Setaranya" {{ old('pendidikan') == 'SMP atau Setaranya' ? 'selected' : '' }}>SMP atau Setaranya</option>
                                        <option value="SMA atau Setaranya" {{ old('pendidikan') == 'SMA atau Setaranya' ? 'selected' : '' }}>SMA atau Setaranya</option>
                                        <option value="S1 atau Setaranya" {{ old('pendidikan') == 'S1 atau Setaranya' ? 'selected' : '' }}>

S1 atau Setaranya</option>
                                        <option value="S2 atau Setaranya" {{ old('pendidikan') == 'S2 atau Setaranya' ? 'selected' : '' }}>S2 atau Setaranya</option>
                                        <option value="S3 atau Setaranya" {{ old('pendidikan') == 'S3 atau Setaranya' ? 'selected' : '' }}>S3 atau Setaranya</option>
                                    </select>
                                </div>
                                @error('pendidikan')
                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="no_telp" class="block mb-2 font-medium text-gray-800 text-sm">No Telp:</label>
                                <div class="relative">
                                    <input type="text" name="no_telp" id="no_telp" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white custom-number-only" placeholder="Masukkan nomor telepon" value="{{ old('no_telp') }}">
                                </div>
                                @error('no_telp')
                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="role-select" class="block mb-2 font-medium text-gray-800 text-sm">Role:</label>
                                <div class="relative">
                                    <select name="role" id="UserUntuk" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white appearance-none bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-[right_0.9375rem_center]">
                                        <option value="" disabled selected>-- Pilih Role --</option>
                                        <option value="murid" {{ old('role') == 'murid' ? 'selected' : '' }}>Murid</option>
                                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                @error('role')
                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-full bg-gray-50 p-4 rounded-lg border-l-4 border-blue-600 mt-6" id="FormUntukMurid" style="display: none;">
                                <h2 class="text-gray-800 text-base lg:text-lg mb-5 relative pb-2 inline-block">Data Murid
                                    <span class="absolute bottom-0 left-0 h-[2px] w-12 bg-blue-600"></span>
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                                    <div class="mb-4">
                                        <label for="asal_sekolah" class="block mb-2 font-medium text-gray-800 text-sm">Asal Sekolah:</label>
                                        <div class="relative">
                                            <input type="text" name="asal_sekolah" id="asal_sekolah" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Masukkan asal sekolah" value="{{ old('asal_sekolah') }}">
                                        </div>
                                        @error('asal_sekolah')
                                            <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="nis" class="block mb-2 font-medium text-gray-800 text-sm">NIS:</label>
                                        <div class="relative">
                                            <input type="text" name="nis" id="nis" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Masukkan NIS" value="{{ old('nis') }}">
                                        </div>
                                        @error('nis')
                                            <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="nisn" class="block mb-2 font-medium text-gray-800 text-sm">NISN:</label>
                                        <div class="relative">
                                            <input type="text" name="nisn" id="nisn" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Masukkan NISN" value="{{ old('nisn') }}">
                                        </div>
                                        @error('nisn')
                                            <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="kelas_tahun_id" class="block mb-2 font-medium text-gray-800 text-sm">Kelas Tahun:</label>
                                        <div class="relative">
                                            <select name="kelas_tahun_id" id="kelas_tahun_id" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white appearance-none bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-[right_0.9375rem_center]">
                                                <option value="" disabled selected>-- Pilih Kelas --</option>
                                                @foreach ($kelasList as $kelas)
                                                    <option value="{{ $kelas->kelas_tahun_id }}" {{ old('kelas_tahun_id') == $kelas->kelas_tahun_id ? 'selected' : '' }}>
                                                        {{ $kelas->kelas->nama_kelas }} - {{ $kelas->tahunajar->tahun_ajaran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('kelas_tahun_id')
                                            <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <h5 class="col-span-full text-gray-800 text-sm lg:text-base mb-5 relative pb-2 inline-block mt-3">Data Wali Murid
                                        <span class="absolute bottom-0 left-0 h-[2px] w-12 bg-blue-600"></span>
                                    </h5>
                                    <div class="col-span-full mt-2 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                                            <div class="mb-4">
                                                <label for="ortu_name" class="block mb-2 font-medium text-gray-800 text-sm">Nama Wali Murid:</label>
                                                <div class="relative">
                                                    <input type="text" name="ortu_name" id="ortu_name" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Nama wali murid" value="{{ old('ortu_name') }}">
                                                </div>
                                                @error('ortu_name')
                                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="ortu_email" class="block mb-2 font-medium text-gray-800 text-sm">Email Wali Murid:</label>
                                                <div class="relative">
                                                    <input type="email" name="ortu_email" id="ortu_email" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Email wali murid" value="{{ old('ortu_email') }}">
                                                </div>
                                                @error('ortu_email')
                                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="ortu_alamat" class="block mb-2 font-medium text-gray-800 text-sm">Alamat Wali Murid:</label>
                                                <div class="relative">
                                                    <input type="text" name="ortu_alamat" id="ortu_alamat" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Alamat wali murid" value="{{ old('ortu_alamat') }}">
                                                </div>
                                                @error('ortu_alamat')
                                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="ortu_jenis_kelamin" class="block mb-2 font-medium text-gray-800 text-sm">Jenis Kelamin Wali Murid:</label>
                                                <div class="relative">
                                                    <select name="ortu_jenis_kelamin" id="ortu_jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white appearance-none bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-[right_0.9375rem_center]">
                                                        <option value="" disabled {{ old('ortu_jenis_kelamin') ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                                                        <option value="Laki-laki" {{ old('ortu_jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                        <option value="Perempuan" {{ old('ortu_jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                </div>
                                                @error('ortu_jenis_kelamin')
                                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="ortu_tempat_lahir" class="block mb-2 font-medium text-gray-800 text-sm">Tempat Lahir Wali Murid:</label>
                                                <div class="relative">
                                                    <input type="text" name="ortu_tempat_lahir" id="ortu_tempat_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Tempat lahir wali murid" value="{{ old('ortu_tempat_lahir') }}">
                                                </div>
                                                @error('ortu_tempat_lahir')
                                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="ortu_tanggal_lahir" class="block mb-2 font-medium text-gray-800 text-sm">Tanggal Lahir Wali Murid:</label>
                                                <div class="relative">
                                                    <input type="date" name="ortu_tanggal_lahir" id="ortu_tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" value="{{ old('ortu_tanggal_lahir') }}">
                                                </div>
                                                @error('ortu_tanggal_lahir')
                                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="ortu_profesi" class="block mb-2 font-medium text-gray-800 text-sm">Profesi Wali Murid:</label>
                                                <div class="relative">
                                                    <input type="text" name="ortu_profesi" id="ortu_profesi" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Profesi wali murid" value="{{ old('ortu_profesi') }}">
                                                </div>
                                                @error('ortu_profesi')
                                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="ortu_pendidikan" class="block mb-2 font-medium text-gray-800 text-sm">Pendidikan Terakhir Wali Murid:</label>
                                                <div class="relative">
                                                    <input type="text" name="ortu_pendidikan" id="ortu_pendidikan" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Pendidikan terakhir wali murid" value="{{ old('ortu_pendidikan') }}">
                                                </div>
                                                @error('ortu_pendidikan')
                                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="ortu_no_telp" class="block mb-2 font-medium text-gray-800 text-sm">No Telp Wali Murid:</label>
                                                <div class="relative">
                                                    <input type="text" name="ortu_no_telp" id="ortu_no_telp" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white custom-number-only" placeholder="No Telp wali murid" value="{{ old('ortu_no_telp') }}">
                                                </div>
                                                @error('ortu_no_telp')
                                                    <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-full bg-gray-50 p-4 rounded-lg border-l-4 border-blue-600 mt-6" id="FormUntukGuru" style="display: none;">
                                <h2 class="text-gray-800 text-base lg:text-lg mb-5 relative pb-2 inline-block">Data Guru
                                    <span class="absolute bottom-0 left-0 h-[2px] w-12 bg-blue-600"></span>
                                </h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                                    <div class="mb-4">
                                        <label for="gelar" class="block mb-2 font-medium text-gray-800 text-sm">Gelar:</label>
                                        <div class="relative">
                                            <input type="text" name="gelar" id="gelar" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Masukkan gelar" value="{{ old('gelar') }}">
                                        </div>
                                        @error('gelar')
                                            <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="nuptk" class="block mb-2 font-medium text-gray-800 text-sm">Nomor Unik Pendidik dan Tenaga Kependidikan:</label>
                                        <div class="relative">
                                            <input type="text" name="nuptk" id="nuptk" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white" placeholder="Masukkan NUPTK" value="{{ old('nuptk') }}">
                                        </div>
                                        @error('nuptk')
                                            <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="statusMenikah" class="block mb-2 font-medium text-gray-800 text-sm">Status Nikah:</label>
                                        <div class="relative">
                                            <select name="statusMenikah" id="statusMenikah" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white appearance-none bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-[right_0.9375rem_center]">
                                                <option value="" disabled {{ old('statusMenikah') ? '' : 'selected' }}>-- Pilih Status Nikah --</option>
                                                <option value="Menikah" {{ old('statusMenikah') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                                <option value="Belum Menikah" {{ old('statusMenikah') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                            </select>
                                        </div>
                                        @error('statusMenikah')
                                            <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="statusKerja" class="block mb-2 font-medium text-gray-800 text-sm">Status Kerja:</label>
                                        <div class="relative">
                                            <select name="statusKerja" id="statusKerja" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white appearance-none bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-[right_0.9375rem_center]">
                                                <option value="" disabled {{ old('statusKerja') ? '' : 'selected' }}>-- Pilih Status Kerja --</option>
                                                <option value="Full time" {{ old('statusKerja') == 'Full time' ? 'selected' : '' }}>Full time</option>
                                                <option value="Honorer" {{ old('statusKerja') == 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                            </select>
                                        </div>
                                        @error('statusKerja')
                                            <span class="text-red-600 text-xs mt-1 block ml-auto">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="col-span-full justify-self-center px-6 py-2 bg-blue-600 text-white border-none rounded-md text-sm font-medium cursor-pointer transition-all duration-300 ease-in-out hover:bg-blue-700 hover:scale-105 hover:shadow-lg hover:shadow-blue-600/30 w-full md:w-[200px]">Daftarkan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex-1 bg-white rounded-lg shadow-md overflow-y-auto w-full flex flex-col mt-5 lg:mt-0">
                <div class="p-4 border-b border-gray-200 bg-gray-50 rounded-t-lg items-start sm:items-center gap-3 sm:gap-4 flex-wrap">
                    <form method="GET" action="{{ route('admin.ManajemenUser') }}" class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                        <label for="role_select" class="inline-block mr-2 font-medium text-gray-800 text-sm min-w-[170px]">Filter berdasarkan peran:</label>
                        <select name="role" id="role_select" onchange="this.form.submit()" class="px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out appearance-none bg-white bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-[right_0.9375rem_center] w-full focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="murid" {{ request('role') == 'murid' ? 'selected' : '' }}>Murid</option>
                            <option value="orang_tua" {{ request('role') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                        </select>
                    </form>

                    <div>
                        <form method="GET" action="{{ route('admin.ManajemenUser') }}" class="flex flex-col sm:flex-row items-start sm:items-center gap-2 w-full">
                            <label for="nameSearchBar" class="inline-block mr-2 font-medium text-gray-800 text-sm min-w-[170px]">Mencari:</label>
                            <div class="flex-1 relative bg-white border border-gray-300 rounded-lg transition duration-300 ease-in-out focus-within:border-blue-600 focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-opacity-20 w-full">
                                <input type="text" placeholder="Masukan nama user" class="w-full px-3 py-2 pl-3 border-none outline-none text-sm bg-transparent rounded-lg text-gray-800" name="search" id="nameSearchBar" value="{{ request('search') }}">
                                <i class='bx bx-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-500'></i>
                            </div>
                            <input type="hidden" name="role" value="{{ request('role') }}">
                            <input type="hidden" name="additional_filter" value="{{ request('additional_filter') }}">
                        </form>
                    </div>
                </div>

                @php $role = request('role'); @endphp

                <div class="flex-1 p-4 overflow-auto">
                    @if ($role === 'admin')
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-5 w-full">
                        <h3 class="text-gray-800 text-lg lg:text-xl m-0 pb-2 relative inline-block text-left mb-3 sm:mb-0">Data Admin
                            <span class="absolute bottom-0 left-0 h-[2px] w-12 bg-blue-600"></span>
                        </h3>
                        <div class="flex justify-end w-full sm:w-auto">
                            <a href="{{ route('admin.downloaduser', ['role' => $role]) }}" class="inline-block font-normal text-center whitespace-nowrap align-middle select-none border border-transparent px-3 py-1.5 text-sm leading-normal rounded-md transition duration-300 ease-in-out cursor-pointer text-white bg-green-600 hover:bg-green-700 w-full sm:w-auto">
                                <i class="fa-solid fa-file-excel mr-2"></i>Unduh Data {{ $role }}
                            </a>
                        </div>
                    </div>
                        @if (isset($admins) && $admins->isNotEmpty())
                            <div class="overflow-x-auto">
                                <table class="w-full mb-0 text-gray-800 border-collapse min-w-[600px]">
                                    <thead>
                                        <tr>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Nama</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Email</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Alamat</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="adminTableBody">
                                        @foreach ($admins as $admin)
                                            <tr class="hover:bg-blue-600/5">
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $admin->profile->name }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $admin->profile->email }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $admin->profile->alamat }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">
                                                    <div class="flex gap-1 justify-center flex-wrap">
                                                        <a href="{{ route('admin.user.edit', ['id' => $admin->admin_id, 'role' => 'admin']) }}" class="text-white bg-blue-600 border border-blue-600 px-2 py-1 text-xs rounded-md leading-normal no-underline w-14 h-7 transition duration-300 ease-in-out hover:bg-blue-700 hover:border-blue-700 hover:-translate-y-px flex items-center justify-center">
                                                            Edit
                                                        </a>
                                                        <form method="POST" action="{{ route('admin.user.delete', ['id' => $admin->admin_id, 'role' => 'admin']) }}" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-white border border-red-600 bg-red-600 leading-normal px-2 py-1 rounded-md text-xs transition duration-300 ease-in-out cursor-pointer hover:bg-red-700 hover:border-red-700 hover:-translate-y-px flex items-center justify-center h-7" onclick="return confirm('Yakin hapus user ini?')">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-600 text-center py-4 text-sm">Tidak ada data admin yang ditemukan.</p>
                        @endif

                    @elseif ($role === 'guru')
                        <div class="flex flex-col sm:flex-row items-start sm:items-center mb-5">
                            <div class="flex flex-col sm:flex-row min-w-0 items-start sm:items-center w-full sm:w-auto mb-3 sm:mb-0">
                                <h3 class="text-gray-800 text-lg lg:text-xl m-0 pb-2 relative inline-block mb-2 sm:mb-0">Data Guru
                                    <span class="absolute bottom-0 left-0 h-[2px] w-12 bg-blue-600"></span>
                                </h3>
                            </div>
                            <div class="ml-0 sm:ml-auto w-full sm:w-auto flex flex-col sm:flex-row items-start sm:items-center gap-2">
                                <form method="GET" action="{{ route('admin.ManajemenUser') }}" class="filter-form w-full sm:w-auto">
                                    <div class="flex items-center w-full mt-4">
                                        <select name="additional_filter" id="additional_filter" onchange="this.form.submit()" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white appearance-none bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-[right_0.9375rem_center] min-w-0 sm:min-w-[150px]">
                                            <option value="" {{ request('additional_filter') == '' ? 'selected' : '' }}>-- Pilih Status Kerja --</option>
                                            <option value="Full time" {{ request('additional_filter') == 'Full time' ? 'selected' : '' }}>Full time</option>
                                            <option value="Honorer" {{ request('additional_filter') == 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="role" value="guru">
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                </form>
                                <a href="{{ route('admin.downloaduser', ['role' => $role]) }}" class="inline-block font-normal text-center whitespace-nowrap align-middle select-none border border-transparent px-3 py-1.5 text-sm leading-normal rounded-md transition duration-300 ease-in-out cursor-pointer text-white bg-green-600 hover:bg-green-700 w-full sm:w-auto mt-2 sm:mt-0">
                                    <i class="fa-solid fa-file-excel mr-2"></i>Unduh Data {{ $role }}
                                </a>
                            </div>
                        </div>

                        @if (isset($gurus) && $gurus->isNotEmpty())
                            <div class="overflow-x-auto">
                                <table class="w-full mb-0 text-gray-800 border-collapse min-w-[700px]">
                                    <thead>
                                        <tr>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Nama</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Nuptk</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Status Kerja</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Email</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">No Telpon</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="guruTableBody">
                                        @foreach ($gurus as $guru)
                                            <tr class="hover:bg-blue-600/5">
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $guru->profile->name }} {{ $guru->gelar }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $guru->nuptk }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $guru->statusKerja }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $guru->profile->email }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $guru->profile->no_telp }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">
                                                    <div class="flex gap-1 justify-center flex-wrap">
                                                        <a href="{{ route('admin.user.edit', ['id' => $guru->guru_id, 'role' => 'guru']) }}" class="text-white bg-blue-600 border border-blue-600 px-2 py-1 text-xs rounded-md leading-normal no-underline w-14 h-7 transition duration-300 ease-in-out hover:bg-blue-700 hover:border-blue-700 hover:-translate-y-px flex items-center justify-center">
                                                            Edit
                                                        </a>
                                                        <form method="POST" action="{{ route('admin.user.delete', ['id' => $guru->guru_id, 'role' => 'guru']) }}" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-white border border-red-600 bg-red-600 leading-normal px-2 py-1 rounded-md text-xs transition duration-300 ease-in-out cursor-pointer hover:bg-red-700 hover:border-red-700 hover:-translate-y-px flex items-center justify-center h-7" onclick="return confirm('Yakin hapus user ini?')">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-600 text-center py-4 text-sm">Tidak ada data guru yang ditemukan.</p>
                        @endif

                    @elseif ($role === 'murid')
                        <div class="flex flex-col sm:flex-row items-start sm:items-center mb-5">
                            <div class="flex flex-col sm:flex-row min-w-0 items-start sm:items-center w-full sm:w-auto mb-3 sm:mb-0">
                                <h3 class="text-gray-800 text-lg lg:text-xl m-0 pb-2 relative inline-block mb-2 sm:mb-0">Data Murid
                                    <span class="absolute bottom-0 left-0 h-[2px] w-12 bg-blue-600"></span>
                                </h3>
                            </div>
                            <div class="ml-0 sm:ml-auto w-full sm:w-auto flex flex-col sm:flex-row items-start sm:items-center gap-2">
                                <form method="GET" action="{{ route('admin.ManajemenUser') }}" class="filter-form w-full sm:w-auto">
                                    <div class="flex items-center w-full">
                                        <label for="additional_filter" class="sr-only">Filter Tambahan</label>
                                        <select name="additional_filter" id="additional_filter" onchange="this.form.submit()" class="mt-4 w-full px-3 py-2 border border-gray-300 rounded-md text-sm transition duration-300 ease-in-out focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-20 bg-white appearance-none bg-no-repeat bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-[right_0.9375rem_center] min-w-0 sm:min-w-[150px]">
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
                                <a href="{{ route('admin.downloaduser', ['role' => $role]) }}" class="inline-block font-normal text-center whitespace-nowrap align-middle select-none border border-transparent px-3 py-1.5 text-sm leading-normal rounded-md transition duration-300 ease-in-out cursor-pointer text-white bg-green-600 hover:bg-green-700 w-full sm:w-auto mt-2 sm:mt-0">
                                    <i class="fa-solid fa-file-excel mr-2"></i>Unduh Data {{ $role }}
                                </a>
                            </div>
                        </div>

                        @if (isset($muridOrangTuas) && $muridOrangTuas->isNotEmpty())
                            <div class="overflow-x-auto">
                                <table class="w-full mb-0 text-gray-800 border-collapse min-w-[1000px]">
                                    <thead>
                                        <tr>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Nama</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Email</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Kelas</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Tahun Ajaran</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Semester</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">NIS</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">NSSN</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Nama Orang Tua</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Asal Sekolah</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="muridTableBody">
                                        @foreach ($muridOrangTuas as $muridOrangTua)
                                            <tr class="hover:bg-blue-600/5">
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->muridKelas->murid->profile->name }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->muridKelas->murid->profile->email }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->muridKelas->kelasTahun->kelas->nama_kelas }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->muridKelas->kelasTahun->tahunajar->tahun_ajaran }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->muridKelas->kelasTahun->tahunajar->semester }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->muridKelas->murid->nis }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->muridKelas->murid->nisn }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->orangTua->profile->name }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->muridKelas->murid->asal_sekolah }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">
                                                    <div class="flex gap-1 justify-center flex-wrap">
                                                        <a href="{{ route('admin.user.edit', ['id' => $muridOrangTua->muridKelas->murid_kelas_id, 'role' => 'murid']) }}" class="text-white bg-blue-600 border border-blue-600 px-2 py-1 text-xs rounded-md leading-normal no-underline w-14 h-7 transition duration-300 ease-in-out hover:bg-blue-700 hover:border-blue-700 hover:-translate-y-px flex items-center justify-center">
                                                            Edit
                                                        </a>
                                                        <form method="POST" action="{{ route('admin.user.delete', ['id' => $muridOrangTua->muridKelas->murid_kelas_id, 'role' => 'murid']) }}" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-white border border-red-600 bg-red-600 leading-normal px-2 py-1 rounded-md text-xs transition duration-300 ease-in-out cursor-pointer hover:bg-red-700 hover:border-red-700 hover:-translate-y-px flex items-center justify-center h-7" onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-600 text-center py-4 text-sm">Tidak ada data murid yang ditemukan.</p>
                        @endif

                    @elseif ($role === 'orang_tua')
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-5 w-full">
                        <h3 class="text-gray-800 text-lg lg:text-xl m-0 pb-2 relative inline-block text-left mb-3 sm:mb-0">Data Orang Tua
                            <span class="absolute bottom-0 left-0 h-[2px] w-12 bg-blue-600"></span>
                        </h3>
                        <div class="flex justify-end w-full sm:w-auto">
                                <a href="{{ route('admin.downloaduser', ['role' => $role]) }}" class="inline-block font-normal text-center whitespace-nowrap align-middle select-none border border-transparent px-3 py-1.5 text-sm leading-normal rounded-md transition duration-300 ease-in-out cursor-pointer text-white bg-green-600 hover:bg-green-700 w-full sm:w-auto">
                                    <i class="fa-solid fa-file-excel mr-2"></i>Unduh Data {{ $role }}
                                </a>
                        </div>
                    </div>

                        @if (isset($muridOrangTuas) && $muridOrangTuas->isNotEmpty())
                            <div class="overflow-x-auto">
                                <table class="w-full mb-0 text-gray-800 border-collapse min-w-[600px]">
                                    <thead>
                                        <tr>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Nama</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Email</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Profesi</th>
                                            <th class="py-3 px-3 align-middle border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold text-xs uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orangTuaTableBody">
                                        @foreach ($muridOrangTuas as $muridOrangTua)
                                            <tr class="hover:bg-blue-600/5">
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->orangTua->profile->name }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->orangTua->profile->email }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">{{ $muridOrangTua->orangTua->profesi }}</td>
                                                <td class="py-2 px-3 align-middle border-b border-gray-200 text-sm text-center">
                                                    <div class="flex gap-1 justify-center flex-wrap">
                                                        <a href="{{ route('admin.user.edit', ['id' => $muridOrangTua->orangTua->orang_tua_id, 'role' => 'orang_tua']) }}" class="text-white bg-blue-600 border border-blue-600 px-2 py-1 text-xs rounded-md leading-normal no-underline w-14 h-7 transition duration-300 ease-in-out hover:bg-blue-700 hover:border-blue-700 hover:-translate-y-px flex items-center justify-center">
                                                            Edit
                                                        </a>
                                                        <form method="POST" action="{{ route('admin.user.delete', ['id' => $muridOrangTua->orangTua->orang_tua_id, 'role' => 'orang_tua']) }}" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-white border border-red-600 bg-red-600 leading-normal px-2 py-1 rounded-md text-xs transition duration-300 ease-in-out cursor-pointer hover:bg-red-700 hover:border-red-700 hover:-translate-y-px flex items-center justify-center h-7" onclick="return confirm('Yakin hapus user ini?')">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-600 text-center py-4 text-sm">Tidak ada data orang tua yang ditemukan.</p>
                        @endif

                    @else
                        <p class="text-gray-600 text-center py-4 text-sm">Silakan pilih peran untuk menampilkan data user tertentu.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
        <p class="text-center text-red-600 mt-10">Anda tidak memiliki akses ke halaman ini.</p>
        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login kembali di sini</a>
        </div>
    @endif

    <script src="{{ asset('js/CssAdmin.js') }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('UserUntuk');
        const formMurid = document.getElementById('FormUntukMurid');
        const formGuru = document.getElementById('FormUntukGuru');
        const nameSearchBar = document.getElementById('nameSearchBar');
        const roleFilterSelect = document.getElementById('role_select');
        const additionalFilterSelect = document.getElementById('additional_filter');

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

        document.querySelectorAll('.custom-number-only').forEach(input => {
            input.addEventListener('input', () => {
                input.value = input.value.replace(/[^0-9]/g, '');
            });
        });

        if (nameSearchBar) {
            nameSearchBar.addEventListener('input', debounce(function() {
                performSearch();
            }, 300));

            roleFilterSelect.addEventListener('change', function() {
                this.form.submit();
            });

            if (additionalFilterSelect) {
                additionalFilterSelect.addEventListener('change', function() {
                    this.form.submit();
                });
            }
        }

        function performSearch() {
            const searchQuery = nameSearchBar.value;
            const currentRole = roleFilterSelect.value;
            
            const url = new URL(window.location.href);
            url.searchParams.set('search', searchQuery);
            url.searchParams.set('role', currentRole);

            if (additionalFilterSelect && additionalFilterSelect.value) {
                 url.searchParams.set('additional_filter', additionalFilterSelect.value);
            }

            fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); 
            })
            .then(html => {
                let targetTableBody;
                if (currentRole === 'admin') {
                    targetTableBody = document.getElementById('adminTableBody');
                } else if (currentRole === 'guru') {
                    targetTableBody = document.getElementById('guruTableBody');
                } else if (currentRole === 'murid') {
                    targetTableBody = document.getElementById('muridTableBody');
                } else if (currentRole === 'orang_tua') {
                    targetTableBody = document.getElementById('orangTuaTableBody');
                } else {
                    targetTableBody = document.querySelector('table tbody');
                }

                if (targetTableBody) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = html;
                    
                    let newTableBody;
                    if (currentRole === 'admin') {
                        newTableBody = tempDiv.querySelector('#adminTableBody');
                    } else if (currentRole === 'guru') {
                        newTableBody = tempDiv.querySelector('#guruTableBody');
                    } else if (currentRole === 'murid') {
                        newTableBody = tempDiv.querySelector('#muridTableBody');
                    } else if (currentRole === 'orang_tua') {
                        newTableBody = tempDiv.querySelector('#orangTuaTableBody');
                    } else {
                        newTableBody = tempDiv.querySelector('tbody');
                    }

                    if (newTableBody) {
                        targetTableBody.innerHTML = newTableBody.innerHTML;
                    } else {
                        targetTableBody.innerHTML = '<tr><td colspan="10" class="text-gray-600 text-center py-4">Tidak ada data yang ditemukan.</td></tr>';
                    }
                }
            })
            .catch(error => {
                console.error('Error during search:', error);
            });
        }

        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                const context = this;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), delay);
            };
        }
    });
    </script>
</body>