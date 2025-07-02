@include('admin.partials.header')
@include('admin.partials.sidebar')

<body class="font-sans text-gray-800 bg-blue-50">
    <div class="p-4 md:ml-64 md:p-6 flex flex-col min-h-screen">
        <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4 md:mb-6 relative pb-2 border-b-2 border-blue-500 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-blue-500">Tambah Jadwal Pembelajaran</h1>

        <div class="flex flex-col md:flex-row md:gap-6 flex-1">
            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-1/4 flex flex-col mb-6 md:mb-0">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Tambah Jadwal</h2>
                <form action="{{ route('TambahJadwal.store') }}" method="POST" class="space-y-4 flex-1">
                    @csrf

                    <div>
                        <label for="pelajaran_id" class="block text-sm font-medium text-gray-700">Pelajaran</label>
                        <select name="pelajaran_id" id="pelajaran_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="" disabled selected>-- Pilih Pelajaran --</option>
                            @foreach($pelajaran as $item)
                                <option value="{{ $item->pelajaran_id }}">
                                    {{ $item->namaPelajaran }} ({{ $item->guru->profile->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="kelas_tahun_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <select name="kelas_tahun_id" id="kelas_tahun_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="" disabled selected>-- Pilih Kelas --</option>
                            @foreach($kelasTahun as $item)
                                <option value="{{ $item->kelas_tahun_id }}">
                                    {{ $item->kelas->nama_kelas }} ({{ $item->TahunAjar->tahun_ajaran }}) {{ $item->TahunAjar->status }}
                                </option>
                            @endforeach
                        </select>
                        @error('namaPelajaran')
                            <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                        <select name="hari" id="hari" class="w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="" disabled selected>-- Pilih Hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>

                    <div>
                        <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" id="waktu_mulai" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" id="waktu_selesai" class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 block mx-auto mt-auto">Tambah Jadwal</button>
                </form>

                @if(session('success'))
                    <div class="mt-2 p-2 bg-green-100 text-green-700 text-sm rounded-md">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-3/4 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Jadwal Pembelajaran</h2>
                    <a href="{{ route('admin.export') }}" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm hover:bg-green-700 flex items-center">
                        <i class="fa-solid fa-file-excel mr-2"></i> Unduh Jadwal
                    </a>
                </div>

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
                                <th class="p-2 border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwals as $jadwal)
                                <tr class="{{ $loop->odd ? 'bg-gray-100' : 'bg-white' }}">
                                    <td class="p-2 border-b text-center">{{ $jadwal->pelajaran->namaPelajaran }}</td>
                                    <td class="p-2 border-b text-center">{{ $jadwal->kelasTahun->kelas->nama_kelas }}</td>
                                    <td class="p-2 border-b text-center">{{ $jadwal->hari }}</td>
                                    <td class="p-2 border-b text-center">{{ $jadwal->waktu_mulai }}</td>
                                    <td class="p-2 border-b text-center">{{ $jadwal->waktu_selesai }}</td>
                                    <td class="p-2 border-b text-center">{{ $jadwal->pelajaran->guru->profile->name }}</td>
                                    <td class="p-2 border-b text-center whitespace-nowrap">
                                        <a href="jadwal/edit/{{ $jadwal->jadwal_id }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600 block w-full mb-1 md:inline md:w-auto md:mr-1 md:mb-0">Edit</a>
                                        <form action="{{ route('jadwal.destroy', $jadwal->jadwal_id) }}" method="POST" class="inline-block w-full md:w-auto">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600 block w-full md:inline md:w-auto">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>