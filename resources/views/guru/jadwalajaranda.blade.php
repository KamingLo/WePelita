@include('guru.partials.header')
@include('guru.partials.sidebar')

<div class="container">
    {{-- <h1>Jadwal Pelajaran Semua Guru</h1> --}}

    
    @livewireScripts
    @livewire('guru.tampilkan-jadwal-anda')

    @livewireStyles

</div>