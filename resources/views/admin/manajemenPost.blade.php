@include('admin.partials.header')
@include('admin.partials.sidebar')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenPost.css') }}" />
<script src="{{ asset('js/CssAdmin.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

<body>
    <div class="ContainerPostManagement">
        <h1>Manajemen Post</h1>
        <div class="DisFlexFungsi">
            <div class="OpsiManajemenPost">
                <form method="GET" action="{{ route('admin.manajemenPost') }}" id="filterForm">
                    <label for="TipePost">Filter berdasarkan tipe:</label>
                    <select name="TipePost" id="TipePost" class="PilihOpsiMP" onchange="this.form.submit()">
                        <option value="" {{ request('TipePost') == '' ? 'selected' : '' }}>Postingan Baru</option>
                        <option value="pengumuman" {{ request('TipePost') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        <option value="blog" {{ request('TipePost') == 'blog' ? 'selected' : '' }}>Blog</option>
                    </select>
                </form>
            </div>

            <div class="NotifPostingan">
                <div class="UiPsnDis PsnBerhasil" 
                     style="{{ session('success') ? 'display: block;' : 'display: none;' }}" 
                     id="successAlert">
                    {{ session('success') }}
                </div>
            </div>
        </div>

        <div class="KotakBGLayout">
            <div class="ContainerNewPost" id="tambahPost" style="{{ request('TipePost') == '' ? 'display: block;' : 'display: none;' }}">
                <div class="LayoutNewPost">
                    <h2>Buat Postingan</h2>
                    <form id="postForm" action="{{ route('admin.post.tambah') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="ContainerDalam">
                            <div class="FormKiri">
                                <div class="IsiData">
                                    <div class="OpsiTipePost">
                                        <label class="labelNWPT">Tipe Postingan</label>
                                        <input type="radio" id="pengumuman" name="tipe" value="pengumuman" {{ old('tipe', 'pengumuman') == 'pengumuman' ? 'checked' : '' }}>
                                        <input type="radio" id="blog" name="tipe" value="blog" {{ old('tipe') == 'blog' ? 'checked' : '' }}>
                                        <label class="switch" for="pengumuman">
                                            <span class="switch-left">Pengumuman</span>
                                            <span class="switch-right">Blog</span>
                                            <span class="switch-button"></span>
                                        </label>
                                        @error('tipe')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="IsiData" id="tujuanContainer" style="display: none;">
                                    <label for="tujuan" class="labelNWPT">Tujuan</label>
                                    <select name="tujuan" id="tujuan" class="TampilanIsiData">
                                        <option value="">Semua Kelas</option>
                                        @foreach($kelasTahuns as $kelasTahun)
                                            <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ old('tujuan') == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
                                                {{ $kelasTahun->kelas->nama_kelas }} - {{ $kelasTahun->tahunajar->tahun_ajaran }} ({{ $kelasTahun->tahunajar->semester }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tujuan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="IsiData">
                                    <div class="UploadFoto">
                                        <label for="lampiran" class="labelNWPT">Foto Thumbnail</label>
                                        <input type="file" class="TampilanIsiData" id="lampiran" name="lampiran" style="display: none;">
                                        <div class="TombolUploadFoto">
                                            <span class="DeskripsiBarUpload" id="FileNamaFoto">Pilih file</span>
                                            <button type="button" class="BrowseFoto" id="browseButton">Browse</button>
                                            <button type="button" class="BrowseFoto hapus" id="deleteButton" style="display: none;">Hapus</button>
                                        </div>
                                        @error('lampiran')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="PreviewContainer" id="previewContainer">
                                    <img id="previewImage" class="PreviewImage" alt="Preview">
                                    <div class="PreviewText" id="previewText">Preview foto akan muncul di sini</div>
                                </div>
                            </div>

                            <div class="FormKanan">
                                <div class="SubmitContainer">
                                    <button type="submit" class="TombolOJT TombolPosting">Posting</button>
                                    <div class="UiPsnDis PsnError" style="display: none;" id="errorMessage">
                                        Postingan Bermasalah
                                    </div>
                                </div>

                                <div class="IsiData">
                                    <label for="judul" class="labelNWPT">Judul</label>
                                    <input class="TampilanIsiData" type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Isi judul postingan" required>
                                    @error('judul')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="KhususTrixIsiKonten">
                                    <div class="IsiData">
                                        <label for="isi_trix" class="labelNWPT">Isi Konten</label>
                                        <input id="isi_trix" type="hidden" name="isi_trix" value="{{ old('isi_trix') }}">
                                        <trix-editor input="isi_trix" placeholder="Tulis konten postingan Anda di sini..."></trix-editor>
                                        @error('isi_trix')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="pengumumanList" style="{{ request('TipePost') == 'pengumuman' ? 'display: block;' : 'display: none;' }}">
                <h2>Daftar Pengumuman</h2>
                <div class="LayoutDisplayPostingan">
                    @if(isset($pengumumans) && $pengumumans->isNotEmpty())
                        @foreach($pengumumans as $pengumuman)
                            <div class="CardPost">
                                <div class="ImagePostCard"
                                    @if($pengumuman->lampiran)
                                        style="background-image: url('{{ asset('storage/' . $pengumuman->lampiran) }}');"
                                    @else
                                        style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80');"
                                    @endif>
                                </div>
                                <div class="IsiCardPost">
                                    <h3 class="JudulCardPost">{{ $pengumuman->judul }}</h3>
                                    <p class="KontenCardPost">{{ Str::limit(strip_tags($pengumuman->isi), 210) }}</p>
                                    <div class="FooterCardPost">
                                        <div class="InfoUserCardPost">
                                            <div class="FotoProfileCardPost">
                                                @if($pengumuman->profile)
                                                    {{ strtoupper(substr($pengumuman->profile->name, 0, 2)) }}
                                                @else
                                                    ??
                                                @endif
                                            </div>
                                            <div class="UserProfileCardPost">
                                                <span class="NamaPengunaCP">
                                                    @if($pengumuman->profile)
                                                        {{ $pengumuman->profile->name }}
                                                    @else
                                                        Unknown Author
                                                    @endif
                                                </span>
                                                <span class="TanggalPublikasihCP">{{ $pengumuman->created_at->format('M d, Y') }}</span>
                                                <span class="TujuanPost">
                                                    Tujuan: {{ $pengumuman->kelasTahun ? $pengumuman->kelasTahun->kelas->nama_kelas . ' - ' . $pengumuman->kelasTahun->tahunajar->tahun_ajaran : 'Publik' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="OpsiTombolCp">
                                            <a href="{{ route('admin.post.edit', ['id' => $pengumuman->postingan_id]) }}" class="TombolOJT TombolEdit">Edit</a>
                                            <form action="{{ route('admin.post.hapus', ['id' => $pengumuman->postingan_id]) }}" method="POST" class="delete-post-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="TipePost" value="pengumuman">
                                                <button type="submit" class="TombolOJT TombolHapus">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Tidak ada pengumuman tersedia.</p>
                    @endif
                </div>
            </div>

            <div id="blogList" style="{{ request('TipePost') == 'blog' ? 'display: block;' : 'display: none;' }}">
                <h2>Daftar Blog</h2>
                <div class="LayoutDisplayPostingan">
                    @if(isset($blogs) && $blogs->isNotEmpty())
                        @foreach($blogs as $blog)
                            <div class="CardPost">
                                <div class="ImagePostCard"
                                    @if($blog->lampiran)
                                        style="background-image: url('{{ asset('storage/' . $blog->lampiran) }}');"
                                    @else
                                        style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80');"
                                    @endif>
                                </div>
                                <div class="IsiCardPost">
                                    <h3 class="JudulCardPost">{{ $blog->judul }}</h3>
                                    <p class="KontenCardPost">{{ Str::limit(strip_tags($blog->isi), 210) }}</p>
                                    <div class="FooterCardPost">
                                        <div class="InfoUserCardPost">
                                            <div class="FotoProfileCardPost">
                                                @if($blog->profile)
                                                    {{ strtoupper(substr($blog->profile->name, 0, 2)) }}
                                                @else
                                                    ??
                                                @endif
                                            </div>
                                            <div class="UserProfileCardPost">
                                                <span class="NamaPengunaCP">
                                                    @if($blog->profile)
                                                        {{ $blog->profile->name }}
                                                    @else
                                                        Unknown Author
                                                    @endif
                                                </span>
                                                <span class="TanggalPublikasihCP">{{ $blog->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="OpsiTombolCp">
                                            <a href="{{ route('admin.post.edit', ['id' => $blog->postingan_id]) }}" class="TombolOJT TombolEdit">Edit</a>
                                            <form action="{{ route('admin.post.hapus', ['id' => $blog->postingan_id]) }}" method="POST" class="delete-post-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="TipePost" value="blog">
                                                <button type="submit" class="TombolOJT TombolHapus">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Tidak ada blog tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>