@include('admin.partials.header')
@include('admin.partials.sidebar')

<body class="font-sans text-gray-800 bg-blue-50">
    <div class="p-4 md:ml-64 md:p-6 flex flex-col min-h-screen">
        {{-- Adjusted after:h-1 to after:h-[2px] for thinner underline --}}
        <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4 md:mb-6 relative pb-2 border-b-2 border-blue-500 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-blue-500">Tambah Pelajaran Baru</h1>

        <div class="flex flex-col md:flex-row md:gap-6 flex-1">
            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-1/4 flex flex-col mb-6 md:mb-0">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Tambah Pelajaran</h2>
                <form action="{{ route('admin.TambahPelajaran') }}" method="POST" class="space-y-4 flex-1">
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

            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-3/4 flex flex-col">
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
                                    <td class="p-2 border-b text-center whitespace-nowrap"> {{-- Added whitespace-nowrap to keep buttons on one line on larger screens --}}
                                        {{-- Conditional classes for mobile vs. desktop button display --}}
                                        <a href="pelajaran/edit/{{ $pelajaran->pelajaran_id }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600 block w-full mb-1 md:inline md:w-auto md:mr-1 md:mb-0">Edit</a>
                                        <form action="{{ route('pelajaran.destroy', $pelajaran->pelajaran_id) }}" method="POST" class="inline-block w-full md:w-auto"> {{-- Made form inline-block for md --}}
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

<script src="{{ asset('js/CssAdmin.js') }}"></script>