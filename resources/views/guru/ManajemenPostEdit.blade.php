<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/trix@2.0.5/dist/trix.js"></script>
    <link href="https://unpkg.com/trix@2.0.5/dist/trix.css" rel="stylesheet">
    @include('guru.partials.header')
</head>
<body>
    @include('guru.partials.sidebar')

    <div class="min-h-screen md:ml-64 p-4 sm:p-6 md:p-8">
        <div class="mb-6">
            <h1 class="w-full text-[#343a40] mb-2 text-2xl font-bold relative pb-2 md:mt-0">
                Managemen Postingan
                <span class="absolute left-0 bottom-0 h-1 w-24 bg-[#4a6cf7]"></span>
            </h1>
        </div>

        @if ($errors->any())
            <div class="p-4 border border-red-300 bg-red-100 text-red-700 rounded-lg mt-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 mb-6">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit {{ $postingan->tipe == 'pengumuman' ? 'Pengumuman' : 'Blog' }}</h2>
            </div>

            <div id="tambahPost" class="block">
                <form id="postForm" action="{{ route('guru.post.update', ['id' => $postingan->postingan_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Postingan</label>
                                <div class="flex rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                                    <input type="radio" id="pengumuman" name="tipe" value="pengumuman" {{ old('tipe', $postingan->tipe) == 'pengumuman' ? 'checked' : '' }} class="hidden peer/pengumuman">
                                    <label for="pengumuman" class="flex-1 text-center py-2 text-sm font-medium cursor-pointer transition-colors peer-checked/pengumuman:bg-[#4a6cf7] peer-checked/pengumuman:text-white text-gray-700">Pengumuman</label>
                                    <input type="radio" id="blog" name="tipe" value="blog" {{ old('tipe', $postingan->tipe) == 'blog' ? 'checked' : '' }} class="hidden peer/blog">
                                    <label for="blog" class="flex-1 text-center py-2 text-sm font-medium cursor-pointer transition-colors peer-checked/blog:bg-[#4a6cf7] peer-checked/blog:text-white text-gray-700">Blog</label>
                                </div>
                                @error('tipe')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="{{ old('tipe', $postingan->tipe) == 'pengumuman' ? 'block' : 'hidden' }}" id="tujuanContainer">
                                <label for="tujuan" class="block text-sm font-medium text-gray-700 mb-1">Tujuan</label>
                                <select name="tujuan" id="tujuan" class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Semua Kelas</option>
                                    @foreach($kelasTahuns as $kelasTahun)
                                        <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ old('tujuan', $postingan->kelas_tahun_id) == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
                                            {{ $kelasTahun->kelas->nama_kelas }} - {{ $kelasTahun->tahunajar->tahun_ajaran }} ({{ $kelasTahun->tahunajar->semester }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('tujuan')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="lampiran" class="block text-sm font-medium text-gray-700 mb-1">Foto Thumbnail</label>
                                <div class="border border-gray-300 rounded-lg p-2 bg-white flex items-center justify-between">
                                    <span id="FileNamaFoto" class="text-sm text-gray-600 truncate flex-1">{{ $postingan->lampiran ? basename($postingan->lampiran) : 'Pilih file' }}</span>
                                    <div class="flex gap-2">
                                        <button type="button" id="browseButton" class="bg-[#4a6cf7] text-white px-3 py-1.5 rounded text-xs hover:bg-[#3a5bcd] transition">Browse</button>
                                        <button type="button" id="deleteButton" class="bg-red-600 text-white px-3 py-1.5 rounded text-xs hover:bg-red-700 transition {{ $postingan->lampiran ? '' : 'hidden' }}">Hapus</button>
                                    </div>
                                    <input type="file" class="hidden" id="lampiran" name="lampiran" accept="image/*">
                                </div>
                                @error('lampiran')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50 text-center h-40 flex items-center justify-center">
                                <img id="previewImage" class="max-w-full max-h-full rounded-lg object-contain {{ $postingan->lampiran ? '' : 'hidden' }}" src="{{ $postingan->lampiran ? asset('storage/' . $postingan->lampiran) : '' }}" alt="Preview">
                                <span class="previewText text-gray-600 text-sm {{ $postingan->lampiran ? 'hidden' : '' }}">Preview foto akan muncul di sini</span>
                            </div>
                        </div>

                        <div class="lg:col-span-2 space-y-6">
                            <div class="hidden p-4 border border-red-300 bg-red-100 text-red-700 rounded-lg" id="errorMessage">
                                Postingan Bermasalah
                            </div>

                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                                <input class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" id="judul" name="judul" value="{{ old('judul', $postingan->judul) }}" placeholder="Masukkan judul postingan" required>
                                @error('judul')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="isi" class="block text-sm font-medium text-gray-700 mb-1">Isi Konten</label>
                                <input id="isi" type="hidden" name="isi" value="{{ old('isi', $postingan->isi) }}">
                                <trix-editor input="isi" class="h-64 border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Tulis konten postingan Anda di sini..."></trix-editor>
                                @error('isi')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="submit" class="bg-[#4a6cf7] text-white px-6 py-2 rounded-lg font-medium hover:bg-[#3a5bcd] transition">Update</button>
                                <a href="{{ route('guru.ManajemenPost', ['TipePost' => $postingan->tipe]) }}" class="bg-red-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-red-700 transition">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Post Type Toggle
            const pengumumanRadio = document.getElementById('pengumuman');
            const blogRadio = document.getElementById('blog');
            const tujuanContainer = document.getElementById('tujuanContainer');

            function toggleTujuan() {
                tujuanContainer.classList.toggle('hidden', !pengumumanRadio.checked);
            }

            pengumumanRadio.addEventListener('change', toggleTujuan);
            blogRadio.addEventListener('change', toggleTujuan);
            toggleTujuan();

            // Image Upload and Preview
            const lampiranInput = document.getElementById('lampiran');
            const fileNamaFotoSpan = document.getElementById('FileNamaFoto');
            const browseButton = document.getElementById('browseButton');
            const deleteButton = document.getElementById('deleteButton');
            const previewImage = document.getElementById('previewImage');
            const previewText = document.querySelector('.previewText');

            browseButton.addEventListener('click', () => lampiranInput.click());

            lampiranInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        previewText.classList.add('hidden');
                        deleteButton.classList.remove('hidden');
                        fileNamaFotoSpan.textContent = lampiranInput.files[0].name;
                    };
                    reader.readAsDataURL(this.files[0]);
                } else {
                    previewImage.classList.add('hidden');
                    previewText.classList.remove('hidden');
                    deleteButton.classList.add('hidden');
                    fileNamaFotoSpan.textContent = 'Pilih file';
                }
            });

            deleteButton.addEventListener('click', function() {
                lampiranInput.value = '';
                previewImage.classList.add('hidden');
                previewText.classList.remove('hidden');
                this.classList.add('hidden');
                fileNamaFotoSpan.textContent = 'Pilih file';
            });

            // Trix Attach File Button Removal
            const trixToolbar = document.querySelector('trix-toolbar');
            if (trixToolbar) {
                const attachButton = trixToolbar.querySelector('.trix-button--icon-attach');
                if (attachButton) {
                    attachButton.style.display = 'none';
                }
            }
            document.addEventListener('trix-file-accept', function(event) {
                event.preventDefault();
            });

            // Form Validation
            const postForm = document.getElementById('postForm');
            const errorMessage = document.getElementById('errorMessage');

            postForm.addEventListener('submit', function(e) {
                const judul = document.getElementById('judul').value.trim();
                const isi = document.getElementById('isi').value.trim();

                if (!judul || !isi) {
                    errorMessage.textContent = 'Judul dan konten tidak boleh kosong.';
                    errorMessage.classList.remove('hidden');
                    e.preventDefault();
                } else {
                    errorMessage.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>