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

    <div id="main-content" class="min-h-screen md:ml-64 p-4 sm:p-6 md:p-8 transition-all duration-400 ease-in-out">
        <div class="mb-6">
            <h1 class="w-full text-[#343a40] mb-2 text-2xl font-bold relative pb-2 md:mt-0">
                Managemen Postingan
                <span class="absolute left-0 bottom-0 h-1 w-24 bg-[#4a6cf7]"></span>
            </h1>
        </div>

        <div class="mb-6 {{ session('success') ? 'block' : 'hidden' }}" id="successAlert">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                {{ session('success') }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <form method="GET" action="{{ route('guru.ManajemenPost') }}" id="filterForm" class="flex items-center gap-3">
                    <label for="TipePost" class="font-medium text-gray-700 min-w-[90px]">Filter Tipe:</label>
                    <select name="TipePost" id="TipePost" class="w-full sm:w-48 p-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                        <option value="" {{ request('TipePost') == '' ? 'selected' : '' }}>Buat Postingan</option>
                        <option value="pengumuman" {{ request('TipePost') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        <option value="blog" {{ request('TipePost') == 'blog' ? 'selected' : '' }}>Blog</option>
                    </select>
                </form>
            </div>

            <div class="{{ request('TipePost') == '' ? 'block' : 'hidden' }}" id="tambahPost">
                <form id="postForm" action="{{ route('guru.post.tambah') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Postingan</label>
                                <div class="flex rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                                    <input type="radio" id="pengumuman" name="tipe" value="pengumuman" {{ old('tipe', 'pengumuman') == 'pengumuman' ? 'checked' : '' }} class="hidden peer/pengumuman">
                                    <label for="pengumuman" class="flex-1 text-center py-2 text-sm font-medium cursor-pointer transition-colors peer-checked/pengumuman:bg-[#4a6cf7] peer-checked/pengumuman:text-white text-gray-700">Pengumuman</label>
                                    <input type="radio" id="blog" name="tipe" value="blog" {{ old('tipe') == 'blog' ? 'checked' : '' }} class="hidden peer/blog">
                                    <label for="blog" class="flex-1 text-center py-2 text-sm font-medium cursor-pointer transition-colors peer-checked/blog:bg-[#4a6cf7] peer-checked/blog:text-white text-gray-700">Blog</label>
                                </div>
                                @error('tipe')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="{{ old('tipe', 'pengumuman') == 'pengumuman' ? 'block' : 'hidden' }}" id="tujuanContainer">
                                <label for="tujuan" class="block text-sm font-medium text-gray-700 mb-1">Tujuan</label>
                                <select name="tujuan" id="tujuan" class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Semua Kelas</option>
                                    @foreach($kelasTahuns as $kelasTahun)
                                        <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ old('tujuan') == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
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
                                    <span id="FileNamaFoto" class="text-sm text-gray-600 truncate flex-1">Pilih file</span>
                                    <div class="flex gap-2">
                                        <button type="button" id="browseButton" class="bg-[#4a6cf7] text-white px-3 py-1.5 rounded text-xs hover:bg-[#3a5bcd] transition">Browse</button>
                                        <button type="button" id="deleteButton" class="bg-red-600 text-white px-3 py-1.5 rounded text-xs hover:bg-red-700 transition hidden">Hapus</button>
                                    </div>
                                    <input type="file" class="hidden" id="lampiran" name="lampiran" accept="image/*">
                                </div>
                                @error('lampiran')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50 text-center h-40 flex items-center justify-center">
                                <img id="previewImage" class="max-w-full max-h-full rounded-lg object-contain hidden" alt="Preview">
                                <span class="previewText text-gray-600 text-sm">Preview foto akan muncul di sini</span>
                            </div>
                        </div>

                        <div class="lg:col-span-2 space-y-6">
                            <div class="hidden p-4 border border-red-300 bg-red-100 text-red-700 rounded-lg" id="errorMessage">
                                Postingan Bermasalah
                            </div>

                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                                <input class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul postingan" required>
                                @error('judul')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="isi" class="block text-sm font-medium text-gray-700 mb-1">Isi Konten</label>
                                <input id="isi" type="hidden" name="isi" value="{{ old('isi') }}">
                                <trix-editor input="isi" class="h-64 border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Tulis konten postingan Anda di sini..."></trix-editor>
                                @error('isi')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-[#4a6cf7] text-white px-6 py-2 rounded-lg font-medium hover:bg-[#3a5bcd] transition">Posting</button>
                            </div>
                        </div>
                    </div>
                </form>
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

            <div id="blogList" class="{{ request('TipePost') == 'blog' ? 'block' : 'hidden' }}">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar Blog</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if(isset($blogs) && $blogs->isNotEmpty())
                        @foreach($blogs as $blog)
                            <div class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition">
                                <div class="h-40 bg-cover bg-center rounded-lg mb-4"
                                    style="{{ $blog->lampiran ? 'background-image: url(\''.asset('storage/' . $blog->lampiran).'\');' : 'background-image: url(\'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80\');' }}">
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $blog->judul }}</h3>
                                <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ Str::limit(strip_tags($blog->isi), 150) }}</p>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-800 font-semibold border border-gray-200">
                                        @if($blog->profile)
                                            {{ strtoupper(substr($blog->profile->name, 0, 2)) }}
                                        @else
                                            ??
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">
                                            @if($blog->profile)
                                                {{ $blog->profile->name }}
                                            @else
                                                Unknown Author
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-600">{{ $blog->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('guru.post.edit', ['id' => $blog->postingan_id]) }}" class="flex-1 bg-[#4a6cf7] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#3a5bcd] transition text-center">Edit</a>
                                    <form action="{{ route('guru.post.hapus', ['id' => $blog->postingan_id]) }}" method="POST" class="delete-post-form flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="TipePost" value="blog">
                                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-600 text-sm p-6 bg-white rounded-xl shadow-sm">Tidak ada blog tersedia.</p>
                    @endif
                </div>
            </div>

            <div id="pengumumanList" class="{{ request('TipePost') == 'pengumuman' ? 'block' : 'hidden' }}">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar Pengumuman</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if(isset($pengumumans) && $pengumumans->isNotEmpty())
                        @foreach($pengumumans as $pengumuman)
                            <div class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition">
                                <div class="h-40 bg-cover bg-center rounded-lg mb-4"
                                    style="{{ $pengumuman->lampiran ? 'background-image: url(\''.asset('storage/' . $pengumuman->lampiran).'\');' : 'background-image: url(\'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80\');' }}">
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $pengumuman->judul }}</h3>
                                <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ Str::limit(strip_tags($pengumuman->isi), 150) }}</p>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-800 font-semibold border border-gray-200">
                                        @if($pengumuman->profile)
                                            {{ strtoupper(substr($pengumuman->profile->name, 0, 2)) }}
                                        @else
                                            ??
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">
                                            @if($pengumuman->profile)
                                                {{ $pengumuman->profile->name }}
                                            @else
                                                Unknown Author
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-600">{{ $pengumuman->created_at->format('M d, Y') }}</p>
                                        <p class="text-xs text-gray-600">
                                            Tujuan: {{ $pengumuman->kelasTahun ? $pengumuman->kelasTahun->kelas->nama_kelas . ' - ' : '' }}
                                            {{ $pengumuman->kelasTahun ? $pengumuman->kelasTahun->tahunajar->tahun_ajaran : 'Publik' }}
                                            {{ $pengumuman->kelasTahun ? '(' . $pengumuman->kelasTahun->tahunajar->semester . ')' : '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('guru.post.edit', ['id' => $pengumuman->postingan_id]) }}" class="flex-1 bg-[#4a6cf7] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#3a5bcd] transition text-center">Edit</a>
                                    <form action="{{ route('guru.post.hapus', ['id' => $pengumuman->postingan_id]) }}" method="POST" class="delete-post-form flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="TipePost" value="pengumuman">
                                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-600 text-sm p-6 bg-white rounded-xl shadow-sm">Tidak ada pengumuman tersedia.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="space-y-6">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pengumumanRadio = document.getElementById('pengumuman');
            const blogRadio = document.getElementById('blog');
            const tujuanContainer = document.getElementById('tujuanContainer');

            function toggleTujuan() {
                tujuanContainer.classList.toggle('hidden', !pengumumanRadio.checked);
            }

            pengumumanRadio.addEventListener('change', toggleTujuan);
            blogRadio.addEventListener('change', toggleTujuan);
            toggleTujuan();

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

            const successAlert = document.getElementById('successAlert');
            if (successAlert.textContent.trim() !== '') {
                successAlert.classList.remove('hidden');
                setTimeout(() => successAlert.classList.add('hidden'), 5000);
            }
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
        });
    </script>
</body>
</html>