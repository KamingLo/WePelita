@include('admin.partials.header', ['NamaPage' => 'Halaman Utama'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{asset('css/AdminCSS/ManajemenUser.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="container">
    <h1>Manajemen User</h1>

    <div class="filter-container">
        <form method="GET" action="{{ route('admin.ManajemenUser') }}">
            <label for="role">Filter berdasarkan peran:</label>
            <select name="role" id="role" onchange="this.form.submit()">
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="murid" {{ request('role') == 'murid' ? 'selected' : '' }}>Murid</option>
                <option value="orang_tua" {{ request('role') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Admins as $Admin)
                        <tr>
                            <td>{{ $Admin->profile->name }}</td>
                            <td>{{ $Admin->profile->email }}</td>
                            <td>{{ $Admin->profile->alamat }}</td>
                            <td>
                                <div class="OptionManajemenTabel">
                                    <a href="{{ route('admin.user.edit', ['id' => $Admin->admin_id, 'role' => 'admin']) }}" class="btn btn-sm btn-warning">
                                        <i class='bx bx-edit-alt IconForButton'></i>Edit‎ ‎ ‎ ‎ ‎ </a>
                                    <form method="POST" action="{{ route('admin.user.delete', ['id' => $Admin->admin_id, 'role' => 'admin']) }}" style="display:inline-block;">
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
                        <th>Nuptk</th>
                        <th>Status Kerja</th>
                        <th>Email</th>
                        <th>No telpon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Gurus as $guru)
                        <tr>
                            <td>{{ $guru->profile->name }} {{ $guru->gelar }}</td>
                            <td>{{ $guru->nuptk }}</td>
                            <td>{{ $guru->statusKerja }}</td>
                            <td>{{ $guru->profile->email }}</td>
                            <td>{{ $guru->profile->no_telp }}</td>
                            <td>
                                <div class="OptionManajemenTabel">
                                    <a href="{{ route('admin.user.edit', ['id' => $guru->guru_id, 'role' => 'guru']) }}" class="btn btn-sm btn-warning">
                                        <i class='bx bx-edit-alt IconForButton'></i>Edit‎ ‎ ‎ ‎ ‎ </a>
                                    <form method="POST" action="{{ route('admin.user.delete', ['id' => $guru->guru_id, 'role' => 'guru']) }}" style="display:inline-block;">
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
                        <th>Nama orang tua</th>
                        <th>Asal Sekolah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($MuridOrangTuas as $MuridOrang_tua)
                        <tr>
                            <td>{{ $MuridOrang_tua->muridKelas->murid->profile->name }}</td>
                            <td>{{ $MuridOrang_tua->muridKelas->Murid->profile->email }}</td>
                            <td>{{ $MuridOrang_tua->muridKelas->kelasTahun->kelas->nama_kelas }}</td>
                            <td>{{ $MuridOrang_tua->muridKelas->Murid->nis }}</td>
                            <td>{{ $MuridOrang_tua->muridKelas->Murid->nisn }}</td>
                            <td>{{ $MuridOrang_tua->orangTua->profile->name }}</td>
                            <td>{{ $MuridOrang_tua->muridKelas->Murid->asal_sekolah }}</td>

                            <td>
                                <div class="OptionManajemenTabel">
                                    <a href="{{ route('admin.user.edit', ['id' => $MuridOrang_tua->MuridKelas->murid_kelas_id, 'role' => 'murid']) }}" class="btn btn-sm btn-warning">
                                        <i class='bx bx-edit-alt IconForButton'></i>Edit‎ ‎ ‎ ‎ ‎ </a>
                                    <form method="POST" action="{{ route('admin.user.delete', ['id' => $MuridOrang_tua->Muridkelas->murid_kelas_id, 'role' => 'murid']) }}" style="display:inline-block;">
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

        @elseif ($role === 'orang_tua')
            <h3>Data Orang Tua</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($MuridOrangTuas as $MuridOrang_tua)
                        <tr>
                            <td>{{ $MuridOrang_tua->orangTua->profile->name }}</td>
                            <td>{{ $MuridOrang_tua->orangTua->profile->email }}</td>
                            <td>{{ $MuridOrang_tua->orangTua->profile->nik }}</td>
                            <td>
                                <div class="OptionManajemenTabel">
                                    <a href="{{ route('admin.user.edit', ['id' => $MuridOrang_tua->orangTua->orang_tua_id, 'role' => 'orang_tua']) }}" class="btn btn-sm btn-warning">
                                        <i class='bx bx-edit-alt IconForButton'></i>Edit‎ ‎ ‎ ‎ ‎ </a>
                                    <form method="POST" action="{{ route('admin.user.delete', ['id' => $MuridOrang_tua->orangTua->orang_tua_id, 'role' => 'orang_tua']) }}" style="display:inline-block;">
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