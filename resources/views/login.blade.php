@include('partials.header', ['NamaPage' => 'Halaman Login'])
    @include('partials.navbar')

<div class="KotakUtamaLog">
  <div class="ImgVidLogin">
    <video autoplay loop muted>
    <source src="/image/introRE.mp4" type="video/mp4">
    Browser Anda tidak mendukung elemen video.
    </video>
  </div>

  <div class="KotakGridLog">
    <div class="KotakLoginLog">
      <h2>Login</h2>
      <form method="POST" action="{{ url('login') }}">
        @csrf
        <label for="email">Email:</label>
        <input
          type="text"
          name="email"
          placeholder="Enter your Email"
          required
        />

        <label for="password">Password:</label>
        <input
          type="password"
          name="password"
          placeholder="Enter your password"
          required
        />

        <button type="submit" class="SubmitLog">Login</button>

            @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
      </form>
    </div>

    <script src="/js/AnimTeks.js"></script>
  </div>
</div>

@include('partials.footer')