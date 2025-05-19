@include('guru.partials.header', ['NamaPage' => 'Jadwal Pelajaran Semua Guru'])

<div class="container">
    <h1>Jadwal Pelajaran Semua Guru</h1>

    
    @livewireScripts
    @livewire('guru.tampilkan-jadwal-hari')

    @livewireStyles

</div>