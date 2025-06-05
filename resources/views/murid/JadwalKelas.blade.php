@include('murid.partials.header')
@include('murid.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/TambahPelajaran.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<style>
    .FilterContainer {
        position: relative;
        display: inline-block;
        margin-bottom: 15px;
    }

    .FilterButton {
        padding: 8px 15px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: var(--transition);
    }

    .FilterButton:hover {
        background-color: #3959d9;
    }

    .FilterDropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 6px;
        box-shadow: var(--shadow);
        z-index: 20;
        min-width: 150px;
        padding: 10px 0;
    }

    .FilterDropdown.show {
        display: block;
    }

    .FilterOption {
        display: flex;
        align-items: center;
        padding: 8px 15px;
        font-size: 14px;
        color: #333;
        cursor: pointer;
    }

    .FilterOption:hover {
        background-color: #f8f9fa;
    }

    .FilterOption input[type="checkbox"] {
        margin-right: 10px;
    }

    .ApplyButton {
        display: block;
        width: calc(100% - 30px);
        margin: 10px 15px 5px;
        padding: 8px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: var(--transition);
    }

    .ApplyButton:hover {
        background-color: #3959d9;
    }

    .KhususTombolUnduh {
        display: inline-block;
        margin-left: 15px;
        margin-bottom: 15px;
    }

    .DownloadJadwal {
        background-color: #28a745;
        border-color: #28a745;
    }

    .DownloadJadwal:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
</style>

<body>
    <div class="ContainerPelajaran">
        <h1>Jadwal Pelajaran</h1>

        <!-- Display student's class -->
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

        <div class="LayoutPelajaranTable">
            <h2>Jadwal Kelas: {{ $kelasName }}</h2>
            <div class="FilterContainer">
                <button class="FilterButton" onclick="toggleDropdown()">Filter Hari</button>
                <form action="{{ route('murid.jadwal') }}" method="GET" id="filterForm">
                    <div class="FilterDropdown" id="filterDropdown">
                        @foreach($days as $day)
                            <label class="FilterOption">
                                <input type="checkbox" name="hari[]" value="{{ $day }}" {{ in_array($day, $selectedDays) ? 'checked' : '' }}>
                                {{ $day }}
                            </label>
                        @endforeach
                        <button type="submit" class="ApplyButton">Apply</button>
                    </div>
                </form>
                <div class="KhususTombolUnduh">
                    <a href="{{ route('murid.export') }}" class="TombolOJT DownloadJadwal">Download Jadwal</a>
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

<script src="{{ asset('js/CssAdmin.js') }}"></script>
<script>
    let dropdownOpen = false;

    function toggleDropdown() {
        const dropdown = document.getElementById('filterDropdown');
        dropdownOpen = !dropdownOpen;
        dropdown.classList.toggle('show', dropdownOpen);
    }

    document.querySelectorAll('.FilterOption input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });

    window.onclick = function(event) {
        const dropdown = document.getElementById('filterDropdown');
        const button = document.querySelector('.FilterButton');
        if (dropdownOpen && !event.target.matches('.FilterButton') && !dropdown.contains(event.target)) {
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