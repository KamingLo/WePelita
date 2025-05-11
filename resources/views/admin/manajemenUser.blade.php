

<div class="container">
    <h1>Manajemen User</h1>

    <form method="GET" action="{{ route('admin.manajemenUser') }}" class="mb-4">
        <label for="role">Filter berdasarkan peran:</label>
        <select name="role" id="role" onchange="this.form.submit()">
            <option value="">-- Semua --</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
            <option value="murid" {{ request('role') == 'murid' ? 'selected' : '' }}>Murid</option>
            <option value="orangtua" {{ request('role') == 'orangtua' ? 'selected' : '' }}>Orang Tua</option>
        </select>
    </form>

    @php $role = request('role'); @endphp

    @if ($role === 'admin')
        <h3>Data Admin</h3>
        <table class="table table-bordered">
            <tr><th>Nama</th><th>Email</th></tr>
            @foreach ($Admins as $admin)
                <tr>
                    <td>{{ $admin->profile->name }}</td>
                    <td>{{ $admin->profile->email }}</td>
                </tr>
            @endforeach
        </table>
    
    @elseif ($role === 'guru')
        <h3>Data Guru</h3>
        <table class="table table-bordered">
            <tr><th>Nama</th><th>Email</th></tr>
            @foreach ($Gurus as $guru)
                <tr>
                    <td>{{ $guru->profile->name }}</td>
                    <td>{{ $guru->profile->email }}</td>
                </tr>
            @endforeach
        </table>

    @elseif ($role === 'murid')
        <h3>Data Murid</h3>
        <table class="table table-bordered">
            <tr><th>Nama</th><th>Email</th><th>Kelas</th></tr>
            @foreach ($Murids as $murid)
                <tr>
                    <td>{{ $murid->profile->name }}</td>
                    <td>{{ $murid->profile->email }}</td>
                    <td>{{ $murid->kelas }}</td>
                </tr>
            @endforeach
        </table>

    @elseif ($role === 'orangtua')
        <h3>Data Orang Tua</h3>
        <table class="table table-bordered">
            <tr><th>Nama</th><th>Email</th></tr>
            @foreach ($OrangTuas as $ortu)
                <tr>
                    <td>{{ $ortu->profile->name }}</td>
                    <td>{{ $ortu->profile->email }}</td>
                </tr>
            @endforeach
        </table>

    @else
        <p>Silakan pilih peran untuk menampilkan data user tertentu.</p>
    @endif
</div>

<style>
    .container {
            margin-left: 280px;
    }
</style>