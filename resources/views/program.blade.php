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
        <img src="{{ asset('image/kurikulum/kurikulum-merdeka.jpg') }}" alt="Kurikulum Merdeka" class="rounded-xl shadow-md w-full h-64 object-cover">
    </section>

    {{-- Section: Program Keahlian (Jurusan) --}}
    <section class="space-y-6">
        <h2 class="text-3xl font-bold text-blue-800">Program Keahlian Kami</h2>
        <p class="text-gray-600 text-sm max-w-2xl">
            Pilihan jurusan yang disesuaikan dengan kebutuhan industri, dunia usaha, dan teknologi masa depan.
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ([
                ['title' => 'Rekayasa Perangkat Lunak', 'desc' => 'Membentuk developer profesional melalui praktik coding, UI/UX, dan software development lifecycle.'],
                ['title' => 'Teknik Komputer & Jaringan', 'desc' => 'Mengasah kemampuan membangun, mengelola, dan mengamankan jaringan TI perusahaan.'],
                ['title' => 'Multimedia', 'desc' => 'Dari desain grafis, motion graphic hingga konten digital yang kreatif dan komunikatif.'],
                ['title' => 'Akuntansi & Keuangan Lembaga', 'desc' => 'Menyiapkan siswa menjadi analis keuangan dan akuntan profesional.'],
                ['title' => 'Manajemen Perkantoran', 'desc' => 'Keterampilan administrasi modern berbasis digital untuk mendukung kegiatan organisasi.'],
                ['title' => 'Bisnis Daring & Pemasaran', 'desc' => 'Membangun brand dan strategi pemasaran dengan pendekatan digital.'],
            ] as $jurusan)
                <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border-l-4 border-blue-600">
                    <h3 class="text-lg font-semibold text-blue-700">{{ $jurusan['title'] }}</h3>
                    <p class="text-gray-600 text-sm mt-1">{{ $jurusan['desc'] }}</p>
                </div>
            @endforeach
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

    {{-- Section: Galeri --}}
    <section class="space-y-6">
        <h2 class="text-3xl font-bold text-blue-800">Galeri Kegiatan</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach (['kelas.jpg', 'pameran.jpg', 'magang.jpg', 'eskul.jpg', 'praktikum.jpg', 'rpl.jpg'] as $img)
                <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                    <img src="{{ asset('image/galeri/' . $img) }}" alt="Galeri" class="w-full h-40 sm:h-48 object-cover">
                </div>
            @endforeach
        </div>
    </section>

</div>

@include('partials.footer')
