@include('admin.partials.header')
@include('admin.partials.sidebar')

<body class="font-sans text-gray-800 bg-blue-50 h-screen">
    <div class="p-4 md:ml-64 md:p-6 flex flex-col h-full">
        <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4 md:mb-6 relative pb-2 border-b-2 border-blue-500 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-blue-500 w-full">Manajemen Kelas</h1>

        <div class="flex flex-col md:flex-row justify-between items-center w-full mb-4">
            <div class="flex gap-2">
                <button class="px-4 py-2 border-none bg-gray-200 rounded-full cursor-pointer text-sm transition-all duration-300 ease-in-out" onclick="switchTab('manajemen')" id="tabManajemen">
                    Manajemen Kelas
                </button>
                <button class="px-4 py-2 border-none bg-gray-200 rounded-full cursor-pointer text-sm transition-all duration-300 ease-in-out" onclick="switchTab('kenaikan')" id="tabKenaikan">
                    Kenaikan Kelas
                </button>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:gap-6 flex-1 h-full">
            <div class="w-full md:w-1/4 flex flex-col h-full mb-6">
                <div id="manajemenFormWrapper" class="bg-white p-4 rounded-lg shadow-md flex flex-col h-full">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Tambah Kelas</h2>
                    <form action="{{ route('admin.tambahKelas') }}" method="POST" class="space-y-4 flex-1 overflow-y-auto" style="max-height: calc(100vh - 20rem);">
                        @csrf
                        <div>
                            <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                            <div class="relative">
                                <input type="text" name="nama_kelas" id="nama_kelas" class="w-full p-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Masukkan nama kelas" required>
                                <button type="button" id="clearNamaKelas" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="tahunAjar" class="block text-sm font-medium text-gray-700">Tahun ajar</label>
                            <select name="tahun_ajar" id="tahunAjar" class="w-full p-2 border border-gray-300 rounded-md appearance-none bg-no-repeat bg-right pr-8" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E');" required>
                                <option value="{{ (now()->year) }}/{{ (now()->year)+1}}">{{ (now()->year) }}/{{ (now()->year)+1}}</option>
                                <option value="{{ (now()->year)-1 }}/{{ (now()->year)}}">{{ (now()->year)-1 }}/{{ (now()->year)}}</option>
                                <option value="{{ (now()->year)-2 }}/{{ (now()->year)-1}}">{{ (now()->year)-2 }}/{{ (now()->year)-1}}</option>
                            </select>
                        </div>

                        <div>
                            <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                            <select name="semester" id="semester" class="w-full p-2 border border-gray-300 rounded-md appearance-none bg-no-repeat bg-right pr-8" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E');" required>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 block mx-auto mt-auto">
                            Tambah Kelas Baru
                        </button>
                        @error('nama_kelas')
                            <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                        @enderror
                        @error('tahun_ajar')
                            <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                        @enderror
                        @error('semester')
                            <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                        @endif
                        @if(session('success'))
                            <div class="mt-2 p-2 bg-green-100 text-green-700 text-sm rounded-md">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->has('jadwal'))
                            <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">
                                {{ $errors->first('jadwal') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>

                <div id="kenaikanFormWrapper" class="bg-white p-4 rounded-lg shadow-md flex flex-col hidden h-full">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Form Kenaikan Kelas</h2>
                    <form action="{{ route('admin.prosesKenaikanKelas') }}" method="POST" class="space-y-4 flex-1 overflow-y-auto" style="max-height: calc(100vh - 20rem);">
                        @csrf
                        <div>
                            <label for="kelas_asal" class="block text-sm font-medium text-gray-700">Kelas Asal</label>
                            <select name="kelas_asal" id="kelas_asal" class="w-full p-2 border border-gray-300 rounded-md appearance-none bg-no-repeat bg-right pr-8" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E');" required>
                                <option value="" disabled {{ old('kelas_asal') ? '' : 'selected' }}>-- Pilih Kelas Asal --</option>
                                @if(isset($kelasSekarang) && $kelasSekarang->isNotEmpty())
                                    @foreach($kelasSekarang as $kelas)
                                        <option value="{{ $kelas->kelas_tahun_id }}" {{ old('kelas_asal') == $kelas->kelas_tahun_id ? 'selected' : '' }}>
                                            {{ $kelas->kelas->nama_kelas }} - {{ $kelas->tahunajar->tahun_ajaran }} {{ $kelas->tahunajar->semester }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>Tidak ada kelas aktif</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label for="kelas_tujuan" class="block text-sm font-medium text-gray-700">Kelas Tujuan</label>
                            <select name="kelas_tujuan" id="kelas_tujuan" class="w-full p-2 border border-gray-300 rounded-md appearance-none bg-no-repeat bg-right pr-8" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E');" required>
                                <option value="" disabled {{ old('kelas_tujuan') ? '' : 'selected' }}>-- Pilih Kelas Tujuan --</option>
                                @if(isset($semuaKelas) && $semuaKelas->isNotEmpty())
                                    @foreach($semuaKelas as $kelas)
                                        <option value="{{ $kelas->kelas_id }}" {{ old('kelas_tujuan') == $kelas->kelas_id ? 'selected' : '' }}>
                                            {{ $kelas->nama_kelas }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>Tidak ada kelas tersedia</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label for="tahun_ajaran_kenaikan" class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                            <select name="tahun_ajaran" id="tahun_ajaran_kenaikan" class="w-full p-2 border border-gray-300 rounded-md appearance-none bg-no-repeat bg-right pr-8" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E');" required>
                                <option value="{{ now()->year }}/{{ now()->year + 1 }}" {{ old('tahun_ajaran') == now()->year . '/' . (now()->year + 1) ? 'selected' : '' }}>
                                    {{ now()->year }}/{{ now()->year + 1 }}
                                </option>
                                <option value="{{ now()->year - 1 }}/{{ now()->year }}" {{ old('tahun_ajaran') == (now()->year - 1) . '/' . now()->year ? 'selected' : '' }}>
                                    {{ now()->year - 1 }}/{{ now()->year }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="semester_kenaikan" class="block text-sm font-medium text-gray-700">Semester</label>
                            <select name="semester" id="semester_kenaikan" class="w-full p-2 border border-gray-300 rounded-md appearance-none bg-no-repeat bg-right pr-8" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E');" required>
                                <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                            </select>
                        </div>
                        <div class="text-center mt-8">
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">
                                Proses Kenaikan Kelas
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-3/4 flex flex-col h-full">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Semua Kelas</h2>
                <div class="overflow-x-auto flex-1">
                    <div class="h-full overflow-y-auto" style="max-height: calc(100vh - 20rem);">
                        <table class="min-w-full text-sm text-gray-700">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-2 border-b text-center sticky top-0 bg-gray-100">Nama kelas</th>
                                    <th class="p-2 border-b text-center sticky top-0 bg-gray-100">Tahun ajaran</th>
                                    <th class="p-2 border-b text-center sticky top-0 bg-gray-100">Semester</th>
                                    <th class="p-2 border-b text-center sticky top-0 bg-gray-100">Status</th>
                                    <th class="p-2 border-b text-center sticky top-0 bg-gray-100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($kelastahuns))
                                    @foreach($kelastahuns as $kelastahun)
                                        <tr class="{{ $loop->odd ? 'bg-gray-100' : 'bg-white' }}">
                                            <td class="p-2 border-b text-center">{{ $kelastahun->kelas->nama_kelas ?? 'N/A' }}</td>
                                            <td class="p-2 border-b text-center">{{ $kelastahun->tahunajar->tahun_ajaran ?? 'N/A' }}</td>
                                            <td class="p-2 border-b text-center">{{ $kelastahun->tahunajar->semester ?? 'N/A' }}</td>
                                            <td class="p-2 border-b text-center">{{ $kelastahun->tahunajar->status ?? 'N/A' }}</td>
                                            <td class="p-2 border-b text-center whitespace-nowrap">
                                                <div class="flex flex-col items-center justify-center gap-2">
                                                    <a href="manajemenKelas/edit/{{ $kelastahun->kelas_tahun_id }}" class="bg-blue-500 text-white px-3 py-1.5 rounded text-xs hover:bg-blue-600 w-[60px] text-center mb-1">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('kelas.destroy', $kelastahun->kelas_tahun_id) }}" method="POST" class="w-[60px]">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded text-xs hover:bg-red-600 w-full text-center">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="5" class="p-2 border-b text-center">Tidak ada data kelas.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-5"></div>
    </div>
</body>

<script>
    function switchTab(tabId) {
        document.getElementById('tabManajemen').classList.remove('bg-blue-500', 'text-white');
        document.getElementById('tabManajemen').classList.add('bg-gray-200');
        document.getElementById('tabKenaikan').classList.remove('bg-blue-500', 'text-white');
        document.getElementById('tabKenaikan').classList.add('bg-gray-200');

        document.getElementById('manajemenFormWrapper').classList.add('hidden');
        document.getElementById('kenaikanFormWrapper').classList.add('hidden');

        if (tabId === 'manajemen') {
            document.getElementById('tabManajemen').classList.add('bg-blue-500', 'text-white');
            document.getElementById('tabManajemen').classList.remove('bg-gray-200');
            document.getElementById('manajemenFormWrapper').classList.remove('hidden');
        } else if (tabId === 'kenaikan') {
            document.getElementById('tabKenaikan').classList.add('bg-blue-500', 'text-white');
            document.getElementById('tabKenaikan').classList.remove('bg-gray-200');
            document.getElementById('kenaikanFormWrapper').classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const oldKelasAsal = document.getElementById('kelas_asal');
        const oldKelasTujuan = document.getElementById('kelas_tujuan');

        const kenaikanErrorsExist = document.querySelector('#kenaikanFormWrapper .bg-red-100') !== null;
        const hasOldInput = (oldKelasAsal && oldKelasAsal.value) || (oldKelasTujuan && oldKelasTujuan.value);

        if (kenaikanErrorsExist || hasOldInput) {
            switchTab('kenaikan');
        } else {
            switchTab('manajemen');
        }

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