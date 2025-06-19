@include('partials.header', ['NamaPage' => $postingan->judul])

<link rel="stylesheet" href="{{ asset('css/BlogFull.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />

<div class="blog-page-container">
    <section class="blog-detail-section">
        <div class="blog-detail-container" data-aos="fade-up">
            <div class="blog-image">
                @if($postingan->lampiran)
                    <img src="{{ asset('storage/' . $postingan->lampiran) }}" alt="{{ $postingan->judul }}">
                @else
                    <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $postingan->judul }}">
                @endif
            </div>
            <div class="blog-content" data-aos="fade-up" data-aos-delay="100">
                <h1>{{ $postingan->judul }}</h1>
                <div class="blog-meta">
                    <span class="author">
                        <i class='bx bx-user'></i> {{ $postingan->profile->name ?? 'Penulis Tidak Diketahui' }}
                    </span>
                    <span class="date">
                        <i class='bx bx-calendar'></i> {{ $postingan->created_at->format('M d, Y') }}
                    </span>
                </div>
                <div class="blog-body">
                    {!! $postingan->isi !!}
                </div>
                <a href="{{ route('blog') }}" class="back-btn">
                    <i class='bx bx-arrow-back'></i> Kembali ke Blog
                </a>
            </div>
        </div>
    </section>

    <section class="comments-section" data-aos="fade-up" data-aos-delay="300">
        <div class="comments-container">
            <h2>Komentar</h2>
            <div class="comments-list">
                @forelse($postingan->comments as $comment)
                    <div class="comment-card">
                        <div class="comment-header">
                            <strong class="comment-author">{{ $comment->commentator->name ?? 'Anonymous' }}</strong>
                            <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="comment-text">{{ $comment->comment }}</p>
                    </div>
                @empty
                    <p class="no-comments">Belum ada komentar untuk postingan ini.</p>
                @endforelse
            </div>

            @auth
                <div class="comment-form">
                    <form action="{{ route('postingan.comment', $postingan->postingan_id) }}" method="POST">
                        @csrf
                        <label for="comment" class="form-label">Tambahkan Komentar:</label>
                        <textarea name="comment" id="comment" rows="4" class="form-textarea" required></textarea>
                        <button type="submit" class="submit-btn">Kirim Komentar</button>
                    </form>
                </div>
            @else
                <p class="login-prompt">Silakan <a href="{{ route('login') }}" class="login-link">login</a> untuk memberikan komentar.</p>
            @endauth

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
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
    });
</script>

@include('partials.footer')