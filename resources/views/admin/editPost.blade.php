<form action="{{ route('edit.pengumuman', ['id' => $pengumuman->pengumuman_id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Judul -->
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" required
            value="{{ old('judul', $pengumuman->judul_pengumuman) }}">
    </div>

    <!-- Isi -->
    <div class="mb-3">
        <label for="isi" class="form-label">Isi</label>
        <textarea class="form-control" id="isi" name="isi" rows="4" required>{{ old('isi', $pengumuman->isi_pengumuman) }}</textarea>
    </div>

    <!-- Lampiran -->
    <div class="mb-3">
        <label for="lampiran" class="form-label">Foto Kegiatan (Opsional)</label>
        <input type="file" class="form-control" id="lampiran" name="lampiran">
        @if ($pengumuman->lampiran)
            <p class="mt-2">Lampiran saat ini:
                <a href="{{ asset('storage/' . $pengumuman->lampiran) }}" target="_blank">Lihat lampiran</a>
            </p>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
