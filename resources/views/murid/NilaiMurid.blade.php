@include('murid.partials.header')
@include('murid.partials.sidebar')

<body class="font-sans text-gray-700 m-0 p-0 overflow-x-hidden md:overflow-x-auto">
    <div class="md:ml-[256px] px-4 md:px-8 py-8 flex flex-wrap gap-8">
        <h1 class="w-full text-gray-800 mb-2 text-2xl font-bold relative pb-2 md:mt-0">
            Cek Nilai
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
        @endphp

        <div class="w-full bg-white p-4 md:p-6 rounded-lg shadow-md max-h-[600px] flex flex-col md:min-h-[80vh]">
            <div class="flex flex-col md:flex-row md:items-center mb-5">
                <h2 class="text-gray-800 text-xl relative pb-2 mb-4 md:mb-0 md:mr-auto">
                    Nilai Kelas: {{ $kelasName }}
                    <span class="absolute left-0 bottom-0 h-0.5 w-10 bg-blue-600"></span>
                </h2>
            </div>
            <div class="overflow-y-auto overflow-x-auto flex-1">
                @if($nilais->isNotEmpty())
                    <table class="w-full mb-4 text-gray-800 border-collapse table-auto">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 text-center align-bottom border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold uppercase text-xs tracking-wide sticky top-0 z-10 shadow-sm whitespace-nowrap">Mata Pelajaran</th>
                                <th class="py-3 px-4 text-center align-bottom border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold uppercase text-xs tracking-wide sticky top-0 z-10 shadow-sm whitespace-nowrap">Nilai Tugas</th>
                                <th class="py-3 px-4 text-center align-bottom border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold uppercase text-xs tracking-wide sticky top-0 z-10 shadow-sm whitespace-nowrap">Nilai UTS</th>
                                <th class="py-3 px-4 text-center align-bottom border-b-2 border-gray-300 bg-gray-50 text-gray-800 font-semibold uppercase text-xs tracking-wide sticky top-0 z-10 shadow-sm whitespace-nowrap">Nilai UAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nilais as $nilai)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 align-middle border-t border-gray-200 text-sm text-center whitespace-nowrap">{{ $nilai->pelajaran->namaPelajaran }}</td>
                                    <td class="py-3 px-4 align-middle border-t border-gray-200 text-sm text-center whitespace-nowrap">{{ $nilai->nilai_tugas ?? '-' }}</td>
                                    <td class="py-3 px-4 align-middle border-t border-gray-200 text-sm text-center whitespace-nowrap">{{ $nilai->nilai_uts ?? '-' }}</td>
                                    <td class="py-3 px-4 align-middle border-t border-gray-200 text-sm text-center whitespace-nowrap">{{ $nilai->nilai_uas ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="p-4">Tidak ada nilai tersedia untuk kelas ini.</p>
                @endif
            </div>
        </div>
    </div>
</body>