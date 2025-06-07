@include('admin.partials.header')
@include('admin.partials.sidebar')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin/ManajemenUser.css') }}" />

<body>
    @if (auth()->check())
    <div class="ContainerUtamaManajemenUserEdit">
        <h1>Edit Profil Pengguna</h1>
        <div class="SplitFormMuEdit">
            <div class="ReisterUser">
                <div class="ContainerRegister">
                    <div class="LayoutRegisterForm">
                        <div class="NotifikasiMUFormRegUser">
                            <div class="HeaderRegisUser">
                                <h2>Edit Data Profil</h2>
                                <div class="KhususPsnBerhasil">
                                    @if(session('success'))
                                    <div class="UiPsnDis PsnBerhasil">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('postingan.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="IsiData">
                                <label for="email">Email:</label>
                                <div style="position: relative;">
                                    <input type="email" name="email" id="email" class="TampilanIsiData" value="{{ old('email', auth()->user()->email) }}" placeholder="Masukkan email" style="padding-right: 40px;" required>
                                    <button type="button" id="clearEmail" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('email')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="IsiData">
                                <label for="password">Password (kosongkan jika tidak diubah):</label>
                                <div style="position: relative;">
                                    <input type="password" name="password" id="password" class="TampilanIsiData" placeholder="Masukkan password baru" style="padding-right: 40px;">
                                    <button type="button" id="clearPassword" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="IsiData">
                                <label for="avatar">Avatar:</label>
                                <div style="position: relative;">
                                    <input type="file" name="avatar" id="avatar" class="TampilanIsiData" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml" style="padding-right: 40px;">
                                    <button type="button" id="clearAvatar" class="HapusBar">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                                @if(auth()->user()->avatar)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Current Avatar" style="max-width: 100px; border-radius: 8px;">
                                        <p class="text-sm text-gray-600">Avatar saat ini</p>
                                    </div>
                                @endif
                                @error('avatar')
                                    <span class="PsnError">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="TambahRegister">Update Profil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <p>Anda tidak memiliki akses ke halaman ini</p>
        <a href="/login">Login kembali disini</a>
    @endif

    <script src="{{ asset('js/CssAdmin.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const clearButtons = document.querySelectorAll('.HapusBar');
            clearButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    if (input.tagName === 'INPUT' || input.tagName === 'SELECT') {
                        input.value = '';
                    }
                });
            });
        });
    </script>
</body>