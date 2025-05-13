@include('admin.partials.header', ['NamaPage' => 'Manajemen Pengguna'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{asset('css/AdminCSS/ManajemenUser.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>Manajemen User</h1>

    <div class="filter-container">
        <form method="GET" action="{{ route('admin.manajemenUser') }}">
            <label for="role">Filter berdasarkan peran:</label>
            <select name="role" id="role" onchange="this.form.submit()">
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="murid" {{ request('role') == 'murid' ? 'selected' : '' }}>Murid</option>
                <option value="orangtua" {{ request('role') == 'orangtua' ? 'selected' : '' }}>Orang Tua</option>
            </select>
        </form>
    </div>

    @php $role = request('role'); @endphp

    <div class="table-container">
        @if ($role === 'admin')
            <h3>Data Admin</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nik</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Admins as $Admin)
                        <tr>
                            <td>{{ $Admin->profile->name }}</td>
                            <td>{{ $Admin->profile->email }}</td>
                            <td>{{ $Admin->profile->nik }}</td>
                            <td>********</td>
                            <td>
                                <div class="OptionManajemenTabel">
                                    <a href="{{ route('admin.user.edit', ['id' => $Admin->admin_id, 'role' => 'admin']) }}" class="btn btn-sm btn-warning">
                                        <i class='bx bx-edit-alt IconForButton'></i>Edit‎ ‎ ‎ ‎ ‎ </a>
                                    <form method="POST" action="{{ route('admin.user.delete', $Admin->admin_id) }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                                            <i class='bx bx-trash IconForButton'></i>Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
        @elseif ($role === 'guru')
            <h3>Data Guru</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nik</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Gurus as $guru)
                        <tr>
                            <td>{{ $guru->profile->name }}</td>
                            <td>{{ $guru->profile->email }}</td>
                            <td>{{ $guru->profile->nik }}</td>
                            <td>********</td>
                            <td>
                                <div class="OptionManajemenTabel">
                                    <a href="{{ route('admin.user.edit', ['id' => $guru->guru_id, 'role' => 'guru']) }}" class="btn btn-sm btn-warning">
                                        <i class='bx bx-edit-alt IconForButton'></i>Edit‎ ‎ ‎ ‎ ‎ </a>
                                    <form method="POST" action="{{ route('admin.user.delete', $guru->guru_id) }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                                            <i class='bx bx-trash IconForButton'></i>Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @elseif ($role === 'murid')
            <h3>Data Murid</h3>
            <table class="table murid">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>Nis</th>
                        <th>Nisn</th>
                        <th>Nik</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($MuridOrangTuas as $MuridOrang_tua)
                        <tr>
                            <td>{{ $MuridOrang_tua->Murid->profile->name }}</td>
                            <td>{{ $MuridOrang_tua->Murid->profile->email }}</td>
                            <td>{{ $MuridOrang_tua->Murid->kelas->nama_kelas }}</td>
                            <td>{{ $MuridOrang_tua->Murid->nis }}</td>
                            <td>{{ $MuridOrang_tua->Murid->nisn }}</td>
                            <td>{{ $MuridOrang_tua->Murid->profile->nik }}</td>
                            <td>********</td>
                            <td>
                                <div class="OptionManajemenTabel">
                                    <a href="{{ route('admin.user.edit', ['id' => $MuridOrang_tua->Murid->murid_id, 'role' => 'murid']) }}" class="btn btn-sm btn-warning">
                                        <i class='bx bx-edit-alt IconForButton'></i>Edit‎ ‎ ‎ ‎ ‎ </a>
                                    <form method="POST" action="{{ route('admin.user.delete', $MuridOrang_tua->Murid->murid_id) }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                                            <i class='bx bx-trash IconForButton'></i>Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @elseif ($role === 'orangtua')
            <h3>Data Orang Tua</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nik</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($MuridOrangTuas as $MuridOrang_tua)
                        <tr>
                            <td>{{ $MuridOrang_tua->orangTua->profile->name }}</td>
                            <td>{{ $MuridOrang_tua->orangTua->profile->email }}</td>
                            <td>{{ $MuridOrang_tua->orangTua->profile->nik }}</td>
                            <td>********</td>
                            <td>
                                <div class="OptionManajemenTabel">
                                    <a href="{{ route('admin.user.edit', ['id' => $MuridOrang_tua->orangTua->orang_tua_id, 'role' => 'orangtua']) }}" class="btn btn-sm btn-warning">
                                        <i class='bx bx-edit-alt IconForButton'></i>Edit‎ ‎ ‎ ‎ ‎ </a>
                                    <form method="POST" action="{{ route('admin.user.delete', $MuridOrang_tua->orangTua->orang_tua_id) }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                                            <i class='bx bx-trash IconForButton'></i>Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @else
            <p>Silakan pilih peran untuk menampilkan data user tertentu.</p>
        @endif
    </div>
</div>