@include('admin.partials.header')
@include('admin.partials.sidebar')

<body class="font-sans text-gray-800 bg-blue-50">
    <div id="main-content" class="px-4 md:px-8 py-8 flex flex-col gap-8 transition-all duration-400 ease-in-out">
        <h1 class="text-gray-800 mb-2 text-2xl font-bold relative pb-2">
            Tambah Pelajaran Baru
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
        </h1>

        <div class="flex flex-col md:flex-row md:gap-6 flex-1">
            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-1/3 flex flex-col mb-6 md:mb-0 md:h-[calc(100vh-10rem)]">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Tambah Pelajaran</h2>
                <form action="{{ route('admin.TambahPelajaran') }}" method="POST" class="space-y-4 flex-1 overflow-y-auto">
                    @csrf
                    <div>
                        <label for="guru_id" class="block text-sm font-medium text-gray-700">Guru</label>
                        <select name="guru_id" id="guru_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="" disabled selected>-- Pilih Guru --</option>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->guru_id }}">{{ $guru->profile->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative flex-1">
                        <label for="namaPelajaran" class="block text-sm font-medium text-gray-700">Nama Pelajaran</label>
                        <input type="text" name="namaPelajaran" id="namaPelajaran" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Masukkan nama pelajaran" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 block mx-auto mt-auto">Tambah Pelajaran</button>

                    @error('guru_id')
                        <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                    @enderror
                    @error('namaPelajaran')
                        <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                    @enderror
                    @if(session('success'))
                        <div class="mt-2 p-2 bg-green-100 text-green-700 text-sm rounded-md">{{ session('success') }}</div>
                    @endif
                </form>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-2/3 flex flex-col">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Daftar Pelajaran</h2>
                <div class="flex-1 overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 border-b text-center">Nama Guru</th>
                                <th class="p-2 border-b text-center">Mata Pelajaran</th>
                                <th class="p-2 border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelajarans as $pelajaran)
                                <tr class="{{ $loop->odd ? 'bg-gray-100' : 'bg-white' }}">
                                    <td class="p-2 border-b text-center">{{ $pelajaran->guru->profile->name }}</td>
                                    <td class="p-2 border-b text-center">{{ $pelajaran->namaPelajaran }}</td>
                                    <td class="p-2 border-b text-center whitespace-nowrap">
                                        <div class="flex flex-col items-center justify-center gap-2 mt-2">
                                            <a href="pelajaran/edit/{{ $pelajaran->pelajaran_id }}" class="bg-blue-600 text-white px-3 py-1.5 rounded text-xs hover:bg-blue-700 w-[60px] text-center mb-1">Edit</a>
                                            <form action="{{ route('pelajaran.destroy', $pelajaran->pelajaran_id) }}" method="POST" class="inline-block w-full md:w-auto">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded text-xs hover:bg-red-700 w-full text-center">Hapus</button>
                                            </form>
                                        </div>
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

<script src="{{ asset('js/CssAdmin.js') }}"></script>