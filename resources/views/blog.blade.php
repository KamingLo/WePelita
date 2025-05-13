@include('partials.header', ['NamaPage' => $kegiatans->judul_kegiatan])
<link rel="stylesheet" href="{{ asset('css/bombaclat.css') }}" />

<section class="container" id="article1">
        <div class="article-container">
            <div class="article-header">
                <h1 class="article-title">{{ $kegiatans->judul_kegiatan }}</h1>
                <div class="article-meta">
                    <div class="article-author">
                        {{-- <img src="{{ asset('storage/' . $kegiatans->lampiran) }}" alt="Author"> --}}
                        <div>
                            <strong>{{ $kegiatans->admin->profile->name }}</strong>
                        </div>
                    </div>
                    <div class="article-date">
                        <span>{{ $kegiatans->created_at }}</span>
                    </div>
                </div>
            </div>
            
            <div class="article-image">
                <img src="{{ asset('storage/' . $kegiatans->lampiran) }}">
            </div>

            <div class="article-content">
                <p>
                    {{ $kegiatans->isi_kegiatan }}
                </p>
            </div>
        </div>
    </section>