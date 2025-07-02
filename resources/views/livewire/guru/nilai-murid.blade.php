<div>
    <div class="md:ml-64 px-4 md:px-8 py-8">
        <h1 class="w-full text-[#343a40] mb-5 text-2xl font-bold relative pb-2 transform translate-y-0 -lg:-translate-y-[2rem]">
            Cek dan Input Nilai Murid
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-[#4a6cf7]"></span>
        </h1>

        <div class="flex flex-col md:flex-row gap-8 transform translate-y-0 -lg:-translate-y-[5rem]">
            <div class="flex-1 min-w-[300px] max-w-full md:max-w-[400px] bg-white p-6 rounded-lg shadow-md flex flex-col md:min-h-[80vh]">
                <h2 class="text-[#343a40] text-xl font-semibold mb-5 relative pb-2">
                    Pilih Pelajaran & Kelas
                    <span class="absolute left-0 bottom-0 h-0.5 w-10 bg-[#4a6cf7]"></span>
                </h2>

                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col">
                            <label class="block text-[#343a40] text-sm font-semibold uppercase mb-2 tracking-wider">Pilih Pelajaran</label>
                            <select wire:model.live="pilihanPelajaran" class="w-full px-4 py-3 border-2 border-[#e9ecef] rounded-lg text-sm bg-white transition-all duration-300 ease-in-out focus:border-[#4a6cf7] focus:outline-none focus:shadow-[0_0_0_3px_rgba(74,108,247,0.1)] appearance-none bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-no-repeat bg-[right_15px_center] pr-11">
                                <option value="">-- Pilih Pelajaran --</option>
                                @foreach($pelajaranList as $pelajaran)
                                    <option value="{{ $pelajaran->pelajaran_id }}">{{ $pelajaran->namaPelajaran }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if($pilihanPelajaran)
                            <div class="flex flex-col">
                                <label class="block text-[#343a40] text-sm font-semibold uppercase mb-2 tracking-wider">Pilih Kelas</label>
                                <select wire:model.live="pilihanKelasTahun" class="w-full px-4 py-3 border-2 border-[#e9ecef] rounded-lg text-sm bg-white transition-all duration-300 ease-in-out focus:border-[#4a6cf7] focus:outline-none focus:shadow-[0_0_0_3px_rgba(74,108,247,0.1)] appearance-none bg-[url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'%23333\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M8 9.5a.5.5 0 01-.354-.146l-4-4a.5.5 0 01.708-.708L8 8.293l3.646-3.647a.5.5 0 01.708.708l-4 4A.5.5 0 018 9.5z\'/%3E%3C/svg%3E')] bg-no-repeat bg-[right_15px_center] pr-11">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelasTahunList as $kelasTahun)
                                        <option value="{{ $kelasTahun->kelas_tahun_id }}">
                                            {{ $kelasTahun->kelas->nama_kelas }} - {{ $kelasTahun->TahunAjar->tahun_ajaran }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>

                    @if($pilihanKelasTahun && $muridList && count($muridList) > 0)
                        <div class="flex flex-col gap-4 mt-5">
                            <button type="submit" form="formNilai" class="w-full bg-[#4a6cf7] text-white border-2 border-[#4a6cf7] py-[10px] px-[15px] rounded-lg text-[13px] font-semibold uppercase tracking-wider cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#3959d9] hover:border-[#3959d9] hover:translate-y-[-2px] hover:shadow-[0_8px_25px_rgba(74,108,247,0.3)] flex items-center justify-center gap-2">
                                <i class="fas fa-save text-base"></i> Simpan Nilai
                            </button>
                            <form method="GET" action="{{ route('guru.nilai.download') }}" onsubmit="return copyKelasToExport()" class="inline-block w-full">
                                <input value="{{ $pilihanKelasTahun }}" type="hidden" name="kelas_tahun_id" id="export_kelas_id">
                                <button type="submit" class="w-full bg-[#28a745] text-white border-2 border-[#28a745] py-[10px] px-[15px] rounded-lg text-[13px] font-semibold uppercase tracking-wider cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#218838] hover:border-[#218838] hover:translate-y-[-2px] hover:shadow-[0_8px_25px_rgba(40,167,69,0.3)] flex items-center justify-center gap-2">
                                    <i class="fas fa-download text-base"></i> Unduh Data Kelas Ini
                                </button>
                            </form>
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="bg-[#d4edda] border border-[#c3e6cb] text-[#155724] p-4 rounded-lg text-sm flex items-center w-full mt-6">
                            <span class="bg-[#28a745] text-white rounded-full w-5 h-5 flex items-center justify-center mr-2 text-xs font-bold">&check;</span>
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex-auto min-w-[300px] md:min-w-[600px] bg-white p-6 rounded-lg shadow-md flex flex-col max-h-[600px] min-h-[80vh]">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-5">
                    <h2 class="text-[#343a40] text-xl font-semibold relative pb-2 md:mb-0">
                        Daftar Nilai Murid
                        <span class="absolute left-0 bottom-0 h-0.5 w-10 bg-[#4a6cf7]"></span>
                    </h2>
                    
                    <div class="mt-4 md:mt-0">
                        <div class="flex items-center gap-4">
                            <p class="text-[#343a40] text-sm font-semibold tracking-wider flex items-center h-10">Cari Murid</p>
                            <input type="text" id="searchInput" class="w-full md:w-auto pl-[35px] pr-[15px] py-[10px] border-2 border-[#e9ecef] rounded-lg text-[13px] bg-white transition-all duration-300 ease-in-out focus:border-[#4a6cf7] focus:outline-none focus:shadow-[0_0_0_3px_rgba(74,108,247,0.2)]" placeholder="Ketik nama murid...">
                        </div>
                    </div>
                </div>

                @if($pilihanPelajaran && $pilihanKelasTahun)
                    <div class="flex flex-wrap gap-4 mb-5 p-4 bg-[#f8f9fa] rounded-lg border-l-4 border-[#4a6cf7]">
                        <span class="text-sm text-[#343a40]">Pelajaran: <strong class="text-[#4a6cf7] font-semibold">{{ collect($pelajaranList)->firstWhere('pelajaran_id', $pilihanPelajaran)->namaPelajaran ?? 'Tidak dipilih' }}</strong></span>
                        <span class="text-sm text-[#343a40]">Kelas: <strong class="text-[#4a6cf7] font-semibold">{{ collect($kelasTahunList)->firstWhere('kelas_tahun_id', $pilihanKelasTahun)->kelas->nama_kelas ?? 'Tidak dipilih' }}</strong></span>
                    </div>
                @endif

                <div class="overflow-x-auto flex-1 rounded-lg shadow-[0_2px_8px_rgba(0,0,0,0.08)]">
                    @if($pilihanPelajaran && $pilihanKelasTahun)
                        <form id="formNilai" action="{{ route('guru.isinilai') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pelajaran_id" value="{{ $pilihanPelajaran }}">
                            <input type="hidden" name="kelas_tahun_id" value="{{ $pilihanKelasTahun }}">

                            <table class="min-w-full border-collapse bg-white rounded-lg overflow-hidden" id="tabelNilai">
                                <thead>
                                    <tr>
                                        <th class="bg-[#f8f9fa] text-[#343a40] font-semibold uppercase text-[13px] tracking-wider py-[10px] px-[8px] text-center border-b-2 border-[#dee2e6] sticky top-0 z-10">No</th>
                                        <th class="bg-[#f8f9fa] text-[#343a40] font-semibold uppercase text-[13px] tracking-wider py-[10px] px-[8px] text-left border-b-2 border-[#dee2e6] sticky top-0 z-10">Nama Murid</th>
                                        <th class="bg-[#f8f9fa] text-[#343a40] font-semibold uppercase text-[13px] tracking-wider py-[10px] px-[8px] text-center border-b-2 border-[#dee2e6] sticky top-0 z-10">Nilai Tugas</th>
                                        <th class="bg-[#f8f9fa] text-[#343a40] font-semibold uppercase text-[13px] tracking-wider py-[10px] px-[8px] text-center border-b-2 border-[#dee2e6] sticky top-0 z-10">Nilai UTS</th>
                                        <th class="bg-[#f8f9fa] text-[#343a40] font-semibold uppercase text-[13px] tracking-wider py-[10px] px-[8px] text-center border-b-2 border-[#dee2e6] sticky top-0 z-10">Nilai UAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($muridList as $index => $muridKelas)
                                        <tr class="transition-all duration-300 ease-in-out hover:bg-[rgba(74,108,247,0.05)]">
                                            <td class="py-[10px] px-[8px] border-b border-[#e9ecef] text-[13px] align-middle text-center">{{ $index + 1 }}</td>
                                            <td class="NamaMurid py-[10px] px-[8px] border-b border-[#e9ecef] text-[13px] align-middle text-left">{{ $muridKelas->murid->profile->name }}</td>
                                            <td class="py-[10px] px-[8px] border-b border-[#e9ecef] text-[13px] align-middle text-center">
                                                <input type="number" 
                                                       name="nilai[{{ $muridKelas->murid_kelas_id }}][nilai_tugas]"
                                                       class="w-[60px] py-[6px] px-[8px] border-2 border-[#e9ecef] rounded-md text-sm text-center transition-all duration-300 ease-in-out bg-white focus:border-[#4a6cf7] focus:outline-none focus:shadow-[0_0_0_3px_rgba(74,108,247,0.1)] hover:border-[#4a6cf7]"
                                                       min="0"
                                                       max="100"
                                                       step="0.1"
                                                       placeholder="0-100"
                                                       onchange="hitungRataRata(this)"
                                                       value="{{ old('nilai.' . $muridKelas->murid_kelas_id . '.nilai_tugas', $nilai[$muridKelas->murid_kelas_id]['nilai_tugas'] ?? '') }}">
                                            </td>
                                            <td class="py-[10px] px-[8px] border-b border-[#e9ecef] text-[13px] align-middle text-center">
                                                <input type="number" 
                                                       name="nilai[{{ $muridKelas->murid_kelas_id }}][nilai_uts]"
                                                       class="w-[60px] py-[6px] px-[8px] border-2 border-[#e9ecef] rounded-md text-sm text-center transition-all duration-300 ease-in-out bg-white focus:border-[#4a6cf7] focus:outline-none focus:shadow-[0_0_0_3px_rgba(74,108,247,0.1)] hover:border-[#4a6cf7]"
                                                       min="0"
                                                       max="100"
                                                       step="0.1"
                                                       placeholder="0-100"
                                                       onchange="hitungRataRata(this)"
                                                       value="{{ old('nilai.' . $muridKelas->murid_kelas_id . '.nilai_uts', $nilai[$muridKelas->murid_kelas_id]['nilai_uts'] ?? '') }}">
                                            </td>
                                            <td class="py-[10px] px-[8px] border-b border-[#e9ecef] text-[13px] align-middle text-center">
                                                <input type="number" 
                                                       name="nilai[{{ $muridKelas->murid_kelas_id }}][nilai_uas]"
                                                       class="w-[60px] py-[6px] px-[8px] border-2 border-[#e9ecef] rounded-md text-sm text-center transition-all duration-300 ease-in-out bg-white focus:border-[#4a6cf7] focus:outline-none focus:shadow-[0_0_0_3px_rgba(74,108,247,0.1)] hover:border-[#4a6cf7]"
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
                                            <td colspan="5" class="py-5 px-3 border-b border-[#dee2e6] bg-white text-sm text-center">
                                                <div class="flex flex-col items-center justify-center p-4 text-[#6c757d]">
                                                    <div class="text-5xl mb-4 opacity-50">📝</div>
                                                    <p>Tidak ada murid dalam kelas ini</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </form>
                    @else
                        <table class="min-w-full border-collapse bg-white rounded-lg overflow-hidden">
                            <thead>
                                <tr>
                                    <th class="bg-[#f8f9fa] text-[#343a40] font-semibold uppercase text-[13px] tracking-wider py-[10px] px-[8px] text-center border-b-2 border-[#dee2e6] sticky top-0 z-10">No</th>
                                    <th class="bg-[#f8f9fa] text-[#343a40] font-semibold uppercase text-[13px] tracking-wider py-[10px] px-[8px] text-left border-b-2 border-[#dee2e6] sticky top-0 z-10">Nama Murid</th>
                                    <th class="bg-[#f8f9fa] text-[#343a40] font-semibold uppercase text-[13px] tracking-wider py-[10px] px-[8px] text-center border-b-2 border-[#dee2e6] sticky top-0 z-10">Nilai Tugas</th>
                                    <th class="bg-[#f8f9fa] text-[#343a40] font-semibold uppercase text-[13px] tracking-wider py-[10px] px-[8px] text-center border-b-2 border-[#dee2e6] sticky top-0 z-10">Nilai UTS</th>
                                    <th class="bg-[#f8f9fa] text-[#343a40] font-semibold uppercase text-[13px] tracking-wider py-[10px] px-[8px] text-center border-b-2 border-[#dee2e6] sticky top-0 z-10">Nilai UAS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="py-5 px-3 border-b border-[#dee2e6] bg-white text-sm text-center">
                                        <div class="flex flex-col items-center justify-center p-4 text-[#6c757d]">
                                            <div class="text-5xl mb-4 opacity-50">📝</div>
                                            <p>Silakan pilih pelajaran dan kelas untuk melihat daftar murid</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
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

    function copyKelasToExport() {
        return true;
    }
</script>