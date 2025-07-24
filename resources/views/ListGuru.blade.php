@include('partials.header', ['NamaPage' => 'Daftar Guru'])

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Daftar Guru</h1>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($gurus as $guru)
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center">
                    @if($guru->profile && $guru->profile->avatar && file_exists(public_path('storage/file/' . $guru->profile->avatar)))
                        <img
                            src="{{ asset('storage/file/' . $guru->profile->avatar . '?v=' . time()) }}"
                            alt="{{ $guru->profile->name }} Avatar"
                            class="w-28 h-28 object-cover rounded-full border-4 border-blue-500 mb-4">
                    @else
                        <div
                            class="flex items-center justify-center w-28 h-28 rounded-full border-4 border-blue-500 bg-gray-200 text-2xl md:text-3xl font-semibold text-blue-600 uppercase mb-4">
                            {{ strtoupper(substr($guru->profile->name, 0, 2)) }}
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold">{{ $guru->profile->name }}</h3>
                    <p class="text-sm text-gray-600">Sebagai</p>
                    <p class="text-sm text-gray-800 mb-2">{{ $guru->jabatan ? $guru->jabatan : '...' }}</p>

                    @auth
                        @if(session('role') === 'admin')
                            <form action="{{ route('admin.updateGuruStatus', $guru->guru_id) }}" method="POST" class="mt-2 w-full">
                                @csrf
                                @method('PUT')
                                <input type="text" name="jabatan" 
                                       value="" 
                                       placeholder="Masukkan jabatan (misalnya, Kepala Sekolah)" 
                                       class="w-full text-sm text-center border border-gray-300 rounded-md p-1 mb-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <button type="submit" 
                                        class="w-full bg-green-500 hover:bg-green-600 text-white text-sm font-semibold py-1 px-2 rounded">
                                    Edit
                                </button>
                            </form>
                        @endif
                    @endauth

                    <button onclick="openModal('modal-{{ $guru->guru_id }}')"
                            class="mt-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                        Info
                    </button>
                </div>

                <div id="modal-{{ $guru->guru_id }}"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
                    aria-modal="true" role="dialog" tabindex="-1">

                    <div class="bg-white rounded-lg p-6 w-full max-w-md
                                transform transition-all duration-300 ease-out scale-95 opacity-0"
                        id="modal-content-{{ $guru->guru_id }}">
                        <h2 class="text-xl font-bold mb-4">{{ $guru->profile->name }}</h2>
                        <div class="space-y-2">
                            <p><strong>Email:</strong> {{ $guru->profile->email }}</p>
                            <p><strong>Alamat:</strong> {{ $guru->profile->alamat }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $guru->profile->jenis_kelamin }}</p>
                            <p><strong>Tanggal Lahir:</strong> {{ $guru->profile->tanggal_lahir->format('d-m-Y') }}</p>
                            <p><strong>Tempat Lahir:</strong> {{ $guru->profile->tempat_lahir }}</p>
                            <p><strong>Pendidikan:</strong> {{ $guru->profile->pendidikan }}</p>
                            <p><strong>No. Telp:</strong> {{ $guru->profile->no_telp }}</p>
                            <p><strong>Gelar:</strong> {{ $guru->gelar }}</p>
                            <p><strong>Status Menikah:</strong> {{ $guru->statusMenikah }}</p>
                            <p><strong>Status Kerja:</strong> {{ $guru->statusKerja }}</p>
                            <p><strong>NUPTK:</strong> {{ $guru->nuptk }}</p>
                            <p><strong>Jabatan:</strong> {{ $guru->jabatan ? $guru->jabatan : '...' }}</p>
                        </div>
                        <button onclick="closeModal('modal-{{ $guru->guru_id }}')"
                                class="mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                            Close
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            const modalContent = document.getElementById(modalId.replace('modal-', 'modal-content-'));

            if (modal && modalContent) {
                modal.classList.remove('hidden');
                void modalContent.offsetWidth;
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const modalContent = document.getElementById(modalId.replace('modal-', 'modal-content-'));

            if (modal && modalContent) {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');

                modalContent.addEventListener('transitionend', function handler() {
                    modal.classList.add('hidden');
                    modalContent.removeEventListener('transitionend', handler);
                }, { once: true });
            }
        }
    </script>
</body>

@include('partials.footer')