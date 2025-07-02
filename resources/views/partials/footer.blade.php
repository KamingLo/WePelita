<footer>
    <div class="bg-blue-700 text-white pt-8 pb-4 w-full">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex flex-wrap justify-between mb-5 items-start">
                <div class="w-full md:w-1/3 lg:w-1/4 mb-6 pr-5">
                    <img class="h-12 w-auto mb-3" src="/image/LogoPelitaFooter.png" alt="Logo Pelita Project">
                    <p class="text-white text-opacity-80 mb-4 max-w-xs leading-tight text-sm">
                        <strong>Alamat:</strong><br>
                        Jl. Duri Utara No.23-29, RT.3/RW.6, Duri Utara, Kec. Tambora, Kota Jakarta Barat, DKI Jakarta 11270
                    </p>
                    <div class="flex max-w-xs justify-between">
                        <div>
                            <p class="text-white text-opacity-80 text-sm"><strong>Telepon:</strong></p>
                            <p class="text-white text-opacity-80 text-sm">0216314072</p>
                        </div>
                        <div>
                            <p class="text-white text-opacity-80 text-sm"><strong>Email:</strong></p>
                            <p class="text-white text-opacity-80 text-sm">pelitaschool4@gmail.com</p>
                        </div>
                    </div>
                    <p class="text-white text-opacity-80 mt-4 text-sm"><strong>Ikuti Kami:</strong></p>
                    <div class="flex gap-2.5 mt-4">
                        <a href="https://www.youtube.com/@smkpelitaivjakbar7063" class="flex items-center justify-center w-8 h-8 bg-white bg-opacity-10 rounded-full text-white border border-white border-opacity-20 hover:bg-opacity-20 transform hover:-translate-y-0.5 transition-transform" aria-label="YouTube">
                            <i class='bx bxl-youtube text-lg'></i>
                        </a>
                        <a href="https://www.instagram.com/smkpelitaiv_/" class="flex items-center justify-center w-8 h-8 bg-white bg-opacity-10 rounded-full text-white border border-white border-opacity-20 hover:bg-opacity-20 transform hover:-translate-y-0.5 transition-transform" aria-label="Instagram">
                            <i class='bx bxl-instagram text-lg'></i>
                        </a>
                        <a href="https://x.com/smk_pelitaiv?t=tx0q1ofTW8C1n6vWHcpTVg&s=08" class="flex items-center justify-center w-8 h-8 bg-white bg-opacity-10 rounded-full text-white border border-white border-opacity-20 hover:bg-opacity-20 transform hover:-translate-y-0.5 transition-transform" aria-label="Twitter">
                            <i class='bx bxl-twitter text-lg'></i>
                        </a>
                    </div>
                </div>

                <div class="w-full md:w-1/3 lg:w-1/4 mb-6 pr-5 md:pl-10">
                    <h3 class="text-base mb-3 font-medium text-white">Tags</h3>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <a class="inline-block border border-white text-white text-xs px-3 py-2 rounded whitespace-nowrap cursor-default" title="SMK PELITA IV - SMK Bisa SMK Hebat">SMK PELITA IV - SMK Bisa SMK Hebat</a>
                        <a class="inline-block border border-white text-white text-xs px-3 py-2 rounded whitespace-nowrap cursor-default" title="Pendaftaran Siswa Baru">PENDAFTARAN SISWA BARU</a>
                        <a class="inline-block border border-white text-white text-xs px-3 py-2 rounded whitespace-nowrap cursor-default" title="Sekilas Info">SEKILAS-INFO</a>
                        <a class="inline-block border border-white text-white text-xs px-3 py-2 rounded whitespace-nowrap cursor-default" title="Berita">BERITA</a>
                        <a class="inline-block border border-white text-white text-xs px-3 py-2 rounded whitespace-nowrap cursor-default" title="Para Guru dan Tenaga Kependidikan">PARA GURU DAN TENDIK</a>
                        <a class="inline-block border border-white text-white text-xs px-3 py-2 rounded whitespace-nowrap cursor-default" title="Pengurus Yayasan">PENGURUS YAYASAN</a>
                        <a class="inline-block border border-white text-white text-xs px-3 py-2 rounded whitespace-nowrap cursor-default" title="PPDB">PPDB</a>
                        <a class="inline-block border border-white text-white text-xs px-3 py-2 rounded whitespace-nowrap cursor-default" title="Pengumuman">PENGUMUMAN</a>
                    </div>
                </div>

                <div class="w-full md:w-1/3 lg:w-1/4 mb-6 pl-0 md:pl-10">
                    <h3 class="text-base mb-3 font-medium text-white">Our Location</h3>
                    <div id="map" class="h-72 w-full rounded-lg shadow-md"></div>
                </div>
            </div>

            <div class="text-center border-t border-white border-opacity-10 text-white text-opacity-70 text-xs pt-3">
                <p>© 2025 Pelita Project. All rights reserved.</p>
            </div>
        </div>

        <a href="https://wa.me/6285218826006?text=Halo,%20saya%20ingin%20bertanya%20tentang%20sekolah%20SMK%20Pelita%20IV." target="_blank"
            class="fixed bottom-5 right-5 w-16 h-16 bg-green-500 rounded-full flex items-center justify-center shadow-lg z-50 transition-transform duration-300 ease-in-out hover:scale-110" aria-label="WhatsApp Us">
            <i class='bx bxl-whatsapp text-white text-4xl'></i>
        </a>
    </div>
</footer>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([-6.155879835873499, 106.80203030611892], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        L.marker([-6.155879835873499, 106.80203030611892]).addTo(map)
            .bindPopup("SMK Pelita IV")
            .openPopup();
    });
</script>