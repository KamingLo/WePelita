@include('partials.header', ['NamaPage' => 'Profil Sekolah Pelita'])

<div id="main-content-wrapper" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <div id="main-content">
        
        {{-- Sejarah Sekolah --}}
        <section class="py-12">
            <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 section-title">Sejarah SMK Pelita IV</h2>
            </div>
            <div class="text-gray-600 text-sm sm:text-base md:text-lg leading-relaxed space-y-4 text-justify" data-aos="fade-up">
                <p>
                    SMK Pelita IV Jakarta didirikan pada tahun 1987 oleh para pendidik yang peduli terhadap kebutuhan pendidikan kejuruan di Indonesia. Sejak awal, sekolah ini bertujuan untuk mencetak lulusan yang siap kerja dan memiliki kompetensi unggul di bidangnya.
                </p>
                <p>
                    Dalam perjalanannya, SMK Pelita IV terus berkembang baik dari segi jumlah peserta didik, tenaga pengajar, maupun fasilitas pendukung. Dengan semangat inovasi, sekolah ini mampu menyesuaikan kurikulum dengan kebutuhan industri yang terus berubah.
                </p>
                <p>
                    Hingga kini, SMK Pelita IV telah meluluskan lebih dari 10.000 siswa yang tersebar di berbagai sektor industri dan pendidikan lanjutan di dalam maupun luar negeri.
                </p>
            </div>
        </section>

        {{-- Visi dan Misi --}}
        <section class="py-12">
        <div class="flex flex-col md:flex-row flex-wrap gap-6 md:gap-8">
            <div class="flex-1 min-w-[280px] p-6 md:p-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 text-white shadow-lg relative overflow-hidden" data-aos="fade-right">
                <div class="relative z-10">
                    <h2 class="text-xl sm:text-2xl font-bold mb-4 md:mb-6 after:content-[''] after:absolute after:bottom-[-10px] after:left-0 after:w-10 after:h-1 after:bg-white relative">Visi</h2>
                    <p class="text-sm sm:text-base leading-relaxed">"Menjadi lembaga pendidikan kejuruan yang unggul, berkarakter, dan menghasilkan lulusan yang kompeten serta mampu bersaing di era global."</p>
                    <i class='bx bx-bulb absolute right-3 bottom-3 text-7xl sm:text-8xl opacity-20'></i>
                </div>
            </div>
            <div class="flex-1 min-w-[280px] p-6 md:p-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-500 text-white shadow-lg relative overflow-hidden" data-aos="fade-left">
                <div class="relative z-10">
                    <h2 class="text-xl sm:text-2xl font-bold mb-4 md:mb-6 after:content-[''] after:absolute after:bottom-[-10px] after:left-0 after:w-10 after:h-1 after:bg-white relative">Misi</h2>
                    <ul class="list-disc pl-5 text-sm sm:text-base">
                        <li class="mb-2">Menyelenggarakan pendidikan kejuruan yang berorientasi pada kebutuhan dunia kerja.</li>
                        <li class="mb-2">Mengembangkan kurikulum berbasis kompetensi dan karakter.</li>
                        <li class="mb-2">Meningkatkan kualitas tenaga pendidik dan kependidikan.</li>
                        <li class="mb-2">Menyediakan sarana dan prasarana pembelajaran yang modern.</li>
                        <li>Menjalin kerjasama dengan dunia usaha dan industri.</li>
                    </ul>
                    <i class='bx bx-target-lock absolute right-3 bottom-3 text-7xl sm:text-8xl opacity-20'></i>
                </div>
            </div>
        </div>
    </section>


        {{-- Struktur Organisasi --}}
        <section class="py-12 bg-gray-50">
            <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 section-title">Struktur Organisasi</h2>
                <p class="text-gray-600 text-sm sm:text-base">Struktur Kepemimpinan dan Staf Sekolah</p>
            </div>
            <div class="flex justify-center" data-aos="zoom-in">
                <img src="{{ asset('image/struktur-organisasi.png') }}" alt="Struktur Organisasi SMK Pelita IV" class="w-full md:max-w-3xl rounded-lg shadow-lg">
            </div>
        </section>

        {{-- Fasilitas Sekolah --}}
        <section class="py-12">
            <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 section-title">Fasilitas Sekolah</h2>
                <p class="text-gray-600 text-sm sm:text-base">Lingkungan Belajar yang Nyaman dan Lengkap</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach ([
                    ['src' => 'lab-komputer.jpg', 'title' => 'Laboratorium Komputer'],
                    ['src' => 'perpustakaan.jpg', 'title' => 'Perpustakaan Digital'],
                    ['src' => 'ruang-kelas.jpg', 'title' => 'Ruang Kelas Multimedia'],
                    ['src' => 'aula.jpg', 'title' => 'Aula Serbaguna'],
                    ['src' => 'lapangan.jpg', 'title' => 'Lapangan Olahraga'],
                    ['src' => 'kantin.jpg', 'title' => 'Kantin Sehat']
                ] as $fasilitas)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all" data-aos="fade-up">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('image/fasilitas/' . $fasilitas['src']) }}" alt="{{ $fasilitas['title'] }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-semibold text-blue-600">{{ $fasilitas['title'] }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>
</div>

@include('partials.footer')
