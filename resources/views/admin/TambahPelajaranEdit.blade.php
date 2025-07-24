@include('admin.partials.header')
@include('admin.partials.sidebar')

<body class="font-sans text-gray-800 bg-blue-50">
    <div id="main-content" class="px-4 md:px-8 py-8 flex flex-col gap-8 transition-all duration-400 ease-in-out">
        <h1 class="text-gray-800 mb-2 text-2xl font-bold relative pb-2">
            Edit Pelajaran
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
        </h1>

        <div class="flex flex-col md:flex-row md:gap-6 flex-1">
            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-1/3 flex flex-col mb-6 md:mb-0 md:h-[calc(100vh-10rem)]">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Form Edit Pelajaran</h2>
                <form action="{{ route('pelajaran.update', ['id' => $pelajaran->pelajaran_id]) }}" method="POST" class="space-y-4 flex-1 overflow-y-auto">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="guru_id" class="block text-sm font-medium text-gray-700 -mt-5">Guru</label>
                        <select name="guru_id" id="guru_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->guru_id }}"
                                    {{ (old('guru_id') ?? $pelajaran->guru_id) == $guru->guru_id ? 'selected' : '' }}>
                                    {{ $guru->profile->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('guru_id')
                            <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="relative flex-1">
                        <label for="namaPelajaran" class="block text-sm font-medium text-gray-700">Nama Pelajaran</label>
                        <input type="text" name="namaPelajaran" id="namaPelajaran" class="w-full p-2 border border-gray-300 rounded-md"
                            placeholder="Masukkan nama pelajaran" required
                            value="{{ old('namaPelajaran') ?? $pelajaran->namaPelajaran }}">
                        @error('namaPelajaran')
                            <div class="mt-2 p-2 bg-red-100 text-red-700 text-sm rounded-md">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex flex-col space-y-2 md:flex-row md:space-x-2 md:space-y-0 mt-auto">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 w-full md:w-auto">
                            Simpan Pelajaran
                        </button>
                        <a href="{{ route('admin.TambahPelajaran') }}" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 text-center w-full md:w-auto">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-2/3 flex flex-col">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Data Pelajaran</h2>
                <div class="flex-1 overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 border-b text-center">Nama Guru</th>
                                <th class="p-2 border-b text-center">Mata Pelajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-2 border-b text-center">{{ $pelajaran->guru->profile->name }}</td>
                                <td class="p-2 border-b text-center">{{ $pelajaran->namaPelajaran }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('js/CssAdmin.js') }}"></script>