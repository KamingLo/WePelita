<table class="table">
    <thead>
        <tr>
            <th>ID</th><th>Judul</th><th>Isi</th><th>Admin</th><th>Tanggal</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pengumumans as $pengumuman)
        <tr>
            <td>{{ $pengumuman->pengumuman_id }}</td>
            <td>{{ $pengumuman->judul_pengumuman }}</td>
            <td>{{ $pengumuman->isi_pengumuman }}</td>
            <td>{{ $pengumuman->admin->profile->name }}</td>
            <td>{{ $pengumuman->created_at }}</td>
            <td>
                <form action="{{ route('pengumuman.update', ['id' => $pengumuman->pengumuman_id]) }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
                <form action="{{ route('pengumuman.destroy', $pengumuman->pengumuman_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
