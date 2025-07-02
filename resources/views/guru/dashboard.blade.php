@include('guru.partials.header')
@include('guru.partials.sidebar')

<body class="font-sans text-gray-700 m-0 p-0 overflow-x-hidden md:overflow-x-auto">
    <div class="md:ml-[256px] px-4 md:px-8 py-8 flex flex-col gap-8">
        <h1 class="text-gray-800 mb-2 text-2xl font-bold relative pb-2">
            Teacher Tools
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.jadwal') }}" 
               class="bg-white p-5 rounded-lg shadow-md text-center text-gray-700 no-underline transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                <div class="text-4xl text-blue-600 mb-4"><i class="fas fa-users"></i></div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Liat Jadwal Pelajaran</h3>
                <p class="text-sm text-gray-500">Manage students, teachers, parents, and admins</p>
            </a>
            <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.jadwalanda') }}" 
               class="bg-white p-5 rounded-lg shadow-md text-center text-gray-700 no-underline transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                <div class="text-4xl text-blue-600 mb-4"><i class="fas fa-chalkboard"></i></div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Liat Jadwal Ajar Anda</h3>
                <p class="text-sm text-gray-500">Create and manage class assignments</p>
            </a>
            <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.isinilai') }}" 
               class="bg-white p-5 rounded-lg shadow-md text-center text-gray-700 no-underline transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl text-blue-600 mb-4"><i class="fas fa-calendar-alt"></i></div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Menu Nilai</h3>
                <p class="text-sm text-gray-500">Schedule classes and check for conflicts</p>
            </a>
            <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.ManajemenPost') }}" 
               class="bg-white p-5 rounded-lg shadow-md text-center text-gray-700 no-underline transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="400">
                <div class="text-4xl text-blue-600 mb-4"><i class="fas fa-book"></i></div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Manajemen Postingan</h3>
                <p class="text-sm text-gray-500">Add and update school subjects</p>
            </a>
        </div>

        <div class="w-full">
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-5 max-w-md">
                <div class="w-24 h-24 rounded-full overflow-hidden flex items-center justify-center bg-gray-100 border-4 border-blue-600">
                    @if($guru->profile && $guru->profile->avatar && file_exists(public_path('storage/file/' . $guru->profile->avatar)))
                        <img src="{{ asset('storage/file/' . $guru->profile->avatar . '?v=' . time()) }}" alt="{{ $guru->profile->name }} Avatar" class="w-full h-full object-cover">
                    @else
                        <div class="text-3xl font-semibold text-blue-600 uppercase">{{ strtoupper(substr($guru->profile->name, 0, 2)) }}</div>
                    @endif
                </div>
                <div class="flex-1 flex items-center">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-gray-800 mb-1">{{ $guru->profile->name }}</h2>
                        <p class="text-sm text-gray-500">Guru</p>
                    </div>
                    <a href="{{ route('postingan.profile.update') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-blue-600 border border-blue-600 rounded-md no-underline transition-all duration-300 ease-in-out hover:bg-blue-700 hover:border-blue-700 hover:shadow-lg hover:shadow-blue-600/30">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        });
    </script>
</body>