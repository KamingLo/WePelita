@include('admin.partials.header')
@include('admin.partials.sidebar')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
<link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenPost.css') }}" />
<script src="{{ asset('js/CssAdmin.js') }}"></script>

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
                                    <label for="judul" class="labelNWPT">Judul</label>
                                    <input class="TampilanIsiData" type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Isi judul postingan" required>
                                    @error('judul')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="IsiData">
                                    <div class="JuduldanOpsi">
                                        <div class="UploadFoto">
                                            <label for="lampiran" class="labelNWPT">Foto Thumbnail</label>
                                            <input type="file" class="TampilanIsiData" id="lampiran" name="lampiran">
                                            <div class="TombolUploadFoto">
                                                <span class="DeskripsiBarUpload" id="FileNamaFoto">Pilih file</span>
                                                <button type="button" class="BrowseFoto">Browse</button>
                                            </div>
                                            @error('lampiran')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

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
                                    
                                    <div class="PreviewContainer" id="previewContainer">
                                        <img id="previewImage" class="PreviewImage" alt="Preview">
                                        <div class="PreviewText" id="previewText">Preview foto akan muncul di sini</div>
                                        <button type="button" class="RemoveImage" id="removeImage">Hapus Foto</button>
                                    </div>

                                    <div class="InfoSubmit">
                                        <button type="submit" class="TombolOJT TombolPosting">Posting</button>
                                        <div class="UiPsnDis PsnError" style="display: none;" id="errorMessage">
                                            Postingan Bermasalah
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="FormKanan">
                                <div class="IsiData">
                                    <label for="isi" class="labelNWPT">Isi Konten</label>
                                    <input id="isi" type="hidden" name="isi" value="{{ old('isi') }}">
                                    <trix-editor input="isi" placeholder="Tulis konten postingan Anda di sini..."></trix-editor>
                                    @error('isi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                                @if($pengumuman->creator())
                                                    {{ strtoupper(substr($pengumuman->creator()->name, 0, 2)) }}
                                                @else
                                                    ??
                                                @endif
                                            </div>
                                            <div class="UserProfileCardPost">
                                                <span class="NamaPengunaCP">
                                                    @if($pengumuman->creator())
                                                        {{ $pengumuman->creator()->name }}
                                                    @else
                                                        Unknown Author
                                                    @endif
                                                </span>
                                                <span class="TanggalPublikasihCP">{{ $pengumuman->created_at->format('M d, Y') }}</span>
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
                                                @if($blog->creator())
                                                    {{ strtoupper(substr($blog->creator()->name, 0, 2)) }}
                                                @else
                                                    ??
                                                @endif
                                            </div>
                                            <div class="UserProfileCardPost">
                                                <span class="NamaPengunaCP">
                                                    @if($blog->creator())
                                                        {{ $blog->creator()->name }}
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
                                                <button type="submit" class="TombolOJT TombolHapus" data-post-type="blog" data-post-id="{{ $blog->postingan_id }}">Hapus</button>
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