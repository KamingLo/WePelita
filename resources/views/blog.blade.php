@include('partials.header', ['NamaPage' => $kegiatans->judul_kegiatan])
<link rel="stylesheet" href="{{ asset('css/bombaclat.css') }}" />

{{-- error kalau pake cssnya kosong ngak ada gambar --}}
<img src="{{ asset('storage/' . $kegiatans->lampiran) }}" alt="" style="max-width: 30%; max-height:30%;">