@include('admin.partials.header')
@include('admin.partials.sidebar')

<body class="font-sans text-gray-800 bg-blue-50">
    <div class="p-4 md:ml-64 md:p-6 flex flex-col min-h-screen">
        <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4 md:mb-6 relative pb-2 border-b-2 border-blue-500 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-blue-500">Tampilkan Nilai Murid</h1>

        <div class="flex flex-col md:flex-row md:gap-6 flex-1">
            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-1/4 flex flex-col mb-6 md:mb-0">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500">Pilih Pelajaran & Kelas</h2>
                <form method="GET" action="{{ route('admin.tampilkanNilai') }}" id="filterForm" class="space-y-4 flex-1">
                    <div class="flex flex-col gap-4">
                        <div>
                            <label for="pelajaran_id" class="block text-sm font-medium text-gray-700">Pilih Pelajaran</label>
                            <select name="pelajaran_id" id="pelajaran_id" class="w-full p-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">-- Pilih Pelajaran --</option>
                                @foreach($pelajaranList as $pelajaran)
                                    <option value="{{ $pelajaran->pelajaran_id }}" {{ $pilihanPelajaran == $pelajaran->pelajaran_id ? 'selected' : '' }}>
                                        {{ $pelajaran->namaPelajaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="kelas_tahun_id" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                            <select name="kelas_tahun_id" id="kelas_tahun_id" class="w-full p-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelasTahuns as $kelasTahun)
                                    <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ $pilihanKelasTahun == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
                                        {{ $kelasTahun->kelas->nama_kelas }} - {{ $kelasTahun->tahunajar->tahun_ajaran }} ({{ $kelasTahun->tahunajar->semester }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        @if($muridList && count($muridList) > 0)
                            <a href="{{ route('admin.export.nilai', ['kelas_tahun_id' => $pilihanKelasTahun, 'pelajaran_id' => $pilihanPelajaran]) }}" class="w-full bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 flex items-center justify-center">
                                <i class="fa-solid fa-file-excel mr-2"></i> Export Excel
                            </a>
                        @endif
                    </div>
                </form>

                @if (session()->has('success'))
                    <div class="mt-4 p-3 bg-green-100 text-green-700 text-sm rounded-md flex items-center">
                        <i class="fa-solid fa-circle-check mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-3/4 flex flex-col">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 relative pb-2 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-10 after:bg-blue-500 mb-4 md:mb-0">Daftar Nilai Murid</h2>
                    <div class="flex items-center gap-4">
                        <label for="searchInput" class="block text-sm font-medium text-gray-700 whitespace-nowrap">Cari Murid</label>
                        <input type="text" placeholder="Cari Murid" class="w-full p-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" id="searchInput">
                    </div>
                </div>

                @if($pilihanPelajaran && $pilihanKelasTahun)
                    <div class="flex flex-wrap gap-2 mb-4 p-3 bg-gray-100 rounded-md border-l-4 border-blue-500">
                        <span class="text-sm text-gray-700"><strong>Pelajaran:</strong> {{ collect($pelajaranList)->firstWhere('pelajaran_id', $pilihanPelajaran)->namaPelajaran ?? 'Tidak dipilih' }}</span>
                        <span class="text-sm text-gray-700"><strong>Kelas:</strong> {{ collect($kelasTahuns)->firstWhere('kelas_tahun_id', $pilihanKelasTahun)->kelas->nama_kelas ?? 'Tidak dipilih' }}</span>
                    </div>
                @endif

                <div class="flex-1 overflow-x-auto rounded-lg shadow-sm">
                    <table class="w-full text-sm text-gray-700" id="tabelNilai">
                        <thead class="bg-gray-100 sticky top-0">
                            <tr>
                                <th class="p-3 border-b text-center font-semibold uppercase text-xs tracking-wider">No</th>
                                <th class="p-3 border-b text-center font-semibold uppercase text-xs tracking-wider">Nama Murid</th>
                                <th class="p-3 border-b text-center font-semibold uppercase text-xs tracking-wider">Nilai Tugas</th>
                                <th class="p-3 border-b text-center font-semibold uppercase text-xs tracking-wider">Nilai UTS</th>
                                <th class="p-3 border-b text-center font-semibold uppercase text-xs tracking-wider">Nilai UAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($muridList as $index => $muridKelas)
                                <tr class="{{ $loop->odd ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors duration-200">
                                    <td class="p-3 border-b text-center">{{ $index + 1 }}</td>
                                    <td class="p-3 border-b text-center NamaMurid">{{ $muridKelas->murid->profile->name }}</td>
                                    <td class="p-3 border-b text-center">
                                        @if($muridKelas->nilai && $muridKelas->nilai->isNotEmpty())
                                            {{ $muridKelas->nilai->first()->nilai_tugas ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="p-3 border-b text-center">
                                        @if($muridKelas->nilai && $muridKelas->nilai->isNotEmpty())
                                            {{ $muridKelas->nilai->first()->nilai_uts ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="p-3 border-b text-center">
                                        @if($muridKelas->nilai && $muridKelas->nilai->isNotEmpty())
                                            {{ $muridKelas->nilai->first()->nilai_uas ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-10 text-center text-gray-500 italic bg-gray-50">
                                        <i class="fa-solid fa-clipboard-list text-4xl mb-4 opacity-50 block"></i>
                                        Silakan pilih pelajaran dan kelas untuk melihat daftar murid
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if(!$pilihanPelajaran || !$pilihanKelasTahun)
                        <table class="w-full text-sm text-gray-700 hidden" id="tabelNilaiPlaceholder">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-3 border-b text-center font-semibold uppercase text-xs tracking-wider">No</th>
                                    <th class="p-3 border-b text-center font-semibold uppercase text-xs tracking-wider">Nama Murid</th>
                                    <th class="p-3 border-b text-center font-semibold uppercase text-xs tracking-wider">Nilai Tugas</th>
                                    <th class="p-3 border-b text-center font-semibold uppercase text-xs tracking-wider">Nilai UTS</th>
                                    <th class="p-3 border-b text-center font-semibold uppercase text-xs tracking-wider">Nilai UAS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="p-10 text-center text-gray-500 italic bg-gray-50">
                                        <i class="fa-solid fa-clipboard-list text-4xl mb-4 opacity-50 block"></i>
                                        Silakan pilih pelajaran dan kelas untuk melihat daftar murid
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pelajaranSelect = document.getElementById('pelajaran_id');
            const kelasSelect = document.getElementById('kelas_tahun_id');
            const filterForm = document.getElementById('filterForm');
            const searchInput = document.getElementById('searchInput');

            function checkAndSubmit() {
                if (pelajaranSelect.value && kelasSelect.value) {
                    filterForm.submit();
                }
            }

            pelajaranSelect.addEventListener('change', checkAndSubmit);
            kelasSelect.addEventListener('change', checkAndSubmit);

            function filterTable() {
                const keyword = searchInput.value.toLowerCase();
                const rows = document.querySelectorAll('#tabelNilai tbody tr');
                
                rows.forEach(row => {
                    const namaCell = row.querySelector('.NamaMurid');
                    if (namaCell) {
                        const nama = namaCell.textContent.toLowerCase();
                        if (nama.includes(keyword)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
        });
    </script>
</body>