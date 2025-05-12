@include('partials.header', ['NamaPage' => 'Registrasi Pengguna'])
@include('partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/EditPost.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="ContainerPostManagement">
    <h1>Manajemen Post</h1>

    <!-- Alert Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter Section -->
    <div class="filter-container">
        <form method="GET" action="{{ route('admin.manajemenPost') }}">
            <label for="TipePost">Filter berdasarkan peran:</label>
            <select name="TipePost" id="TipePost" class="filter-select" onchange="this.form.submit()">
                <option value="" {{ request('TipePost') == '' ? 'selected' : '' }}>-- Pilih Tipe Post --</option>
                <option value="pengumuman" {{ request('TipePost') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                <option value="kegiatan" {{ request('TipePost') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
            </select>
        </form>
    </div>

    @php $TipePost = request('TipePost'); @endphp

    <!-- Data Table Section -->
    <div class="table-container">
        @if ($TipePost === 'pengumuman')
            <h2>Daftar Pengumuman</h2>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Admin</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pengumumans as $pengumuman)
                    <tr>
                        <td>{{ $pengumuman->judul_pengumuman }}</td>
                        <td class="truncate">{{ $pengumuman->isi_pengumuman }}</td>
                        <td>{{ $pengumuman->admin->profile->name }}</td>
                        {{-- <td>{{ $pengumuman->created_at->format('d M Y') }}</td> --}}
                        <td class="action-buttons">
                            <form action="{{ route('pengumuman.update', ['id' => $pengumuman->pengumuman_id]) }}" method="GET" style="display:inline;">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                            <form action="{{ route('pengumuman.destroy', $pengumuman->pengumuman_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengumuman ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            
        @elseif ($TipePost === 'kegiatan')
            <h2>Daftar Kegiatan</h2>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Admin</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($kegiatans as $kegiatan)
                    <tr>
                        <td>{{ $kegiatan->judul_kegiatan }}</td>
                        <td class="truncate">{{ $kegiatan->isi_kegiatan }}</td>
                        <td>{{ $kegiatan->admin->profile->name }}</td>
                        
                        <td class="action-buttons">
                            <form action="{{ route('kegiatan.update', ['id' => $kegiatan->kegiatan_id]) }}" method="GET" style="display:inline;">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                            <form action="{{ route('kegiatan.destroy', $kegiatan->kegiatan_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            
        @else
            <div class="no-preview-message">
                <p>Silakan pilih tipe post untuk menampilkan data.</p>
            </div>
        @endif
    </div>
</div>