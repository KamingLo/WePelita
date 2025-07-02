@include('partials.header', ['NamaPage' => $postingan->judul])

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-10 max-w-7xl mx-auto px-4 py-8 lg:py-4 mt-15">
    <section class="lg:col-span-2 flex flex-col" data-aos="fade-up">
        <div class="bg-white rounded-xl shadow-lg p-6 flex-1 flex flex-col">
            <div class="mb-4">
                @if($postingan->lampiran)
                    <img src="{{ asset('storage/' . $postingan->lampiran) }}" alt="{{ $postingan->judul }}" class="w-full h-auto rounded-xl">
                @else
                    <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $postingan->judul }}" class="w-full h-auto rounded-xl">
                @endif
            </div>
            <div class="flex-1 flex flex-col" data-aos="fade-up" data-aos-delay="100">
                <h1 class="text-3xl font-semibold text-gray-800 mb-2">{{ $postingan->judul }}</h1>
                <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                    <span class="flex items-center">
                        <i class='bx bx-user mr-1'></i> {{ $postingan->profile->name ?? 'Penulis Tidak Diketahui' }}
                    </span>
                    <span class="flex items-center">
                        <i class='bx bx-calendar mr-1'></i> {{ $postingan->created_at->format('M d, Y') }}
                    </span>
                </div>
                <div class="text-base leading-relaxed text-gray-700 mb-6 prose max-w-none flex-1">
                    {!! $postingan->isi !!}
                </div>
                <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition duration-300 ease-in-out self-start">
                    <i class='bx bx-arrow-back'></i> Kembali ke Blog
                </a>
            </div>
        </div>
    </section>

    <section class="lg:col-span-1 flex flex-col" data-aos="fade-up" data-aos-delay="300">
        <div class="bg-white rounded-xl shadow-lg p-6 flex-1 flex flex-col">
            <h2 class="text-2xl font-semibold text-gray-800 mb-5 flex-shrink-0">Komentar</h2>
            <div class="overflow-y-auto mb-5 flex-1 min-h-48">
                @forelse($postingan->comments as $comment)
                    <div class="bg-gray-50 border border-gray-200 rounded-md p-3 mb-3">
                        <div class="flex justify-between mb-2">
                            <strong class="font-semibold text-gray-800 text-sm">{{ $comment->commentator->name ?? 'Anonymous' }}</strong>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-700 leading-snug">{{ $comment->comment }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-600 text-center py-2">Belum ada komentar untuk postingan ini.</p>
                @endforelse
            </div>

            @auth
                <div class="flex flex-col gap-3 mt-auto flex-shrink-0">
                    <form action="{{ route('postingan.comment', $postingan->postingan_id) }}" method="POST">
                        @csrf
                        <label for="comment" class="block text-base font-medium text-gray-800 mb-1">Tambahkan Komentar:</label>
                        <textarea name="comment" id="comment" rows="4" class="w-full p-3 border border-gray-300 rounded-md resize-y text-sm min-h-32 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        <button type="submit" class="mt-6 px-5 py-2 bg-blue-600 text-white rounded-md cursor-pointer transition duration-300 ease-in-out hover:bg-blue-700 hover:shadow-lg text-sm">Kirim Komentar</button>
                    </form>
                </div>
            @else
                <p class="text-sm text-gray-600 text-center mt-4">Silakan <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> untuk memberikan komentar.</p>
            @endauth

            @if(session('success'))
                <div class="bg-green-50 text-green-700 text-sm p-2 rounded-md text-center mt-3">
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