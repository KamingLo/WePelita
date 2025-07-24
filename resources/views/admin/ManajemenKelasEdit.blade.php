@include('admin.partials.header')
@include('admin.partials.sidebar')

<body class="font-sans text-gray-800 m-0 p-0 overflow-x-hidden md:overflow-x-auto">
    <div id="main-content" class="px-4 md:px-8 py-8 flex flex-col gap-8 transition-all duration-400 ease-in-out">
        <h1 class="text-gray-800 mb-2 text-2xl font-bold relative pb-2">
            Manajemen Kelas
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
        </h1>

        <div class="flex flex-col md:flex-row md:gap-6 flex-1">
            <div class="w-full md:w-1/3 flex flex-col mb-6">
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col h-full md:h-[calc(100vh-12rem)]">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-600">Edit Kelas</h2>
                    <form action="{{ route('kelas.update', $kelastahun->kelas_tahun_id) }}" method="POST" class="space-y-4 flex-1 overflow-y-auto" style="max-height: calc(100vh - 20rem);">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                            <div class="relative">
                                <input type="text" name="nama_kelas" id="nama_kelas" class="w-full p-2 border border-gray-300 rounded-md focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Masukkan nama kelas" value="{{ $kelastahun->kelas->nama_kelas }}" required>
                                <button type="button" id="clearNamaKelas" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            @error('nama_kelas')
                                <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="tahunAjar" class="block text-sm font-medium text-gray-700">Tahun Ajar</label>
                            <select name="tahun_ajaran" id="tahunAjar" class="w-full p-2 border border-gray-300 rounded-md appearance-none bg-no-repeat bg-right pr-8 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E');" required>
                                <option value="{{ (now()->year) }}/{{ (now()->year)+1}}" {{ $kelastahun->tahunajar->tahun_ajaran == (now()->year) . '/' . (now()->year)+1 ? 'selected' : '' }}>{{ (now()->year) }}/{{ (now()->year)+1}}</option>
                                <option value="{{ (now()->year)-1 }}/{{ (now()->year)}}" {{ $kelastahun->tahunajar->tahun_ajaran == (now()->year)-1 . '/' . (now()->year) ? 'selected' : '' }}>{{ (now()->year)-1 }}/{{ (now()->year)}}</option>
                                <option value="{{ (now()->year)-2 }}/{{ (now()->year)-1}}" {{ $kelastahun->tahunajar->tahun_ajaran == (now()->year)-2 . '/' . (now()->year)-1 ? 'selected' : '' }}>{{ (now()->year)-2 }}/{{ (now()->year)-1}}</option>
                            </select>
                            @error('tahun_ajaran')
                                <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                            <select name="semester" id="semester" class="w-full p-2 border border-gray-300 rounded-md appearance-none bg-no-repeat bg-right pr-8 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E');" required>
                                <option value="Ganjil" {{ $kelastahun->tahunajar->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                <option value="Genap" {{ $kelastahun->tahunajar->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                            </select>
                            @error('semester')
                                <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded-md appearance-none bg-no-repeat bg-right pr-8 focus:border-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E');" required>
                                <option value="Aktif" {{ $kelastahun->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ $kelastahun->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex justify-start gap-4 mt-6">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.manajemenKelas') }}" class="bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-700">Batal</a>
                        </div>
                        
                        @if(session('success'))
                            <div class="mt-2 p-2 bg-green-100 text-green-700 text-sm rounded-md">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->has('kelas'))
                            <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">
                                {{ $errors->first('kelas') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-2/3 flex flex-col h-full md:h-[calc(100vh-12rem)]"">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-600">Detail Kelas</h2>
                <div class="overflow-x-auto flex-1">
                    <div class="h-full overflow-y-auto" style="max-height: calc(100vh - 20rem);">
                        <table class="min-w-full text-sm text-gray-700">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-2 border-b text-center sticky top-0 bg-gray-100">Nama kelas</th>
                                    <th class="p-2 border-b text-center sticky top-0 bg-gray-100">Tahun ajaran</th>
                                    <th class="p-2 border-b text-center sticky top-0 bg-gray-100">Semester</th>
                                    <th class="p-2 border-b text-center sticky top-0 bg-gray-100">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-gray-100">
                                    <td class="p-2 border-b text-center">{{ $kelastahun->kelas->nama_kelas}}</td>
                                    <td class="p-2 border-b text-center">{{ $kelastahun->tahunajar->tahun_ajaran }}</td>
                                    <td class="p-2 border-b text-center">{{ $kelastahun->tahunajar->semester}}</td>
                                    <td class="p-2 border-b text-center">{{ $kelastahun->tahunajar->status}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const namaKelasInput = document.getElementById('nama_kelas');
            const clearNamaKelasButton = document.getElementById('clearNamaKelas');

            if (namaKelasInput && clearNamaKelasButton) {
                clearNamaKelasButton.addEventListener('click', () => {
                    namaKelasInput.value = '';
                    namaKelasInput.focus();
                });
            }
        });
    </script>
</body>