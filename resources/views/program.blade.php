@include('partials.header', ['NamaPage' => 'Kurikulum & Program Keahlian'])

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-24 text-gray-800">
    
    {{-- Section: Pembuka --}}
    <section class="text-center space-y-3 max-w-3xl mx-auto">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-900">Membentuk Generasi Tangguh dan Siap Kerja</h1>
        <p class="text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed">
            Kami percaya bahwa pendidikan bukan hanya tentang belajar, tetapi membentuk karakter, keterampilan, dan semangat inovasi. Di sinilah tempatnya, di mana kurikulum nasional berpadu dengan pengalaman nyata industri.
        </p>
    </section>

    {{-- Section: Kurikulum Merdeka --}}
    <section class="grid md:grid-cols-2 gap-10 items-center">
        <div class="space-y-4">
            <h2 class="text-xl sm:text-2xl font-semibold text-blue-800">Apa itu Kurikulum Merdeka?</h2>
            <p class="text-sm sm:text-base md:text-lg text-gray-700 leading-relaxed">
                Kurikulum Merdeka adalah bentuk transformasi pendidikan. Fleksibel, kolaboratif, dan berfokus pada kompetensi nyata siswa.
            </p>
            <ul class="list-disc pl-5 space-y-2 text-sm sm:text-base text-gray-700 leading-relaxed">
                <li>Proyek Penguatan Profil Pelajar Pancasila (P5)</li>
                <li>Fleksibilitas pemilihan mata pelajaran</li>
                <li>Pembelajaran berbasis minat dan kebutuhan siswa</li>
                <li>Integrasi dunia kerja sejak dini</li>
            </ul>
        </div>
        <img src="{{ asset('image/Kurikulum.webp') }}" alt="Kurikulum Merdeka" loading="lazy" class="rounded-xl shadow-md w-full h-64 object-cover">
    </section>

    <section class="space-y-6">
        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">Program Keahlian Unggulan Kami</h2>
        <p class="text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed max-w-2xl text-justify">
            SMK kami menawarkan program keahlian yang relevan dengan perkembangan industri, dunia usaha, dan inovasi teknologi terkini. Setiap jurusan dirancang untuk membekali siswa dengan kompetensi tinggi dan siap bersaing di masa depan.
        </p>

        <div class="space-y-8">
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-blue-600 grid md:grid-cols-2 gap-6 items-center">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-semibold text-blue-700">Desain Komunikasi Visual (DKV)</h3>
                    </div>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed text-justify">
                        Jurusan <strong>Desain Komunikasi Visual (DKV)</strong> membimbing siswa untuk menjadi kreator visual yang inovatif dan terampil. Di sini, kamu akan mendalami dunia <strong>fotografi</strong> dan <strong>videografi</strong> untuk menghasilkan karya visual yang menawan, menguasai <strong>desain grafis</strong> mulai dari ilustrasi, logo, poster, hingga <em>branding</em>, serta belajar membuat <strong>animasi</strong> dan <strong>konten digital</strong> yang menarik dan komunikatif. Kurikulum DKV juga mencakup dasar-dasar <strong>UI/UX design</strong>, <strong>web design</strong>, dan kemampuan <strong>digital marketing</strong> visual, mempersiapkanmu untuk karir di industri kreatif yang dinamis. Lulusan DKV siap berkarya sebagai desainer grafis, fotografer, videografer, ilustrator, animator, atau spesialis konten digital.
                    </p>
                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="bg-blue-50 text-blue-700 text-xs px-3 py-1 rounded-full">Fotografi</span>
                        <span class="bg-blue-50 text-blue-700 text-xs px-3 py-1 rounded-full">Videografi</span>
                        <span class="bg-blue-50 text-blue-700 text-xs px-3 py-1 rounded-full">Desain Grafis</span>
                        <span class="bg-blue-50 text-blue-700 text-xs px-3 py-1 rounded-full">UI/UX Design</span>
                        <span class="bg-blue-50 text-blue-700 text-xs px-3 py-1 rounded-full">Animasi</span>
                    </div>
                </div>
                <img src="{{ asset('image/Welcome/DKV.webp') }}" loading="lazy" alt="Desain Komunikasi Visual" class="rounded-xl shadow-md w-full h-64 object-cover order-last">
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-green-600 grid md:grid-cols-2 gap-6 items-center">
                <div class="space-y-4 order-last md:order-first">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-semibold text-green-700">Akuntansi & Keuangan Lembaga</h3>
                    </div>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed text-justify">
                        Program keahlian <strong>Akuntansi & Keuangan Lembaga</strong> menyiapkan siswa menjadi profesional yang kompeten di bidang pencatatan dan pengelolaan keuangan. Kamu akan mempelajari seluruh <strong>siklus akuntansi</strong>, mulai dari analisis bukti transaksi, pembuatan jurnal, posting buku besar, hingga penyusunan <strong>laporan keuangan</strong> (neraca, laba rugi, arus kas). Selain itu, jurusan ini juga membekali siswa dengan pemahaman <strong>perpajakan</strong>, <strong>auditing</strong> dasar, dan penggunaan <strong>aplikasi komputer akuntansi</strong> (seperti MYOB atau Zahir) yang sangat dibutuhkan di dunia kerja. Lulusan Akuntansi memiliki prospek karir sebagai staf akuntan, auditor junior, staf keuangan, bendahara, hingga konsultan pajak di berbagai sektor industri.
                    </p>
                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="bg-green-50 text-green-700 text-xs px-3 py-1 rounded-full">Siklus Akuntansi</span>
                        <span class="bg-green-50 text-green-700 text-xs px-3 py-1 rounded-full">Laporan Keuangan</span>
                        <span class="bg-green-50 text-green-700 text-xs px-3 py-1 rounded-full">Perpajakan</span>
                        <span class="bg-green-50 text-green-700 text-xs px-3 py-1 rounded-full">Auditing</span>
                        <span class="bg-green-50 text-green-700 text-xs px-3 py-1 rounded-full">Software Akuntansi</span>
                    </div>
                </div>
                <img src="{{ asset('image/Welcome/AKUNTANSI.webp') }}" loading="lazy" alt="Akuntansi & Keuangan Lembaga" class="rounded-xl shadow-md w-full h-64 object-cover order-first">
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-purple-600 grid md:grid-cols-2 gap-6 items-center">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-semibold text-purple-700">Otomatisasi Tata Kelola Perkantoran (OTKP)</h3>
                    </div>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed text-justify">
                        <strong>Otomatisasi Tata Kelola Perkantoran (OTKP)</strong> adalah jurusan yang mempersiapkan siswa untuk menjadi tenaga administrasi profesional yang adaptif di era digital. Kamu akan dibekali dengan keterampilan <strong>korespondensi</strong> (penulisan surat resmi dan email bisnis), <strong>kearsipan digital</strong> dan konvensional, serta penggunaan <strong>aplikasi perkantoran</strong> terkini (Microsoft Office, Google Workspace) dan <strong>sistem otomatisasi kantor</strong>. Selain itu, siswa juga akan mempelajari dasar-dasar <strong>manajemen kesiswaan dan kepegawaian</strong>, <strong>administrasi keuangan sederhana</strong> (kas kecil, pengadaan), hingga etika <strong>layanan prima</strong> dan <strong>keprotokolan</strong>. Lulusan OTKP memiliki peluang karir luas sebagai sekretaris, staf administrasi, resepsionis, <em>personal assistant</em>, atau staf tata usaha di berbagai jenis instansi.
                    </p>
                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="bg-purple-50 text-purple-700 text-xs px-3 py-1 rounded-full">Korespondensi</span>
                        <span class="bg-purple-50 text-purple-700 text-xs px-3 py-1 rounded-full">Kearsipan Digital</span>
                        <span class="bg-purple-50 text-purple-700 text-xs px-3 py-1 rounded-full">Microsoft Office</span>
                        <span class="bg-purple-50 text-purple-700 text-xs px-3 py-1 rounded-full">Manajemen</span>
                        <span class="bg-purple-50 text-purple-700 text-xs px-3 py-1 rounded-full">Layanan Prima</span>
                    </div>
                </div>
                <img src="{{ asset('image/Welcome/OTKP.webp') }}" loading="lazy" alt="Otomatisasi Tata Kelola Perkantoran" class="rounded-xl shadow-md w-full h-64 object-cover order-last">
            </div>
        </div>
    </section>

    {{-- Section: Ekstrakurikuler --}}
    <section class="space-y-4">
        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">Ekstrakurikuler Berkembang</h2>
        <p class="text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed max-w-2xl">
            Lebih dari sekadar kegiatan tambahan—ekstrakurikuler kami adalah tempat siswa menemukan jati diri, membangun kerja tim, dan mengasah kreativitas.
        </p>
        <div class="flex flex-wrap gap-3">
            @foreach (['Pramuka', 'Paskibra', 'English Club', 'PMR', 'Rohis', 'Rokris', 'Futsal', 'Basket', 'Voli', 'Desain Grafis'] as $eskul)
                <div class="bg-blue-100 text-blue-800 text-xs sm:text-sm px-4 py-2 rounded-full shadow-sm hover:bg-blue-200">
                    {{ $eskul }}
                </div>
            @endforeach
        </div>
    </section>

    {{-- Section: Program Unggulan --}}
    <section class="grid md:grid-cols-2 gap-10 items-start">
        <div class="space-y-4">
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">Program Unggulan Sekolah</h2>
            <ul class="list-disc pl-5 text-sm sm:text-base text-gray-700 leading-relaxed space-y-2">
                <li>Kelas Industri kolaborasi langsung dengan perusahaan</li>
                <li>Magang bersertifikat & penguatan soft skill</li>
                <li>Sertifikasi Profesi (BNSP/LSP-P1)</li>
                <li>Teaching Factory: produksi nyata di sekolah</li>
                <li>Penggunaan Google Workspace & LMS interaktif</li>
                <li>Startup project untuk siswa kreatif</li>
            </ul>
        </div>
        <img src="{{ asset('image/kurikulum/program-unggulan.jpg') }}" loading="lazy" alt="Program Unggulan" class="rounded-xl shadow w-full h-64 object-cover">
    </section>

    {{-- Section: Galeri Kegiatan --}}
    <section class="space-y-6">
        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">Galeri Kegiatan</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            {{-- Galeri 1 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/1.webp') }}" alt="Galeri 1" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 2 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/2.webp') }}" alt="Galeri 2" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 3 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/3.webp') }}" alt="Galeri 3" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 4 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/4.webp') }}" alt="Galeri 4" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 5 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/5.webp') }}" alt="Galeri 5" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 6 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/6.webp') }}" alt="Galeri 6" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 7 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/7.webp') }}" alt="Galeri 7" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 8 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/8.webp') }}" alt="Galeri 8" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 9 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/9.webp') }}" alt="Galeri 9" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 10 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/10.webp') }}" alt="Galeri 10" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 11 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/11.webp') }}" alt="Galeri 11" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 12 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/12.webp') }}" alt="Galeri 12" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 13 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/13.webp') }}" alt="Galeri 13" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 14 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/14.webp') }}" alt="Galeri 14" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 15 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/15.webp') }}" alt="Galeri 15" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 16 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/16.webp') }}" alt="Galeri 16" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 17 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/17.webp') }}" alt="Galeri 17" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
            {{-- Galeri 18 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/18.webp') }}" alt="Galeri 18" class="w-full h-40 sm:h-48 object-cover" loading="lazy">
            </div>
        </div>
    </section>

</div>

@include('partials.footer')