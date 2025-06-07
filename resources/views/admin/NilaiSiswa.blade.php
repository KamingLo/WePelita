@include('admin.partials.header')
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/NilaiSiswa.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="KontainerNilai">
        <h1 class="JudulHalaman">Tampilkan Nilai Murid</h1>

        <div class="LayoutPelajaranForm">
            <h2>Pilih Pelajaran & Kelas</h2>
            <form method="GET" action="{{ route('admin.tampilkanNilai') }}" class="KontainerFormNilai" id="filterForm">
                <div class="FilterRow">
                    <div class="GrupInput">
                        <label for="pelajaran_id" class="LabelInput">Pilih Pelajaran</label>
                        <select name="pelajaran_id" id="pelajaran_id" class="DropdownPilihan">
                            <option value="">-- Pilih Pelajaran --</option>
                            @foreach($pelajaranList as $pelajaran)
                                <option value="{{ $pelajaran->pelajaran_id }}" {{ $pilihanPelajaran == $pelajaran->pelajaran_id ? 'selected' : '' }}>
                                    {{ $pelajaran->namaPelajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="GrupInput">
                        <label for="kelas_tahun_id" class="LabelInput">Pilih Kelas</label>
                        <select name="kelas_tahun_id" id="kelas_tahun_id" class="DropdownPilihan">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasTahuns as $kelasTahun)
                                <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ $pilihanKelasTahun == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
                                    {{ $kelasTahun->kelas->nama_kelas }} - {{ $kelasTahun->tahunajar->tahun_ajaran }} ({{ $kelasTahun->tahunajar->semester }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="KontainerTombol">
                    @if($muridList && count($muridList) > 0)
                        <a href="{{ route('admin.export.nilai', ['kelas_tahun_id' => $pilihanKelasTahun, 'pelajaran_id' => $pilihanPelajaran]) }}" class="TombolOJT DownloadBtn">Export Excel</a>
                    @endif
                </div>
            </form>

            @if (session()->has('success'))
                <div class="PesanSukses">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="LayoutPelajaranTable">
            <div class="KhususHeaderPelajaraTable">
                <h2>Daftar Nilai Murid</h2>
                <div class="CumanMaginDoang">
                    <div class="GrupInputSearchBar">
                        <label class="LabelInputSearchBar">Cari Murid</label>
                        <input type="text" placeholder="Cari Murid" class="InputCari" id="searchInput">
                    </div>
                </div>
            </div>

            @if($pilihanPelajaran && $pilihanKelasTahun)
                <div class="InfoSeleksi">
                    <span class="InfoTag"><strong>Pelajaran:</strong> {{ collect($pelajaranList)->firstWhere('pelajaran_id', $pilihanPelajaran)->namaPelajaran ?? 'Tidak dipilih' }}</span>
                    <span class="InfoTag"><strong>Kelas:</strong> {{ collect($kelasTahuns)->firstWhere('kelas_tahun_id', $pilihanKelasTahun)->kelas->nama_kelas ?? 'Tidak dipilih' }}</span>
                </div>
            @endif

            <div class="DisplayDataTable">
                @if($pilihanPelajaran && $pilihanKelasTahun)
                    <table class="table" id="tabelNilai">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Murid</th>
                                <th>Nilai Tugas</th>
                                <th>Nilai UTS</th>
                                <th>Nilai UAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($muridList as $index => $muridKelas)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="NamaMurid">{{ $muridKelas->murid->profile->name }}</td>
                                    <td>
                                        @if($muridKelas->nilai && $muridKelas->nilai->isNotEmpty())
                                            {{ $muridKelas->nilai->first()->nilai_tugas ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($muridKelas->nilai && $muridKelas->nilai->isNotEmpty())
                                            {{ $muridKelas->nilai->first()->nilai_uts ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($muridKelas->nilai && $muridKelas->nilai->isNotEmpty())
                                            {{ $muridKelas->nilai->first()->nilai_uas ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="PesanKosong">Silakan pilih pelajaran dan kelas untuk melihat daftar murid</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <table class="table" id="tabelNilai">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Murid</th>
                                <th>Nilai Tugas</th>
                                <th>Nilai UTS</th>
                                <th>Nilai UAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="PesanKosong">Silakan pilih pelajaran dan kelas untuk melihat daftar murid</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pelajaranSelect = document.getElementById('pelajaran_id');
            const kelasSelect = document.getElementById('kelas_tahun_id');
            const filterForm = document.getElementById('filterForm');
            const searchInput = document.getElementById('searchInput');

            // Auto-submit when both dropdowns are selected
            function checkAndSubmit() {
                if (pelajaranSelect.value && kelasSelect.value) {
                    filterForm.submit();
                }
            }

            pelajaranSelect.addEventListener('change', checkAndSubmit);
            kelasSelect.addEventListener('change', checkAndSubmit);

            // Client-side search filtering
            function filterTable() {
                const keyword = searchInput.value.toLowerCase();
                const rows = document.querySelectorAll('#tabelNilai tbody tr');

                rows.forEach(row => {
                    const namaCell = row.querySelector('.NamaMurid');
                    if (namaCell) {
                        const nama = namaCell.textContent.toLowerCase();
                        row.style.display = nama.includes(keyword) ? '' : 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
        });
    </script>
</body>
</body>