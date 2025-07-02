@include('partials.header', ['NamaPage' => 'SMK Pelita IV'])

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />

<style>
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .text-shadow-lg {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    .text-shadow-md {
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
    }
    
    .hero-slide {
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .hero-slide.active {
        opacity: 1 !important;
        z-index: 10 !important;
    }
    
    .hero-slide.inactive {
        opacity: 0 !important;
        z-index: 1 !important;
    }
    
    .slide-content {
        animation: slideInRight 0.8s ease-out forwards;
    }
    
    .slide-indicators {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 30;
    }
    
    .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .indicator.active {
        background: white;
        transform: scale(1.2);
    }

    .section-title {
        position: relative;
        padding-bottom: 1rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 4rem;
        height: 4px;
        background-color: #2563eb;
        border-radius: 9999px;
    }

    .hero-heading {
        font-size: 2.25rem;
        line-height: 1.2;
    }
    @media (min-width: 640px) {
        .hero-heading {
            font-size: 2.5rem;
        }
    }
    @media (min-width: 768px) {
        .hero-heading {
            font-size: 3rem;
        }
    }
    @media (min-width: 1024px) {
        .hero-heading {
            font-size: 3rem;
        }
    }

    .hero-paragraph {
        font-size: 1rem;
        line-height: 1.5;
    }
    @media (min-width: 640px) {
        .hero-paragraph {
            font-size: 1.125rem;
        }
    }

    .profile-video-wrapper {
        z-index: 1;
    }
    @media (min-width: 768px) {
        .profile-video-wrapper {
            z-index: auto;
        }
    }

    .main-content-container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    @media (min-width: 640px) {
        .main-content-container {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    }
    @media (min-width: 1024px) {
        .main-content-container {
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
        }
    }

    @media (max-width: 640px) {
        section.relative.w-full {
            aspect-ratio: 16 / 9;
            max-height: 360px;
            min-height: 200px;
        }

        .hero-slide img {
            object-fit: cover;
            object-position: center;
        }

        .hero-slide .slide-content {
            bottom: 5px;
            padding: 1rem;
            max-width: 90%;
            /* Removed left and transform here as we will use flex/margin for centering */
            text-align: center; /* Ensures text inside is centered */
            margin-left: auto; /* New: Auto margins for horizontal centering */
            margin-right: auto; /* New: Auto margins for horizontal centering */
        }

        .hero-heading {
            font-size: 1.5rem;
        }

        .hero-paragraph {
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .slide-indicators {
            bottom: 5px;
            gap: 5px;
        }

        .indicator {
            width: 8px;
            height: 8px;
        }

        .hero-slide .slide-content a {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        #prevBtn, #nextBtn {
            padding: 0.5rem;
            font-size: 0.875rem;
        }
    }
</style>

<section class="relative w-full" style="height: 90vh;">
    <div class="absolute inset-0 overflow-hidden z-0 rounded-xl shadow-xl mx-4 sm:mx-8 my-4 sm:my-8">
        <div class="hero-slide absolute inset-0 active" data-slide="0">
            <div class="absolute inset-0 bg-blue-800 rounded-xl"></div>
            <img src="{{ asset('image/imageSekolah.png') }}" 
                 alt="SMK Pelita IV Jakarta" 
                 class="absolute inset-0 w-full h-full object-cover rounded-xl">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/20 rounded-xl 
                        md:bg-gradient-to-r md:from-black/20 md:to-black/70"></div>
            
            <div class="absolute bottom-10 left-0 right-0 mx-auto text-center text-white z-20 w-[calc(100%-2rem)] max-w-xl p-4 
                        md:bottom-10 md:right-20 md:left-auto md:transform-none md:text-right md:p-6">
                <div class="slide-content">
                    <h1 class="hero-heading font-bold mb-4 text-shadow-lg leading-tight">
                        Selamat Datang di<br>SMK Pelita IV Jakarta
                    </h1>
                    <p class="hero-paragraph mb-6 text-shadow-md text-gray-200">
                        Membangun Generasi Unggul, Berkarakter <br> dan Siap untuk Masa Depan
                    </p>
                    <a href="#main-content" 
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 hover:scale-105 shadow-lg transition-all duration-300 text-sm md:text-base">
                        Mulai Jelajahi
                        <i class='bx bx-chevron-down ml-2 text-xl animate-bounce'></i>
                    </a>
                </div>
            </div>
        </div>

        @foreach($blogs->take(5) as $index => $blog)
            <div class="hero-slide absolute inset-0 inactive" data-slide="{{ $index + 1 }}">
                <div class="absolute inset-0 bg-gray-800 rounded-xl"></div>
                <img src="{{ $blog->lampiran ? asset('storage/' . $blog->lampiran) : 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' }}" 
                     alt="{{ $blog->judul }}" 
                     class="absolute inset-0 w-full h-full object-cover rounded-xl"
                     onerror="this.src='https://via.placeholder.com/1200x800/1E40AF/FFFFFF?text=Blog+Post'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/20 rounded-xl 
                            md:bg-gradient-to-r md:from-black/30 md:to-black/80"></div>
                
                <div class="absolute bottom-10 left-0 right-0 mx-auto text-center text-white z-20 w-[calc(100%-2rem)] max-w-xl p-4 
                            md:bottom-10 md:right-20 md:left-auto md:transform-none md:text-right md:p-6">
                    <div class="slide-content">
                        <h1 class="hero-heading font-bold mb-4 text-shadow-lg leading-tight">
                            {{ $blog->judul }}
                        </h1>
                        <a href="{{ route('blog.show', $blog->postingan_id) }}" 
                           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 hover:scale-105 shadow-lg transition-all duration-300 text-sm md:text-base">
                            Baca Selengkapnya
                            <i class='bx bx-right-arrow-alt ml-2 text-xl'></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <button id="prevBtn" class="absolute top-1/2 left-2 sm:left-4 -translate-y-1/2 bg-black/50 hover:bg-blue-600 text-white rounded-full p-2 sm:p-3 text-lg sm:text-xl backdrop-blur-sm transition-all duration-300 hover:scale-110 z-30" 
                aria-label="Previous Slide">
            <i class='bx bx-chevron-left'></i>
        </button>
        
        <button id="nextBtn" class="absolute top-1/2 right-2 sm:right-4 -translate-y-1/2 bg-black/50 hover:bg-blue-600 text-white rounded-full p-2 sm:p-3 text-lg sm:text-xl backdrop-blur-sm transition-all duration-300 hover:scale-110 z-30" 
                aria-label="Next Slide">
            <i class='bx bx-chevron-right'></i>
        </button>

        <div class="slide-indicators">
            <div class="indicator active" data-slide="0"></div>
            @foreach($blogs->take(5) as $index => $blog)
                <div class="indicator" data-slide="{{ $index + 1 }}"></div>
            @endforeach
        </div>
    </div>
</section>

<div id="main-content" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <section class="py-12 md:py-20">
        <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 section-title">Profile SMK Pelita IV</h2>
            </div>
        <div class="flex flex-col md:flex-row flex-wrap items-center gap-8 md:gap-10">
            <div class="flex-1 min-w-[280px] md:min-w-[300px]" data-aos="fade-right">
                <p class="mb-4 text-gray-600 leading-relaxed text-sm sm:text-base md:text-lg">
                    SMK Pelita IV Jakarta berdiri sejak tahun 1987 dan telah mencetak ribuan lulusan berkualitas yang tersebar di berbagai bidang pekerjaan. Berlokasi strategis di Jl. Duri Utara No.23-29, Jakarta Barat, sekolah kami dilengkapi dengan fasilitas modern yang mendukung proses pembelajaran.
                </p>
                <p class="mb-4 text-gray-600 leading-relaxed text-sm sm:text-base md:text-lg">
                    Dengan akreditasi A, SMK Pelita IV Jakarta terus berinovasi dalam mengembangkan kurikulum yang sesuai dengan perkembangan teknologi dan kebutuhan industri. Kami juga menjalin kerja sama dengan berbagai perusahaan untuk program prakerin dan penempatan kerja lulusan.
                </p>
                <div class="grid grid-cols-2 gap-4 mt-6 md:mt-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="text-center p-4 bg-white rounded-lg shadow hover:-translate-y-2 hover:shadow-lg transition-all" data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-2xl sm:text-3xl font-bold text-blue-600 mb-1">35+</div>
                        <div class="text-xs text-gray-600">Tahun Pengalaman</div>
                    </div>
                    <div class="text-center p-4 bg-white rounded-lg shadow hover:-translate-y-2 hover:shadow-lg transition-all" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-2xl sm:text-3xl font-bold text-blue-600 mb-1">500+</div>
                        <div class="text-xs text-gray-600">Siswa Aktif</div>
                    </div>
                    <div class="text-center p-4 bg-white rounded-lg shadow hover:-translate-y-2 hover:shadow-lg transition-all" data-aos="zoom-in" data-aos-delay="300">
                        <div class="text-2xl sm:text-3xl font-bold text-blue-600 mb-1">50+</div>
                        <div class="text-xs text-gray-600">Tenaga Pendidik</div>
                    </div>
                    <div class="text-center p-4 bg-white rounded-lg shadow hover:-translate-y-2 hover:shadow-lg transition-all" data-aos="zoom-in" data-aos-delay="400">
                        <div class="text-2xl sm:text-3xl font-bold text-blue-600 mb-1">100+</div>
                        <div class="text-xs text-gray-600">Mitra Industri</div>
                    </div>
                </div>
            </div>
            <div class="flex-1 min-w-[280px] md:min-w-[300px] profile-video-wrapper">
                <video id="introVideo" autoplay muted loop class="w-full rounded-lg shadow-lg" style="pointer-events: none;">
                    <source src="{{ asset('image/logo_pelita2.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20 bg-gray-50">
        <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 section-title">Sambutan Kepala Sekolah</h2>
        </div>
        <div class="flex flex-col md:flex-row flex-wrap items-center gap-8 md:gap-10">
            <div class="flex-1 min-w-[280px] md:min-w-[300px]" data-aos="fade-right">
                <img src="{{ asset('image/KepalaSekolah1.png') }}" alt="Kepala Sekolah SMK Pelita IV" class="w-full max-w-xs sm:max-w-sm rounded-lg mx-auto">
            </div>
            <div class="flex-1 min-w-[280px] md:min-w-[300px]" data-aos="fade-left">
                <h3 class="text-xl sm:text-2xl font-bold text-blue-600 mb-2">Yohanes Sigit Widiatmaka, S.Pd</h3>
                <p class="text-gray-600 font-medium mb-3 sm:mb-4 text-sm sm:text-base">Kepala SMK Pelita IV Jakarta</p>
                <div class="w-10 h-1 bg-blue-600 mb-5 sm:mb-6"></div>
                <p class="mb-3 text-gray-600 leading-relaxed text-sm sm:text-base">Assalamualaikum Wr. Wb.</p>
                <p class="mb-3 text-gray-600 leading-relaxed text-sm sm:text-base">Selamat datang di website resmi SMK Pelita IV Jakarta. Sebagai lembaga pendidikan kejuruan, kami berkomitmen untuk menyiapkan generasi muda yang unggul dalam keterampilan, berkarakter, dan siap menghadapi tantangan masa depan.</p>
                <p class="mb-3 text-gray-600 leading-relaxed text-sm sm:text-base">Dengan dukungan tenaga pendidik yang profesional dan fasilitas yang memadai, kami yakin dapat mencetak lulusan yang kompeten sesuai dengan kebutuhan dunia kerja.</p>
                <p class="mb-3 text-gray-600 leading-relaxed text-sm sm:text-base">Mari bersama-sama kita wujudkan SMK Pelita IV Jakarta menjadi sekolah kejuruan terbaik yang menghasilkan SDM berkualitas dan berdaya saing tinggi.</p>
                <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Wassalamualaikum Wr. Wb.</p>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20">
        <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 section-title">Program Keahlian</h2>
            <p class="text-gray-600 text-sm sm:text-base">Pilihan Jurusan untuk Masa Depanmu</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 justify-center">
            <div class="bg-white rounded-xl shadow-lg hover:-translate-y-4 hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="100">
                <div class="relative h-48 overflow-hidden rounded-t-xl">
                    <img src="{{ asset('image/tkj.jpg') }}" alt="Desain Komunikasi Visual" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/70"></div>
                </div>
                <div class="p-5 md:p-6">
                    <h3 class="text-lg sm:text-xl font-bold text-blue-600 mb-3">Desain Komunikasi Visual</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed text-sm sm:text-base">Program keahlian yang mempelajari tentang perakitan komputer, instalasi jaringan, dan pemrograman dasar.</p>
                    <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md font-medium text-sm hover:bg-blue-700 transition-all">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg hover:-translate-y-4 hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="200">
                <div class="relative h-48 overflow-hidden rounded-t-xl">
                    <img src="{{ asset('image/akuntansi.jpg') }}" alt="Akuntansi" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/70"></div>
                </div>
                <div class="p-5 md:p-6">
                    <h3 class="text-lg sm:text-xl font-bold text-blue-600 mb-3">Akuntansi</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed text-sm sm:text-base">Program keahlian yang mempelajari tentang pencatatan, pengikhtisaran, dan pelaporan keuangan.</p>
                    <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md font-medium text-sm hover:bg-blue-700 transition-all">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg hover:-translate-y-4 hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="300">
                <div class="relative h-48 overflow-hidden rounded-t-xl">
                    <img src="{{ asset('image/multimedia.jpg') }}" alt="Multimedia" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/70"></div>
                </div>
                <div class="p-5 md:p-6">
                    <h3 class="text-lg sm:text-xl font-bold text-blue-600 mb-3">OTKP</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed text-sm sm:text-base">Comingsonn</p>
                    <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md font-medium text-sm hover:bg-blue-700 transition-all">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20 bg-gray-50">
        <div class="flex flex-col md:flex-row flex-wrap gap-6 md:gap-8">
            <div class="flex-1 min-w-[280px] p-6 md:p-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 text-white shadow-lg relative overflow-hidden" data-aos="fade-right">
                <div class="relative z-10">
                    <h2 class="text-xl sm:text-2xl font-bold mb-4 md:mb-6 relative after:content-[''] after:absolute after:bottom-[-10px] after:left-0 after:w-10 after:h-1 after:bg-white">Visi</h2>
                    <p class="text-sm sm:text-base leading-relaxed">"Menjadi lembaga pendidikan kejuruan yang unggul, berkarakter, dan menghasilkan lulusan yang kompeten serta mampu bersaing di era global."</p>
                    <i class='bx bx-bulb absolute right-3 bottom-3 text-7xl sm:text-8xl opacity-20'></i>
                </div>
            </div>
            <div class="flex-1 min-w-[280px] p-6 md:p-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-500 text-white shadow-lg relative overflow-hidden" data-aos="fade-left">
                <div class="relative z-10">
                    <h2 class="text-xl sm:text-2xl font-bold mb-4 md:mb-6 relative after:content-[''] after:absolute after:bottom-[-10px] after:left-0 after:w-10 after:h-1 after:bg-white">Misi</h2>
                    <ul class="list-disc pl-5 text-sm sm:text-base">
                        <li class="mb-2">Menyelenggarakan pendidikan kejuruan yang berorientasi pada kebutuhan dunia kerja.</li>
                        <li class="mb-2">Mengembangkan kurikulum berbasis kompetensi dan karakter.</li>
                        <li class="mb-2">Meningkatkan kualitas tenaga pendidik dan kependidikan.</li>
                        <li class="mb-2">Menyediakan sarana dan prasarana pembelajaran yang modern.</li>
                        <li>Menjalin kerjasama dengan dunia usaha dan industri.</li>
                    </ul>
                    <i class='bx bx-target-lock absolute right-3 bottom-3 text-7xl sm:text-8xl opacity-20'></i>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20">
        <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 section-title">Berita Terbaru</h2>
            <p class="text-gray-600 text-sm sm:text-base">Informasi dan Kegiatan Terkini</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 max-w-5xl mx-auto">
            @forelse($blogs as $index => $blog)
                <div class="bg-white rounded-xl shadow-lg hover:-translate-y-4 hover:shadow-xl transition-all" data-aos="zoom-in" data-aos-delay="{{ ($index % 2 + 1) * 100 }}">
                    <div class="relative h-48 md:h-56 overflow-hidden rounded-t-xl">
                        <img src="{{ $blog->lampiran ? asset('storage/' . $blog->lampiran) : 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" alt="{{ $blog->judul }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-3 right-3 w-14 h-14 bg-blue-600 text-white text-center rounded-lg p-1 shadow-lg">
                            <span class="block text-lg font-bold">{{ $blog->created_at->format('d') }}</span>
                            <span class="block text-xs">{{ $blog->created_at->format('M') }}</span>
                        </div>
                    </div>
                    <div class="p-5 md:p-6">
                        <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-3 hover:text-blue-600 transition-colors">{{ $blog->judul }}</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed text-sm sm:text-base">{{ Str::limit(strip_tags($blog->isi), 100) }}</p>
                        <a href="{{ route('blog.show', $blog->postingan_id) }}" class="relative inline-block text-blue-600 font-semibold text-sm hover:text-blue-700 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all hover:after:w-full">Baca Selengkapnya</a>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-lg hover:-translate-y-4 hover:shadow-xl transition-all col-span-full text-center py-10" data-aos="zoom-in" data-aos-delay="100">
                    <p class="text-gray-600 text-base sm:text-lg">Saat ini belum ada berita terbaru yang dapat ditampilkan. Silakan kembali lagi nanti untuk melihat update terbaru dari SMK Pelita IV Jakarta.</p>
                    <a href="/blog" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 transition-all text-sm">Lihat Blog</a>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-10 md:mt-12" data-aos="fade-up">
            <a href="/blog" class="inline-block px-5 py-2 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 hover:-translate-y-1 shadow-lg transition-all text-sm">Lihat Semua Berita</a>
        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        const slides = document.querySelectorAll('.hero-slide');
        const indicators = document.querySelectorAll('.indicator');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        let currentSlide = 0;
        let slideInterval;
        const slideDelay = 6000;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                slide.classList.add('inactive');
            });
            
            indicators.forEach((indicator, i) => {
                indicator.classList.remove('active');
            });

            if (slides[index]) {
                slides[index].classList.remove('inactive');
                slides[index].classList.add('active');
            }
            
            if (indicators[index]) {
                indicators[index].classList.add('active');
            }

            const activeSlide = slides[index];
            if (activeSlide) {
                const content = activeSlide.querySelector('.slide-content');
                if (content) {
                    content.style.animation = 'none';
                    void content.offsetWidth;
                    content.style.animation = 'slideInRight 0.8s ease-out forwards';
                }
            }

            currentSlide = index;
        }

        function nextSlide() {
            const nextIndex = (currentSlide + 1) % slides.length;
            showSlide(nextIndex);
        }

        function prevSlide() {
            const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(prevIndex);
        }

        function startAutoSlide() {
            stopAutoSlide();
            slideInterval = setInterval(nextSlide, slideDelay);
        }

        function stopAutoSlide() {
            if (slideInterval) {
                clearInterval(slideInterval);
            }
        }

        if (slides.length > 0) {
            showSlide(0);
            startAutoSlide();
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            });
        }

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', function() {
                stopAutoSlide();
                showSlide(index);
                startAutoSlide();
            });
        });

        const heroSection = document.querySelector('section');
        if (heroSection) {
            heroSection.addEventListener('mouseenter', stopAutoSlide);
            heroSection.addEventListener('mouseleave', startAutoSlide);
            heroSection.addEventListener('touchstart', stopAutoSlide, { passive: true });
            heroSection.addEventListener('touchend', startAutoSlide);
        }

        document.querySelectorAll('a[href="#main-content"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const targetElement = document.querySelector('#main-content');
                if (targetElement) {
                    const header = document.querySelector('header'); 
                    const headerHeight = header ? header.offsetHeight : 0; 
                    const targetPosition = targetElement.offsetTop - headerHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            } else if (e.key === 'ArrowRight') {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            }
        });

        let touchStartX = 0;
        let touchEndX = 0;

        heroSection.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        heroSection.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                stopAutoSlide();
                if (diff > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
                startAutoSlide();
            }
        }

        window.addEventListener('resize', function() {

        });

        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                stopAutoSlide();
            } else {
                startAutoSlide();
            }
        });
    });
</script>

@include('partials.footer')