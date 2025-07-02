@include('partials.header', ['NamaPage' => 'Register'])

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="relative bg-cover bg-center" style="background-image: url('/image/imageSekolah.png');">
        <div class="absolute inset-0 bg-white opacity-80 z-0"></div>

        <div class="relative z-10 container mx-auto px-4 py-8 md:py-12 lg:py-16">
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl p-6 sm:p-8 md:p-10 lg:p-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Form Registrasi Murid & Orang Tua</h2>
                    <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-semibold hover:bg-blue-700 transition duration-200 ease-in-out">
                        Kembali
                    </a>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf

                    <h3 class="text-xl sm:text-2xl font-semibold mb-6 text-gray-700 border-b pb-2">Data Murid</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Nama Murid</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="name" name="name" value="{{ old('name') }}" required />
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email Murid</label>
                            <input type="email" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="email" name="email" value="{{ old('email') }}" required />
                        </div>
                        <div>
                            <label for="alamat" class="block text-gray-700 text-sm font-medium mb-2">Alamat</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="alamat" name="alamat" value="{{ old('alamat') }}" required />
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="block text-gray-700 text-sm font-medium mb-2">Jenis Kelamin</label>
                            <select class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-gray-700 text-sm font-medium mb-2">Tanggal Lahir</label>
                            <input type="date" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required />
                        </div>
                        <div>
                            <label for="tempat_lahir" class="block text-gray-700 text-sm font-medium mb-2">Tempat Lahir</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required />
                        </div>
                        <div>
                            <label for="pendidikan" class="block text-gray-700 text-sm font-medium mb-2">Pendidikan</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}" required />
                        </div>
                        <div>
                            <label for="no_telp" class="block text-gray-700 text-sm font-medium mb-2">No. Telp</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required />
                        </div>
                    </div>

                    <h3 class="text-xl sm:text-2xl font-semibold mb-6 text-gray-700 border-b pb-2">Data Murid Tambahan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="asal_sekolah" class="block text-gray-700 text-sm font-medium mb-2">Asal Sekolah</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required />
                        </div>
                        <div>
                            <label for="nis" class="block text-gray-700 text-sm font-medium mb-2">NIS</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="nis" name="nis" value="{{ old('nis') }}" required />
                        </div>
                        <div>
                            <label for="nisn" class="block text-gray-700 text-sm font-medium mb-2">NISN</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="nisn" name="nisn" value="{{ old('nisn') }}" required />
                        </div>
                        <div>
                            <label for="kelas_tahun_id" class="block text-gray-700 text-sm font-medium mb-2">Kelas Tahun</label>
                            <select class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="kelas_tahun_id" name="kelas_tahun_id" required>
                                <option value="">-- Pilih --</option>
                                @foreach($kelasTahunList as $kelasTahun)
                                    <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ old('kelas_tahun_id') == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
                                        {{ $kelasTahun->kelas->nama_kelas ?? 'Kelas' }} - {{ $kelasTahun->tahunAjar->tahun_ajaran ?? 'Tahun Ajaran' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <h3 class="text-xl sm:text-2xl font-semibold mb-6 text-gray-700 border-b pb-2">Data Orang Tua</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="ortu_name" class="block text-gray-700 text-sm font-medium mb-2">Nama Orang Tua</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="ortu_name" name="ortu_name" value="{{ old('ortu_name') }}" required />
                        </div>
                        <div>
                            <label for="ortu_email" class="block text-gray-700 text-sm font-medium mb-2">Email Orang Tua</label>
                            <input type="email" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="ortu_email" name="ortu_email" value="{{ old('ortu_email') }}" required />
                        </div>
                        <div>
                            <label for="ortu_alamat" class="block text-gray-700 text-sm font-medium mb-2">Alamat Orang Tua</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="ortu_alamat" name="ortu_alamat" value="{{ old('ortu_alamat') }}" required />
                        </div>
                        <div>
                            <label for="ortu_tempat_lahir" class="block text-gray-700 text-sm font-medium mb-2">Tempat Lahir Orang Tua</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="ortu_tempat_lahir" name="ortu_tempat_lahir" value="{{ old('ortu_tempat_lahir') }}" required />
                        </div>
                        <div>
                            <label for="ortu_tanggal_lahir" class="block text-gray-700 text-sm font-medium mb-2">Tanggal Lahir Orang Tua</label>
                            <input type="date" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="ortu_tanggal_lahir" name="ortu_tanggal_lahir" value="{{ old('ortu_tanggal_lahir') }}" required />
                        </div>
                        <div>
                            <label for="ortu_jenis_kelamin" class="block text-gray-700 text-sm font-medium mb-2">Jenis Kelamin Orang Tua</label>
                            <select class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="ortu_jenis_kelamin" name="ortu_jenis_kelamin" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('ortu_jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('ortu_jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="ortu_pendidikan" class="block text-gray-700 text-sm font-medium mb-2">Pendidikan Orang Tua</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="ortu_pendidikan" name="ortu_pendidikan" value="{{ old('ortu_pendidikan') }}" required />
                        </div>
                        <div>
                            <label for="ortu_no_telp" class="block text-gray-700 text-sm font-medium mb-2">No. Telp Orang Tua</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="ortu_no_telp" name="ortu_no_telp" value="{{ old('ortu_no_telp') }}" required />
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label for="ortu_profesi" class="block text-gray-700 text-sm font-medium mb-2">Profesi Orang Tua</label>
                            <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="ortu_profesi" name="ortu_profesi" value="{{ old('ortu_profesi') }}" required />
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 ease-in-out">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

@include('partials.footer')