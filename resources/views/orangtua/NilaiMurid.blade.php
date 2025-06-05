@include('murid.partials.header')
@include('murid.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/TambahPelajaran.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="ContainerPelajaran">
        <h1>Cek Nilai</h1>

        <!-- Display student's class and academic year -->
        @php
            $muridKelas = App\Models\MuridKelas::where('murid_id', $murid->murid_id)
                ->whereHas('kelasTahun.tahunajar', function ($query) {
                    $query->where('status', 'Aktif');
                })
                ->with('kelasTahun.kelas', 'kelasTahun.tahunajar')
                ->first();
            $kelasName = $muridKelas ? $muridKelas->kelasTahun->kelas->nama_kelas . ' (' . $muridKelas->kelasTahun->tahunajar->tahun_ajaran . ')' : 'No class assigned';
        @endphp

        <div class="LayoutPelajaranTable">
            <h2>Nilai Kelas: {{ $kelasName }}</h2>
            <div class="DisplayDataTable">
                @if($nilais->isNotEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Nilai Tugas</th>
                                <th>Nilai UTS</th>
                                <th>Nilai UAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nilais as $nilai)
                                <tr>
                                    <td>{{ $nilai->pelajaran->namaPelajaran }}</td>
                                    <td>{{ $nilai->nilai_tugas ?? '-' }}</td>
                                    <td>{{ $nilai->nilai_uts ?? '-' }}</td>
                                    <td>{{ $nilai->nilai_uas ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada nilai tersedia untuk kelas ini.</p>
                @endif
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('js/CssAdmin.js') }}"></script>