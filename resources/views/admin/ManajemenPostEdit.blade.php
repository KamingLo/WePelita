@include('admin.partials.header')
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenPost.css') }}">
<script src="{{ asset('js/CssAdmin.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

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

                                <div class="IsiData" id="tujuanContainer" style="display: {{ old('tipe', $postingan->tipe) == 'pengumuman' ? 'block' : 'none' }};">
                                    <label for="tujuan" class="labelNWPT">Tujuan</label>
                                    <select name="tujuan" id="tujuan" class="TampilanIsiData">
                                        <option value="">Semua Kelas</option>
                                        @foreach($kelasTahuns as $kelasTahun)
                                            <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ old('tujuan', $postingan->kelas_tahun_id) == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
                                                {{ $kelasTahun->kelas->nama_kelas }} - {{ $kelasTahun->tahunajar->tahun_ajaran }} ({{ $kelasTahun->tahunajar->semester }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tujuan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="IsiData">
                                    <div class="JuduldanOpsi">
                                        <div class="UploadFoto">
                                            <label for="lampiran" class="labelNWPT">Foto Thumbnail</label>
                                            <input type="file" class="TampilanIsiData" id="lampiran" name="lampiran" style="display: none;">
                                            <div class="TombolUploadFoto">
                                                <span class="DeskripsiBarUpload" id="FileNamaFoto">
                                                    {{ $postingan->lampiran ? basename($postingan->lampiran) : 'Pilih file' }}
                                                </span>
                                                <button type="button" class="BrowseFoto" id="browseButton">Browse</button>
                                                <button type="button" class="BrowseFoto hapus" id="deleteButton" style="{{ $postingan->lampiran ? 'display: inline-block;' : 'display: none;' }}">Hapus</button>
                                            </div>
                                            @error('lampiran')
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
                                    </div>
                                </div>
                            </div>

                            <div class="FormKanan">
                                <div class="SubmitContainer">
                                    <button type="submit" class="TombolOJT TombolPosting">Update</button>
                                    <a href="{{ route('admin.manajemenPost', ['TipePost' => $postingan->tipe]) }}" class="TombolOJT TombolCancel">Cancel</a>
                                    <div class="UiPsnDis PsnError" style="display: none;" id="errorMessage">
                                        Terjadi kesalahan!
                                    </div>
                                </div>

                                <div class="IsiData">
                                    <label for="judul" class="NamaLabelBar">Judul</label>
                                    <input class="TampilanIsiData" type="text" id="judul" name="judul" value="{{ old('judul', $postingan->judul) }}" placeholder="Isi judul postingan" required>
                                    @error('judul')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="KhususTrixIsiKonten">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>