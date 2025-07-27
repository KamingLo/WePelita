@include('partials.header', ['NamaPage' => 'SMK Pelita IV'])

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style>
    body, html {
        overflow-x: hidden;
        width: 100%;
    }

    *, *::before, *::after {
        box-sizing: border-box;
    }

    .hero-slide {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        pointer-events: none;
    }
    .hero-slide.active {
        opacity: 1;
        pointer-events: auto;
    }
    .hero-slide.inactive {
        opacity: 0;
    }
    .indicator {
        width: 10px;
        height: 10px;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        display: inline-block;
        margin: 0 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .indicator.active {
        background-color: #fff;
        transform: scale(1.2);
    }
    .slide-indicators {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
    }
    .slide-content {
        animation: slideInRight 0.8s ease-out forwards;
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

    /* Styles for Mobile Hero */
    .mobile-hero-slide {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        pointer-events: none;
    }
    .mobile-hero-slide.active {
        opacity: 1;
        pointer-events: auto;
    }
    .mobile-hero-slide.inactive {
        opacity: 0;
    }
    .mobile-indicator {
        width: 8px;
        height: 8px;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        display: inline-block;
        margin: 0 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .mobile-indicator.active {
        background-color: #fff;
        transform: scale(1.2);
    }
    .mobile-slide-indicators {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
    }
    .mobile-slide-content {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .mobile-hero-text-container {
        background: rgba(255, 255, 255, 0.9);
        padding: 1rem;
        text-align: center;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Styles for Testimonial Slider */
    .testimonial-slide {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        pointer-events: none;
    }
    .testimonial-slide.active {
        opacity: 1;
        pointer-events: auto;
    }
    .testimonial-slide.inactive {
        opacity: 0;
    }
    .testimonial-content {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }
    .testimonial-content.active {
        opacity: 1;
    }
    .testimonial-indicator {
        width: 10px;
        height: 10px;
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        display: inline-block;
        margin: 0 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .testimonial-indicator.active {
        background-color: #1E40AF;
        transform: scale(1.2);
    }
    .testimonial-indicators {
        text-align: center;
        margin-top: 1.5rem;
        z-index: 20;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>

<!-- Desktop -->
<section class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 hidden md:block" style="height: 70vh; margin-top: 5rem;">
    <div class="absolute top-0 bottom-0 left-0 right-0 overflow-hidden z-0 rounded-xl shadow-xl">
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
                    <h1 class="hero-heading font-bold mb-4 text-shadow-lg leading-tight text-3xl md:text-5xl lg:text-2xl">
                        Selamat Datang di<br>SMK Pelita IV Jakarta
                    </h1>
                    <p class="hero-paragraph mb-6 text-shadow-md text-gray-200">
                        Membangun Generasi Unggul, Berkarakter <br> dan Siap untuk Masa Depan
                    </p>
                    <a href="#main-content-wrapper"
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 hover:scale-105 shadow-lg transition-all duration-300 text-sm md:text-base">
                        Mulai Jelajahi
                        <i class='bx bx-chevron-down ml-2 text-xl animate-bounce'></i>
                    </a>
                </div>
            </div>
        </div>

        @if(isset($blogs) && $blogs->count() > 0)
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
        @endif

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
            @if(isset($blogs) && $blogs->count() > 0)
                @foreach($blogs->take(5) as $index => $blog)
                    <div class="indicator" data-slide="{{ $index + 1 }}"></div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Mobile -->
<section class="relative mx-auto px-4 max-w-full block md:hidden" style="height: 30vh;">
    <div class="absolute top-0 bottom-0 left-0 right-0 overflow-hidden z-0 shadow-lg">
        <div class="mobile-hero-slide absolute inset-0 active" data-slide="0" style="height: 100%;">
            <img src="{{ asset('image/imageSekolah.png') }}"
                 alt="SMK Pelita IV Jakarta"
                 class="absolute inset-0 w-full h-full object-cover"
                 style="object-position: center;">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        </div>

        @if(isset($blogs) && $blogs->count() > 0)
            @foreach($blogs->take(5) as $index => $blog)
                <div class="mobile-hero-slide absolute inset-0 inactive" data-slide="{{ $index + 1 }}" style="height: 100%;">
                    <img src="{{ $blog->lampiran ? asset('storage/' . $blog->lampiran) : 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' }}"
                         alt="{{ $blog->judul }}"
                         class="absolute inset-0 w-full h-full object-cover"
                         onerror="this.src='https://via.placeholder.com/1200x800/1E40AF/FFFFFF?text=Blog+Post'"
                         style="object-position: center;">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
            @endforeach
        @endif

        <button id="mobilePrevBtn" class="absolute top-1/2 left-2 -translate-y-1/2 bg-black/50 hover:bg-blue-600 text-white rounded-full p-2 text-lg backdrop-blur-sm transition-all duration-300 hover:scale-110 z-30"
                aria-label="Previous Slide">
            <i class='bx bx-chevron-left'></i>
        </button>
        <button id="mobileNextBtn" class="absolute top-1/2 right-2 -translate-y-1/2 bg-black/50 hover:bg-blue-600 text-white rounded-full p-2 text-lg backdrop-blur-sm transition-all duration-300 hover:scale-110 z-30"
                aria-label="Next Slide">
            <i class='bx bx-chevron-right'></i>
        </button>

        <div class="mobile-slide-indicators">
            <div class="mobile-indicator active" data-slide="0"></div>
            @if(isset($blogs) && $blogs->count() > 0)
                @foreach($blogs->take(5) as $index => $blog)
                    <div class="mobile-indicator" data-slide="{{ $index + 1 }}"></div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="mobile-hero-text-container mt-10">
        <div class="mobile-slide-content mt-20">
            <h1 class="text-sm font-bold mb-2 leading-tight text-white">
                Selamat Datang di SMK Pelita IV Jakarta
            </h1>
            <p class="text-xs mb-3 text-white">
                Membangun Generasi Unggul, Berkarakter <br> dan Siap untuk Masa Depan
            </p>
            <a href="#main-content-wrapper"
               class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition-all duration-300 text-xs">
                Mulai Jelajahi
                <i class='bx bx-chevron-down ml-1 text-base animate-bounce'></i>
            </a>
        </div>

        @if(isset($blogs) && $blogs->count() > 0)
            @foreach($blogs->take(5) as $index => $blog)
                <div class="mobile-slide-content hidden">
                    <a href="{{ route('blog.show', $blog->postingan_id) }}" style="margin-top: 10rem"
                       class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition-all duration-300 text-xs">
                        Baca Selengkapnya
                        <i class='bx bx-right-arrow-alt ml-1 text-base'></i>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</section>

<div id="main-content-wrapper" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <div id="main-content">
        <section class="py-12 md:py-20">
            <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 section-title">Profile SMK Pelita IV</h2>
            </div>
            <div class="flex flex-col md:flex-row flex-wrap items-center gap-8 md:gap-10">
                <div class="flex-1 min-w-[280px] md:min-w-[300px]" data-aos="fade-right">
                    <p class="mb-4 text-gray-600 leading-relaxed text-sm sm:text-base md:text-lg text-justify">
                        SMK Pelita IV Jakarta berdiri sejak tahun 1987 dan telah mencetak ribuan lulusan berkualitas yang tersebar di berbagai bidang pekerjaan. Berlokasi strategis di Jl. Duri Utara No.23-29, Jakarta Barat, sekolah kami dilengkapi dengan fasilitas modern yang mendukung proses pembelajaran.
                    </p>
                    <p class="mb-4 text-gray-600 leading-relaxed text-sm sm:text-base md:text-lg text-justify">
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
                <div class="flex-1 min-w-[280px] md:min-w-[300px] px-4 md:pr-10">
                    <h3 class="text-xl sm:text-2xl font-bold text-blue-600 mb-2">Yohanes Sigit Widiatmaka, S.Pd</h3>
                    <p class="text-gray-600 font-medium mb-3 sm:mb-4 text-sm sm:text-base">Kepala SMK Pelita IV Jakarta</p>
                    <div class="w-10 h-1 bg-blue-600 mb-5 sm:mb-6"></div>
                    <p class="mb-3 text-gray-600 leading-relaxed text-sm sm:text-base text-justify">Assalamualaikum Wr. Wb.</p>
                    <p class="mb-3 text-gray-600 leading-relaxed text-sm sm:text-base text-justify">Selamat datang di website resmi SMK Pelita IV Jakarta. Sebagai lembaga pendidikan kejuruan, kami berkomitmen untuk menyiapkan generasi muda yang unggul dalam keterampilan, berkarakter, dan siap menghadapi tantangan masa depan.</p>
                    <p class="mb-3 text-gray-600 leading-relaxed text-sm sm:text-base text-justify">Dengan dukungan tenaga pendidik yang profesional dan fasilitas yang memadai, kami yakin dapat mencetak lulusan yang kompeten sesuai dengan kebutuhan dunia kerja.</p>
                    <p class="mb-3 text-gray-600 leading-relaxed text-sm sm:text-base text-justify">Mari bersama-sama kita wujudkan SMK Pelita IV Jakarta menjadi sekolah kejuruan terbaik yang menghasilkan SDM berkualitas dan berdaya saing tinggi.</p>
                    <p class="text-gray-600 leading-relaxed text-sm sm:text-base text-justify">Wassalamualaikum Wr. Wb.</p>
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
                        <img src="{{ asset('image/DKV.jpg') }}" alt="Desain Komunikasi Visual" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-5 md:p-6">
                        <h3 class="text-lg sm:text-xl font-bold text-blue-600 mb-3">Desain Komunikasi Visual</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed text-sm sm:text-base">Program keahlian yang mempelajari tentang perakitan komputer, instalasi jaringan, dan pemrograman dasar.</p>
                        <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md font-medium text-sm hover:bg-blue-700 transition-all">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg hover:-translate-y-4 hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-48 overflow-hidden rounded-t-xl">
                        <img src="{{ asset('image/AKUNTANSI.png') }}" alt="Akuntansi" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-5 md:p-6">
                        <h3 class="text-lg sm:text-xl font-bold text-blue-600 mb-3">Akuntansi</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed text-sm sm:text-base">Program keahlian yang mempelajari tentang pencatatan, pengikhtisaran, dan pelaporan keuangan.</p>
                        <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md font-medium text-sm hover:bg-blue-700 transition-all">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg hover:-translate-y-4 hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-48 overflow-hidden rounded-t-xl">
                        <img src="{{ asset('image/OTKP.png') }}" alt="Multimedia" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"> 
                    </div>
                    <div class="p-5 md:p-6">
                        <h3 class="text-lg sm:text-xl font-bold text-blue-600 mb-3">OTKP</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed text-sm sm:text-base">Comingsonn</p>
                        <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md font-medium text-sm hover:bg-blue-700 transition-all">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 md:py-20">
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

        <section class="py-12 md:py-20 bg-gray-50">
            <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 section-title">Testimoni & Prestasi Siswa</h2>
                <p class="text-gray-600 text-sm sm:text-base">Kisah Sukses dan Prestasi Siswa Kami</p>
            </div>
            <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative flex flex-col md:flex-row gap-6 md:gap-8 overflow-hidden">
                    <div class="relative flex-1 min-w-[280px] h-64 md:h-80">
                        <div class="testimonial-slide absolute inset-0 active" data-slide="0">
                            <img src="{{ asset('image/testimoni1.jpg') }}" alt="Testimoni 1" class="w-full h-full object-cover rounded-xl shadow-lg">
                        </div>
                        <div class="testimonial-slide absolute inset-0 inactive" data-slide="1">
                            <img src="{{ asset('image/testimoni2.jpeg') }}" alt="Testimoni 2" class="w-full h-full object-cover rounded-xl shadow-lg">
                        </div>
                        <div class="testimonial-slide absolute inset-0 inactive" data-slide="2">
                            <img src="{{ asset('image/testimoni3.jpg') }}" alt="Testimoni 3" class="w-full h-full object-cover rounded-xl shadow-lg">
                        </div>
                        <div class="testimonial-slide absolute inset-0 inactive" data-slide="3">
                            <img src="{{ asset('image/testimoni4.jpg') }}" alt="Testimoni 4" class="w-full h-full object-cover rounded-xl shadow-lg">
                        </div>
                        <div class="testimonial-slide absolute inset-0 inactive" data-slide="4">
                            <img src="{{ asset('image/testimoni5.jpg') }}" alt="Testimoni 5" class="w-full h-full object-cover rounded-xl shadow-lg">
                        </div>
                        <button id="testimonialPrevBtn" class="absolute top-1/2 left-2 -translate-y-1/2 bg-black/50 hover:bg-blue-600 text-white rounded-full p-2 text-lg backdrop-blur-sm transition-all duration-300 hover:scale-110 z-30" aria-label="Previous Testimonial">
                            <i class='bx bx-chevron-left'></i>
                        </button>
                        <button id="testimonialNextBtn" class="absolute top-1/2 right-2 -translate-y-1/2 bg-black/50 hover:bg-blue-600 text-white rounded-full p-2 text-lg backdrop-blur-sm transition-all duration-300 hover:scale-110 z-30" aria-label="Next Testimonial">
                            <i class='bx bx-chevron-right'></i>
                        </button>
                    </div>
                    <div class="flex-1 min-w-[280px] p-4 md:p-6 bg-white rounded-xl shadow-lg">
                        <div class="testimonial-content active" data-slide="0">
                            <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">"Berkat pembelajaran di SMK Pelita IV, saya berhasil meraih juara 1 lomba desain grafis tingkat nasional!"</p>
                            <p class="text-blue-600 font-semibold text-sm sm:text-base">— Testimoni1, Alumni DKV</p>
                        </div>
                        <div class="testimonial-content hidden" data-slide="1">
                            <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">"Program di SMK Pelita IV membuka peluang saya bekerja di perusahaan teknologi ternama."</p>
                            <p class="text-blue-600 font-semibold text-sm sm:text-base">— Testimoni2, Alumni OTKP</p>
                        </div>
                        <div class="testimonial-content hidden" data-slide="2">
                            <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">"Fasilitas dan guru yang mendukung membuat saya percaya diri mengikuti kompetisi akuntansi."</p>
                            <p class="text-blue-600 font-semibold text-sm sm:text-base">— Testimoni3, Alumni Akuntansi</p>
                        </div>
                        <div class="testimonial-content hidden" data-slide="3">
                            <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">"Saya belajar banyak tentang multimedia dan berhasil membuat proyek animasi yang diakui industri."</p>
                            <p class="text-blue-600 font-semibold text-sm sm:text-base">— Testimoni4, Alumni Multimedia</p>
                        </div>
                        <div class="testimonial-content hidden" data-slide="4">
                            <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">"SMK Pelita IV membantu saya mengembangkan keterampilan administrasi yang sangat dibutuhkan dunia kerja."</p>
                            <p class="text-blue-600 font-semibold text-sm sm:text-base">— Testimoni5, Alumni OTKP</p>
                        </div>
                        <div class="testimonial-indicators" style="z-index: 999;">
                            <div class="testimonial-indicator active" data-slide="0"></div>
                            <div class="testimonial-indicator" data-slide="1"></div>
                            <div class="testimonial-indicator" data-slide="2"></div>
                            <div class="testimonial-indicator" data-slide="3"></div>
                            <div class="testimonial-indicator" data-slide="4"></div>
                        </div>
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
                @if(isset($blogs) && $blogs->count() > 0)
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
                @else
                    <div class="bg-white rounded-xl shadow-lg hover:-translate-y-4 hover:shadow-xl transition-all col-span-full text-center py-10" data-aos="zoom-in" data-aos-delay="100">
                        <p class="text-gray-600 text-base sm:text-lg">Saat ini belum ada berita terbaru yang dapat ditampilkan. Silakan kembali lagi nanti untuk melihat update terbaru dari SMK Pelita IV Jakarta.</p>
                    </div>
                @endif
            </div>
            <div class="text-center mt-10 md:mt-12" data-aos="fade-up">
                <a href="/blog" class="inline-block px-5 py-2 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 hover:-translate-y-1 shadow-lg transition-all text-sm">Lihat Semua Berita</a>
            </div>
        </section>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Desktop
        const slides = document.querySelectorAll('.hero-slide');
        const indicators = document.querySelectorAll('.indicator');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const heroSection = document.querySelector('section.hidden.md\\:block');
        
        let currentSlide = 0;
        let slideInterval = null;
        const slideDelay = 6000;

        function showSlide(index) {
            if (index >= slides.length || index < 0) {
                index = 0;
            }

            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                slide.classList.add('inactive');
            });

            indicators.forEach((indicator) => {
                indicator.classList.remove('active');
            });

            slides[index].classList.remove('inactive');
            slides[index].classList.add('active');
            indicators[index]?.classList.add('active');

            const content = slides[index].querySelector('.slide-content');
            if (content) {
                content.style.animation = 'none';
                content.offsetHeight;
                content.style.animation = 'slideInRight 0.8s ease-out forwards';
            }

            currentSlide = index;
        }

        function nextSlide() {
            showSlide((currentSlide + 1) % slides.length);
        }

        function prevSlide() {
            showSlide((currentSlide - 1 + slides.length) % slides.length);
        }

        function startAutoSlide() {
            if (slideInterval) {
                clearInterval(slideInterval);
            }
            slideInterval = setInterval(nextSlide, slideDelay);
        }

        function stopAutoSlide() {
            if (slideInterval) {
                clearInterval(slideInterval);
                slideInterval = null;
            }
        }

        if (slides.length > 1) {
            showSlide(0);
            startAutoSlide();
        } else {
            showSlide(0);
        }

        prevBtn?.addEventListener('click', () => {
            stopAutoSlide();
            prevSlide();
            startAutoSlide();
        });

        nextBtn?.addEventListener('click', () => {
            stopAutoSlide();
            nextSlide();
            startAutoSlide();
        });

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                stopAutoSlide();
                showSlide(index);
                startAutoSlide();
            });
        });

        if (heroSection) {
            heroSection.addEventListener('mouseenter', stopAutoSlide);
            heroSection.addEventListener('mouseleave', startAutoSlide);
            heroSection.addEventListener('touchstart', stopAutoSlide, { passive: true });
            heroSection.addEventListener('touchend', startAutoSlide, { passive: true });
        }

        // Mobile
        const mobileSlides = document.querySelectorAll('.mobile-hero-slide');
        const mobileIndicators = document.querySelectorAll('.mobile-indicator');
        const mobilePrevBtn = document.getElementById('mobilePrevBtn');
        const mobileNextBtn = document.getElementById('mobileNextBtn');
        const mobileHeroSection = document.querySelector('section.block.md\\:hidden');
        const mobileContentSlides = document.querySelectorAll('.mobile-slide-content');

        let currentMobileSlide = 0;
        let mobileSlideInterval = null;
        const mobileSlideDelay = 5000;

        function showMobileSlide(index) {
            if (index >= mobileSlides.length || index < 0) {
                index = 0;
            }

            mobileSlides.forEach((slide, i) => {
                slide.classList.remove('active');
                slide.classList.add('inactive');
            });

            mobileIndicators.forEach((indicator) => {
                indicator.classList.remove('active');
            });

            mobileContentSlides.forEach((content, i) => {
                content.classList.add('hidden');
            });

            mobileSlides[index].classList.remove('inactive');
            mobileSlides[index].classList.add('active');
            mobileIndicators[index]?.classList.add('active');
            mobileContentSlides[index].classList.remove('hidden');

            const content = mobileContentSlides[index];
            if (content) {
                content.style.animation = 'none';
                content.offsetHeight;
                content.style.animation = 'fadeInUp 0.6s ease-out forwards';
            }

            currentMobileSlide = index;
        }

        function nextMobileSlide() {
            showMobileSlide((currentMobileSlide + 1) % mobileSlides.length);
        }

        function prevMobileSlide() {
            showMobileSlide((currentMobileSlide - 1 + mobileSlides.length) % mobileSlides.length);
        }

        function startMobileAutoSlide() {
            if (mobileSlideInterval) {
                clearInterval(mobileSlideInterval);
            }
            mobileSlideInterval = setInterval(nextMobileSlide, mobileSlideDelay);
        }

        function stopMobileAutoSlide() {
            if (mobileSlideInterval) {
                clearInterval(mobileSlideInterval);
                mobileSlideInterval = null;
            }
        }

        if (mobileSlides.length > 1) {
            showMobileSlide(0);
            startMobileAutoSlide();
        } else {
            showMobileSlide(0);
        }

        mobilePrevBtn?.addEventListener('click', () => {
            stopMobileAutoSlide();
            prevMobileSlide();
            startMobileAutoSlide();
        });

        mobileNextBtn?.addEventListener('click', () => {
            stopMobileAutoSlide();
            nextMobileSlide();
            startMobileAutoSlide();
        });

        mobileIndicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                stopMobileAutoSlide();
                showMobileSlide(index);
                startMobileAutoSlide();
            });
        });

        if (mobileHeroSection) {
            mobileHeroSection.addEventListener('mouseenter', stopMobileAutoSlide);
            mobileHeroSection.addEventListener('mouseleave', startMobileAutoSlide);
            mobileHeroSection.addEventListener('touchstart', stopMobileAutoSlide, { passive: true });
            mobileHeroSection.addEventListener('touchend', startMobileAutoSlide, { passive: true });
        }

        const testimonialSlides = document.querySelectorAll('.testimonial-slide');
        const testimonialIndicators = document.querySelectorAll('.testimonial-indicator');
        const testimonialPrevBtn = document.getElementById('testimonialPrevBtn');
        const testimonialNextBtn = document.getElementById('testimonialNextBtn');
        const testimonialContents = document.querySelectorAll('.testimonial-content');
        const testimonialSection = document.querySelector('section.bg-gray-50');

        let currentTestimonialSlide = 0;
        let testimonialSlideInterval = null;
        const testimonialSlideDelay = 5000;

        function showTestimonialSlide(index) {
            if (index >= testimonialSlides.length || index < 0) {
                index = 0;
            }

            testimonialSlides.forEach(slide => {
                slide.classList.remove('active');
                slide.classList.add('inactive');
            });

            testimonialIndicators.forEach(indicator => {
                indicator.classList.remove('active');
            });

            testimonialContents.forEach(content => {
                content.classList.remove('active');
                content.classList.add('hidden');
            });

            testimonialSlides[index].classList.remove('inactive');
            testimonialSlides[index].classList.add('active');
            testimonialIndicators[index]?.classList.add('active');
            testimonialContents[index].classList.remove('hidden');
            testimonialContents[index].classList.add('active');

            const content = testimonialContents[index];
            if (content) {
                content.style.animation = 'none';
                content.offsetHeight;
                content.style.animation = 'fadeIn 0.5s ease-out forwards';
            }

            currentTestimonialSlide = index;
        }

        function nextTestimonialSlide() {
            showTestimonialSlide((currentTestimonialSlide + 1) % testimonialSlides.length);
        }

        function prevTestimonialSlide() {
            showTestimonialSlide((currentTestimonialSlide - 1 + testimonialSlides.length) % testimonialSlides.length);
        }

        function startTestimonialAutoSlide() {
            if (testimonialSlideInterval) {
                clearInterval(testimonialSlideInterval);
            }
            testimonialSlideInterval = setInterval(nextTestimonialSlide, testimonialSlideDelay);
        }

        function stopTestimonialAutoSlide() {
            if (testimonialSlideInterval) {
                clearInterval(testimonialSlideInterval);
                testimonialSlideInterval = null;
            }
        }

        if (testimonialSlides.length > 0) {
            showTestimonialSlide(0);
            if (testimonialSlides.length > 1) {
                startTestimonialAutoSlide();
            }
        }

        testimonialPrevBtn?.addEventListener('click', () => {
            stopTestimonialAutoSlide();
            prevTestimonialSlide();
            startTestimonialAutoSlide();
        });

        testimonialNextBtn?.addEventListener('click', () => {
            stopTestimonialAutoSlide();
            nextTestimonialSlide();
            startTestimonialAutoSlide();
        });

        testimonialIndicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                stopTestimonialAutoSlide();
                showTestimonialSlide(index);
                startTestimonialAutoSlide();
            });
        });

        if (testimonialSection) {
            testimonialSection.addEventListener('mouseenter', stopTestimonialAutoSlide);
            testimonialSection.addEventListener('mouseleave', startTestimonialAutoSlide);
            
            let touchStartX = 0;
            testimonialSection.addEventListener('touchstart', (e) => {
                touchStartX = e.touches[0].clientX;
                stopTestimonialAutoSlide();
            }, { passive: true });
            
            testimonialSection.addEventListener('touchend', (e) => {
                const touchEndX = e.changedTouches[0].clientX;
                const diff = touchStartX - touchEndX;
                const swipeThreshold = 50;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        nextTestimonialSlide();
                    } else {
                        prevTestimonialSlide();
                    }
                }
                startTestimonialAutoSlide();
            }, { passive: true });
        }

        document.querySelectorAll('a[href="#main-content-wrapper"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const targetElement = document.querySelector('#main-content-wrapper');
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


        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                stopAutoSlide();
                stopMobileAutoSlide();
                stopTestimonialAutoSlide();
                prevSlide();
                prevMobileSlide();
                prevTestimonialSlide();
                startAutoSlide();
                startMobileAutoSlide();
                startTestimonialAutoSlide();
            } else if (e.key === 'ArrowRight') {
                stopAutoSlide();
                stopMobileAutoSlide();
                stopTestimonialAutoSlide();
                nextSlide();
                nextMobileSlide();
                nextTestimonialSlide();
                startAutoSlide();
                startMobileAutoSlide();
                startTestimonialAutoSlide();
            }
        });

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                stopAutoSlide();
                stopMobileAutoSlide();
                stopTestimonialAutoSlide();
            } else {
                if (slides.length > 1) {
                    startAutoSlide();
                }
                if (mobileSlides.length > 1) {
                    startMobileAutoSlide();
                }
                if (testimonialSlides.length > 1) {
                    startTestimonialAutoSlide();
                }
            }
        });
    });
</script>

@include('partials.footer')