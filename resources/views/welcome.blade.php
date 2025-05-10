@include('partials.header', ['NamaPage' => 'Halaman Utama'])
@include('partials.navbar')
<link rel="stylesheet" href="{{ asset('css/Welcome.css') }}" />

<div class="ContainerWelcomePage">
    <div class="cards">
        <div class="card card1">
            <div class="container">
                <img src="las vegas.jpg">
            </div>
            <div class="details">
                <h3>WePelita Murid</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium dignissimos, minus aperiam adipisci exercitationem.</p>
            </div>
        </div>

        <div class="card card2">
            <div class="container">
                <img src="newyork.jpg">
            </div>
            <div class="details">
                <h3>WePelita Guru</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium dignissimos, minus aperiam adipisci exercitationem.</p>
            </div>
        </div>

        <div class="card card3">
            <div class="container">
                <img src="singapore.jpg">
            </div>
            <div class="details">
                <h3>WePelita OrangTua</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium dignissimos, minus aperiam adipisci exercitationem.</p>
            </div>
        </div>
    </div>
</div>


@include('partials.footer')