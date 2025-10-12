<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts dari Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    {{-- Kode CSS yang sebelumnya ada di @push('styles') --}}
    <style>
        * {
            box-sizing: border-box
        }

        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
        }

        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
            overflow: hidden;
            border-radius: 8px;
        }

        .mySlides {
            display: none;
        }

        .mySlides img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background: rgba(0, 0, 0, 0.2);
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .text {
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            padding: 8px 12px;
            position: absolute;
            bottom: 12px;
            left: 0;
            right: 0;
            text-align: center;
            background: rgba(0, 0, 0, 0.4);
        }

        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        .dot {
            cursor: pointer;
            height: 12px;
            width: 12px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .dot.active,
        .dot:hover {
            background-color: #333;
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

        .main-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
            display: grid;
            grid-template-columns: 3fr 1fr;
            gap: 20px;
        }

        .sidebar {
            width: 100%;
        }

        .trending-title {
            font-style: italic;
            font-weight: 600;
            color: #004c75;
            border-bottom: 2px solid #004c75;
            padding-bottom: 4px;
            margin-bottom: 15px;
        }

        .trending-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 12px;
            cursor: pointer;
        }

        .trending-item:hover .trending-number,
        .trending-item:hover .trending-link {
            color: #002ac0;
        }

        .trending-number {
            color: #000;
            font-weight: 700;
            font-size: 20px;
            width: 35px;
            text-align: center;
        }

        .trending-link {
            color: #000;
            text-decoration: none;
            font-weight: 600;
        }

        .post-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .post-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .post-card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .post-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .post-title:hover {
            color: #004c75;
        }

        .post-views {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 1024px) {
            .main-container {
                grid-template-columns: 2fr 1fr;
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .main-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .mySlides img {
                height: 250px;
            }
        }
    </style>
</head>

<body class="antialiased bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <header class="py-6 text-center">
        <h1 class="text-4xl font-bold">Selamat Datang di Portal Berita</h1>
    </header>

    <main class="main-container">
        <!-- KONTEN UTAMA -->
        <section class="content-main">
            {{-- Pastikan ada data konten sebelum menampilkan slideshow --}}
            @if ($konten && count($konten) > 0)
                <!-- 🔥 HEADLINE DENGAN SLIDESHOW DINAMIS -->
                <div class="mb-8">
                    <div class="slideshow-container">
                        {{-- Ambil 3 konten pertama untuk slideshow --}}
                        @foreach (collect($konten)->take(3) as $item)
                            @php $slide = (object) $item; @endphp
                            <div class="mySlides fade">
                                <div class="numbertext">{{ $loop->iteration }} / 3</div>
                                {{-- Gunakan gambar_url dari accessor --}}
                                <img src="{{ $slide->gambar_url }}" alt="{{ $slide->judul }}" style="width:100%">
                                <div class="text">{{ $slide->judul }}</div>
                            </div>
                        @endforeach

                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>

                    <div style="text-align:center; margin-top: 10px;">
                        @foreach (collect($konten)->take(3) as $item)
                            <span class="dot" onclick="currentSlide({{ $loop->iteration }})"></span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Postingan Terbaru -->
            <section class="max-w-6xl mx-auto">
                <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Postingan Terbaru</h2>

                <div class="post-grid">
                    @forelse ($konten as $item)
                        @php $post = (object) $item; @endphp
                        <div
                            class="post-card bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                            {{-- Arahkan ke halaman detail dengan ID konten --}}
                            <a href="{{route('advertorial.page')?post={{ $post->id }}" class="block"}}>
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ $post->gambar_url }}" alt="{{ $post->judul }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <h3 class="post-title font-semibold text-lg mb-2 line-clamp-2">
                                        {{ $post->judul }}
                                    </h3>
                                    <div class="post-views flex items-center text-gray-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>Views : {{ $post->views ?? '1.2K' }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="col-span-full text-center py-10">Tidak ada postingan yang dapat ditampilkan saat ini.
                        </p>
                    @endforelse
                </div>
            </section>
        </section>

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <h3 class="trending-title">TRENDING</h3>

            {{-- Ambil 6 konten pertama untuk daftar trending --}}
            @forelse (collect($konten)->take(6) as $item)
                @php $trending = (object) $item; @endphp
                <div class="trending-item">
                    <div class="trending-number">{{ $loop->iteration }}</div>
                    <a href="route('advertorial.page')?post={{ $trending->id }}" class="trending-link"
                        data-title="{{ $trending->judul }}">
                        {{ $trending->judul }}
                    </a>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada konten trending.</p>
            @endforelse
        </aside>
    </main>

    <footer class="mt-16 text-center text-sm text-gray-500 dark:text-gray-400 py-4">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>


    {{-- Kode JavaScript yang sebelumnya ada di @push('scripts') --}}
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
            if (slides.length === 0) return; // Hentikan jika tidak ada slide

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

        // Auto-slide setiap 5 detik
        setInterval(() => {
            plusSlides(1);
        }, 5000);
    </script>

</body>

</html>
