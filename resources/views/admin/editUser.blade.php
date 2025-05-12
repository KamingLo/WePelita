<form method="POST" action="{{ route('admin.user.update', $id) }}">
    @csrf
    @method('PUT')

    <input type="hidden" name="role" value="{{ $role }}">

    <div>
        <label>Nama</label>
        <input type="text" name="name" value="{{ $user->profile->name }}" required>
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ $user->profile->email }}" required>
    </div>

    <div>
        <label>NIK</label>
        <input type="text" name="nik" value="{{ $user->profile->nik }}" required>
    </div>

    <div>
        <label>Password (kosongkan jika tidak diubah)</label>
        <input type="password" name="password">
    </div>

    @if ($role === 'murid')
        <div>
            <label>NIS</label>
            <input type="text" name="nis" value="{{ $user->nis }}" required>
        </div>

        <div>
            <label>NISN</label>
            <input type="text" name="nisn" value="{{ $user->nisn }}" required>
        </div>

        <div>
            <label>Kelas</label>
            <select name="kelas_id" required>
                @foreach ($kelasList as $kelas)
                    <option value="{{ $kelas->kelas_id }}" {{ $user->kelas_id == $kelas->kelas_id ? 'selected' : '' }}>
                        {{ $kelas->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    <button type="submit">Update</button>
</form>
