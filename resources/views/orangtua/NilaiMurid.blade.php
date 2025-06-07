@include('orangtua.partials.header')
@include('orangtua.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/OrtuCSS/JadwalKelas.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="ContainerPelajaran">
        <h1>Cek Nilai Anak</h1>

        @php
            $kelasName = $muridKelas ? $muridKelas->kelasTahun->kelas->nama_kelas . ' (' . $muridKelas->kelasTahun->tahunajar->tahun_ajaran . ')' : 'No class assigned';
            $muridName = $muridKelas ? $muridKelas->murid->profile->name : 'No child assigned';
        @endphp

        <div class="LayoutPelajaranTable">
            <div class="KhususHeaderPelajaranTable" style="display: flex;">
                <h2>Nilai Anak: {{ $muridName }} - {{ $kelasName }}</h2>
            </div>
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