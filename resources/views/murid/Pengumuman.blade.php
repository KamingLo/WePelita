@include('murid.partials.header')
@include('murid.partials.sidebar')

<body class="font-sans text-gray-700 m-0 p-0 overflow-x-hidden md:overflow-x-auto">
    <div class="md:ml-[256px] px-4 md:px-8 py-8 flex flex-col gap-8">
        <h2 class="w-full text-gray-800 mb-2 text-2xl font-bold relative pb-2 md:mt-0">
            Daftar Pengumuman
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
        </h2>

        <div class="w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pb-2 rounded-xl overflow-y-auto max-h-[calc(100vh-250px)]">
                @if($announcements->isNotEmpty())
                    @foreach($announcements as $announcement)
                        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-md transition-all duration-300 ease-in-out flex flex-col md:flex-row gap-5 items-center min-h-[200px] hover:shadow-lg hover:-translate-y-0.5">
                            <div class="w-[200px] h-[200px] md:w-[200px] md:h-[200px] flex-shrink-0 rounded-lg border border-gray-200 overflow-hidden">
                                <img src="{{ $announcement->lampiran ? asset('storage/' . $announcement->lampiran) : 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80' }}"
                                     alt="{{ $announcement->judul }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 flex flex-col gap-2 mt-0 h-auto">
                                <h3 class="text-xl font-semibold text-gray-900 leading-tight">
                                    {{ $announcement->judul }}
                                </h3>
                                <p class="text-gray-600 text-sm overflow-hidden min-h-[5rem] text-justify">
                                    {{ Str::limit(strip_tags($announcement->isi), 210) }}
                                </p>
                                <div class="flex justify-between items-center gap-2 mt-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-semibold text-gray-700 text-base border-2 border-gray-200">
                                            @if($announcement->profile)
                                                {{ strtoupper(substr($announcement->profile->name, 0, 2)) }}
                                            @else
                                                ??
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-800 text-sm">
                                                @if($announcement->profile)
                                                    {{ $announcement->profile->name }}
                                                @else
                                                    Unknown Author
                                                @endif
                                            </span>
                                            <span class="text-gray-500 text-xs">{{ $announcement->created_at->format('M d, Y') }}</span>
                                            <span class="text-gray-500 text-xs">
                                                Tujuan: {{ $announcement->kelasTahun ? $announcement->kelasTahun->kelas->nama_kelas . ' - ' . $announcement->kelasTahun->tahunajar->tahun_ajaran : 'Publik' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="#" class="TombolBacaSelengkapnya inline-flex items-center font-medium select-none border border-blue-600 px-4 py-2 text-sm leading-normal rounded-md transition-all duration-300 ease-in-out cursor-pointer no-underline text-white bg-blue-600 hover:bg-blue-700 hover:border-blue-700 hover:shadow-lg hover:shadow-blue-600/30" data-id="{{ $announcement->postingan_id }}">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="p-4 text-gray-600 col-span-full">Tidak ada pengumuman tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    <div id="announcementPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[1000] flex items-center justify-center">
        <div class="relative bg-white m-auto p-5 rounded-lg w-11/12 max-w-4xl shadow-lg max-h-[90vh] overflow-y-auto">
            <div class="flex flex-col gap-5">
                <div class="blog-image w-full h-auto rounded-lg object-cover" data-aos="fade-up"></div>
                <div class="blog-content px-0 md:px-5" data-aos="fade-up" data-aos-delay="100">
                    <h1 class="popup-title text-2xl md:text-3xl font-bold text-gray-800 mb-3"></h1>
                    <div class="blog-meta flex gap-5 text-gray-500 text-sm mb-4">
                        <span class="author flex items-center gap-1"><i class='bx bx-user'></i> <span class="popup-author"></span></span>
                        <span class="date flex items-center gap-1"><i class='bx bx-calendar'></i> <span class="popup-date"></span></span>
                    </div>
                    <div class="blog-body text-gray-700 text-base leading-relaxed"></div>
                    <a href="#" class="back-btn inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-blue-600 border border-blue-600 rounded-md no-underline transition-all duration-300 ease-in-out w-fit mt-5 hover:bg-blue-700 hover:border-blue-700 hover:shadow-lg hover:shadow-blue-600/30" data-aos="fade-up" data-aos-delay="200">
                        <i class='bx bx-arrow-back'></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });

            $('.TombolBacaSelengkapnya').on('click', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                console.log('Fetching announcement ID:', id);

                let url = '';
                const role = '{{ session('role') }}';
                if (role === 'orangtua') {
                    url = `/announcement/orangtua/${id}`;
                } else if (role === 'murid') {
                    url = `/announcement/murid/${id}`;
                } else {
                    console.error('Unknown role:', role);
                    alert('Role not recognized. Please log in again.');
                    return;
                }

                $.ajax({
                    url: url,
                    method: 'GET',
                    xhrFields: {
                        withCredentials: true
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    success: function(data) {
                        console.log('Data received:', data);
                        $('#announcementPopup .blog-image').html(
                            data.lampiran ? `<img src="{{ asset('storage/') }}/${data.lampiran}" alt="${data.judul}" class="w-full h-auto rounded-lg object-cover">` :
                            `<img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="${data.judul}" class="w-full h-auto rounded-lg object-cover">`
                        );
                        $('#announcementPopup .popup-title').text(data.judul);
                        $('#announcementPopup .popup-author').text(data.profile?.name ?? 'Penulis Tidak Diketahui');
                        $('#announcementPopup .popup-date').text(moment(data.created_at).format('MMM D, YYYY'));
                        $('#announcementPopup .blog-body').html(data.isi);
                        $('#announcementPopup').fadeIn();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        console.log('Response:', jqXHR.responseText);
                        let response = jqXHR.responseJSON;
                        let errorMessage = response?.error || 'Failed to load announcement. Please try again.';
                        alert(errorMessage);
                    }
                });
            });

            $(document).on('click', '.close-btn', function() {
                $('#announcementPopup').fadeOut();
            });

            $(document).on('click', '.back-btn', function(e) {
                e.preventDefault();
                console.log('Kembali button clicked');
                $('#announcementPopup').fadeOut();
            });

            $(window).on('click', function(e) {
                if ($(e.target).is('#announcementPopup')) {
                    $('#announcementPopup').fadeOut();
                }
            });
        });
    </script>
</body>