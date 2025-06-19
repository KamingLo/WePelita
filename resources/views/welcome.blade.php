@include('partials.header', ['NamaPage' => 'Halaman Utama'])

<link rel="stylesheet" href="{{ asset('css/Welcome.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />

<style>
    .hero-content h1,
    .hero-content p,
    .hero-content .hero-btn {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeUp 0.6s ease-out forwards;
    }

    .hero-content h1 {
        animation-delay: 0.1s;
    }

    .hero-content p {
        animation-delay: 0.2s;
    }

    .hero-content .hero-btn {
        animation-delay: 0.3s;
    }

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
</style>

<section class="hero-section">
    <div class="hero-container">
        <div class="hero-image-container">
            <!-- Welcome Slide -->
            <div class="hero-slide active" data-index="0">
                <img src="/image/imageSekolah.png" alt="SMK Pelita IV Building" class="hero-image">
                <div class="hero-content">
                    <h1>Selamat Datang di SMK Pelita IV Jakarta</h1>
                    <p>Membangun Generasi Unggul, Berkarakter, dan Siap untuk Masa Depan</p>
                    <a href="#main-content" class="hero-btn">
                        Get Started
                        <i class='bx bx-chevron-down'></i>
                    </a>
                </div>
            </div>
            <!-- Blog Slides -->
            @foreach($blogs->take(5) as $index => $blog)
                <div class="hero-slide" data-index="{{ $index + 1 }}">
                    <img src="{{ $blog->lampiran ? asset('storage/' . $blog->lampiran) : 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $blog->judul }}" class="blog-hero-image">
                    <div class="hero-content">
                        <h1>{{ $blog->judul }}</h1>
                        <a href="{{ route('blog.show', $blog->postingan_id) }}" class="hero-btn read-more-btn">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            @endforeach
            <!-- Navigation Buttons -->
            <button class="hero-nav-btn prev-btn" aria-label="Previous Slide">
                <i class='bx bx-chevron-left'></i>
            </button>
            <button class="hero-nav-btn next-btn" aria-label="Next Slide">
                <i class='bx bx-chevron-right'></i>
            </button>
        </div>
    </div>
</section>

