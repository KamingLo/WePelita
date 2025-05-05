
@if (Route::has('login'))
    <nav class="">
        @auth
            <a href="{{ url('/dashboard') }}" class="">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="">
                Log in
            </a>

@if (Route::has('register'))
    <a href="{{ route('register') }}" class="">
        Register
    </a>
@endif

    @endauth
</nav>
@endif