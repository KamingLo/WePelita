@include('admin.partials.header')
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenPost.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
<script src="{{ asset('js/CssAdmin.js') }}"></script>

<body>
    <div class="ContainerPostManagement">
        <h1>Manajemen Post</h1>
    
        @if($errors->any())
            <div class="UiPsnDis PsnError">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="KotakBGLayoutEdit">
            <div class="ContainerNewPost" id="tambahPost" style="display: block;">
                <div class="LayoutNewPost">
                    <h2>Edit {{ $postingan->tipe == 'pengumuman' ? 'Pengumuman' : 'Blog' }}</h2>
                    <form id="postForm" action="{{ route('admin.post.update', ['id' => $postingan->postingan_id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="ContainerDalam">
                            <div class="FormKiri">
                                <div class="IsiData">
                                    <label for="judul" class="NamaLabelBar">Judul</label>
                                    <input class="TampilanIsiData" type="text" id="judul" name="judul" value="{{ old('judul', $postingan->judul) }}" placeholder="Isi judul postingan" required>
                                    @error('judul')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="IsiData">
                                    <div class="JuduldanOpsi">
                                        <div class="UploadFoto">
                                            <label for="lampiran" class="NamaLabelBar">Foto Thumbnail</label>
                                            <input type="file" class="TampilanIsiData" id="lampiran" name="lampiran">
                                            <div class="TombolUploadFoto">
                                                <span class="DeskripsiBarUpload" id="FileNamaFoto">
                                                    {{ $postingan->lampiran ? basename($postingan->lampiran) : 'Pilih file' }}
                                                </span>
                                                <button type="button" class="BrowseFoto">Browse</button>
                                            </div>
                                            @error('lampiran')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="OpsiTipePost">
                                            <label class="labelNWPT">Tipe Postingan</label>
                                            <input type="radio" id="pengumuman" name="tipe" value="pengumuman" {{ old('tipe', $postingan->tipe) == 'pengumuman' ? 'checked' : '' }}>
                                            <input type="radio" id="blog" name="tipe" value="blog" {{ old('tipe', $postingan->tipe) == 'blog' ? 'checked' : '' }}>
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
                                        @if($postingan->lampiran)
                                            <img id="previewImage" class="PreviewImage" src="{{ asset('storage/' . $postingan->lampiran) }}" alt="Preview" style="display: block;">
                                        @else
                                            <img id="previewImage" class="PreviewImage" alt="Preview" style="display: none;">
                                        @endif
                                        <div class="PreviewText" id="previewText" style="{{ $postingan->lampiran ? 'display: none;' : 'display: block;' }}">Preview foto akan muncul di sini</div>
                                        <button type="button" class="RemoveImage" id="removeImage" style="{{ $postingan->lampiran ? 'display: block;' : 'display: none;' }}">Hapus Foto</button>
                                    </div>

                                    <div class="InfoSubmitEdit">
                                        <button type="submit" class="TombolOJT TombolPosting">Update</button>
                                        <a href="{{ route('admin.manajemenPost', ['TipePost' => $postingan->tipe]) }}" class="TombolOJT TombolCancel">Cancel</a>
                                        <div class="UiPsnDis PsnError" style="display: none;" id="errorMessage">
                                            Terjadi kesalahan!
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="FormKanan">
                                <div class="IsiData">
                                    <label for="isi" class="NamaLabelBar">Isi Konten</label>
                                    <input id="isi" type="hidden" name="isi" value="{{ old('isi', $postingan->isi) }}">
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
        </div>
    </div>
</body>