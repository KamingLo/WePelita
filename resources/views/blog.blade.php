@include('partials.header', ['NamaPage' => 'Blog'])

<body>
    <div class="py-4 md:py-11">
        <div class="container mx-auto px-4 py-4 max-w-6xl bg-white rounded-xl shadow-lg">

            <div class="text-center">
                <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-700 section-title mb-4 inline-block">
                    Blog SMK Pelita IV
                </h1>
            </div>

            <div class="blog-section flex flex-col lg:flex-row gap-8 mt-8">
                <div class="main-content flex-grow">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8" id="blogGrid">
                        @forelse($blogs as $blog)
                        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300
                                    flex flex-col md:flex-row overflow-hidden border border-gray-200">

                            <div class="w-full md:w-1/3 flex-shrink-0 h-48 md:h-auto bg-cover bg-center rounded-t-xl md:rounded-l-xl md:rounded-t-none"
                                @if($blog->lampiran)
                                    style="background-image: url('{{ asset('storage/' . $blog->lampiran) }}');"
                                @else
                                    style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80');"
                                @endif
                            ></div>

                            <div class="p-6 flex flex-col flex-grow w-full md:w-2/3">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2 leading-tight">{{ Str::limit(strip_tags($blog->judul), 50) }}</h3>
                                <p class="text-gray-600 text-sm mb-4 flex-grow line-clamp-4">{{ Str::limit(strip_tags($blog->isi), 150) }}</p>

                                <div class="flex items-center justify-between mt-4 border-t border-gray-100 pt-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-800 text-base flex-shrink-0">
                                            {{ $blog->profile ? strtoupper(substr($blog->profile->name, 0, 2)) : '??' }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-700 text-sm">{{ $blog->profile->name ?? 'Unknown Author' }}</span>
                                            <span class="text-gray-500 text-xs">{{ $blog->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="flex-shrink-0">
                                        <a href="{{ route('blog.show', $blog->postingan_id) }}"
                                           class="px-4 py-2 bg-blue-600 text-white font-medium text-sm rounded-md hover:bg-blue-700 transition duration-200 ease-in-out">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-10 text-gray-600">
                            <p>Belum ada artikel blog yang tersedia.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="text-center py-10 text-gray-600 hidden" id="noResults">
                        <p>Tidak ada artikel yang ditemukan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@include('partials.footer')