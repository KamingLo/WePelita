@include('guru.partials.header')
@include('guru.partials.sidebar')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenPost.css') }}" />
<script src="{{ asset('js/CssAdmin.js') }}"></script>

<body>
    <div class="ContainerPostManagement">
        <h1>Edit Postingan</h1>
        <div class="KotakBGLayout">
            <div class="ContainerNewPost">
                <div class="LayoutNewPost">
                    <h2>Edit Postingan</h2>
                    <form id="postForm" action="{{ route('guru.post.update', ['id' => $postingan->postingan_id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="ContainerDalam">
                            <div class="FormKiri">
                                <div class="IsiData">
                                    <label for="judul" class="labelNWPT">Judul</label>
                                    <input class="TampilanIsiData" type="text" id="judul" name="judul" value="{{ old('judul', $postingan->judul) }}" placeholder="Isi judul postingan" required>
                                    @error('judul')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
            
                                <div class="IsiData">
                                    <div class="JuduldanOpsi">
                                        <div class="UploadFoto">
                                            <label for="lampiran" class="labelNWPT">Foto Thumbnail</label>
                                            <input type="file" class="TampilanIsiData" id="lampiran" name="lampiran" accept="image/*">
                                            <div class="TombolUploadFoto">
                                                <span class="DeskripsiBarUpload" id="FileNamaFoto">{{ $postingan->lampiran ? basename($postingan->lampiran) : 'Pilih file' }}</span>
                                                <button type="button" class="BrowseFoto" onclick="document.getElementuvat .Id('lampiran').click()">Browse</button>
                                            </div>
                                            @if ($postingan->lampiran)
                                                <p>Current Image: <img src="{{ asset('storage/' . $postingan->lampiran) }}" alt="Current Thumbnail" style="max-width: 100px;"></p>
                                            @endif
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
                                            @endif
                                        </div>
                                    </div>

                                    <div class="IsiData" id="tujuanContainer" style="{{ old('tipe', $postingan->tipe) == 'pengumuman' ? 'display: block;' : 'display: none;' }}">
                                        <label for="tujuan" class="labelNWPT">Tujuan</label>
                                        <select name="tujuan" id="tujuan" class="TampilanIsiData">
                                            <option value="public">Semua Kelas</option>
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
            
                                    <div class="PreviewContainer">
                                        <img id="previewImage" class="PreviewImage" alt="Preview" style="display: none; max-height: 200px;">
                                        <div class="PreviewText" id="previewText">Preview foto akan muncul di sini</div>
                                        <button type="button class="RemoveImage" id="removeImage" style="display: none;">Hapus Foto</button>
                                    </div>
            
                                    <div class="InfoSubmit">
                                        <button type="submit" class="TombolOJT TombolEdit">Update</button>
                                        <div class="UiPsnDis PsnError" style="display: none;" id="errorMessage">
                                            Postingan Bermasalah
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="FormKanan">
                                <div class="IsiData">
                                    <label for="isi" class="labelNWPT">Isi Konten</label>
                                    <input id="isi" type="hidden" name="isi" value="{{ old('isi', $postingan->isi) }}">
                                    <trix-editor input="isi" placeholder="Tulis konten postingan Anda di sini..."></trix-editor>
                                    @error('isi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle tujuan field based on post type
            const pengumumanRadio = document.getElementById('pengumuman');
            const blogRadio = document.getElementById('blog');
            const tujuanContainer = document.getElementById('tujuanContainer');

            function toggleTujuanField() {
                tujuanContainer.style.display = pengumumanRadio.checked ? 'block' : 'none';
            }

            pengumumanRadio.addEventListener('change', toggleTujuanField);
            blogRadio.addEventListener('change', toggleTujuanField);
            toggleTujuanField(); // Initial check

            // Image preview functionality
            const lampiranInput = document.getElementById('lampiran');
            const previewImage = document.getElementById('previewImage');
            const previewText = document.getElementById('previewText');
            const removeImage = document.getElementById('removeImage');
            const fileNamaFoto = document.getElementById('FileNamaFoto');

            lampiranInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    fileNamaFoto.textContent = file.name;
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                        previewText.style.display = 'none';
                        removeImage.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    fileNamaFoto.textContent = 'Pilih file';
                }
            });

            removeImage.addEventListener('click', function () {
                lampiranInput.value = '';
                previewImage.src = '';
                previewImage.style.display = 'none';
                previewText.style.display = 'block';
                removeImage.style.display = 'none';
                fileNamaFoto.textContent = 'Pilih file';
            });
        });
</script>

<!-- Trix Editor JS (via CDN) -->
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Tunggu hingga Trix siap
            const waitForTrix = setInterval(function() {
                const trixEditor = document.querySelector("trix-editor");
                if (trixEditor) {
                    // Pastikan toolbar sudah ada
                    const toolbar = trixEditor.toolbarElement;
                    if (toolbar) {
                        const attachButton = toolbar.querySelector("[data-trix-action='attachFiles']");
                        if (attachButton) {
                            attachButton.style.display = 'none';
                            clearInterval(waitForTrix); // Hentikan interval setelah berhasil
                        }
                    }
                }
            }, 100); // Cek setiap 100ms
        });
    </script>
</body>