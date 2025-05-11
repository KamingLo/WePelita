<div class="container">
    <h2>Buat Postingan</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.posting') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Pilih tipe postingan -->
        <div class="mb-3">
            <label class="form-label">Tipe Postingan</label><br>
            <input type="radio" id="announcement" name="tipe" value="pengumuman" checked>
            <label for="announcement">Pengumuman</label>

            <input type="radio" id="event" name="tipe" value="kegiatan">
            <label for="event">Kegiatan</label>
        </div>

        <!-- Judul -->
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>

        <!-- Isi -->
        <div class="mb-3">
            <label for="isi" class="form-label">Isi</label>
            <textarea class="form-control" id="isi" name="isi" rows="4" required></textarea>
        </div>

        <!-- Lampiran -->
        <div class="mb-3">
            <label for="lampiran" class="form-label">Foto Kegiatan</label>
            <input type="file" class="form-control" id="lampiran" name="lampiran">
        </div>

        <button type="submit" class="btn btn-primary">Posting</button>
    </form>

    @if ($errors->has('lampiran'))
        <div class="alert alert-danger">
            {{ $errors->first('lampiran') }}
        </div>
    @endif


@foreach($pengumumans as $pengumuman)
    @if ($pengumuman->lampiran)
        <img src="{{ asset('storage/' . $pengumuman->lampiran) }}" alt="Lampiran" />
    @else
        <p>Gambar tidak tersedia.</p>
    @endif
@endforeach
</div>