<div id="main-content" class="main-content-container">
    <div class="section-title" data-aos="fade-up"></div>

    <section class="profile-section">
        <div class="section-title" data-aos="fade-up">
            <h2>Profile SMK Pelita IV</h2>
        </div>
        <div class="profile-container">
            <div class="profile-content" data-aos="fade-right">
                <p>SMK Pelita IV Jakarta berdiri sejak tahun 1987 dan telah mencetak ribuan lulusan berkualitas yang tersebar di berbagai bidang pekerjaan. Berlokasi strategis di Jl. Duri Utara No.23-29, Jakarta Barat, sekolah kami dilengkapi dengan fasilitas modern yang mendukung proses pembelajaran.</p>
                <p>Dengan akreditasi A, SMK Pelita IV Jakarta terus berinovasi dalam mengembangkan kurikulum yang sesuai dengan perkembangan teknologi dan kebutuhan industri. Kami juga menjalin kerja sama dengan berbagai perusahaan untuk program prakerin dan penempatan kerja lulusan.</p>
                <div class="profile-stats">
                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="100">
                        <div class="stat-number">35+</div>
                        <div class="stat-label">Tahun Pengalaman</div>
                    </div>
                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="200">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Siswa Aktif</div>
                    </div>
                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="300">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Tenaga Pendidik</div>
                    </div>
                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="400">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Mitra Industri</div>
                    </div>
                </div>
            </div>
            <div class="video-container">
                <video id="introVideo" autoplay muted style="pointer-events: none;">
                    <source src="{{ asset('image/logo_pelita2.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>
        </div>
    </section>

    <section class="kepala-sekolah-section">
        <div class="section-title" data-aos="fade-up">
            <h2>Sambutan Kepala Sekolah</h2>
        </div>
        <div class="kepala-sekolah-container">
            <div class="kepala-sekolah-image" data-aos="fade-right">
                <img src="/image/KepalaSekolah1.png" alt="Kepala Sekolah SMK Pelita IV">
            </div>
            <div class="kepala-sekolah-content" data-aos="fade-left">
                <h3>Yohanes Sigit Widiatmaka, S.Pd</h3>
                <p class="kepala-title">Kepala SMK Pelita IV Jakarta</p>
                <div class="divider"></div>
                <p>Assalamualaikum Wr. Wb.</p>
                <p>Selamat datang di website resmi SMK Pelita IV Jakarta. Sebagai lembaga pendidikan kejuruan, kami berkomitmen untuk menyiapkan generasi muda yang unggul dalam keterampilan, berkarakter, dan siap menghadapi tantangan masa depan.</p>
                <p>Dengan dukungan tenaga pendidik yang profesional dan fasilitas yang memadai, kami yakin dapat mencetak lulusan yang kompeten sesuai dengan kebutuhan dunia kerja.</p>
                <p>Mari bersama-sama kita wujudkan SMK Pelita IV Jakarta menjadi sekolah kejuruan terbaik yang menghasilkan SDM berkualitas dan berdaya saing tinggi.</p>
                <p>Wassalamualaikum Wr. Wb.</p>
            </div>
        </div>
    </section>

    <section class="program-keahlian-section">
        <div class="section-title" data-aos="fade-up">
            <h2>Program Keahlian</h2>
            <p>Pilihan Jurusan untuk Masa Depanmu</p>
        </div>
        <div class="program-container">
            <div class="program-card" data-aos="fade-up" data-aos-delay="100">
                <div class="program-image">
                    <img src="/image/tkj.jpg" alt="Teknik Komputer dan Jaringan">
                    <div class="program-overlay"></div>
                </div>
                <div class="program-content">
                    <h3>Desain Komunikasi Visual</h3>
                    <p>Program keahlian yang mempelajari tentang perakitan komputer, instalasi jaringan, dan pemrograman dasar.</p>
                    <a href="#" class="program-btn">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            
            <div class="program-card" data-aos="fade-up" data-aos-delay="200">
                <div class="program-image">
                    <img src="/image/akuntansi.jpg" alt="Akuntansi">
                    <div class="program-overlay"></div>
                </div>
                <div class="program-content">
                    <h3>Akuntansi</h3>
                    <p>Program keahlian yang mempelajari tentang pencatatan, pengikhtisaran, dan pelaporan keuangan.</p>
                    <a href="#" class="program-btn">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            
            <div class="program-card" data-aos="fade-up" data-aos-delay="300">
                <div class="program-image">
                    <img src="/image/multimedia.jpg" alt="Multimedia">
                    <div class="program-overlay"></div>
                </div>
                <div class="program-content">
                    <h3>OTKP</h3>
                    <p>Comingsonn</p>
                    <a href="#" class="program-btn">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </section>

    <section class="visi-misi-section">
        <div class="visi-misi-container">
            <div class="visi-box" data-aos="fade-right">
                <div class="visi-content">
                    <h2>Visi</h2>
                    <p>"Menjadi lembaga pendidikan kejuruan yang unggul, berkarakter, dan menghasilkan lulusan yang kompeten serta mampu bersaing di era global."</p>
                    <div class="visi-icon">
                        <i class='bx bx-bulb'></i>
                    </div>
                </div>
            </div>
            
            <div class="misi-box" data-aos="fade-left">
                <div class="misi-content">
                    <h2>Misi</h2>
                    <ul>
                        <li>Menyelenggarakan pendidikan kejuruan yang berorientasi pada kebutuhan dunia kerja.</li>
                        <li>Mengembangkan kurikulum berbasis kompetensi dan karakter.</li>
                        <li>Meningkatkan kualitas tenaga pendidik dan kependidikan.</li>
                        <li>Menyediakan sarana dan prasarana pembelajaran yang modern.</li>
                        <li>Menjalin kerjasama dengan dunia usaha dan industri.</li>
                    </ul>
                    <div class="misi-icon">
                        <i class='bx bx-target-lock'></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="berita-section">
        <div class="section-title" data-aos="fade-up">
            <h2>Berita Terbaru</h2>
            <p>Informasi dan Kegiatan Terkini</p>
        </div>
        <div class="berita-container">
            @forelse($blogs as $index => $blog)
                <div class="berita-card" data-aos="zoom-in" data-aos-delay="{{ ($index % 2 + 1) * 100 }}">
                    <div class="berita-image">
                        @if($blog->lampiran)
                            <img src="{{ asset('storage/' . $blog->lampiran) }}" alt="{{ $blog->judul }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="{{ $blog->judul }}">
                        @endif
                        <div class="berita-date">
                            <span class="day">{{ $blog->created_at->format('d') }}</span>
                            <span class="month">{{ $blog->created_at->format('M') }}</span>
                        </div>
                    </div>
                    <div class="berita-content">
                        <h3>{{ $blog->judul }}</h3>
                        <p>{{ Str::limit(strip_tags($blog->isi), 120) }}</p>
                        <a href="{{ route('blog.show', $blog->postingan_id) }}" class="berita-btn">Baca Selengkapnya</a>
                    </div>
                </div>
            @empty
                <div class="berita-card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="berita-image">
                        <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Tidak ada berita">
                        <div class="berita-date">
                            <span class="day">--</span>
                            <span class="month">---</span>
                        </div>
                    </div>
                    <div class="berita-content">
                        <h3>Belum Ada Berita</h3>
                        <p>Saat ini belum ada berita terbaru yang dapat ditampilkan. Silakan kembali lagi nanti untuk melihat update terbaru dari SMK Pelita IV Jakarta.</p>
                        <a href="/blog" class="berita-btn">Lihat Blog</a>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="berita-more" data-aos="fade-up">
            <a href="/blog" class="more-btn">Lihat Semua Berita</a>
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

        // Hero Slider Functionality
        const slides = document.querySelectorAll('.hero-slide');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        let currentSlide = 0;
        let slideInterval;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
                slide.style.opacity = i === index ? '1' : '0';
                // Reset animations for hero-content elements
                if (i === index) {
                    const content = slide.querySelector('.hero-content');
                    content.querySelectorAll('h1, p, .hero-btn').forEach(el => {
                        el.style.animation = 'none';
                        el.offsetHeight; // Trigger reflow
                        el.style.animation = null;
                    });
                }
            });
            currentSlide = index;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        function startSlider() {
            slideInterval = setInterval(nextSlide, 5000);
        }

        function stopSlider() {
            clearInterval(slideInterval);
        }

        // Initialize slider
        showSlide(0);
        startSlider();

        // Navigation button events
        nextBtn.addEventListener('click', () => {
            stopSlider();
            nextSlide();
            startSlider();
        });

        prevBtn.addEventListener('click', () => {
            stopSlider();
            prevSlide();
            startSlider();
        });

        // Smooth scroll for hero button
        document.querySelectorAll('.hero-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.classList.contains('read-more-btn')) return; // Skip for blog links
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
            });
        });
    });
</script>

@include('partials.footer')