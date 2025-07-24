@include('admin.partials.header')
@include('admin.partials.sidebar')

<body class="font-sans text-gray-800 bg-blue-50">
    <div id="main-content" class="p-4 md:ml-64 md:p-6 flex flex-col min-h-screen transition-all duration-400 ease-in-out">
        <h1 class="text-gray-800 mb-2 text-2xl font-bold relative pb-2">
            Edit Jadwal Pembelajaran
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
        </h1>
        
        <div class="flex flex-col md:flex-row md:gap-6 flex-1 mt-5">
            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-1/3 flex flex-col mb-6 md:mb-0 md:h-[calc(100vh-7rem)]">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Edit Jadwal</h2>
                <form action="{{ route('jadwal.update', ['id' => $jadwal->jadwal_id]) }}" method="POST" class="space-y-4 flex-1 overflow-y-auto">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="pelajaran_id" class="block text-sm font-medium text-gray-700">Pelajaran</label>
                        <select name="pelajaran_id" id="pelajaran_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="" disabled selected>-- Pilih Pelajaran --</option>
                            @foreach($pelajaran as $item)
                                <option value="{{ $item->pelajaran_id }}"
                                    {{ old('pelajaran_id', $jadwal->pelajaran_id) == $item->pelajaran_id ? 'selected' : '' }}>
                                    {{ $item->namaPelajaran }} ({{ $item->guru->profile->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="kelas_tahun_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <select name="kelas_tahun_id" id="kelas_tahun_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="" disabled selected>-- Pilih Kelas --</option>
                            @foreach($kelas as $item)
                                <option value="{{ $item->kelas_tahun_id }}"
                                    {{ old('kelas_tahun_id', $jadwal->kelasTahun->kelas_tahun_id) == $item->kelas_tahun_id ? 'selected' : '' }}>
                                    {{ $item->kelas->nama_kelas }} ({{ $item->TahunAjar->tahun_ajaran }}) {{ $item->TahunAjar->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                        <select name="hari" id="hari" class="w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="" disabled selected>-- Pilih Hari --</option>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $day)
                                <option value="{{ $day }}"
                                    {{ old('hari', $jadwal->hari) == $day ? 'selected' : '' }}>
                                    {{ $day }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" id="waktu_mulai" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('waktu_mulai', $jadwal->waktu_mulai) }}" required>
                    </div>

                    <div>
                        <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" id="waktu_selesai" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('waktu_selesai', $jadwal->waktu_selesai) }}" required>
                    </div>

                    <div class="flex gap-4 mt-auto">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 flex-1">
                            Simpan Jadwal
                        </button>
                        <a href="{{ route('admin.TambahJadwal') }}" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 flex-1 text-center">Batal</a>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-2/3 flex flex-col">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Detail Jadwal</h2>
                <div class="flex-1 overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 border-b text-center">Pelajaran</th>
                                <th class="p-2 border-b text-center">Kelas</th>
                                <th class="p-2 border-b text-center">Hari</th>
                                <th class="p-2 border-b text-center">Waktu Mulai</th>
                                <th class="p-2 border-b text-center">Waktu Selesai</th>
                                <th class="p-2 border-b text-center">Guru Pengajar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white">
                                <td class="p-2 border-b text-center">{{ $jadwal->pelajaran->namaPelajaran }}</td>
                                <td class="p-2 border-b text-center">{{ $jadwal->kelasTahun->kelas->nama_kelas }}</td>
                                <td class="p-2 border-b text-center">{{ $jadwal->hari }}</td>
                                <td class="p-2 border-b text-center">{{ $jadwal->waktu_mulai }}</td>
                                <td class="p-2 border-b text-center">{{ $jadwal->waktu_selesai }}</td>
                                <td class="p-2 border-b text-center">{{ $jadwal->pelajaran->guru->profile->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>