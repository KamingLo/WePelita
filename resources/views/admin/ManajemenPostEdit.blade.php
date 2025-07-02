@include('admin.partials.header')
@include('admin.partials.sidebar')
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('js/CssAdmin.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

<body>
    <div class="ml-0 md:ml-64 p-4 md:p-8 flex flex-wrap gap-4 md:gap-6 min-h-[82vh] md:min-h-[calc(100vh-100px)] pb-10 md:pb-20">
        <h1 class="w-full text-[#343a40] mb-2 text-2xl font-bold relative pb-2 md:mt-0">Manajemen Post
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-[#4a6cf7]"></span>
        </h1>

        @if($errors->any())
            <div class="p-3 md:p-4 border border-red-300 bg-red-100 text-red-700 rounded-lg md:rounded-xl w-full">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="w-full bg-white p-4 md:p-6 rounded-lg md:rounded-xl shadow-md md:shadow-lg mb-4 md:mb-6 h-auto overflow-hidden">
            <div class="block" id="tambahPost">
                <h2 class="text-gray-800 text-xl md:text-2xl mb-3 md:mb-4 pb-2 relative inline-block after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-12 md:after:w-16 after:bg-blue-500 font-semibold mt-4">Edit {{ $postingan->tipe == 'pengumuman' ? 'Pengumuman' : 'Blog' }}</h2>
                <form id="postForm" action="{{ route('admin.post.update', ['id' => $postingan->postingan_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-x-6 gap-y-4 md:gap-y-6">
                        <div class="flex flex-col max-w-full md:max-w-[420px]">
                            <div class="mb-4 md:mb-5">
                                <div class="mb-4 md:mb-5">
                                    <label class="block mb-1 md:mb-2 font-medium text-gray-800 text-sm">Tipe Postingan</label>
                                    <div class="custom-switch-wrapper relative flex p-1 bg-gray-500 rounded-lg shadow-inner">
                                        <input type="radio" id="pengumuman" name="tipe" value="pengumuman" {{ old('tipe', $postingan->tipe) == 'pengumuman' ? 'checked' : '' }} class="hidden">
                                        <input type="radio" id="blog" name="tipe" value="blog" {{ old('tipe', $postingan->tipe) == 'blog' ? 'checked' : '' }} class="hidden">

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

                            <div class="mb-4 md:mb-5 {{ old('tipe', $postingan->tipe) == 'pengumuman' ? 'block' : 'hidden' }}" id="tujuanContainer">
                                <label for="tujuan" class="block mb-1 md:mb-2 font-medium text-gray-800 text-sm">Tujuan</label>
                                <select name="tujuan" id="tujuan" class="w-full p-2 md:p-3 border border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                                    <option value="">Semua Kelas</option>
                                    @foreach($kelasTahuns as $kelasTahun)
                                        <option value="{{ $kelasTahun->kelas_tahun_id }}" {{ old('tujuan', $postingan->kelas_tahun_id) == $kelasTahun->kelas_tahun_id ? 'selected' : '' }}>
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
                                        <span id="FileNamaFoto">{{ $postingan->lampiran ? basename($postingan->lampiran) : 'Pilih file' }}</span>
                                        <div class="flex gap-2">
                                            <button type="button" class="bg-blue-500 text-white px-3 py-1.5 rounded text-xs hover:bg-blue-600 transition h-10 flex items-center justify-center" id="browseButton">Browse</button>
                                            <button type="button" class="bg-red-500 text-white px-3 py-1.5 rounded text-xs hover:bg-red-600 transition h-10 flex items-center justify-center {{ $postingan->lampiran ? 'block' : 'hidden' }}" id="deleteButton">Hapus</button>
                                        </div>
                                    </div>
                                    @error('lampiran')
                                        <span class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-3 md:mt-4 p-4 md:p-5 border-2 border-dashed border-gray-300 rounded-lg md:rounded-xl bg-gray-50 text-center h-40 md:h-48 overflow-hidden transition {{ $postingan->lampiran ? 'border-blue-500 bg-white' : '' }}" id="previewContainer">
                                @if($postingan->lampiran)
                                    <img id="previewImage" class="max-w-full max-h-32 md:max-h-40 rounded-md md:rounded-lg shadow-md object-contain block" src="{{ asset('storage/' . $postingan->lampiran) }}" alt="Preview">
                                @else
                                    <img id="previewImage" class="max-w-full max-h-32 md:max-h-40 rounded-md md:rounded-lg shadow-md object-contain hidden" alt="Preview">
                                @endif
                                <div class="previewText text-gray-600 text-xs md:text-sm mt-2 {{ $postingan->lampiran ? 'hidden' : 'block' }}">Preview foto akan muncul di sini</div>
                            </div>
                        </div>

                        <div class="flex flex-col relative pt-0 md:pt-14">
                            <div class="flex flex-col md:flex-row gap-4 md:gap-5 items-start md:items-center mb-4 md:mb-0 md:justify-end md:absolute md:top-0 md:right-0">
                                <button type="submit" class="bg-blue-500 text-white px-4 md:px-6 py-2 md:py-3 rounded-md font-medium hover:bg-blue-600 hover:scale-105 transition shadow-md w-full md:w-32 h-12 flex items-center justify-center">Update</button>
                                <a href="{{ route('admin.manajemenPost', ['TipePost' => $postingan->tipe]) }}" class="bg-red-500 text-white px-4 md:px-6 py-2 md:py-3 rounded-md font-medium hover:bg-red-600 hover:scale-105 transition shadow-md w-full md:w-32 h-12 flex items-center justify-center">Cancel</a>
                                <div class="p-3 md:p-4 border border-red-300 bg-red-100 text-red-700 rounded-lg md:rounded-xl hidden w-full md:w-auto" id="errorMessage">
                                    Terjadi kesalahan!
                                </div>
                            </div>

                            <div class="mt-4 md:mt-0 mb-4 md:mb-5">
                                <label for="judul" class="block mb-1 md:mb-2 font-medium text-gray-800 text-sm">Judul</label>
                                <input class="w-full p-2 md:p-3 border border-gray-300 rounded-md text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" type="text" id="judul" name="judul" value="{{ old('judul', $postingan->judul) }}" placeholder="Isi judul postingan" required>
                                @error('judul')
                                    <span class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="max-w-full">
                                <div class="mb-4 md:mb-5">
                                    <label for="isi_trix" class="block mb-1 md:mb-2 font-medium text-gray-800 text-sm">Isi Konten</label>
                                    <input id="isi_trix" type="hidden" name="isi" value="{{ old('isi', $postingan->isi) }}">
                                    <trix-editor input="isi_trix" class="h-64 md:h-72 min-h-40 md:min-h-48 max-h-64 md:max-h-72 overflow-y-auto border border-gray-300 rounded-md p-3 md:p-4 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Tulis konten postingan Anda di sini..."></trix-editor>
                                    @error('isi')
                                        <span class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pengumumanRadio = document.getElementById('pengumuman');
            const blogRadio = document.getElementById('blog');
            const tujuanContainer = document.getElementById('tujuanContainer');
            const trixEditor = document.querySelector('trix-editor'); // Corrected selector for trix-editor

            // --- Mulai Kode Switch Baru (from manajemenPost.blade.php) ---
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
                        previewContainer.classList.add('border-blue-500', 'bg-white');
                        previewContainer.classList.remove('border-gray-300', 'bg-gray-50');
                    };
                    reader.readAsDataURL(this.files[0]);
                } else {
                    // This part handles if a file is selected and then cleared, or no file was initially present.
                    // If no initial image, hide preview and show text.
                    if (previewImage.src === window.location.origin + '/' + previewImage.getAttribute('src')) { // Check if it's the default blank image
                        previewImage.classList.add('hidden');
                    }
                    previewText.classList.remove('hidden');
                    deleteButton.classList.add('hidden');
                    fileNamaFotoSpan.textContent = 'Pilih file';
                    previewContainer.classList.remove('border-blue-500', 'bg-white');
                    previewContainer.classList.add('border-gray-300', 'bg-gray-50');
                }
            });

            deleteButton.addEventListener('click', function() {
                lampiranInput.value = ''; // Clear the selected file
                previewImage.classList.add('hidden');
                previewImage.src = ''; // Clear the image source
                previewText.classList.remove('hidden');
                this.classList.add('hidden'); // Hide delete button
                fileNamaFotoSpan.textContent = 'Pilih file';
                previewContainer.classList.remove('border-blue-500', 'bg-white');
                previewContainer.classList.add('border-gray-300', 'bg-gray-50');
            });

            // Client-side form validation for general messages (can be enhanced with specific field errors)
            const postForm = document.getElementById('postForm');
            const errorMessage = document.getElementById('errorMessage');

            postForm.addEventListener('submit', function(e) {
                const judul = document.getElementById('judul').value.trim();
                const isiInput = document.getElementById('isi_trix'); // Correct ID for hidden input
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