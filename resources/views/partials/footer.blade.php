<footer>
    <div class="containerFooter">
        <div class="footer-content">
            
            <!-- KIRI: Informasi Sekolah -->
            <div class="footer-column brand-column">
                <img class="footer-logo" src="/image/LogoPelitaFooter.png" alt="Logo Pelita Project">
                <p class="brand-description"><strong>Alamat:</strong></p>
                <p class="brand-description">
                    Jl. Duri Utara No.23-29, RT.3/RW.6, Duri Utara, Kec. Tambora, Kota Jakarta Barat, DKI Jakarta 11270
                </p>
                    <p class="brand-description"><strong>Telepon:</strong></p>
                    <p class="brand-description"><i class='bx bxs-phone'></i> 0216314072</p>
                    <p class="brand-description"><strong>Email:</strong></p>
                    <p class="brand-description"><i class='bx bx-envelope'></i> pelitaschool4@gmail.com</p>
                    <p class="brand-description"><strong>Ikuti Kami:</strong></p>
                <div class="social-icons">
                    <a href="https://www.youtube.com/@smkpelitaivjakbar7063" class="IconLink" style="text-decoration: none;"><i class='bx bxl-youtube'></i></a>
                    <a href="https://www.instagram.com/smkpelitaiv_/" class="IconLink" style="text-decoration: none;"><i class='bx bxl-instagram'></i></a>
                    <a href="https://x.com/smk_pelitaiv?t=tx0q1ofTW8C1n6vWHcpTVg&s=08" class="IconLink" style="text-decoration: none;"><i class='bx bxl-twitter'></i></a>
                </div>
            </div>

            <div class="footer-column">
                <ul class="footer-links">
                    <h4>Tags</h4>
                    <li><a class="Tags" title="SMK PELITA IV - SMK Bisa SMK Hebat">SMK PELITA IV - SMK Bisa SMK Hebat</a></li>
                    <li><a class="Tags" title="Pendaftaran Siswa Baru">PENDAFTARAN SISWA BARU</a></li>
                    <li><a class="Tags" title="Sekilas Info">SEKILAS-INFO</a></li>
                    <li><a class="Tags" title="Berita">BERITA</a></li>
                    <li><a class="Tags" title="Para Guru dan Tenaga Kependidikan">PARA GURU DAN TENDIK</a></li>
                    <li><a class="Tags" title="Pengurus Yayasan">PENGURUS YAYASAN</a></li>
                    <li><a class="Tags" title="PPDB">PPDB</a></li>
                    <li><a class="Tags" title="Pengumuman">PENGUMUMAN</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <div id="map" style="height: 290px; width: 100%; border-radius: 8px;"></div>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Pelita Project. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-6.155879835873499, 106.80203030611892], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    L.marker([-6.155879835873499, 106.80203030611892]).addTo(map)
        .bindPopup("SMK Pelita IV")
        .openPopup();
</script>
