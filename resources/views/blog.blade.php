@include('partials.header', ['NamaPage' => 'Blog'])

<link rel="stylesheet" href="{{ asset('css/Blogs.css') }}" />

<body>
    <div class="container">
        <div class="blog-section">
            <div class="blog-grid" id="blogGrid">
                @forelse($blogs as $blog)
                <div class="CardPost" 
                     data-title="{{ strtolower($blog->judul) }}" 
                     data-content="{{ strtolower(strip_tags($blog->isi)) }}" 
                     data-date="{{ $blog->created_at->format('Y-m-d') }}">
                    <div class="ImagePostCard"
                        @if($blog->lampiran)
                            style="background-image: url('{{ asset('storage/' . $blog->lampiran) }}');"
                        @else
                            style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80');"
                        @endif
                    ></div>
                    <div class="IsiCardPost">
                        <h3 class="JudulCardPost">{{ Str::limit(strip_tags($blog->judul), 30) }}</h3>
                        <p class="KontenCardPost">{{ Str::limit(strip_tags($blog->isi), 250) }}</p>
                        <div class="FooterCardPost">
                            <div class="InfoUserCardPost">
                                <div class="FotoProfileCardPost">
                                    {{ $blog->profile ? strtoupper(substr($blog->profile->name, 0, 2)) : '??' }}
                                </div>
                                <div class="UserProfileCardPost">
                                    <span class="NamaPengunaCP">
                                        {{ $blog->profile->name ?? 'Unknown Author' }}
                                    </span>
                                    <span class="TanggalPublikasihCP">{{ $blog->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="OpsiTombolCp">
                                <a href="{{ route('blog.show', $blog->postingan_id) }}" class="TombolOJT TombolBacaSelengkapnya" data-id="{{ $blog->postingan_id }}">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="no-results">
                    <p>Belum ada artikel blog yang tersedia.</p>
                </div>
                @endforelse
            </div>

            <div class="no-results" id="noResults" style="display: none;">
                <p>Tidak ada artikel yang ditemukan.</p>
            </div>
        </div>
    </div>

@include('partials.footer')