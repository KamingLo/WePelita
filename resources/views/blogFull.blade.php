@include('partials.header', ['NamaPage' => 'Blog Detail'])

<link rel="stylesheet" href="{{ asset('css/blog.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />

<section class="blog-detail-section">
    <div class="blog-detail-container">
        <div class="blog-image" data-aos="fade-up">
            @if($blog->lampiran)
                <img src="{{ asset('storage/' . $blog->lampiran) }}" alt="{{ $blog->judul }}">
            @else
                <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $blog->judul }}">
            @endif
        </div>
        <div class="blog-content" data-aos="fade-up" data-aos-delay="100">
            <h1>{{ $blog->judul }}</h1>
            <div class="blog-meta">
                <span class="author">
                    <i class='bx bx-user'></i> {{ $blog->admin->profile->name }}
                </span>
                <span class="date">
                    <i class='bx bx-calendar'></i> {{ $blog->created_at->format('M d, Y') }}
                </span>
            </div>
            <div class="blog-body">
                {!! $blog->isi !!}
            </div>
            <a href="{{ route('blog') }}" class="back-btn" data-aos="fade-up" data-aos-delay="200">
                <i class='bx bx-arrow-back'></i> Kembali ke Blog
            </a>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    });
</script>

@include('partials.footer')