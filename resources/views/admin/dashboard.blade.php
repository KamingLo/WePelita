@include('partials.header', ['NamaPage' => 'Halaman Utama'])
@include('partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/jadwal.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <div class="ContainerJadwal">
        <h1>Hi,{{ $admin->profile->name }}</h1>
        
