@include('orangtua.partials.header')
@include('orangtua.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/OrtuCSS/JadwalKelas.css') }}" />

<body>
    <div class="ContainerPelajaran">
        <h1>Jadwal Pelajaran</h1>

        @php
            $kelasName = $muridKelas ? $muridKelas->kelasTahun->kelas->nama_kelas . ' (' . $muridKelas->kelasTahun->tahunajar->tahun_ajaran . ')' : 'No class assigned';
            $muridName = $muridKelas ? $muridKelas->murid->profile->name : 'No child assigned';
            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
            $selectedDays = request()->input('hari', []);
        @endphp

        <div class="LayoutPelajaranTable">
            <div class="KhususHeaderPelajaranTable" style="display: flex;">
                <h2>Jadwal Kelas: {{ $muridName }} - {{ $kelasName }}</h2>
                <div style="margin-left: auto; display: flex; gap: 16px;">
                    <div class="KhususTombolUnduh" style="justify-content: center; display: flex;">
                        <a href="{{ route('orangtua.export-jadwal') }}" class="TombolOJT DownloadJadwal">Unduh Jadwal</a>
                    </div>
                    <div class="FilterContainer">
                        <button class="TombolFilter" onclick="toggleDropdown()">Filter Hari</button>
                        <form action="{{ route('orangtua.jadwal') }}" method="GET" id="filterForm">
                            <div class="FilterDropdown" id="filterDropdown" style="margin-top: 1rem;">
                                @foreach($days as $day)
                                    <label class="OpsiFilter">
                                        <input type="checkbox" name="hari[]" value="{{ $day }}" {{ in_array($day, $selectedDays) ? 'checked' : '' }}>
                                        {{ $day }}
                                    </label>
                                @endforeach
                                <button type="submit" class="SetFilter">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="DisplayDataTable">
                @if($jadwals->isNotEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwals as $jadwal)
                                <tr>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->pelajaran->namaPelajaran }}</td>
                                    <td>{{ $jadwal->pelajaran->guru->profile->name }}</td>
                                    <td>{{ $jadwal->waktu_mulai }}</td>
                                    <td>{{ $jadwal->waktu_selesai }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada jadwal pelajaran tersedia untuk kelas ini.</p>
                @endif
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('js/CssOrangTua.js') }}"></script>
<script>
    let dropdownOpen = false;

    function toggleDropdown() {
        const dropdown = document.getElementById('filterDropdown');
        dropdownOpen = !dropdownOpen;
        dropdown.classList.toggle('show', dropdownOpen);
    }

    document.querySelectorAll('.OpsiFilter input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });

    window.onclick = function(event) {
        const dropdown = document.getElementById('filterDropdown');
        const button = document.querySelector('.TombolFilter');
        if (dropdownOpen && !event.target.matches('.TombolFilter') && !dropdown.contains(event.target)) {
            dropdown.classList.remove('show');
            dropdownOpen = false;
        }
    };

    document.getElementById('filterForm').addEventListener('submit', function() {
        const dropdown = document.getElementById('filterDropdown');
        dropdown.classList.remove('show');
        dropdownOpen = false;
    });
</script>