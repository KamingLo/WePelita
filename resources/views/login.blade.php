@include('partials.header', ['NamaPage' => 'Halaman Login', 'isiPage' => 'Anggep ini login page'])

<form method="POST" action="{{ url('login') }}">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif


@include('partials.footer')