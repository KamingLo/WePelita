<div>
    <link rel="stylesheet" href="{{ asset('css/GuruCSS/NilaiMurid.css') }}" />
    <div class="KontainerNilai">
        <h1 class="JudulHalaman">Cek dan Input Nilai Murid</h1>
        <div class="LayoutPelajaranForm">
            <h2>Pilih Pelajaran & Kelas</h2>
            
            <div class="KontainerFormNilai">
                <div class="FilterRow">
                    <div class="GrupInput">
                        <label class="LabelInput">Pilih Pelajaran</label>
                        <select wire:model.live="pilihanPelajaran" class="DropdownPilihan">
                            <option value="">-- Pilih Pelajaran --</option>
                            @foreach($pelajaranList as $pelajaran)
                                <option value="{{ $pelajaran->pelajaran_id }}">{{ $pelajaran->namaPelajaran }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="GrupInput">
                        <label class="LabelInput">Pilih Kelas</label>
                        <select wire:model.live="pilihanKelasTahun" class="DropdownPilihan">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasTahuns as $kelasTahun)
                                <option value="{{ $kelasTahun->kelas_tahun_id }}">
                                    {{ $kelasTahun->kelas->nama_kelas }} - {{ $kelasTahun->tahunajar->tahun_ajaran }} ({{ $kelasTahun->tahunajar->semester }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if($muridList && count($muridList) > 0)
                    <div class="KontainerTombol">
                        <button type="submit" form="formNilai" class="TombolSimpan">Simpan Nilai</button>
                        <form method="GET" action="{{ route('guru.nilai.download') }}" onsubmit="return copyKelasToExport()" style="display:inline;">
                            <input value="{{ $pilihanKelasTahun }}" type="hidden" name="kelas_tahun_id" id="export_kelas_id">
                            <button type="submit" class="TombolOJT DownloadBtn">Unduh Data Kelas Ini</button>
                        </form>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="PesanSukses">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>

        <div class="LayoutPelajaranTable">
            <div class="KhususHeaderPelajaraTable">
                <h2>Daftar Nilai Murid</h2>
                
                <div class="CumanMaginDoang">
                    <div class="GrupInputSearchBar">
                        <p class="LabelInputSearchBar">Cari Murid</p>
                        <input type="text" id="searchInput" class="InputCari" placeholder="Ketik nama murid...">
                    </div>
                </div>
            </div>

            @if($pilihanPelajaran && $pilihanKelasTahun)
                <div class="InfoSeleksi">
                    <span class="InfoTag">Pelajaran: <strong>{{ collect($pelajaranList)->firstWhere('pelajaran_id', $pilihanPelajaran)->namaPelajaran ?? 'Tidak dipilih' }}</strong></span>
                    <span class="InfoTag">Kelas: <strong>{{ collect($kelasTahuns)->firstWhere('kelas_tahun_id', $pilihanKelasTahun)->kelas->nama_kelas ?? 'Tidak dipilih' }}</strong></span>
                </div>
            @endif

            <div class="DisplayDataTable">
                @if($pilihanPelajaran && $pilihanKelasTahun)
                    <form id="formNilai" action="{{ route('guru.isinilai') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pelajaran_id" value="{{ $pilihanPelajaran }}">
                        <input type="hidden" name="kelas_tahun_id" value="{{ $pilihanKelasTahun }}">

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
                                            <input type="number" 
                                                   name="nilai[{{ $muridKelas->murid_kelas_id }}][nilai_tugas]"
                                                   class="InputNilai"
                                                   min="0"
                                                   max="100"
                                                   step="0.1"
                                                   placeholder="0-100"
                                                   onchange="hitungRataRata(this)"
                                                   value="{{ old('nilai.' . $muridKelas->murid_kelas_id . '.nilai_tugas', $nilai[$muridKelas->murid_kelas_id]['nilai_tugas'] ?? '') }}">
                                        </td>
                                        <td>
                                            <input type="number" 
                                                   name="nilai[{{ $muridKelas->murid_kelas_id }}][nilai_uts]"
                                                   class="InputNilai"
                                                   min="0"
                                                   max="100"
                                                   step="0.1"
                                                   placeholder="0-100"
                                                   onchange="hitungRataRata(this)"
                                                   value="{{ old('nilai.' . $muridKelas->murid_kelas_id . '.nilai_uts', $nilai[$muridKelas->murid_kelas_id]['nilai_uts'] ?? '') }}">
                                        </td>
                                        <td>
                                            <input type="number" 
                                                   name="nilai[{{ $muridKelas->murid_kelas_id }}][nilai_uas]"
                                                   class="InputNilai"
                                                   min="0"
                                                   max="100"
                                                   step="0.1"
                                                   placeholder="0-100"
                                                   onchange="hitungRataRata(this)"
                                                   value="{{ old('nilai.' . $muridKelas->murid_kelas_id . '.nilai_uas', $nilai[$muridKelas->murid_kelas_id]['nilai_uas'] ?? '') }}">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="PesanKosong">Silakan pilih pelajaran dan kelas untuk melihat daftar murid</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </form>
                @else
                    <table class="table">
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
                                <td colspan="7" class="PesanKosong">Silakan pilih pelajaran dan kelas untuk melihat daftar murid</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');

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

    searchInput?.addEventListener('input', filterTable);
    searchInput?.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            filterTable();
        }
    });
</script>