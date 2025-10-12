<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Portal Berita Terkini</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts dari Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    {{-- Kode CSS untuk Tampilan Baru --}}
    <style>
        :root {
            --primary-color: #004c75;
            --secondary-color: #fca311;
            --text-dark: #1f2937;
            --text-light: #f9fafb;
            --bg-light: #f9fafb;
            --bg-dark: #111827;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        .dark body {
            background-color: var(--bg-dark);
            color: var(--text-light);
        }

        /* Navigasi */
        .main-nav {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .dark .main-nav {
            background-color: #1f2937;
            /* gray-800 */
        }

        .nav-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .nav-links a {
            margin-left: 1.5rem;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        .dark .nav-links a {
            color: var(--text-light);
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        /* Slideshow */
        .slideshow-container {
            max-width: 1200px;
            position: relative;
            margin: 2rem auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .mySlides {
            display: none;
        }

        .mySlides img {
            width: 100%;
            height: 450px;
            object-fit: cover;
            filter: brightness(0.8);
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: background-color 0.3s ease;
            border-radius: 50%;
            user-select: none;
            background: rgba(0, 0, 0, 0.3);
        }

        .prev {
            left: 15px;
        }

        .next {
            right: 15px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .text {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            padding: 20px;
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: left;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .dot {
            cursor: pointer;
            height: 10px;
            width: 10px;
            margin: 0 4px;
            background-color: #ccc;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.3s;
        }

        .dot.active,
        .dot:hover {
            background-color: var(--primary-color);
            transform: scale(1.2);
        }

        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        /* Main Layout */
        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
        }

        @media (min-width: 1024px) {
            .main-container {
                grid-template-columns: 3fr 1fr;
            }
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--secondary-color);
            display: inline-block;
        }

        /* Sidebar */
        .sidebar .trending-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 4px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .trending-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 15px;
        }

        .dark .trending-item {
            border-color: #374151;
        }

        .trending-item:last-child {
            border-bottom: none;
        }

        .trending-number {
            color: #d1d5db;
            /* gray-300 */
            font-weight: 700;
            font-size: 1.5rem;
            line-height: 1;
            min-width: 30px;
            text-align: center;
        }

        .dark .trending-number {
            color: #4b5563;
            /* gray-600 */
        }

        .trending-link {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .dark .trending-link {
            color: var(--text-light);
        }

        .trending-link:hover {
            color: var(--primary-color);
        }

        /* Post Grid */
        .post-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .post-card {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .dark .post-card {
            background: #1f2937;
        }

        /* gray-800 */

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .post-card-content {
            padding: 1rem;
        }

        .post-category {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .post-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .post-meta {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #6b7280;
            font-size: 0.8rem;
        }

        .dark .post-meta {
            color: #9ca3af;
        }

        /* General links */
        a {
            text-decoration: none;
            color: inherit;
        }

        .caption-content a {
            color: var(--primary-color);
            text-decoration: underline;
        }

        .dark .caption-content a {
            color: #60a5fa;
        }
    </style>
</head>

<body class="antialiased text-gray-800 dark:text-gray-200">
    <nav class="main-nav">
        <div class="nav-container">
            <div class="nav-logo">Portal Berita</div>
            <div class="nav-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ route('advertorial.page') }}">Advertorial</a>
                <a href="#">Kontak</a>
            </div>
        </div>
    </nav>

    @if ($konten && count($konten) > 0)
        <!-- 🔥 HEADLINE DENGAN SLIDESHOW DINAMIS -->
        <div class="slideshow-container">
            @foreach (collect($konten)->take(3) as $k)
                <div class="mySlides fade">
                    {{-- <div class="numbertext">{{ $loop->iteration }} / 3</div> --}}
                    {{-- PERUBAHAN: Tautan slideshow juga mengarah ke halaman advertorial --}}
                    <a href="{{ route('advertorial.page', ['post' => $k->id]) }}">
                        <img src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}">
                        <div class="text">{{ $k->judul }}</div>
                    </a>
                </div>
            @endforeach

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <div style="text-align:center; margin-top: 1rem;">
            @foreach (collect($konten)->take(3) as $item)
                <span class="dot" onclick="currentSlide({{ $loop->iteration }})"></span>
            @endforeach
        </div>
    @endif

    <main class="main-container">
        <!-- KONTEN UTAMA -->
        <section class="content-main">
            <h2 class="section-title">Postingan Terbaru</h2>
            <div class="post-grid">
                @forelse ($konten as $k)
                    {{-- PERUBAHAN: Tautan post-card kembali ke route advertorial.page --}}
                    <a href="{{ route('advertorial.page', ['post' => $k->id]) }}" class="post-card">
                        <img src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}"
                            class="w-full h-48 object-cover">
                        <div class="post-card-content">
                            <span class="post-category">Berita</span>
                            <h3 class="post-title line-clamp-2">{{ $k->judul }}</h3>
                            <div class="post-meta">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center py-10 text-gray-500">Tidak ada postingan yang dapat ditampilkan.
                    </p>
                @endforelse
            </div>
        </section>

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <h3 class="trending-title">TRENDING</h3>
            @forelse (collect($konten)->take(6) as $k)
                <div class="trending-item">
                    <div class="trending-number">{{ $loop->iteration }}</div>
                    {{-- PERUBAHAN: Tautan trending kembali ke route advertorial.page --}}
                    <a href="{{ route('advertorial.page', ['post' => $k->id]) }}" class="trending-link"
                        data-title="{{ $k->judul }}">
                        {{ $k->judul }}
                    </a>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada konten trending.</p>
            @endforelse
        </aside>
    </main>

    <footer class="mt-16 text-center text-sm text-gray-500 dark:text-gray-400 py-6 border-t dark:border-gray-800">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (slides.length === 0) return;
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
        setInterval(() => {
            plusSlides(1);
        }, 5000);
    </script>
</body>

</html>
