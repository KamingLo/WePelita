@include('murid.partials.header')
@include('murid.partials.sidebar')

<body class="font-sans text-gray-700 m-0 p-0 overflow-x-hidden md:overflow-x-auto">
    <div class="md:ml-[256px] px-4 md:px-8 py-8 flex flex-wrap gap-8">
        <h1 class="w-full text-gray-800 mb-2 text-2xl font-bold relative pb-2 md:mt-0">
            Jadwal Pelajaran
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
        </h1>

        @php
            $muridKelas = App\Models\MuridKelas::where('murid_id', $murid->murid_id)
                ->whereHas('kelasTahun.tahunajar', function ($query) {
                    $query->where('status', 'Aktif');
                })
                ->with('kelasTahun.kelas', 'kelasTahun.tahunajar')
                ->first();
            $kelasName = $muridKelas ? $muridKelas->kelasTahun->kelas->nama_kelas . ' (' . $muridKelas->kelasTahun->tahunajar->tahun_ajaran . ')' : 'No class assigned';
            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
            $selectedDays = request()->input('hari', []);
        @endphp

        <div class="w-full bg-white p-4 md:p-6 rounded-lg shadow-md max-h-[600px] flex flex-col md:min-h-[80vh]">
            <div class="flex flex-col md:flex-row md:items-center mb-5">
                <h2 class="text-gray-800 text-xl relative pb-2 mb-4 md:mb-0 md:mr-auto">
                    Jadwal Kelas: {{ $kelasName }}
                    <span class="absolute left-0 bottom-0 h-0.5 w-10 bg-blue-600"></span>
                </h2>
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                    <div class="flex flex-row gap-4 w-full">
                        <a href="{{ route('murid.export') }}" class="inline-block px-10 py-2 bg-green-600 border border-green-600 text-white rounded-md transition duration-300 ease-in-out hover:bg-green-700 hover:border-green-700 w-full md:w-auto text-center h-10 flex items-center justify-center min-w-[190px]">Unduh Jadwal</a>
                        <div class="relative inline-block w-full">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md cursor-pointer text-sm h-10 transition duration-300 ease-in-out hover:bg-blue-700 w-full" onclick="toggleDropdown(event)">Filter Hari</button>
                            <form action="{{ route('murid.jadwal') }}" method="GET" id="filterForm">
                                <div class="FilterDropdown hidden absolute top-full md:right-0 mt-3 bg-white border border-gray-200 rounded-md shadow-lg z-20 min-w-[150px] py-2 w-full md:w-auto" id="filterDropdown">
                                    @foreach($days as $day)
                                        <label class="flex items-center px-6 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-50">
                                            <input type="checkbox" name="hari[]" value="{{ $day }}" {{ in_array($day, $selectedDays) ? 'checked' : '' }} class="mr-2">
                                            {{ $day }}
                                        </label>
                                    @endforeach
                                    <button type="submit" class="block w-11/12 mx-auto my-2 p-2 bg-blue-600 text-white border-none rounded-md cursor-pointer text-sm transition duration-300 ease-in-out hover:bg-blue-700">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-y-auto overflow-x-auto flex-1">
                @if($jadwals->isNotEmpty())
                    <table class="w-full mb-4 text-gray-800 border-collapse table-auto">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 text-center align-bottom border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold uppercase text-xs tracking-wide sticky top-0 z-10 shadow-sm whitespace-nowrap">Hari</th>
                                <th class="py-3 px-4 text-center align-bottom border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold uppercase text-xs tracking-wide sticky top-0 z-10 shadow-sm whitespace-nowrap">Mata Pelajaran</th>
                                <th class="py-3 px-4 text-center align-bottom border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold uppercase text-xs tracking-wide sticky top-0 z-10 shadow-sm whitespace-nowrap">Guru</th>
                                <th class="py-3 px-4 text-center align-bottom border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold uppercase text-xs tracking-wide sticky top-0 z-10 shadow-sm whitespace-nowrap">Waktu Mulai</th>
                                <th class="py-3 px-4 text-center align-bottom border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold uppercase text-xs tracking-wide sticky top-0 z-10 shadow-sm whitespace-nowrap">Waktu Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwals as $jadwal)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 align-middle border-t border-gray-200 text-sm text-center whitespace-nowrap">{{ $jadwal->hari }}</td>
                                    <td class="py-3 px-4 align-middle border-t border-gray-200 text-sm text-center whitespace-nowrap">{{ $jadwal->pelajaran->namaPelajaran }}</td>
                                    <td class="py-3 px-4 align-middle border-t border-gray-200 text-sm text-center whitespace-nowrap">{{ $jadwal->pelajaran->guru->profile->name }}</td>
                                    <td class="py-3 px-4 align-middle border-t border-gray-200 text-sm text-center whitespace-nowrap">{{ $jadwal->waktu_mulai }}</td>
                                    <td class="py-3 px-4 align-middle border-t border-gray-200 text-sm text-center whitespace-nowrap">{{ $jadwal->waktu_selesai }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="p-4">Tidak ada jadwal pelajaran tersedia untuk kelas ini.</p>
                @endif
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('js/CssAdmin.js') }}"></script>
<script>
    let dropdownOpen = false;

    function toggleDropdown(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('filterDropdown');
        dropdownOpen = !dropdownOpen;
        dropdown.classList.toggle('hidden', !dropdownOpen);
    }

    document.querySelectorAll('.OpsiFilter input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });

    window.onclick = function(event) {
        const dropdown = document.getElementById('filterDropdown');
        const button = document.querySelector('.TombolFilter');
        if (dropdownOpen && !button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
            dropdownOpen = false;
        }
    };

    document.getElementById('filterForm').addEventListener('submit', function() {
        const dropdown = document.getElementById('filterDropdown');
        dropdown.classList.add('hidden');
        dropdownOpen = false;
    });
</script>