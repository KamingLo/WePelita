<form action="{{ route('edit.pengumuman', ['id' => $pengumuman->pengumuman_id]) }}" method="POST" enctype="multipart/form-data">
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

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
