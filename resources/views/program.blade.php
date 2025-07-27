@include('partials.header', ['NamaPage' => 'Kurikulum & Program Keahlian'])

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-24 text-gray-800">
    
    {{-- Section: Pembuka --}}
    <section class="text-center space-y-3 max-w-3xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-900">Membentuk Generasi Tangguh dan Siap Kerja</h1>
        <p class="text-lg text-gray-600 leading-relaxed">
            Kami percaya bahwa pendidikan bukan hanya tentang belajar, tetapi membentuk karakter, keterampilan, dan semangat inovasi. Di sinilah tempatnya, di mana kurikulum nasional berpadu dengan pengalaman nyata industri.
        </p>
    </section>

    {{-- Section: Kurikulum Merdeka --}}
    <section class="grid md:grid-cols-2 gap-10 items-center">
        <div class="space-y-4">
            <h2 class="text-3xl font-semibold text-blue-800">Apa itu Kurikulum Merdeka?</h2>
            <p class="text-gray-700 leading-relaxed">
                Kurikulum Merdeka adalah bentuk transformasi pendidikan. Fleksibel, kolaboratif, dan berfokus pada kompetensi nyata siswa.
            </p>
            <ul class="list-disc pl-5 space-y-2 text-sm text-gray-700">
                <li>Proyek Penguatan Profil Pelajar Pancasila (P5)</li>
                <li>Fleksibilitas pemilihan mata pelajaran</li>
                <li>Pembelajaran berbasis minat dan kebutuhan siswa</li>
                <li>Integrasi dunia kerja sejak dini</li>
            </ul>
        </div>
        <img src="{{ asset('image/Kurikulum.jpg') }}" alt="Kurikulum Merdeka" class="rounded-xl shadow-md w-full h-64 object-cover">
    </section>

    <section class="space-y-6">
    <h2 class="text-3xl font-bold text-blue-800">Program Keahlian Unggulan Kami</h2>
    <p class="text-gray-600 text-sm max-w-2xl">
        SMK kami menawarkan program keahlian yang relevan dengan perkembangan industri, dunia usaha, dan inovasi teknologi terkini. Setiap jurusan dirancang untuk membekali siswa dengan kompetensi tinggi dan siap bersaing di masa depan.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border-l-4 border-blue-600">
        <div class="flex items-center space-x-3 mb-2">
            <h3 class="text-lg font-semibold text-blue-700">Desain Komunikasi Visual (DKV)</h3>
        </div>
        <p class="text-gray-600 text-sm mt-1">
            Jurusan <strong>Desain Komunikasi Visual (DKV)</strong> membimbing siswa untuk menjadi kreator visual yang inovatif dan terampil. Di sini, kamu akan mendalami dunia <strong>fotografi</strong> dan <strong>videografi</strong> untuk menghasilkan karya visual yang menawan, menguasai <strong>desain grafis</strong> mulai dari ilustrasi, logo, poster, hingga <em>branding</em>, serta belajar membuat <strong>animasi</strong> dan <strong>konten digital</strong> yang menarik dan komunikatif. Kurikulum DKV juga mencakup dasar-dasar <strong>UI/UX design</strong>, <strong>web design</strong>, dan kemampuan <strong>digital marketing</strong> visual, mempersiapkanmu untuk karir di industri kreatif yang dinamis. Lulusan DKV siap berkarya sebagai desainer grafis, fotografer, videografer, ilustrator, animator, atau spesialis konten digital.
        </p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border-l-4 border-green-600">
        <div class="flex items-center space-x-3 mb-2">
            <h3 class="text-lg font-semibold text-green-700">Akuntansi & Keuangan Lembaga</h3>
        </div>
        <p class="text-gray-600 text-sm mt-1">
            Program keahlian <strong>Akuntansi & Keuangan Lembaga</strong> menyiapkan siswa menjadi profesional yang kompeten di bidang pencatatan dan pengelolaan keuangan. Kamu akan mempelajari seluruh <strong>siklus akuntansi</strong>, mulai dari analisis bukti transaksi, pembuatan jurnal, posting buku besar, hingga penyusunan <strong>laporan keuangan</strong> (neraca, laba rugi, arus kas). Selain itu, jurusan ini juga membekali siswa dengan pemahaman <strong>perpajakan</strong>, <strong>auditing</strong> dasar, dan penggunaan <strong>aplikasi komputer akuntansi</strong> (seperti MYOB atau Zahir) yang sangat dibutuhkan di dunia kerja. Lulusan Akuntansi memiliki prospek karir sebagai staf akuntan, auditor junior, staf keuangan, bendahara, hingga konsultan pajak di berbagai sektor industri.
        </p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border-l-4 border-purple-600">
        <div class="flex items-center space-x-3 mb-2">
            <h3 class="text-lg font-semibold text-purple-700">Otomatisasi Tata Kelola Perkantoran (OTKP)</h3>
        </div>
        <p class="text-gray-600 text-sm mt-1">
            <strong>Otomatisasi Tata Kelola Perkantoran (OTKP)</strong> adalah jurusan yang mempersiapkan siswa untuk menjadi tenaga administrasi profesional yang adaptif di era digital. Kamu akan dibekali dengan keterampilan <strong>korespondensi</strong> (penulisan surat resmi dan email bisnis), <strong>kearsipan digital</strong> dan konvensional, serta penggunaan <strong>aplikasi perkantoran</strong> terkini (Microsoft Office, Google Workspace) dan <strong>sistem otomatisasi kantor</strong>. Selain itu, siswa juga akan mempelajari dasar-dasar <strong>manajemen kesiswaan dan kepegawaian</strong>, <strong>administrasi keuangan sederhana</strong> (kas kecil, pengadaan), hingga etika <strong>layanan prima</strong> dan <strong>keprotokolan</strong>. Lulusan OTKP memiliki peluang karir luas sebagai sekretaris, staf administrasi, resepsionis, <em>personal assistant</em>, atau staf tata usaha di berbagai jenis instansi.
        </p>
        </div>
    </div>
    </section>

    {{-- Section: Ekstrakurikuler --}}
    <section class="space-y-4">
        <h2 class="text-3xl font-bold text-blue-800">Ekstrakurikuler Berkembang</h2>
        <p class="text-gray-600 max-w-2xl">
            Lebih dari sekadar kegiatan tambahan—ekstrakurikuler kami adalah tempat siswa menemukan jati diri, membangun kerja tim, dan mengasah kreativitas.
        </p>
        <div class="flex flex-wrap gap-3">
            @foreach (['Pramuka', 'Paskibra', 'English Club', 'PMR', 'Rohis', 'Rokris', 'Futsal', 'Basket', 'Voli', 'Desain Grafis'] as $eskul)
                <div class="bg-blue-100 text-blue-800 text-sm px-4 py-2 rounded-full shadow-sm hover:bg-blue-200">
                    {{ $eskul }}
                </div>
            @endforeach
        </div>
    </section>

    {{-- Section: Program Unggulan --}}
    <section class="grid md:grid-cols-2 gap-10 items-start">
        <div class="space-y-4">
            <h2 class="text-3xl font-bold text-blue-800">Program Unggulan Sekolah</h2>
            <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                <li>Kelas Industri kolaborasi langsung dengan perusahaan</li>
                <li>Magang bersertifikat & penguatan soft skill</li>
                <li>Sertifikasi Profesi (BNSP/LSP-P1)</li>
                <li>Teaching Factory: produksi nyata di sekolah</li>
                <li>Penggunaan Google Workspace & LMS interaktif</li>
                <li>Startup project untuk siswa kreatif</li>
            </ul>
        </div>
        <img src="{{ asset('image/kurikulum/program-unggulan.jpg') }}" alt="Program Unggulan" class="rounded-xl shadow w-full h-64 object-cover">
    </section>

    <section class="space-y-6">
        <h2 class="text-3xl font-bold text-blue-800">Galeri Kegiatan</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            {{-- Galeri 1 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/1.jpg') }}" alt="Galeri 1" class="w-full h-40 sm:h-48 object-cover">
            </div>
            {{-- Galeri 2 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/2.jpg') }}" alt="Galeri 2" class="w-full h-40 sm:h-48 object-cover">
            </div>
            {{-- Galeri 3 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/3.jpg') }}" alt="Galeri 3" class="w-full h-40 sm:h-48 object-cover">
            </div>
            {{-- Galeri 4 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/4.jpg') }}" alt="Galeri 4" class="w-full h-40 sm:h-48 object-cover">
            </div>
            {{-- Galeri 5 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/5.jpg') }}" alt="Galeri 5" class="w-full h-40 sm:h-48 object-cover">
            </div>
            {{-- Galeri 6 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/6.jpg') }}" alt="Galeri 6" class="w-full h-40 sm:h-48 object-cover">
            </div>
            {{-- Galeri 7 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/7.jpg') }}" alt="Galeri 7" class="w-full h-40 sm:h-48 object-cover">
            </div>
            {{-- Galeri 8 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/8.jpg') }}" alt="Galeri 8" class="w-full h-40 sm:h-48 object-cover">
            </div>
            {{-- Galeri 9 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/9.jpg') }}" alt="Galeri 9" class="w-full h-40 sm:h-48 object-cover">
            </div>
            {{-- Galeri 10 --}}
            <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ asset('image/Galeri/10.jpg') }}" alt="Galeri 10" class="w-full h-40 sm:h-48 object-cover">
            </div>
        </div>
    </section>

</div>

@include('partials.footer')
