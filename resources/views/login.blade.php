@include('partials.header', ['NamaPage' => 'Login'])

<div class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat z-0" style="background-image: url('/image/imageSekolah.png');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>

    <div class="relative z-10 w-full max-w-md rounded-xl overflow-hidden mx-4">
        <div class="w-full bg-white shadow-md backdrop-filter backdrop-blur-lg flex items-center justify-center p-6 sm:p-8 lg:p-10 rounded-xl">
            <div class="w-full">
                <h2 class="text-3xl sm:text-4xl font-bold mb-6 text-center text-gray-800">Login</h2>
                <form method="POST" action="{{ url('login') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email:</label>
                        <input type="text" name="email" id="email" placeholder="Masukkan Email Anda" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-800 text-base placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300" />
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan Kata Sandi Anda" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-800 text-base placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300" />
                    </div>

                    <button type="submit"
                            class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg text-lg hover:bg-blue-700 transition-colors duration-200">
                        Login
                    </button>

                    @if ($errors->any())
                        <div class="mt-6 text-red-500 text-sm font-medium text-center">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')