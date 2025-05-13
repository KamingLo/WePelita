@include('admin.partials.header', ['NamaPage' => 'Dashboard Post'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenPost.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="ContainerPostManagement">
    <h1>Manajemen Post</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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

    <div class="table-container">
        @if ($TipePost === 'pengumuman')
            <h2>Daftar Pengumuman</h2>
            
            <div class="post-preview-container">
                @foreach($pengumumans as $pengumuman)
                    <div class="mini-post-preview {{ $pengumuman->lampiran ? '' : 'no-image' }}">
                        @if($pengumuman->lampiran)
                            <img src="{{ asset('storage/' . $pengumuman->lampiran) }}" alt="Post Image" class="mini-post-image">
                        @endif
                        <div class="mini-post-content">
                            <div>
                                <div class="mini-post-header">
                                    <img src="{{ $pengumuman->admin->profile->avatar ?? '/default-avatar.png' }}" 
                                         alt="User Avatar" class="mini-post-avatar">
                                    <div class="mini-post-user">{{ $pengumuman->admin->profile->name }}</div>
                                </div>
                                <div class="mini-post-title">{{ $pengumuman->judul_pengumuman }}</div>
                                <div class="mini-post-body">{{ $pengumuman->isi_pengumuman }}</div>
                            </div>
                            <div class="mini-post-actions">
                                <div class="post-action-icons">
                                    <span>‎ </span>
                                    <span>‎ </span>
                                    <span>‎ </span>
                                </div>
                                <div class="post-preview-buttons">
                                    <form action="{{ route('pengumuman.update', ['id' => $pengumuman->pengumuman_id]) }}" method="GET" style="display:inline;">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                    <form action="{{ route('pengumuman.destroy', $pengumuman->pengumuman_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengumuman ini?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        @elseif ($TipePost === 'kegiatan')
            <h2>Daftar Kegiatan</h2>
            
            <div class="post-preview-container">
                @foreach($kegiatans as $kegiatan)
                    <div class="mini-post-preview {{ $kegiatan->lampiran ? '' : 'no-image' }}">
                        @if($kegiatan->lampiran)
                            <img src="{{ asset('storage/' . $kegiatan->lampiran) }}" alt="Post Image" class="mini-post-image">
                        @endif
                        <div class="mini-post-content">
                            <div>
                                <div class="mini-post-header">
                                    <img src="{{ $kegiatan->admin->profile->avatar ?? '/default-avatar.png' }}" 
                                         alt="User Avatar" class="mini-post-avatar">
                                    <div class="mini-post-user">{{ $kegiatan->admin->profile->name }}</div>
                                </div>
                                <div class="mini-post-title">{{ $kegiatan->judul_kegiatan }}</div>
                                <div class="mini-post-body">{{ $kegiatan->isi_kegiatan }}</div>
                            </div>
                            <div class="mini-post-actions">
                                       <span>‎ </span>
                                    <span>‎ </span>
                                    <span>‎ </span>
                                <div class="post-preview-buttons">
                                    <form action="{{ route('kegiatan.update', ['id' => $kegiatan->kegiatan_id]) }}" method="GET" style="display:inline;">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                    <form action="{{ route('kegiatan.destroy', $kegiatan->kegiatan_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        @else
            <div class="no-preview-message">
                <p>Silakan pilih tipe post untuk menampilkan data.</p>
            </div>
        @endif
    </div>
</div>