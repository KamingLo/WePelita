@include('admin.partials.header', ['NamaPage' => 'Manajemen Post'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenPost.css') }}">
<link rel="stylesheet" href="{{ asset('css/AdminCSS/NewPost.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
@livewireStyles

<div class="ContainerPostManagement">
    <h1>Manajemen Post</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="filter-container">
        <form method="GET" action="{{ route('admin.manajemenPost') }}">
            <label for="TipePost">Filter berdasarkan:</label>
            <select name="TipePost" id="TipePost" class="filter-select" onchange="this.form.submit()">
                <option value="" {{ request('TipePost') == '' ? 'selected' : '' }}>-- Pilih Tipe Post --</option>
                <option value="pengumuman" {{ request('TipePost') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                <option value="kegiatan" {{ request('TipePost') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                <option value="buat_baru" {{ request('TipePost') == 'buat_baru' ? 'selected' : '' }}>Buat Postingan Baru</option>
            </select>
        </form>
    </div>

    @php $TipePost = request('TipePost'); @endphp

    <div class="table-container">
        @if ($TipePost === 'pengumuman')
            @livewire('pengumuman-list')
        @elseif ($TipePost === 'kegiatan')
            @livewire('kegiatan-list')
        @elseif ($TipePost === 'buat_baru')
            @livewire('post-form')
        @else
            <div class="no-preview-message">
                <p>Silakan pilih tipe post untuk menampilkan data atau membuat postingan baru.</p>
            </div>
        @endif
    </div>
</div>

@livewireScripts
<script src="{{ asset('js/CssAdmin.js') }}"></script>