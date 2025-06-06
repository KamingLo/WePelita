@include('guru.partials.header')
@include('guru.partials.sidebar')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/GuruCSS/ManajemenPost.css') }}" />
<script src="{{ asset('js/CssAdmin.js') }}"></script>

<body>
    <div class="ContainerPostManagement">
        <h1>Download Nilai Murid</h1>

        <div class="DisFlexFungsi">
            <div class="OpsiManajemenPost">
                <form method="GET" action="{{ route('guru.nilai.download') }}" id="filterForm">
                    <label for="kelasTahunId">Pilih Kelas:</label>
                    <select name="kelas_tahun_id" id="kelasTahunId" class="PilihOpsiMP" required>
                        <option value="" disabled selected>-- Pilih Kelas --</option>
                        @foreach($kelasTahuns as $kelasTahun)
                            <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ request('kelas_tahun_id') == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
                                {{ $kelasTahun->kelas->nama_kelas }} - {{ $kelasTahun->tahunajar->tahun_ajaran }} ({{ $kelasTahun->tahunajar->semester }})
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="TombolOJT TombolPosting" style="margin-left: 10px;">
                        <i class="fas fa-download"></i> Download Nilai
                    </button>
                </form>
            </div>

            <div class="NotifPostingan">
                @if(session('success'))
                    <div class="UiPsnDis PsnBerhasil" id="successAlert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="UiPsnDis PsnError" id="errorAlert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>

        @if(isset($nilaiData))
            <div class="KotakBGLayout" style="margin-top: 20px;">
                <h2>Preview Nilai Kelas {{ $kelasTahuns->firstWhere('kelas_tahun_id', request('kelas_tahun_id'))->kelas->nama_kelas ?? '' }}</h2>
                <table class="table" border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Murid</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilaiData as $index => $nilai)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $nilai->murid->nama ?? 'Nama tidak tersedia' }}</td>
                                <td>{{ $nilai->nilai }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center;">Tidak ada data nilai untuk kelas ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
