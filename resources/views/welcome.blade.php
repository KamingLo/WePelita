@include('partials.header', ['NamaPage' => 'Halaman Utama'])

<link rel="stylesheet" href="{{ asset('css/welcome.css') }}" />

<div class="ContainerWelcomePage">
    <div class="LayoutWePelita">
        
        <div class="Layout Murid">
            <div class="IsiDalemanLayout">
                <img src="/image/WePelitaMurid.png">
            </div>
            <div class="details">
                <h3>WePelita Murid</h3>
                <p>Klik Disini Untuk Siswa/Siswi</p>
            </div>
        </div>

        <div class="Layout Guru">
            <div class="IsiDalemanLayout">
                <img src="/image/WePelitaGuru.png">
            </div>
            <div class="details">
                <h3>WePelita Guru</h3>
                <p>Klik Disini Untuk Para Guru</p>
            </div>
        </div>

        <div class="Layout Orangtua">
            <div class="IsiDalemanLayout">
                <img src="" alt="Soon">
            </div>
            <div class="details">
                <h3>WePelita OrangTua</h3>
                <p>Klik Disini Untuk Para Orangtua Murid</p>
            </div>
        </div>

    </div>
</div>

@include('partials.footer')