@include('partials.header', ['NamaPage' => 'Registrasi Pengguna'])
@include('partials.sidebar')
<link rel="stylesheet" href="{{asset('css/AdminCSS/ManajemenUserEdit.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<body>
    <div class="edit-user-container">
        <h1>Edit User</h1>

        <div class="edit-user-card">
            <h2>Edit Data {{ ucfirst($role) }}</h2>
            
            <form method="POST" action="{{ route('admin.user.update', $id) }}">
                @csrf
                @method('PUT')

                <input type="hidden" name="role" value="{{ $role }}">

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" value="{{ $user->profile->name }}" required>
                    @error('name')
                        <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->profile->email }}" required>
                    @error('email')
                        <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" id="nik" name="nik" value="{{ $user->profile->nik }}" required>
                    @error('nik')
                        <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" id="password" name="password">
                    @error('password')
                        <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                @if ($role === 'murid')
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" id="nis" name="nis" value="{{ $user->nis }}" required>
                        @error('nis')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" id="nisn" name="nisn" value="{{ $user->nisn }}" required>
                        @error('nisn')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kelas_id">Kelas</label>
                        <select id="kelas_id" name="kelas_id" required>
                            @foreach ($kelasList as $kelas)
                                <option value="{{ $kelas->kelas_id }}" {{ $user->kelas_id == $kelas->kelas_id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <button type="submit" class="btn-update">Update User</button>
            </form>
        </div>
    </div>
</body>