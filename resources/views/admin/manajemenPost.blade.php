@include('admin.partials.header')
@include('admin.partials.sidebar')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- PENTING: Hapus baris ini untuk menghindari konflik dengan Tailwind --}}
{{-- <link rel="stylesheet" href="{{ asset('css/AdminCSS/ManajemenPost.css') }}" /> --}}
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('js/CssAdmin.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

<body>
    <div class="ml-0 md:ml-64 p-4 md:p-8 flex flex-wrap gap-4 md:gap-6 min-h-[82vh] md:min-h-[calc(100vh-100px)] pb-10 md:pb-20">
        <h1 class="w-full text-[#343a40] mb-2 text-2xl font-bold relative pb-2 md:mt-0">Manajemen Post
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-[#4a6cf7]"></span>
        </h1>
        <div class="flex flex-col md:flex-row gap-4 md:gap-5 w-full -mt-4">
            <div class="w-full min-w-[380px] md:w-96 bg-white py-3 px-4 md:py-3 md:px-5 rounded-lg md:rounded-xl shadow-md md:shadow-lg flex items-center">
                <form method="GET" action="{{ route('admin.manajemenPost') }}" id="filterForm" class="flex items-center flex-wrap md:flex-nowrap gap-x-3 gap-y-2">
                    <label for="TipePost" class="mr-0 md:mr-3 font-medium text-gray-800 text-sm flex-shrink-0">Filter berdasarkan tipe:</label>
                    <select name="TipePost" id="TipePost" class="w-auto min-w-[150px] md:w-44 p-2 border border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" onchange="this.form.submit()">
                        <option value="" {{ request('TipePost') == '' ? 'selected' : '' }}>Postingan Baru</option>
                        <option value="pengumuman" {{ request('TipePost') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        <option value="blog" {{ request('TipePost') == 'blog' ? 'selected' : '' }}>Blog</option>
                    </select>
                </form>
            </div>

            <div class="flex-1">
                <div class="p-3 md:p-4 border border-green-300 bg-green-100 text-green-700 rounded-lg md:rounded-xl {{ session('success') ? 'block' : 'hidden' }}" id="successAlert">
                    {{ session('success') }}
                </div>
            </div>
        </div>

        <div class="w-full bg-white p-4 md:p-6 rounded-lg md:rounded-xl shadow-md md:shadow-lg mb-4 md:mb-6 h-auto overflow-hidden">
            <div class="{{ request('TipePost') == '' ? 'block' : 'hidden' }}" id="tambahPost">
                <h2 class="text-gray-800 text-xl md:text-2xl mb-3 md:mb-4 pb-2 relative inline-block after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-12 md:after:w-16 after:bg-blue-500 font-semibold mt-4">Buat Postingan</h2>
                <form id="postForm" action="{{ route('admin.post.tambah') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-x-6 gap-y-4 md:gap-y-6">
                        <div class="flex flex-col max-w-full md:max-w-[420px]">
                            <div class="mb-4 md:mb-5">
                                <div class="mb-4 md:mb-5">
                                    <label class="block mb-1 md:mb-2 font-medium text-gray-800 text-sm">Tipe Postingan</label>
                                    <div class="custom-switch-wrapper relative flex p-1 bg-gray-500 rounded-lg shadow-inner">
                                        <input type="radio" id="pengumuman" name="tipe" value="pengumuman" {{ old('tipe', 'pengumuman') == 'pengumuman' ? 'checked' : '' }} class="hidden">
                                        <input type="radio" id="blog" name="tipe" value="blog" {{ old('tipe') == 'blog' ? 'checked' : '' }} class="hidden">

                                        <span class="custom-switch-indicator absolute bg-blue-600 rounded-md shadow-md transition-all duration-300 ease-in-out z-10"></span>

                                        <label for="pengumuman" class="custom-switch-label flex-1 text-center py-2 px-4 text-sm font-semibold cursor-pointer transition-colors duration-300 z-20 text-gray-700" data-target="pengumuman">
                                            Pengumuman
                                        </label>
                                        <label for="blog" class="custom-switch-label flex-1 text-center py-2 px-4 text-sm font-semibold cursor-pointer transition-colors duration-300 z-20 text-gray-700" data-target="blog">
                                            Blog
                                        </label>
                                    </div>
                                    @error('tipe')
                                        <span class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 md:mb-5 {{ old('tipe', 'pengumuman') == 'pengumuman' ? 'block' : 'hidden' }}" id="tujuanContainer">
                                <label for="tujuan" class="block mb-1 md:mb-2 font-medium text-gray-800 text-sm">Tujuan</label>
                                <select name="tujuan" id="tujuan" class="w-full p-2 md:p-3 border border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                                    <option value="">Semua Kelas</option>
                                    @foreach($kelasTahuns as $kelasTahun)
                                        <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ old('tujuan') == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
                                            {{ $kelasTahun->kelas->nama_kelas }} - {{ $kelasTahun->tahunajar->tahun_ajaran }} ({{ $kelasTahun->tahunajar->semester }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('tujuan')
                                    <span class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4 md:mb-5">
                                <div class="relative">
                                    <label for="lampiran" class="block mb-1 md:mb-2 font-medium text-gray-800 text-sm">Foto Thumbnail</label>
                                    <input type="file" class="hidden" id="lampiran" name="lampiran" accept="image/*">
                                    <div class="flex items-center justify-between w-full p-2 md:p-3 border border-gray-300 rounded-md text-sm bg-white text-gray-600">
                                        <span id="FileNamaFoto">Pilih file</span>
                                        <div class="flex gap-2">
                                            <button type="button" class="bg-blue-500 text-white px-3 py-1.5 rounded text-xs hover:bg-blue-600 transition h-10 flex items-center justify-center" id="browseButton">Browse</button>
                                            <button type="button" class="bg-red-500 text-white px-3 py-1.5 rounded text-xs hover:bg-red-600 transition h-10 flex items-center justify-center hidden" id="deleteButton">Hapus</button>
                                        </div>
                                    </div>
                                    @error('lampiran')
                                        <span class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-3 md:mt-4 p-4 md:p-5 border-2 border-dashed border-gray-300 rounded-lg md:rounded-xl bg-gray-50 text-center h-40 md:h-48 overflow-hidden transition" id="previewContainer">
                                <img id="previewImage" class="max-w-full max-h-32 md:max-h-40 rounded-md md:rounded-lg shadow-md object-contain hidden" alt="Preview">
                                <div class="previewText text-gray-600 text-xs md:text-sm mt-2">Preview foto akan muncul di sini</div>
                            </div>
                        </div>

                        <div class="flex flex-col relative pt-0 md:pt-14">
                            <div class="flex flex-col md:flex-row gap-4 md:gap-5 items-start md:items-center mb-4 md:mb-0 md:justify-end md:absolute md:top-0 md:right-0">
                                <button type="submit" class="bg-blue-500 text-white px-4 md:px-6 py-2 md:py-3 rounded-md font-medium hover:bg-blue-600 hover:scale-105 transition shadow-md w-full md:w-32 h-12 flex items-center justify-center">Posting</button>
                                <div class="p-3 md:p-4 border border-red-300 bg-red-100 text-red-700 rounded-lg md:rounded-xl hidden w-full md:w-auto" id="errorMessage">
                                    Postingan Bermasalah
                                </div>
                            </div>

                            <div class="mt-4 md:mt-0 mb-4 md:mb-5">
                                <label for="judul" class="block mb-1 md:mb-2 font-medium text-gray-800 text-sm">Judul</label>
                                <input class="w-full p-2 md:p-3 border border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Isi judul postingan" required>
                                @error('judul')
                                    <span class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="max-w-full">
                                <div class="mb-4 md:mb-5">
                                    <label for="isi_trix" class="block mb-1 md:mb-2 font-medium text-gray-800 text-sm">Isi Konten</label>
                                    <input id="isi_trix" type="hidden" name="isi_trix" value="{{ old('isi_trix') }}">
                                    <trix-editor input="isi_trix" class="h-64 md:h-72 min-h-40 md:min-h-48 max-h-64 md:max-h-72 overflow-y-auto border border-gray-300 rounded-md p-3 md:p-4 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Tulis konten postingan Anda di sini..."></trix-editor>
                                    @error('isi_trix')
                                        <span class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            @if ($errors->any())
                <div class="p-3 md:p-4 border border-red-300 bg-red-100 text-red-700 rounded-lg md:rounded-xl">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="pengumumanList" class="{{ request('TipePost') == 'pengumuman' ? 'block' : 'hidden' }}">
                <h2 class="text-gray-800 text-xl md:text-2xl mb-3 md:mb-4 pb-2 relative inline-block after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-12 md:after:w-16 after:bg-blue-500 font-semibold">Daftar Pengumuman</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5 pb-2 md:pb-3 rounded-lg md:rounded-xl max-h-[calc(100vh-400px)] overflow-y-auto">
                    @if(isset($pengumumans) && $pengumumans->isNotEmpty())
                        @foreach($pengumumans as $pengumuman)
                            <div class="bg-white border border-gray-200 rounded-lg md:rounded-xl p-4 md:p-5 shadow-md hover:shadow-lg hover:-translate-y-0.5 transition flex flex-col md:flex-row gap-4 md:gap-5 items-start md:items-stretch min-h-[192px] md:min-h-48">
                                <div class="w-full md:w-48 h-40 md:h-48 bg-cover bg-center rounded-md md:rounded-lg border border-gray-200 flex-shrink-0"
                                    style="{{ $pengumuman->lampiran ? 'background-image: url(\''.asset('storage/' . $pengumuman->lampiran).'\');' : 'background-image: url(\'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80\');' }}">
                                </div>
                                <div class="flex-1 flex flex-col gap-y-2 md:gap-y-3">
                                    <h3 class="text-lg md:text-xl font-semibold text-gray-900 leading-tight mb-1">
                                        {{ $pengumuman->judul }}
                                    </h3>
                                    <p class="text-gray-600 text-xs md:text-sm text-justify line-clamp-4 leading-relaxed flex-grow">
                                        {{ Str::limit(strip_tags($pengumuman->isi), 210) }}
                                    </p>
                                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-3 mt-auto pt-2">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <div class="w-8 md:w-10 h-8 md:h-10 rounded-full bg-gray-100 flex items-center justify-center font-semibold text-gray-800 text-sm md:text-base border-2 border-gray-200">
                                                @if($pengumuman->profile)
                                                    {{ strtoupper(substr($pengumuman->profile->name, 0, 2)) }}
                                                @else
                                                    ??
                                                @endif
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-800 text-sm">
                                                    @if($pengumuman->profile)
                                                        {{ $pengumuman->profile->name }}
                                                    @else
                                                        Unknown Author
                                                    @endif
                                                </span>
                                                <span class="text-gray-600 text-xs md:text-sm">{{ $pengumuman->created_at->format('M d, Y') }}</span>
                                                <span class="text-gray-600 text-xs md:text-sm">
                                                    Tujuan: {{ $pengumuman->kelasTahun ? $pengumuman->kelasTahun->kelas->nama_kelas . ' - ' : '' }}
                                                    {{ $pengumuman->kelasTahun ? $pengumuman->kelasTahun->tahunajar->tahun_ajaran : 'Publik' }}
                                                    {{ $pengumuman->kelasTahun ? '(' . $pengumuman->kelasTahun->tahunajar->semester . ')' : '' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex gap-2 w-full md:w-auto">
                                            <a href="{{ route('admin.post.edit', ['id' => $pengumuman->postingan_id]) }}" class="max-h-[37px] bg-blue-500 text-white px-3 md:px-4 py-1.5 md:py-2 rounded-md text-xs md:text-sm font-medium hover:bg-blue-600 hover:shadow-md transition w-full md:w-auto flex items-center justify-center h-8 md:w-auto">Edit</a>
                                            <form action="{{ route('admin.post.hapus', ['id' => $pengumuman->postingan_id]) }}" method="POST" class="delete-post-form w-full md:w-auto">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="TipePost" value="pengumuman">
                                                <button type="submit" class="bg-red-500 text-white px-3 md:px-4 py-1.5 md:py-2 rounded-md text-xs md:text-sm font-medium hover:bg-red-600 hover:shadow-md transition w-full md:w-auto flex items-center justify-center h-8 md:w-auto">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-left text-gray-600 text-sm md:text-base p-6 md:p-10 rounded-md md:rounded-lg min-h-16 md:min-h-20">Tidak ada pengumuman tersedia.</p>
                    @endif
                </div>
            </div>

            <div id="blogList" class="{{ request('TipePost') == 'blog' ? 'block' : 'hidden' }}">
                <h2 class="text-gray-800 text-xl md:text-2xl mb-3 md:mb-4 pb-2 relative inline-block after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-12 md:after:w-16 after:bg-blue-500 font-semibold">Daftar Blog</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5 pb-2 md:pb-3 rounded-lg md:rounded-xl max-h-[calc(100vh-400px)] overflow-y-auto">
                    @if(isset($blogs) && $blogs->isNotEmpty())
                        @foreach($blogs as $blog)
                            <div class="bg-white border border-gray-200 rounded-lg md:rounded-xl p-4 md:p-5 shadow-md hover:shadow-lg hover:-translate-y-0.5 transition flex flex-col md:flex-row gap-4 md:gap-5 items-start md:items-stretch min-h-[192px] md:min-h-48">
                                <div class="w-full md:w-48 h-40 md:h-48 bg-cover bg-center rounded-md md:rounded-lg border border-gray-200 flex-shrink-0"
                                    style="{{ $blog->lampiran ? 'background-image: url(\''.asset('storage/' . $blog->lampiran).'\');' : 'background-image: url(\'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80\');' }}">
                                </div>
                                <div class="flex-1 flex flex-col gap-y-2 md:gap-y-3">
                                    <h3 class="text-lg md:text-xl font-semibold text-gray-900 leading-tight mb-1">
                                        {{ $blog->judul }}
                                    </h3>
                                    <p class="text-gray-600 text-xs md:text-sm text-justify line-clamp-4 leading-relaxed flex-grow">
                                        {{ Str::limit(strip_tags($blog->isi), 210) }}
                                    </p>
                                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-3 mt-auto pt-2">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <div class="w-8 md:w-10 h-8 md:h-10 rounded-full bg-gray-100 flex items-center justify-center font-semibold text-gray-800 text-sm md:text-base border-2 border-gray-200">
                                                @if($blog->profile)
                                                    {{ strtoupper(substr($blog->profile->name, 0, 2)) }}
                                                @else
                                                    ??
                                                @endif
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-800 text-sm">
                                                    @if($blog->profile)
                                                        {{ $blog->profile->name }}
                                                    @else
                                                        Unknown Author
                                                    @endif
                                                </span>
                                                <span class="text-gray-600 text-xs md:text-sm">{{ $blog->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-2 w-full md:w-auto">
                                            <a href="{{ route('admin.post.edit', ['id' => $blog->postingan_id]) }}" class="bg-blue-500 text-white px-3 md:px-4 py-1.5 md:py-2 rounded-md text-xs md:text-sm font-medium hover:bg-blue-600 hover:shadow-md transition w-full md:w-auto flex items-center justify-center h-8 md:w-auto">Edit</a>
                                            <form action="{{ route('admin.post.hapus', ['id' => $blog->postingan_id]) }}" method="POST" class="delete-post-form w-full md:w-auto">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="TipePost" value="blog">
                                                <button type="submit" class="bg-red-500 text-white px-3 md:px-4 py-1.5 md:py-2 rounded-md text-xs md:text-sm font-medium hover:bg-red-600 hover:shadow-md transition w-full md:w-auto flex items-center justify-center h-8 md:w-auto">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-left text-gray-600 text-sm md:text-base p-6 md:p-10 rounded-md md:rounded-lg min-h-16 md:min-h-20">Tidak ada blog tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pengumumanRadio = document.getElementById('pengumuman');
            const blogRadio = document.getElementById('blog');
            const tujuanContainer = document.getElementById('tujuanContainer');
            const trixEditor = document.querySelector('trix-editor');

            // --- Mulai Kode Switch Baru ---
            const switchWrapper = document.querySelector('.custom-switch-wrapper');
            const switchIndicator = document.querySelector('.custom-switch-indicator');
            const switchLabels = document.querySelectorAll('.custom-switch-label');

            function updateSwitchIndicator() {
                let checkedLabel;
                if (pengumumanRadio.checked) {
                    checkedLabel = document.querySelector('label[for="pengumuman"]');
                } else if (blogRadio.checked) {
                    checkedLabel = document.querySelector('label[for="blog"]');
                }

                if (checkedLabel) {
                    const wrapperRect = switchWrapper.getBoundingClientRect();
                    const labelRect = checkedLabel.getBoundingClientRect();

                    const leftPosition = labelRect.left - wrapperRect.left;
                    const width = labelRect.width;

                    switchIndicator.style.left = `${leftPosition}px`;
                    switchIndicator.style.width = `${width}px`;

                    // Update text color of labels based on active state (JS controlled)
                    switchLabels.forEach(label => {
                        if (label === checkedLabel) {
                            label.classList.remove('text-gray-700');
                            label.classList.add('text-white');
                        } else {
                            label.classList.remove('text-white');
                            label.classList.add('text-gray-700');
                        }
                    });
                }
            }

            // Event listener untuk radio buttons
            pengumumanRadio.addEventListener('change', updateSwitchIndicator);
            blogRadio.addEventListener('change', updateSwitchIndicator);

            // Panggil saat halaman dimuat untuk posisi awal
            updateSwitchIndicator();
            // Panggil saat window diresize untuk menyesuaikan jika tata letak berubah
            window.addEventListener('resize', updateSwitchIndicator);
            // --- Akhir Kode Switch Baru ---


            function toggleTujuan() {
                if (pengumumanRadio.checked) {
                    tujuanContainer.classList.remove('hidden');
                } else {
                    tujuanContainer.classList.add('hidden');
                }
            }

            pengumumanRadio.addEventListener('change', toggleTujuan);
            blogRadio.addEventListener('change', toggleTujuan);

            // Initial state for 'Tujuan'
            toggleTujuan();

            // Image upload and preview logic
            const lampiranInput = document.getElementById('lampiran');
            const fileNamaFotoSpan = document.getElementById('FileNamaFoto');
            const browseButton = document.getElementById('browseButton');
            const deleteButton = document.getElementById('deleteButton');
            const previewImage = document.getElementById('previewImage');
            const previewText = document.querySelector('.previewText');
            const previewContainer = document.getElementById('previewContainer');

            browseButton.addEventListener('click', function() {
                lampiranInput.click();
            });

            lampiranInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        previewText.classList.add('hidden');
                        deleteButton.classList.remove('hidden');
                        fileNamaFotoSpan.textContent = lampiranInput.files[0].name;
                        previewContainer.classList.add('border-blue-500', 'bg-white'); // Apply Tailwind classes
                        previewContainer.classList.remove('border-gray-300', 'bg-gray-50'); // Remove default Tailwind classes
                    };
                    reader.readAsDataURL(this.files[0]);
                } else {
                    previewImage.classList.add('hidden');
                    previewText.classList.remove('hidden');
                    deleteButton.classList.add('hidden');
                    fileNamaFotoSpan.textContent = 'Pilih file';
                    previewContainer.classList.remove('border-blue-500', 'bg-white'); // Remove Tailwind classes
                    previewContainer.classList.add('border-gray-300', 'bg-gray-50'); // Add default Tailwind classes
                }
            });

            deleteButton.addEventListener('click', function() {
                lampiranInput.value = ''; // Clear the selected file
                previewImage.classList.add('hidden');
                previewText.classList.remove('hidden');
                this.classList.add('hidden'); // Hide delete button
                fileNamaFotoSpan.textContent = 'Pilih file';
                previewContainer.classList.remove('border-blue-500', 'bg-white'); // Remove Tailwind classes
                previewContainer.classList.add('border-gray-300', 'bg-gray-50'); // Add default Tailwind classes
            });

            // Handle success/error messages
            const successAlert = document.getElementById('successAlert');
            if (successAlert.textContent.trim() !== '') {
                successAlert.classList.remove('hidden');
                setTimeout(() => {
                    successAlert.classList.add('hidden');
                }, 5000); // Hide after 5 seconds
            }

            // Client-side form validation for general messages (can be enhanced with specific field errors)
            const postForm = document.getElementById('postForm');
            const errorMessage = document.getElementById('errorMessage');

            postForm.addEventListener('submit', function(e) {
                const judul = document.getElementById('judul').value.trim();
                const isiInput = document.getElementById('isi_trix');
                const trixContent = trixEditor ? trixEditor.editor.getDocument().toString().trim() : '';

                if (!judul || !trixContent) {
                    errorMessage.classList.remove('hidden');
                    errorMessage.textContent = 'Judul dan konten tidak boleh kosong.';
                    e.preventDefault(); // Prevent form submission
                } else {
                    errorMessage.classList.add('hidden');
                }
            });

        });
    </script>
</body>