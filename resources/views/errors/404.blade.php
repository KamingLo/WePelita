@include('partials.header', ['NamaPage' => 'Halaman Tidak Ditemukan'])

    <style>
        .error-container {
            color: #222222;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
            margin-bottom: 5rem;
            text-align: center;
            display: flex;
        }
        
        .error-container .logo-container {
            margin-bottom: 40px;
            max-width: 200px;
        }
        
        .error-container .logo-container img {
            width: 100%;
            height: auto;
        }
        
        .error-container h1 {
            font-size: 5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #222222;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        .error-container h2 {
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 30px;
            color: #444444;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        .error-container p {
            max-width: 500px;
            margin-bottom: 40px;
            color: #666666;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        .error-container .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #222222;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        .error-container .btn:hover {
            background-color: #000000;
            transform: translateY(-2px);
        }
        
        @media (max-width: 600px) {
            .error-container h1 {
                font-size: 3rem;
            }
            
            .error-container h2 {
                font-size: 1.2rem;
            }
        }
    </style>
<body>
    <div class="error-container">
        <div class="teks404">
            <h1>404</h1>
            <h2>Halaman Tidak Ditemukan</h2>
            <p>Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin telah dipindahkan atau dihapus.</p>
            <a href="/" class="btn">Kembali ke Beranda</a>
        </div>
    </div>
</body>
@include('partials.footer')