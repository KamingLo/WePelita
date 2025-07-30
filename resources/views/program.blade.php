@include('partials.header', ['NamaPage' => 'Kurikulum & Program Keahlian'])

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-24 text-gray-800 text-lg"> {{-- Tambahkan text-lg di sini --}}
    
    {{-- Section: Pembuka --}}
    <section class="text-center space-y-3 max-w-3xl mx-auto">
        <h1 class="text-5xl font-bold text-blue-900">Membentuk Generasi Tangguh dan Siap Kerja</h1> {{-- text-5xl --}}
        <p class="text-xl text-gray-600 leading-relaxed">
            Kami percaya bahwa pendidikan bukan hanya tentang belajar, tetapi membentuk karakter, keterampilan, dan semangat inovasi. Di sinilah tempatnya, di mana kurikulum nasional berpadu dengan pengalaman nyata industri.
        </p>
    </section>

    {{-- Section: Kurikulum Merdeka --}}
    <section class="grid md:grid-cols-2 gap-10 items-center">
        <div class="space-y-4">
            <h2 class="text-4xl font-semibold text-blue-800">Apa itu Kurikulum Merdeka?</h2>
            <p class="text-lg text-gray-700 leading-relaxed">
                Kurikulum Merdeka adalah sistem pendidikan fleksibel yang menekankan kompetensi, kolaborasi, dan pengalaman nyata siswa.
            </p>
            <ul class="list-disc pl-5 space-y-2 text-base text-gray-700">
                <li>Proyek Penguatan Profil Pelajar Pancasila (P5)</li>
                <li>Pilihan mata pelajaran sesuai minat</li>
                <li>Pembelajaran berbasis kebutuhan siswa</li>
                <li>Integrasi dunia kerja sejak dini</li>
            </ul>
        </div>
        <img src="{{ asset('image/Kurikulum.jpg') }}" alt="Kurikulum Merdeka SMK" class="rounded-xl shadow-md w-full h-64 object-cover">
    </section>

    <section class="space-y-6">
    <h2 class="text-4xl font-bold text-blue-800">Program Keahlian Unggulan</h2>
    <p class="text-lg text-gray-600 max-w-2xl">
        SMK kami menawarkan jurusan yang relevan dengan kebutuhan industri dan teknologi, membekali siswa dengan keahlian siap kerja.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border-l-4 border-blue-600">
        <div class="flex items-center space-x-3 mb-2">
            <h3 class="text-xl font-semibold text-blue-700">Desain Komunikasi Visual (DKV)</h3>
        </div>
        <p class="text-gray-600 text-base mt-1">
            DKV membekali siswa dengan keterampilan desain grafis, fotografi, videografi, animasi, dan digital marketing. Lulusan siap berkarir di industri kreatif.
        </p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border-l-4 border-green-600">
        <div class="flex items-center space-x-3 mb-2">
            <h3 class="text-xl font-semibold text-green-700">Akuntansi & Keuangan Lembaga</h3>
        </div>
        <p class="text-gray-600 text-base mt-1">
            Jurusan ini fokus pada akuntansi, keuangan, perpajakan, dan aplikasi komputer akuntansi. Lulusan siap bekerja sebagai staf akuntansi dan keuangan.
        </p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border-l-4 border-purple-600">
        <div class="flex items-center space-x-3 mb-2">
            <h3 class="text-xl font-semibold text-purple-700">Otomatisasi Tata Kelola Perkantoran (OTKP)</h3>
        </div>
        <p class="text-gray-600 text-base mt-1">
            OTKP mengajarkan administrasi perkantoran, kearsipan, aplikasi digital, dan layanan prima. Lulusan siap menjadi staf administrasi profesional.
        </p>
        </div>
    </div>
    </section>

    {{-- Section: Ekstrakurikuler --}}
    <section class="space-y-4">
        <h2 class="text-4xl font-bold text-blue-800">Ekstrakurikuler Berkembang</h2>
        <p class="text-lg text-gray-600 max-w-2xl">
            Lebih dari sekadar kegiatan tambahan—ekstrakurikuler kami adalah tempat siswa menemukan jati diri, membangun kerja tim, dan mengasah kreativitas.
        </p>
        <div class="flex flex-wrap gap-3">
            @foreach (['English Club', 'Futsal', 'Basket', 'Badminton', 'Fotografi & Videografi', 'Tata Boga', 'Modern Dance', 'Music Club'] as $eskul)
                <div class="bg-blue-100 text-blue-800 text-base px-4 py-2 rounded-full shadow-sm hover:bg-blue-200">
                    {{ $eskul }}
                </div>
            @endforeach
        </div>
    </section>

    <section class="space-y-6">
        <h2 class="text-4xl font-bold text-blue-800">Galeri Kegiatan</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            {{-- Galeri 1 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/1.jpg') }}" alt="Galeri 1" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 2 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/2.jpg') }}" alt="Galeri 2" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 3 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/3.jpg') }}" alt="Galeri 3" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 4 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/4.jpg') }}" alt="Galeri 4" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 5 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/5.jpg') }}" alt="Galeri 5" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 6 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/6.jpg') }}" alt="Galeri 6" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 7 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/7.jpg') }}" alt="Galeri 7" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 8 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/8.jpg') }}" alt="Galeri 8" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 9 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/9.jpg') }}" alt="Galeri 9" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 10 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/10.jpg') }}" alt="Galeri 10" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
        </div>
    </section>

</div>

@include('partials.footer')
