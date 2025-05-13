@include('admin.partials.header', ['NamaPage' => 'Tambah postingan'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/NewPost.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="ContainerNewPost">
    <h1>Postingan Baru</h1>

    <div class="LayoutNewPost">
        <h2>Buat Postingan</h2>

        <div class="form-container">
            <div class="form-left">
                <form action="{{ route('admin.posting') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tipe Postingan</label><br>
                        <input type="radio" id="announcement" name="tipe" value="pengumuman" checked>
                        <label for="announcement">Pengumuman</label>

                        <input type="radio" id="event" name="tipe" value="kegiatan">
                        <label for="event">Kegiatan</label>
                    </div>

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input class="form-control" type="text" id="judul" name="judul" required></input>
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        <textarea class="form-control" id="isi" name="isi" rows="6" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="lampiran" class="form-label">Foto Kegiatan</label>
                        <input type="file" class="form-control" id="lampiran" name="lampiran" accept="image/*">
                    </div>

                    <div class="InfoSubmit">
                        <button type="submit" class="btn btn-primary">Posting</button>

                                @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if ($errors->has('lampiran'))
                            <div class="alert alert-danger mt-3">
                                {{ $errors->first('lampiran') }}
                            </div>
                        @endif
                    </div>    
                </form>
            </div>
            
            <div class="form-right">
                <div class="preview-header">
                    <div class="preview-title">Preview Foto</div>
                    <div class="preview-subtitle">Pratinjau foto yang akan diunggah</div>
                    <button id="close-preview" class="btn btn-sm btn-light" style="position: absolute; top: 0; right: 0; padding: 2px 8px; font-size: 12px;">&times;</button>
                </div>
                <div id="foto-preview-container" class="foto-preview-container">
                    <img id="foto-preview" class="foto-preview" src="" alt="Preview foto" style="display: none;">
                    <p id="file-name" style="display: none; margin-top: 10px; font-size: 14px; color: #666; text-align: center;"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/CssAdmin.js') }}"></script>